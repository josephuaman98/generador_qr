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
                        <h2 class="content-header-title float-start mb-0">Deportista</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Deportista</a></li>
                                <li class="breadcrumb-item active">Crear a un Deportista</li>
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
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Registrar un Nuevo Deportista</h4>
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('usuarios.index') }}">Regresar</a>
                            </div>
                            <div class="card-body">
                                <form id="alertFormulario" action="{{ route('usuarios.store') }}" method="POST">
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
                                        <div class="container mt-0">
                                            <section id="multiple-column-form">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Nombre</label>
                                                                            <input type="text" id="name" class="form-control" name="name" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Genero</label>
                                                                            <input type="text" id="apellido_paterno" class="form-control" name="apellido_paterno" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-12">
                                                                        <div class="mb-1">
                                                                            <label class="form-label" for="name">Telefono</label>
                                                                            <input type="text" id="apellido_materno" class="form-control" name="apellido_materno" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-1">
                                                                        <div class="form-group mb-2">
                                                                            <label for="roles">promocion</label>
                                                                            <select id="promocion" name="promocion" class="form-select" required>
                                                                                <option value="" disabled selected>Seleccione</option>
                                                                                @foreach ($promocion as $promocion)
                                                                                    <option value="{{ $promocion->id }}">{{ $promocion->nombre }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="col-md-12 col-1">
                                                                        <div class="form-group">
                                                                            <label for="roles">Roles</label>
                                                                            <select id="roles" name="roles[]" class="form-select" required>
                                                                                <option value="" disabled selected>Seleccione</option>
                                                                                {{-- @foreach ($roles as $roleName)
                                                                                    @if ($roleName !== 'Administrado')
                                                                                        <option value="{{ $roleName }}">{{ $roleName }}</option>
                                                                                    @endif
                                                                                @endforeach --}}

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                                        <button type="reset" class="btn btn-outline-secondary waves-effect">Resetear</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
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
<script>
    // Selecciona el elemento <select> por su ID
    const selectPromocion = document.getElementById('promocion');

    // Agrega un evento 'change' al <select>
    selectPromocion.addEventListener('change', function() {
        // Obtiene el valor seleccionado (id)
        const selectedValue = this.value;
        
        // Obtiene el texto de la opción seleccionada (nombre)
        const selectedText = this.options[this.selectedIndex].text;
        
        // Muestra el valor y el nombre en la consola
        console.log('ID seleccionado:', selectedValue);
        console.log('Nombre seleccionado:', selectedText);
    });
</script>
@endsection