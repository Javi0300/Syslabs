<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title> Reporte </title>
    </head>

    <body>
        <style>
            *{
                margin: 0 auto;
            }
            table td {
                font-size: 12px;
                height: 10px;
            }
        </style>

<table style="width: 95%">
    <thead>
        <tr>                                 
            <th scope="col" style="width: 30%;"><center><img style="width: 100%;" src="{{ public_path('img/Logoinadware0001.png') }}" alt="" ></center></th>
            <th scope="col" style="width: 5%;"></th>
            <th scope="col" style="width: 5%;"></th>
            
            <th style="width: 50%;"><h5 style="display:inline;font-family:Arial, Helvetica, sans-serif; font-weight:normal;"><b>Empresa Pruebas, S.A de C.V</b><p style="display:inline; color:white;">____________________________________</p></h5>
                <h6 style="display:inline; font-family:Arial, Helvetica, sans-serif;font-weight:normal;"><b>RFC:{{$cfdi->CFDIRFC}}</b><p style="display:inline; color:white;">_____________________________________________________</p></h6>
                <h6 style="font-size: 12px; display:inline;font-family:Arial, Helvetica, sans-serif;font-weight:normal;">{{$cfdi->CFDIFCALLE}} {{$cfdi->CFDIFNEXT}} {{$cfdi->CFDIFNINT}} {{$cfdi->CFDIFCOL}} Tel: {{$cfdi->CFDITEL}}</h6>
                <h6 style="font-family:Arial, Helvetica, sans-serif;font-weight:normal;">Suc. {{$cfdi->CFDISUCURSAL}} {{$cfdi->CFDIFMUNICIPIO}}, {{$cfdi->CFDIFESTADO}}, {{$cfdi->CFDIFPAIS}}</h6>
            </th>
            <th scope="col" style="width: 10%;">
                <img style="margin-top: -50px;width: 100%;" src="{{ public_path('img/Diagrama_Codigo_de_Barras_GS1_Mexico_750-1-e1629484192646.png') }}" alt="" >
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>


               <h5 style="font-weight:normal;font-family:Arial, Helvetica, sans-serif;" class="float-center d-none d-sm-block">
                <b>LABORATORIO DE ANÁLISIS CLÍNICOS</b>
               </h5>

            </td>
        </tr>
    </tbody>
</table>

        <br>
        
        <table id="pacientes" class="table table-striped" style="width: 95%;">
            <thead class="thead">
                <tr> 
                    <th style="widows: 10%;" scope="col">Paciente</th>
                    <th style="widows: 10%;" scope="col">Fecha de Nacimiento</th>
                    <th style="widows: 5%;" scope="col">Sexo</th>
                    <th style="widows: 30%;" scope="col"><center>Domicilio</center></th>
                    <th style="widows: 5%;" scope="col">C.P</th>
                    <th style="widows: 10%;" scope="col">Estado</th>
                    <th style="widows: 10%;"scope="col">Municipio</th>
                    <th style="widows: 10%;" scope="col">Teléfono</th>
                    <th style="widows: 10%;" scope="col">E-mail</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($pacientes as $paciente)
                <tr>
                    
                    <td style="height: 10px;width:10;">{{ $paciente->Paciente }}</td>
                    <td style="height: 10px;">{{ date('d/m/Y', strtotime($paciente->FecNac)) }}</td>
                    @if($paciente->Sexo === "H")
                    <td style="height: 10px;width:10;"><center>{{ $paciente->Sexo = "Hombre" }}</center></td>
                    @endif
                    @if($paciente->Sexo === "M")
                    <td style="height: 10px;width:10;"><center>{{ $paciente->Sexo = "Mujer" }}</center></td>
                    @endif
                    <td style="height: 10px;">{{$paciente->Calle}} {{$paciente->Numero}} {{ $paciente->Colonia }}</td>
                    <td style="width:20;">{{$paciente->Cp}}</td>
                    <td style="height: 10px;">{{$paciente->Estado}}</td>
                    <td style="height: 10px;">{{$paciente->Municipio}}</td>
                    <td style="height: 10px;">{{$paciente->Telefono}}</td>
                    <td style="height: 10px;">{{$paciente->email}}</td>
                </tr>
                @endforeach
            </tbody>
        
        </table>
        <br>
        <footer>
            <br>
            <br>
            <table style="width: 80%">
                    <thead>
                        <tr>
                            <th style="width: 30%;"></th>
                            <th style="width: 45%;font-weight: normal; font-size: 14px;">
                                Software para laboratorios clínicos | www.laboratorios-clinicos.com
                            </th>
                            <th style="width: 33.3%;">
                                <b style="font-size: 11px;">Powered by: </b>
                                <img src="{{ public_path('img/logo_syslabs_Horizontal.png') }}" style="width: 27%;">
                            </th>            
                        </tr>    
                    </thead>
            </table>
        </footer>
 
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     </body>
</html>

<script>

</script>