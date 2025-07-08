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
                                
                                <form id="cart-form" action="{{route('enviarPrueba')}}" method="POST">
                                    @csrf
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                    Código</th>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                    Fecha</th>
                                                <th
                                                    style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                    Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-container">
                                            @foreach ($valoresPrueba as $index => $valor)
                                                <tr id="row-{{ $index }}">
                                                    <td
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                        {{ $valor->id_externo }}</td>
                                                    <td
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                        {{$valor->deuda_id}}</td>
                                                    <td
                                                        style="padding-left: 10px; padding-right: 10px; font-size:11px; text-align:center">
                                                        S/ <span class="amount"
                                                            data-amount="{{ $valor->insoluto }}">{{ $valor->insoluto }}</span>
                                                    </td>
                                                    <input type="text" name="ids[]" value="{{ $valor->deuda_id }}">
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div>
                                        <button type="submit" class="btn btn-primary">Pagar</button>
                                    </div>
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
