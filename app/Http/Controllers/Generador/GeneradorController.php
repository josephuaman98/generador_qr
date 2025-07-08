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
            WHERE g.user_id = ?
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
        // Validación
        $request->validate([
            'link_qr' => 'required|url',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        // Generar QR con BaconQrCode
        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrSvg = $writer->writeString($request->link_qr); // SVG como string

        // Guardar el archivo SVG en storage
        $qrFileName = 'qr-codes/' . Str::uuid() . '.svg';
        Storage::disk('public')->put($qrFileName, $qrSvg);

        // Obtener la URL pública
        $qrPublicUrl = Storage::url($qrFileName); // /storage/qr-codes/xxxx.svg

        // Guardar en la base de datos
        Generador::create([
            'imagen_ruta_qr' => $qrPublicUrl,
            'link_qr' => $request->link_qr,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->id(),
            'estado' => $request->estado,
        ]);

        return redirect()->route('generador.index')
                        ->with('success', 'QR generado exitosamente');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
