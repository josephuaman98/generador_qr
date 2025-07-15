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
                        <h2 class="content-header-title float-start mb-0">Código QR</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('generador.index') }}">QR</a></li>
                                <li class="breadcrumb-item active">Crear QR</li>
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
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title flex-grow-1 text-center m-0">Generar Nuevo Código QR</h4>
                                <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('generador.index') }}">Regresar</a>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('generador.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        @if ($errors->any())
                                            <div class="alert alert-danger text-center">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="link_qr">Enlace para el QR</label>
                                                <input type="url" id="link_qr" name="link_qr" class="form-control" placeholder="https://ejemplo.com" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="descripcion">Descripción (opcional)</label>
                                                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Descripción breve del QR"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="estado">Estado</label>
                                                <select name="estado" id="estado" class="form-select" required>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <button type="submit" class="btn btn-primary">Guardar QR</button>
                                            <button type="reset" class="btn btn-outline-secondary">Resetear</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section>
        </div> <!-- /.content-body -->
    </div> <!-- /.content-wrapper -->
</div> <!-- /.app-content -->

@endsection
