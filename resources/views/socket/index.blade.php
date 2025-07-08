@extends('plantilla.layouts.panel')

@section('panel_blanco')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">WEB SOCKET</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Socket</a></li>
                                    <li class="breadcrumb-item active">registro</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="input-mask-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="display: flex; align-items: center;">
                                    {{-- <a class="btn btn-primary" href="{{ route('libros.create') }}" role="button">REGISTRAR</a> --}}
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            @if ($errors->any())
                                                <div class="alert alert-dismissible alert-danger fade show text-center" role="alert">
                                                    <ul class="error-list">
                                                        @foreach ($errors->all() as $error)
                                                            <li class="">{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                    <button type="button" class="btn-close mb-2" data-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NOMBRE</th>
                                                        <th>CANTIDAD</th>
                                                        <th>ACCION</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="libros-table-body">
                                                    @foreach ($libros as $libro)
                                                        <tr id="socket-{{ $libro->id }}">
                                                            <td>{{ $libro->id }}</td>
                                                            <td class="socket-nombre">{{ $libro->nombre }}</td>
                                                            <td class="socket-cantidad">{{ $libro->cantidad }}</td>
                                                            <td>
                                                                <a href="{{ route('socket.edit', $libro->id) }}" class="btn btn-primary">Editar Socket</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/app.js')

   <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Echo !== 'undefined') {
            console.log('Echo está definido');

            Echo.channel('items-socket')
                .listen('.SocketUpdated', (event) => {
                    console.log('Evento recibido:', event);

                    const libroRow = document.getElementById(`socket-${event.socket_id}`);
                    if (libroRow) {
                        libroRow.querySelector('.socket-nombre').innerText = event.socket_nombre;
                        libroRow.querySelector('.socket-cantidad').innerText = event.socket_cantidad;
                    } else {
                        const newRow = document.createElement('tr');
                        newRow.id = `socket-${event.socket_id}`;
                        newRow.innerHTML = `
                            <td>${event.socket_id}</td>
                            <td class="socket-nombre">${event.socket_nombre}</td>
                            <td class="socket-cantidad">${event.socket_cantidad}</td>
                            <td>
                                <a href="{{ url('socket/edit') }}/${event.socket_id}" class="btn btn-primary">Editar Socket</a>
                            </td>
                        `;
                        document.getElementById('libros-table-body').appendChild(newRow);
                    }
                });

            Echo.connector.pusher.connection.bind('connected', function() {
                console.log('WebSocket está conectado');
            });

            Echo.connector.pusher.connection.bind('disconnected', function() {
                console.log('WebSocket está desconectado');
            });

            Echo.connector.pusher.connection.bind('error', function(err) {
                console.error('Error en la conexión de WebSocket:', err);
            });
        } else {
            console.error('Echo no está definido. Verifica tu configuración.');
        }
    });
</script>

@endsection
