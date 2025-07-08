@extends('plantilla.layouts.panel')

@section('panel_blanco')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Editar Usuario</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Usuario</a></li>
                                <li class="breadcrumb-item active">Editar Usuario</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Input Mask start -->
            <section id="input-mask-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; justify-content: center; align-items: center;">
                                <a class="btn btn-primary" href="{{ route('socket.index') }}"
                                        role="button">atras</a>
                            </div>

                            @if ($errors->any())                                                
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>                        
                                    @foreach ($errors->all() as $error)                                    
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach                        
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif


                            <div class="card-body">
    <form action="{{ route('socket.update', $libro->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre" value="{{ old('nombre', $libro->nombre) }}">
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese la cantidad" value="{{ old('cantidad', $libro->cantidad) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Mask End -->
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection


@section('scripts')
    @vite('resources/js/app.js')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Echo !== 'undefined') {
            console.log('El paquete Laravel-Echo está configurado Correctamente');
            
            Echo.channel('items-socket')
                .listen('.SocketUpdated', (event) => {
                    console.log('Evento recibido:', event);

                    const nombre = document.getElementById('nombre');
                    const cantidad = document.getElementById('cantidad');
                    nombre.value = event.socket_nombre;
                    cantidad.value = event.socket_cantidad;
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
            console.error('El paquete Laravel-Echo NO está configurado Correctamente');
        }
    });
</script>

@endsection

