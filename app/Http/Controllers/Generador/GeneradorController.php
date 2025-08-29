<?php

namespace App\Http\Controllers\Generador;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Generador;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

use Imagick;
use ImagickDraw;

class GeneradorController extends Controller
{

    public function index(Request $request)
{
    $userId = auth()->id();
    $search = $request->input('search');
    $perPage = (int)$request->input('perPage', 5); // Forzar tipo entero
    $sort = $request->input('sort', 'g.id');
    $direction = $request->input('direction', 'asc');

    $query = "
        SELECT
            g.id,
            g.imagen_ruta_qr,
            g.link_qr,
            g.descripcion,
            g.estado,
            g.created_at,
            u.name as usuario_nombre
        FROM generadors g
        INNER JOIN users u ON u.id = g.user_id
        WHERE g.user_id = ? and g.estado = 1
    ";

    $params = [$userId];

    if ($search) {
        $query .= " AND (g.descripcion LIKE ? OR g.link_qr LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $query .= " ORDER BY $sort $direction";

    // Obtener todos los resultados
    $results = DB::select($query, $params);

    // Convertir a colección
    $itemCollection = collect($results);

    // Paginar manualmente
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

    // Crear paginador con todos los parámetros
    $paginatedItems = new LengthAwarePaginator(
        $currentPageItems,
        $itemCollection->count(),
        $perPage,
        $currentPage,
        [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => [
                'search' => $search,
                'perPage' => $perPage,
                'sort' => $sort,
                'direction' => $direction
            ]
        ]
    );

    if ($request->ajax()) {
        return response()->json([
            'html' => view('generador.index_table', ['paginatedItems' => $paginatedItems])->render(),
            'pagination' => $paginatedItems->appends([
                'search' => $search,
                'perPage' => $perPage,
                'sort' => $sort,
                'direction' => $direction
            ])->links()->render()
        ]);
    }

    return view('generador.index', compact('paginatedItems', 'search', 'perPage', 'sort', 'direction'));
}

    public function create()
    {
        $areas = Area::all();
        return view('generador.create', compact('areas'));
    }


public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'link_qr' => 'required|url',
            'descripcion' => 'nullable|string',
            'estado' => 'required|boolean',
            'con_logo' => 'required|boolean',
        ]);

        try {
            // 1. Configuración del QR
            $qrSize = 600;
            $margin = 1;

            // 2. Generar el QR base
            $renderer = new ImageRenderer(
                new RendererStyle($qrSize, $margin),
                new ImagickImageBackEnd()
            );

            $writer = new Writer($renderer);
            $imagick = new Imagick();
            $imagick->readImageBlob($writer->writeString($request->link_qr));
            $imagick->setImageFormat('png');

            // 3. SOLO PROCESAR LOGO SI SE SELECCIONÓ LA OPCIÓN
            if ($request->con_logo == 1) {
                $emptySpaceRatio = 0.17;
                $logoPath = public_path('images/imagenes/logo_muni_lavictoria2.png');

                if (!file_exists($logoPath)) {
                    throw new \Exception("El logo no se encontró en: $logoPath");
                }

                $logo = new Imagick($logoPath);
                $logo->setImageColorspace(Imagick::COLORSPACE_SRGB);
                $logo->transformImageColorspace(Imagick::COLORSPACE_SRGB);
                $logo->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

                // 4. Ajustar tamaño del logo
                $qrWidth = $imagick->getImageWidth();
                $logoSize = (int)($qrWidth * $emptySpaceRatio);

                // Redimensionamiento óptimo para color
                $logo->resizeImage($logoSize, $logoSize, Imagick::FILTER_LANCZOS, 1, true);

                // 5. Crear espacio blanco para el logo
                $x = (int)(($qrWidth - $logoSize) / 2);
                $y = (int)(($qrWidth - $logoSize) / 2);

                $draw = new ImagickDraw();
                $draw->setFillColor('white');
                $draw->rectangle($x, $y, $x + $logoSize, $y + $logoSize);
                $imagick->drawImage($draw);

                // 6. Superposición que mantiene colores
                $imagick->setImageColorspace(Imagick::COLORSPACE_SRGB);
                $imagick->compositeImage($logo, Imagick::COMPOSITE_ATOP, $x, $y);
            }

            // 7. Optimización final
            $imagick->setImageCompressionQuality(100);
            $imagick->setImageFormat('png');
            $imagick->stripImage();

            // 8. Guardar el archivo
            $filename = 'qr-codes/' . Str::uuid() . '.png';
            Storage::disk('public')->makeDirectory('qr-codes');
            Storage::disk('public')->put($filename, $imagick->getImageBlob());

            // 9. Guardar en la base de datos (con la opción de logo)
            Generador::create([
                'imagen_ruta_qr' => Storage::url($filename),
                'link_qr' => $request->link_qr,
                'descripcion' => $request->descripcion,
                'user_id' => auth()->id(),
                'estado' => $request->estado,
                'area_id' => $request->area_id, // **¡CAMBIO AÑADIDO!**
                'con_logo' => $request->con_logo, // **OPCIONAL**
            ]);

            // Mensaje según la opción elegida
            $message = $request->con_logo == 1
                ? 'QR con logo municipal generado correctamente.'
                : 'QR sin logo generado correctamente.';

            return redirect()->route('generador.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el QR: ' . $e->getMessage());
        }
    }


}
