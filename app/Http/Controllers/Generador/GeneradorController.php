<?php

namespace App\Http\Controllers\Generador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generador;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Imagick;
use ImagickDraw; // ✅ AGREGA ESTA LÍNEA




class GeneradorController extends Controller
{

    public function index(Request $request)
    {
        $userId = auth()->id();
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);
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

        $results = DB::select($query, $params);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($results);
        $currentPageItems = $itemCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        if ($request->ajax()) {
            return response()->json([
                'html' => view('generador.index_table', compact('paginatedItems'))->render(),
                'pagination' => $paginatedItems->links()->render()
            ]);
        }

        return view('generador.index', compact('paginatedItems', 'search', 'perPage', 'sort', 'direction'));
    }

    public function create()
    {
        return view('generador.create');
    }



public function store(Request $request)
{
    // 1. Validación
    $request->validate([
        'link_qr' => 'required|url',
        'descripcion' => 'nullable|string',
        'estado' => 'required|boolean',
    ]);

    // 2. Generar QR en PNG (blob)
    $qrImage = \QrCode::format('png')
        ->size(500)
        ->margin(2)
        ->generate($request->link_qr);

    // 3. Crear QR como objeto Imagick
    $qr = new Imagick();
    $qr->readImageBlob($qrImage);
    $qr->setImageColorspace(Imagick::COLORSPACE_RGB);
    $qr->setImageType(Imagick::IMGTYPE_TRUECOLOR);

    // 4. Cargar logo (a color)
    $logoPath = public_path('images/imagenes/logo_muni_lavictoria2.png');
    if (!file_exists($logoPath)) {
        return back()->with('error', 'Logo no encontrado.');
    }

    $logo = new Imagick($logoPath);
    $logo->setImageColorspace(Imagick::COLORSPACE_RGB);
    $logo->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

    // 5. Redimensionar logo (20% del tamaño del QR)
    $qrWidth = $qr->getImageWidth();
    $qrHeight = $qr->getImageHeight();
    $logoSize = (int)($qrWidth * 0.2);
    $logo->resizeImage($logoSize, $logoSize, Imagick::FILTER_LANCZOS, 1, true);

    // 6. Crear espacio blanco para el logo
    $x = (int)(($qrWidth - $logoSize) / 2);
    $y = (int)(($qrHeight - $logoSize) / 2);

    $draw = new ImagickDraw();
    $draw->setFillColor('white');
    $draw->rectangle($x, $y, $x + $logoSize, $y + $logoSize);
    $qr->drawImage($draw);

    // 7. Colocar el logo en el centro del espacio
    $qr->compositeImage($logo, Imagick::COMPOSITE_OVER, $x, $y);

    // 8. Guardar QR generado
    $filename = 'qr-codes/' . Str::uuid() . '.png';
    Storage::disk('public')->makeDirectory('qr-codes');
    Storage::disk('public')->put($filename, $qr->getImageBlob());

    // 9. Obtener URL pública
    $qrPublicUrl = Storage::url($filename);

    // 10. Guardar en la base de datos
    Generador::create([
        'imagen_ruta_qr' => $qrPublicUrl,
        'link_qr' => $request->link_qr,
        'descripcion' => $request->descripcion,
        'user_id' => auth()->id(),
        'estado' => $request->estado,
    ]);

    return redirect()->route('generador.index')
        ->with('success', 'QR generado exitosamente con logo a color centrado y sin pérdida de escaneabilidad.');
}
}
