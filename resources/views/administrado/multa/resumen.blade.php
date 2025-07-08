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
                            <div class="card-body">
                                

                                        @if (session('niubiz'))
                                            @php
                                                $data = session('niubiz')['response'];
                                                $purchaseNumber = session('niubiz')['purchaseNumber'];
                                            @endphp

                                            {{ $data['data']['ACTION_DESCRIPTION'] }}

                                            Numero de Pedido: {{ $purchaseNumber }}
                                            Fecha y hora del pedido:
                                            {{ now()->createFromFormat('ymdHis', $data['data']['TRANSACTION_DATE'])->format('d/m/Y H:i') }}
                                            Tarjeta: {{ $data['data']['CARD'] }} {{ $data['data']['BRAND'] }}
                                        @endif 
                                   

                                <form id="cart-form" action="" method="POST">
                                    @csrf
                                    



                                    <table class="table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%">Código</th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">Fecha</th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-container">
                                            @if ($valoresFiltrados->isEmpty())
                                                <tr>
                                                    <td colspan="3">No hay deudas agrupadas</td>
                                                </tr>
                                            @else
                                                @foreach ($valoresFiltrados as $id_externo => $grupo)
                                                    <tr>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%">{{ $grupo[0]->id_externo }}</th>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">{{ $grupo[0]->Fecha}}</th>
                                                        <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%">
                                                            S/ {{ $grupo->sum('insoluto') }}
                                                        </th>
                                                    </tr>
                                    
                                                    {{-- Detalles ocultos inicialmente --}}
                                                    <tr class="details" style="display: table-row;">
                                                        <td colspan="3" style="padding-right: 0px; padding-left: 0px">
                                                            <table class="table">
                                                                <tbody>
                                                                    @foreach ($grupo as $deuda)
                                                                        <tr>
                                                                            <th style="padding-left: 10px; padding-right: 10px; font-weight: normal; text-align:center; font-size: 11px; width: 25%">
                                                                                {{ $deuda->codigo_sancion }}
                                                                                <input type="hidden" name="ids[]" value="{{ $deuda->deuda_id }}">
                                                                            </th>
                                                                            <th style="padding-left: 10px; padding-right: 10px; font-weight: normal; text-align:center; font-size: 11px; width: 50%">
                                                                                {{ $deuda->descripcion }}
                                                                            </th>
                                                                            <th style="padding-left: 10px; padding-right: 10px; font-weight: normal; font-size: 11px; text-align: center; width: 25%">
                                                                                S/ {{ $deuda->insoluto }}
                                                                            </th>
                                                                            
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
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%"></th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 50%">Total: </th>
                                                <th style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center; width: 25%">S/ <span id="total" data-current-total="{{ $total }}">{{ $total }}</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>






                                    
                                </form>
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
                                <div class="card-body">
                                    <h2>Resumen</h2>
                                    <hr>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="font-size: 20px">
                                            Total: S/ {{ $total }}
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary" onclick="VisanetCheckout.open()">Pagar</button>
                                        </div>
                                    </div>
                                    
                                    
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


    <script type="text/javascript" src="{{ config('services.niubiz.url_js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
    
            let purchasenumber = Math.floor(Math.random() * 1000);

            const ids = Array.from(document.querySelectorAll('input[name="ids[]"]')).map(input => input.value);
            
            const totalAmount = {{ $total }}; 
    
            VisanetCheckout.configure({
                sessiontoken: '{{ $sessionToken }}',
                channel: 'web',
                merchantid: "{{ config('services.niubiz.merchant_id') }}",
                purchasenumber: purchasenumber,
                amount: 100, 
                expirationminutes: '20',
                timeouturl: "{{ route('dashboard') }}",
                merchantlogo: 'https://web.munisjl.gob.pe/web/images/mdsjl-cambia-contigo.png',
                formbuttoncolor: '#000000',
                action: "{{ route('paid.niubiz') }}" + '?purchasenumber=' + purchasenumber + '&amount=100' + '&ids=' + JSON.stringify(ids), 
                complete: function(params) {
                    alert(JSON.stringify(params));
                }
            });
        });
    </script>

