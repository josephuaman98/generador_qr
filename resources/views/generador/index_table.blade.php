@foreach ($paginatedItems as $qr)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td><img src="{{ asset($qr->imagen_ruta_qr) }}" alt="QR" width="60"></td>
        <td><a href="{{ $qr->link_qr }}" target="_blank">{{ Str::limit($qr->link_qr, 30) }}</a></td>
        <td>{{ $qr->descripcion }}</td>
        <td>{{ $qr->usuario_nombre ?? 'Sin nombre' }}</td>
        <td>
            <span class="badge {{ $qr->estado == 1 ? 'badge-light-success' : 'badge-light-danger' }}">
                {{ $qr->estado == 1 ? 'Activo' : 'Inactivo' }}
            </span>
        </td>
        <td>{{ \Carbon\Carbon::parse($qr->created_at)->format('d/m/Y H:i') }}</td>
        <td>
            <!-- Botón de descarga con nombre personalizado -->
            <a href="{{ asset($qr->imagen_ruta_qr) }}" 
               download="{{ $qr->descripcion ? \Illuminate\Support\Str::slug($qr->descripcion) : 'qr-sin-nombre' }}" 
               class="btn btn-sm btn-outline-primary" 
               title="Descargar QR">
                <i class="fas fa-download"></i>
            </a>
        </td>
    </tr>
@endforeach

@if($paginatedItems->isEmpty())
    <tr>
        <td colspan="8" class="text-center">No se encontraron resultados</td>
    </tr>
@endif