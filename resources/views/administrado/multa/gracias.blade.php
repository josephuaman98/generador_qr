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
                            <h2 class="content-header-title float-start mb-0">DEUDA PAGADA</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Volver</a></li>
                                    <li class="breadcrumb-item active"></li>
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
                                    <div class="alert alert-success" role="alert">
                                        @php
                                            $data = session('niubiz')['response'];
                                            $purchaseNumber = session('niubiz')['purchaseNumber'];
                                        @endphp
                                        <h3>{{$data['dataMap']['ACTION_DESCRIPTION']}}</h3>
                                        <p>Numero de Pedido: {{$purchaseNumber}}</p>
                                        <p>Fecha y hora del pedido: {{now()->createFromFormat('ymdHis', $data['dataMap']['TRANSACTION_DATE'])->format('d/m/Y H:i')}}</p>
                                        <p>Tarjeta: {{$data['dataMap']['CARD']}} {{$data['dataMap']['BRAND']}}</p>
                                        <p>Importe: {{$data['order']['amount']}}</p>
                                        {{-- - {{$data['dataMap']['CURRENCY']}} --}}
                                    </div>  
                                @endif
                                <div>
                                    <a href="{{'dashboard'}}" class="btn btn-primary">Volver</a>
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
