@foreach ($qrs as $qr)
    <tr>
        <td>{{ $qr->id }}</td>
        <td><img src="{{ asset($qr->imagen_ruta_qr) }}" alt="QR" width="60"></td>
        <td><a href="{{ $qr->link_qr }}" target="_blank">{{ $qr->link_qr }}</a></td>
        <td>{{ $qr->descripcion }}</td>
        <td>{{ $qr->usuario_nombre ?? 'Sin nombre' }}</td>
        <td>
            <span class="badge {{ $qr->estado == 1 ? 'badge-light-success' : 'badge-light-danger' }}">
                {{ $qr->estado == 1 ? 'Activo' : 'Inactivo' }}
            </span>
        </td>
        <td>{{ \Carbon\Carbon::parse($qr->created_at)->format('d/m/Y H:i') }}</td>
        <td>
            <a href="{{ asset($qr->imagen_ruta_qr) }}" download class="btn btn-sm btn-outline-primary" title="Descargar QR">
                <i class="fas fa-download"></i>
            </a>
        </td>
    </tr>
@endforeach
