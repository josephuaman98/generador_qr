<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .margenes {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .font-subtitulo {
            font-size: 11px;
            text-align: left;
            padding-left: 7px;
            padding-right: 5px;
            width: 31%;
            padding-bottom: 5px;
        }

        .font-tituloPago {
            font-size: 11px;
            text-align: left;
            padding-left: 5px;
            padding-right: 5px;
            width: 31%;
            padding-bottom: 5px;
        }

        .font-tituloCuadro {
            font-size: 11px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            width: 31%;
            padding-bottom: 5px;
        }

        .font-descripcionPago {
            font-size: 10px;
            text-align: center;
            width: 50%;
            font-weight: normal;
            /* Asegúrate que no esté en negrita */
            padding-right: 0px;
            /* Añade espacio a la derecha */
        }

        .font-descripcion {
            font-size: 12px;
            text-align: left;
            width: 50%;
            font-weight: normal;
            padding-right: 20px;
            padding-bottom: 5px;
        }

        .font-pagoFinal {
            font-size: 10px;
            text-align: center;
            width: 50%;
            font-weight: normal;
            padding-right: opx;
        }

        .font-montoLetras {
            font-size: 10px;
            text-align: left;
            padding-left: 7px;
            width: 50%;
            font-weight: normal;
            padding-right: 20px;
        }

        .font-montoPagar {
            font-size: 11px;
            text-align: left;
            padding-left: 7px;
            padding-right: 5px;
            width: 31%;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row justify-content-center mt-0">
                    <div class="col-12 col-sm-8 col-md-6">


                        <div class="card shadow-sm" style="padding-left: 1px">
                            <div style="font-size: 0.9rem;">
                                <center>
                                    <div style="height: 40px"></div>
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/imagenes/sjl_logoBlanco.png'))) }}"
                                        alt="Logo" style="width: 150px; padding-top: 0px">
                                    <p class="margenes" style="font-size: 8px">Lima Peru</p>
                                    <p class="margenes" style="font-size: 8px">20131378034</p>

                                    {{-- <h2 class="margenes" style="font-size: 12px"><strong>BOLETA DE PAGO</strong> 
                                    </h2>--}}
                                    {{-- <h5 class="margenes"><strong>N° ENC0000029</strong></h5> --}}
                                    {{-- <p class="margenes" style="font-size: 8px">(No Conforme)</p> --}}
                                    {{-- <h6 class="margenes" style="font-size: 8px"><strong>RPE N° 162-2023/ATE-PE</strong> 
                                    </h6>--}}
                                    {{-- <h6 class="margenes" style="font-size: 24px"><strong>T.10</strong></h6> --}}
                                    {{-- <p class="margenes" style="font-size: 10px; margin-right: 52px; margin-left: 52px">
                                        Conducir un vehiculo habilitado para prestar el Servicio Publico de Transporte
                                        Especial en la modalidad de taxi sin contar con habilidad de conducir</p> --}}
                                    {{-- <hr> --}}
                                    {{-- <p class="margenes" style="font-size: 10px; margin-right: 42px; margin-left: 42px">
                                        Quienes suscriben la presente acta expresan que los 
                                        fiscalizadores acreditados de la ATU informaron el 
                                        objeto y el sustento legal de la acción de fiscalización 
                                        cumpliendo con lo señalado en la normativa vigente.
                                    </p> --}}
                                </center>

                                <table width="100%" style="padding-top: 20; padding-left: 10px; padding-right: 10px; border-collapse: collapse;">

                                    <thead>
                                        <tr>
                                            <th class="font-tituloPago" colspan="2">Recibo N°:</th>
                                            <td class="font-descripcion" colspan="4">98779898798798798798798</td>
                                        </tr>
                                        <tr>
                                            <th class="font-tituloPago" colspan="2">Código:</th>
                                            <td class="font-descripcion" colspan="4">id persona</td>
                                        </tr>
                                        <tr>
                                            <th class="font-tituloPago" colspan="2">Nombre:</th>
                                            <td class="font-descripcion" colspan="4">Nombre de la persona en negrita</td>
                                        </tr>
                                        <tr>
                                            <th class="font-tituloPago" colspan="2">Dirección:</th>
                                            <td class="font-descripcion" colspan="4">Direccion </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 15px"></td>
                                        </tr>

                                        <tr>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">Concepto</th>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">Ins.</th>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">em</th>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">Int</th>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">Gas.</th>
                                            <th class="font-tituloCuadro" style="border-bottom: 0.5px solid #d3d3d3;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-descripcionPago">MA-2024</td>
                                            <td class="font-descripcionPago">643.75</td>
                                            <td class="font-descripcionPago">0.00</td>
                                            <td class="font-descripcionPago">0.00</td>
                                            <td class="font-descripcionPago">0.00</td>
                                            <td class="font-descripcionPago">643.75</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="font-tituloPago" style="border-top: 0.5px solid #d3d3d3;">Cuotas</td>
                                            <td class="font-descripcionPago" style="border-top: 0.5px solid #d3d3d3;">01</td>
                                            <td colspan="4" style="border-top: 0.5px solid #d3d3d3;"></td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="font-tituloPago">Subtotal:</td>
                                            <td class="font-descripcionPago">0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2" class="font-tituloPago">Total Gen:</td>
                                            <td class="font-descripcionPago">643.75</td>
                                        </tr>
                                        <tr>
                                            <td class="font-subtitulo" >Son:</td>
                                        </tr>
                                        <tr>
                                            <td class="font-montoLetras" colspan="6" style="border-bottom: 0.5px solid #d3d3d3;">SEISCIENTOS CUAREN Y TRES  75/100 SOLES</td>
                                           
                                        </tr>


                                        <tr>
                                            <td style="height: 10px" colspan="6"></td>
                                        </tr>


                                        <tr>
                                            <td class="font-montoPagar" colspan="2">Pagado por:</td>
                                            <td class="font-descripcion" colspan="4">persona id del administrado</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="font-montoPagar" colspan="2">Total Entregado:</td>
                                            <td class="font-pagoFinal">643.75</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th class="font-montoPagar" colspan="2">Total pagado:</th>
                                            <td class="font-pagoFinal">643.75</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th class="font-montoPagar" colspan="2">Vuelto:</th>
                                            <td class="font-pagoFinal">0.00</td>
                                        </tr>

                                        <tr>
                                            <td style="height: 10px"></td>
                                        </tr>

                                        <tr>
                                            <td class="font-montoPagar" colspan="2" style="border-top: 0.5px solid #d3d3d3;">Fecha:</td>
                                            <td class="font-descripcion" colspan="4" style="border-top: 0.5px solid #d3d3d3;">05/10/2024  19:31:15</td>
                                        </tr>
                                        <tr>
                                            <td class="font-montoPagar" colspan="2">Cajero:</td>
                                            <td class="font-descripcion" colspan="4">gnavaez</td>
                                        </tr>
                                        <tr>
                                            <td class="font-montoPagar" colspan="2">Impresión:</td>
                                            <td class="font-descripcion" colspan="4">1</td>
                                        </tr>
                                        <tr>
                                            <td class="font-montoPagar" colspan="2">Forma Pago:</td>
                                            <td class="font-descripcion" colspan="3">Pagos Onine</td>
                                            <td class="font-pagoFinal" colspan="1">643.75</td>
                                        </tr>
                                    </tfoot>

                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
