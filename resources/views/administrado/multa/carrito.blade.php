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
                            <h2 class="content-header-title float-start mb-0">Detalle de Carrito</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Volver</a></li>
                                    <li class="breadcrumb-item active">Carrito</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="padding-left: 6px; padding-right: 6px">
                                <form id="cart-form" id="cart-form" action="{{ route('administrado.carrito.procesar') }}" method="POST">
                                    @csrf
                                    {{-- <p>Total a pagar: S/ <span id="total"
                                            data-current-total="{{ $total }}">{{ $total }}</span></p> --}}

                                    
                                    

                                    {{-- <button type="button" onclick="removeAllItems()">Eliminar todo</button> --}}
                                    
                                    <table class="table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">Código</th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">Fecha</th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">Monto</th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-container">
                                            @if ($valoresFiltrados->isEmpty())
                                                <tr>
                                                    <td colspan="5">No hay deudas agrupadas</td>
                                                </tr>
                                            @else
                                                @foreach ($valoresFiltrados as $id_externo => $grupo)
                                                    <tr onclick="toggleDetails('{{ $id_externo }}')">
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">{{ $grupo[0]->id_externo }}</th>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">{{ $grupo[0]->Fecha}}</th>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%" data-monto="{{ $grupo->sum('insoluto') }}">
                                                            S/ {{ $grupo->sum('insoluto') }}
                                                        </th>
                                                        <th style="padding-left: 10px; padding-right: 10px; text-align:center; width: 10%">
                                                            <input type="hidden" name="ids[]" value="{{ $id_externo }}">
                                                            <button type="button" onclick="removeDebt('{{ $id_externo }}', {{ $grupo->sum('insoluto') }})" class="btn btn-danger" style="padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 5px">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </th>
                                                    </tr>
                                    
                                                    {{-- Detalles ocultos inicialmente --}}
                                                    <tr class="details" id="details-{{ $id_externo }}" style="display: none;">
                                                        <td colspan="5" style="padding-right: 0px; padding-left: 0px">
                                                            <table class="table">
                                                                <tbody>
                                                                    @foreach ($grupo as $deuda)
                                                                        <tr>
                                                                            <th style="padding-left: 10px; padding-right: 10px; text-align:center; font-size: 11px; font-weight: normal; width: 20%">
                                                                                {{ $deuda->codigo_sancion }}
                                                                            </th>
                                                                            <th style="padding-left: 10px; padding-right: 10px; text-align:center; font-size: 10px; font-weight: normal; width: 60%">
                                                                                {{ $deuda->descripcion }}
                                                                            </th>
                                                                            <th style="padding-left: 5px; padding-right: 5px; font-size: 11px; text-align: center; font-weight: normal; width: 20%">
                                                                                S/ {{ $deuda->insoluto }}
                                                                            </th>
                                                                            {{-- <th style="padding-left: 10px; padding-right: 10px; font-size: 11px; text-align: right; width: 10%">
                                                                              
                                                                            </th> --}}
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%"></th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">Total: </th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 20%">S/ <span id="total" data-current-total="{{ $total }}">{{ $total }}</span></th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:right; width: 10%"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    
      
                                    <div style="display:flex; padding-top: 20px">
                                        <input type="checkbox" id="terms" name="terms" onclick="toggleTerminos()">
                                        <span style="padding-left: 5px">Para proceder con el pago es necesario 
                                            que primero lea y acepte los <a href="">términos y condiciones.</a></span>
                                    </div>

                                    <div style="text-align: center; padding-top: 10px; padding-bottom: 0px;">
                                        <button type="submit" class="btn btn-success" id="pay-button" disabled>Pagar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleDetails(idExterno) {
    const detailsRow = document.getElementById(`details-${idExterno}`);
    detailsRow.style.display = (detailsRow.style.display === "none") ? "table-row" : "none";
}

function removeDebt(idExterno, total) {
    // Aquí puedes hacer una llamada AJAX para eliminar la deuda en el backend
    console.log("Eliminar deuda con ID externo:", idExterno);

    // Eliminar la fila del grupo
    const row = document.querySelector(`tr[onclick="toggleDetails('${idExterno}')"]`);
    const detailsRow = document.getElementById(`details-${idExterno}`);
    
    if (row) {
        row.remove(); // Eliminar la fila principal
    }
    if (detailsRow) {
        detailsRow.remove(); // Eliminar la fila de detalles
    }

    // Actualiza el total si es necesario
    let currentTotal = parseFloat(document.getElementById("total").dataset.currentTotal);
    currentTotal -= total;
    document.getElementById("total").innerText = currentTotal.toFixed(2); // Actualiza el total mostrado
    document.getElementById("total").dataset.currentTotal = currentTotal; // Actualiza el total en el dataset
}

function removeDebt(idExterno, total) {
    // Aquí puedes hacer una llamada AJAX para eliminar la deuda en el backend
    console.log("Eliminar deuda con ID externo:", idExterno);

    // Eliminar la fila del grupo
    const row = document.querySelector(`tr[onclick="toggleDetails('${idExterno}')"]`);
    const detailsRow = document.getElementById(`details-${idExterno}`);
    
    if (row) {
        row.remove(); // Eliminar la fila principal
    }
    if (detailsRow) {
        detailsRow.remove(); // Eliminar la fila de detalles
    }

    // Actualiza el total si es necesario
    const totalElement = document.getElementById("total");
    let currentTotal = parseFloat(totalElement.dataset.currentTotal);
    currentTotal -= total; // Resta el monto de la deuda eliminada
    totalElement.innerText = currentTotal.toFixed(2); // Actualiza el total mostrado
    totalElement.dataset.currentTotal = currentTotal; // Actualiza el total en el dataset
}


</script>

<script>
    function toggleTerminos() {
        const boton = document.getElementById('pay-button');
        const checkbox = document.getElementById('terms');
        if(checkbox.checked){
            boton.disabled = false;
        }else{
            boton.disabled = true;
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('cart-form');
        const payButton = document.getElementById('pay-button');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Detiene el envío del formulario inicialmente

            // Deshabilitar el botón de pago para evitar múltiples clics
            payButton.disabled = true;

            // Mostrar el preloader mientras se procesa la solicitud
            Swal.fire({
                title: 'Procesando...',
                text: 'Por favor, espere.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Mostrar preloader
                }
            });

            // Envía el formulario directamente
            form.submit(); 
        });
    });
</script>
