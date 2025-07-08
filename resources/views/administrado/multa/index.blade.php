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
                                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Multa</a></li>
                                    <li class="breadcrumb-item active">Pagar Multa</li>
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
                        No hay items para pagar
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endisset

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="display: flex; align-items: center;">
                                <h4 class="card-title" style="flex: 1; text-align: center; margin: 0;">Multas a Pagar</h4>
                            </div>

                            @if (session('niubiz'))
                                @php
                                    $data = session('niubiz')['response'];
                                    $purchaseNumber = session('niubiz')['purchaseNumber'];
                                @endphp
                                <div class="alert alert-danger" role="alert"
                                    style="padding-left:20px; padding-top:6px; padding-bottom: 6px">
                                    <h3>{{ $data['data']['ACTION_DESCRIPTION'] }}</h3>
                                    <p>Numero de Pedido: {{ $purchaseNumber }}</p>
                                    <p>Fecha y hora del pedido:
                                        {{ now()->createFromFormat('ymdHis', $data['data']['TRANSACTION_DATE'])->format('d/m/Y H:i') }}
                                    </p>
                                    <p>Tarjeta: {{ $data['data']['CARD'] }} {{ $data['data']['BRAND'] }}</p>
                                </div>
                            @endif












                            @isset($valoresFiltrados)
                                <div class="card-body" style="padding-left: 6px; padding-right: 6px">
                                    <p>TOTAL A PAGAR: S/ <span id="total">0</span></p>

                                    <form action="{{ route('administrado.carrito.store') }}" method="POST">
                                        @csrf
                                        <table class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th
                                                        style="padding-left: 8px; padding-right: 0px; font-size:11px; text-align:center; width: 8%;">
                                                        <input type="checkbox" id="selectAll" onclick="toggleAll(this)">
                                                    </th>
                                                    <th
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">
                                                        Código</th>
                                                    <th
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 52%">
                                                        Fecha</th>
                                                    <th
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">
                                                        Total</th>
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
                                                            <th style="padding-left: 8px; padding-right: 0px; font-size:11px; text-align:center"
                                                                onclick="event.stopPropagation();">
                                                                <input type="checkbox" class="group-checkbox"
                                                                    name="items[{{ $loop->index }}]"
                                                                    value="{{ $id_externo }}"
                                                                    onclick="updateTotal('{{ $id_externo }}', this)">
                                                            </th>
                                                            <th
                                                                style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                                {{ $grupo[0]->id_externo }}</th>
                                                            <th
                                                                style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                                {{ $grupo[0]->Fecha }}</th>
                                                            <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center"
                                                                data-monto="{{ $grupo->sum('insoluto') }}">S/
                                                                {{ $grupo->sum('insoluto') }}</th>
                                                        </tr>

                                                        {{-- Detalles ocultos inicialmente --}}
                                                        <tr class="details" id="acciones{{ $id_externo }}"
                                                            style="display: none;">
                                                            <td colspan="4" style="padding-right: 0px; padding-left: 0px">
                                                                <table class="table">
                                                                    <tbody>
                                                                        @foreach ($grupo as $deuda)
                                                                            <tr>
                                                                                <th
                                                                                    style="padding-left: 8px; padding-right: 0px; font-size:11px; width: 8%; text-align:center">
                                                                                </th>
                                                                                <th
                                                                                    style="padding-left: 10px; padding-right: 10px; font-weight: normal; text-align:center; font-size: 11px; width: 20%">
                                                                                    {{ $deuda->codigo_sancion }}</th>
                                                                                <th
                                                                                    style="padding-left: 10px; padding-right: 10px; font-weight: normal; text-align:center; font-size: 10px; width: 52%">
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




                                        @if ($valoresFiltrados->isEmpty())
                                            <div style="text-align: center; padding-top: 10px">
                                                Usted no cuenta con deudas.
                                            </div>
                                        @else
                                        <div style="text-align: center; padding-top: 20px">
                                            <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                                        </div>
                                        @endif
                                    </form>

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
    function updateTotal(id_externo, checkbox) {
        let total = parseFloat(document.getElementById('total').innerText);

        // Obtener el monto desde el atributo data-monto
        const montoGrupo = parseFloat(document.querySelector(
            `tr[onclick="toggleDetails('acciones${id_externo}')"] th[data-monto]`).getAttribute('data-monto'));

        if (checkbox.checked) {
            total += montoGrupo;
        } else {
            total -= montoGrupo;
        }

        document.getElementById('total').innerText = total.toFixed(2);
    }

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

    function toggleAll(selectAllCheckbox) {
        // Obtén todos los checkboxes en el cuerpo de la tabla
        const checkboxes = document.querySelectorAll('#table-container .group-checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox
                .checked; // Marca o desmarca según el estado del checkbox "Seleccionar todo"
            updateTotal(checkbox.value, checkbox); // Actualiza el total cada vez que cambie el estado
        });
    }
</script>
<style>
    .selected {
        background-color: #edfbfefe;
    }
</style>