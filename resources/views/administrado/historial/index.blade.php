@extends('plantilla.layouts.panel')

@section('panel_blanco')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0"></h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Historial</a></li>
                                    <li class="breadcrumb-item active">Historial de Multas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @isset($asd)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="padding: 10px; font-size: 15px">
                        Usted no tiene multas pagadas
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endisset

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center;">
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Historial de Multas
                                </h4>
                            </div>


                            @isset($valoresFiltrados)
                                <div class="card-body" style="padding-left: 6px; padding-right: 6px">
                                    <table class="table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">
                                                    Código</th>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 30px">
                                                    Fecha</th>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 30%">
                                                    Total</th>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">
                                                    Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-container">
                                            @if ($valoresFiltrados->isEmpty())
                                                <tr>
                                                    <td colspan="4" style="text-align: center"></td>
                                                </tr>
                                            @else
                                                @foreach ($valoresFiltrados as $id_externo => $grupo)
                                                    <tr onclick="toggleDetails('acciones{{ $id_externo }}')">
                                                        <th
                                                            style="padding-left: 5px; padding-right: 5px; font-size:11px; text-align:center; width: 20%">
                                                            {{ $grupo[0]->nro_papeleta }}</th>
                                                        <th
                                                            style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 30%">
                                                            {{ $grupo[0]->Fecha }}</th>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 30%"
                                                            data-monto="{{ $grupo->sum('insoluto') }}">S/
                                                            {{ $grupo->sum('insoluto') }}</th>
                                                        <th
                                                            style="padding-left: 5px; padding-right: 5px; font-size:11px; text-align:center; width: 20%">
                                                            {{ $grupo[0]->Estado }}</th>
                                                    </tr>

                                                    {{-- Detalles ocultos inicialmente --}}
                                                    <tr class="details" id="acciones{{ $id_externo }}" style="display: none;">
                                                        <td colspan="4" style="padding-right: 0px; padding-left: 0px">
                                                            <table class="table">
                                                                <tbody>
                                                                    @foreach ($grupo as $deuda)
                                                                        <tr>
                                                                            <th
                                                                                style="padding-left: 5px; padding-right: 5px; font-weight: normal; text-align:center; font-size: 11px; width: 20%">
                                                                                {{ $deuda->codigo_sancion }}</th>
                                                                            <th
                                                                                style="padding-left: 10px; padding-right: 10px; font-weight: normal; text-align:center; font-size: 10px; width: 60%">
                                                                                {{ $deuda->descripcion }}</th>
                                                                            <th
                                                                                style="padding-left: 5px; padding-right: 5px; font-weight: normal; font-size: 11px; text-align: center; width: 20%  ">
                                                                                S/ {{ $deuda->insoluto }}</th>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                </div>
                            @endisset











                            @isset($errores)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div
                                        style="padding-left: 10px; padding-right: 10px; padding-top: 10px; padding-bottom: 10px">
                                        {{ $errores }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function toggleDetails(id_externo) {
        const filaActual = document.getElementById(`${id_externo}`);

        // Verificar si la fila está abierta
        const isVisible = filaActual.style.display === "table-row";

        // Cerrar todas las filas de acciones
        const filasAcciones = document.querySelectorAll('tr[id^="acciones"]');
        filasAcciones.forEach(fila => {
            fila.style.display = "none"; // Cerrar todas las filas abiertas
            fila.previousElementSibling.classList.remove('selected'); // Remover clase de selección
        });

        // Si la fila actual no estaba visible, abrirla
        if (!isVisible) {
            filaActual.style.display = "table-row"; // Mostrar la fila actual
            filaActual.previousElementSibling.classList.add('selected'); // Agregar clase de selección
        }


    }
</script>
<style>
    .selected {
        background-color: #edfbfefe;
    }
</style>
