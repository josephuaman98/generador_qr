@extends('layouts.panel')


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
                            <h2 class="content-header-title float-start mb-0">Pagina Principal</h2>
                            {{-- <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                    </li>
                                    <li class="breadcrumb-item active">Input Mask
                                    </li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Input Mask start -->
                <section id="input-mask-wrapper">
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@if (session('userData'))
                                            <p>Bienvenido, {{ session('userData')->nombres }}</p>
                                            <!-- Mostrar otros datos del usuario si es necesario -->
                                            
                                        @else
                                            <p>No has iniciado sesión.</p>
                                        @endif
                                    </h4>
                                    
                                </div>
                                <div>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="row">
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="credit-card">Credit Card</label>
                                            <input type="text" class="form-control credit-card-mask" placeholder="0000 0000 0000 0000" id="credit-card" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="phone-number">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">US (+1)</span>
                                                <input type="text" class="form-control phone-number-mask" placeholder="1 234 567 8900" id="phone-number" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="date">Date</label>
                                            <input type="text" class="form-control date-mask" placeholder="YYYY-MM-DD" id="date" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="time">Time</label>
                                            <input type="text" class="form-control time-mask" placeholder="hh:mm:ss" id="time" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="numeral-formatting">Numeral formatting</label>
                                            <input type="text" class="form-control numeral-mask" placeholder="10,000" id="numeral-formatting" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="blocks">Blocks</label>
                                            <input type="text" class="form-control block-mask" placeholder="Blocks [4, 3, 3]" id="blocks" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="delimiters">Delimiters</label>
                                            <input type="text" class="form-control delimiter-mask" placeholder="Delimiter: '.'" id="delimiters" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="custom-delimiters">Custom Delimiters</label>
                                            <input type="text" class="form-control custom-delimiter-mask" placeholder="Delimiter: ['.', '.', '-']" id="custom-delimiters" />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="prefix">Prefix</label>
                                            <input type="text" class="form-control prefix-mask" id="prefix" />
                                        </div>
                                    </div> --}}
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
