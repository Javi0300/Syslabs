@extends('adminlte::page')

@section('content_header')
<h1>Configuración del monedero</h1>
@stop

@section('content')
@if($message = Session::get("duplicidad"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message="Datos duplicados. Elimine los registros repetidos."}}</p>
	</div>
@endif
@if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
@endif
<form action="{{route('monedero.store')}}" enctype="multipart/form-data" method="POST">
@csrf
<div class="card">
    <div class="card-body">
        <div class="row">
            @if(is_null($monedero))
            <!----------------------------------------Primera Tarjeta------------------------------------------------------->
            <div class="col-md-9">
                <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <label>Monto Mínimo de Compra</label>
                            </div>
                            <div class="col-6">
                                <input name="minimocompra" type="number" class="form-control" style="width: 100px;">
                                <input name="IdMonedero" hidden readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <label>Porcentaje de  Regalo</label>
                            </div>
                            <div class="col-6">
                                <input name="porcentajeregalo" type="number" class="form-control" style="width: 100px;">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <label>Duración en Meses</label>
                            </div>
                            <div class="col-6">
                                <input name="duracionmeses" type="number" class="form-control" style="width: 100px;" max="99">
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="col-md-3">
                <div class="container">
                  
                    <label class="switch">
                        <input name="activo" type="checkbox" onclick="activar();">
                        <span class="slider round"></span>
                    </label>
                    <label id="indicador">Desactivado</label>
                </div>
            </div>
           @else
            <!----------------------------------------Primera Tarjeta------------------------------------------------------->
            <div class="col-md-9">
                <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <label>Monto Mínimo de Compra</label>
                            </div>
                            <div class="col-6">
                                <input name="minimocompra" type="number" class="form-control" value="{{$monedero->minimocompra}}" style="width: 100px;">
                                <input name="IdMonedero" value="{{$monedero->IdMonedero}}" hidden readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <label>Porcentaje de  Regalo</label>
                            </div>
                            <div class="col-6">
                                <input name="porcentajeregalo" type="number" class="form-control" value="{{$monedero->porcentajeregalo}}" style="width: 100px;">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <label>Duración en Meses</label>
                            </div>
                            <div class="col-6">
                                <input name="duracionmeses" type="number" class="form-control" value="{{$monedero->duracionmeses}}" style="width: 100px;" max="99">
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
            <div class="col-md-3">
                <div class="container">
                    @if($monedero->activo === "0" || $monedero->activo === " ")
                    <label class="switch">
                        <input name="activo" type="checkbox" onclick="activar();">
                        <span class="slider round"></span>
                    </label>
                    <label id="indicador">Desactivado</label>
                    @else
                    <label class="switch">
                        <input name="activo" type="checkbox" checked onclick="desactivar();">
                        <span class="slider round"></span>
                        </label>
                    <label id="indicador">Activado</label>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="card">
    <div style="text-align:left">
        <button id="btnGuardar" type="submit" class="btn btn-primary close-modal">Guardar</button>
        {{-- <button id="btnQuitarOpciones" type="button" class="btn btn-primary close-modal" onclick="quitarOpciones();">quitarOpciones</button> --}}
        <a href="/dashboard"><button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="far fa fa-arrow-left"></i> Regresar</button>
        </a>         
    </div>
</div>
@if($message = Session::get("duplicidadEmp"))
	<div id="duplicidadEmp" style="text-align:left" class="alert alert-danger">
		<p>{{$message="Datos duplicados. Elimine las empresas."}}</p>
	</div>
@endif
<!----------------------------------------------Excepciones de Clientes----------------------------------------------------------------->
<div class="card">
    <div class="card-header"><h4>Excepciones de Clientes</h4></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Clientes que no aplican para monedero</th>
                        <th></th>
                        <th>Clientes que si aplican para monedero</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!----------------------------Select de Empresas---------------------------->
                        <td style="width: 40%;">
                            <select id="select_empresas_disponibles" name="select_empresas_disponibles" class="form-control" size="20" onchange="desbloquearBotonEmpresa();">
                                @foreach($empresas as $empresa)
                                <option id="empresa{{$empresa->idEmpresa}}" value="{{$empresa->idEmpresa}}">{{$empresa->Nombre}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="width: 20%;text-align:center;">
                            <br>
                            <button id="btnPlusGuardar" type="button" class="btn btn-info" onclick="elegirEmpresa();"><i class="far fa fa-plus"></i></button>
                            <br><br>
                            <button id="btnEliminar" type="button" class="btn btn-info" onclick="deselegirEmpresa();"><i class="far fa fa-minus"></i></button>
                        </td>
                        <!--------------------Select de Detalles------------------------------------>
                        <td id="td_empresas_detalle" class="table-responsive">
                            @foreach($monedero_empresa as $monedero_emp)
                            <div id="filaDB{{$monedero_emp->id}}" class="col-md-12" onclick="marcarFilasDB({{$monedero_emp->id}});">
                                <div class="container">
                                    <input name="monedero_id[]" value="{{$monedero_emp->id}}" hidden readonly>
                                    <input name="monedero_id_empresa[]" class="monedero_id_empresa" value="{{$monedero_emp->id_empresa}}" hidden readonly>
                                    <p>{{$monedero_emp->empresa->Nombre}}</p>
                                    <input id="canceladoDB{{$monedero_emp->id}}" name="cancelado[]" type="text" hidden readonly>
                                </div>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@if($message = Session::get("duplicidadEst"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message="Datos duplicados. Elimine los estudios repetidos."}}</p>
	</div>
@endif
<!----------------------------------------------Excepciones de Pruebas/Estudios/Paquetes----------------------------------------------------------------->
<div class="card">
    <div class="card-header"><h4>Excepciones de Estudios/Paquetes</h4></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Paquetes/Estudios que si aplican para monedero</th>
                        <th></th>
                        <th>Paquetes/Estudios que no aplican para monedero</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!----------------------------Select de Paquetes/Estudios---------------------------->
                        <td style="width: 40%;">
                            <select id="select_pruebas_paquetes_estudios_disponibles" name="select_pruebas_paquetes_estudios_disponibles" class="form-control" size="20" onchange="desbloquearBotonEstudio();">
                                @foreach($estudios as $estudio)
                                    @if($estudio->espaquete === "0")
                                    <option id="estudios{{$estudio->idEstudio}}" value="{{$estudio->idEstudio}}">Estudio -> {{$estudio->Nombre}}</option>
                                    @else
                                    <option value="{{$estudio->idEstudio}}">Paquete -> {{$estudio->Nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td style="width: 20%;text-align:center;">
                            <br><br>
                            <button id="btnGuardarEstudios" type="button" class="btn btn-info" onclick="elegirEstudio();"><i class="far fa fa-plus"></i></button>
                            <br><br>
                            <button type="button" class="btn btn-info" onclick="deselegirEstudio();"><i class="far fa fa-minus"></i></button>
                        </td>
                        <!--------------------Select de Detalles------------------------------------>
                        <td id="td_pruebas_paquetes_estudios_detalle" class="table-responsive">
                            @foreach($monedero_estudios as $monedero_est)
                            <div id="filaEstudioDB{{$monedero_est->id}}" class="col-md-12" onclick="marcarFilasEstudioDB({{$monedero_est->id}});">
                                <div class="container">
                                    <input name="monedero_estudios_id[]" value="{{$monedero_est->id}}" hidden readonly>
                                    <input name="monedero_estudios_id_estudio[]" class="monedero_estudios_id_estudio" value="{{$monedero_est->id_estudio}}" hidden readonly>
                                    <p>{{$monedero_est->estudio->Nombre}}</p>
                                    <input id="canceladoEstDB{{$monedero_est->id}}" name="canceladoEst[]" type="text" hidden readonly>
                                </div>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</form>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('css/switch_button.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/multiregistros.js')}}"></script>
<script>
    $(document).ready(function() {
        document.getElementById('btnGuardarEstudios').disabled = true;
        document.getElementById('btnPlusGuardar').disabled = true;
        
        let lstNumeroEmpresas = document.getElementsByClassName("monedero_id_empresa"), arrayEmpresas = [];
        for (var i = 0; i < lstNumeroEmpresas.length; i++) {    
            arrayEmpresas[i] = lstNumeroEmpresas[i].value;
            $('#select_empresas_disponibles option[value="'+lstNumeroEmpresas[i].value+'"]').remove();
        }

        let lstNumeroEstudios = document.getElementsByClassName("monedero_estudios_id_estudio"), arrayEstudios = [];
        for (var i = 0; i < lstNumeroEstudios.length; i++) {    
            arrayEstudios[i] = lstNumeroEstudios[i].value;
            $('#select_pruebas_paquetes_estudios_disponibles option[value="'+lstNumeroEstudios[i].value+'"]').remove();
        }
    });
</script>
<script src="{{ asset('js/monedero.js')}}"></script>
<script>
    function desbloquearBotonEstudio(){
        document.getElementById('btnGuardarEstudios').disabled = false
    }
    contB = 1;
    function elegirEstudio(){
        var estudios_id = $('#select_pruebas_paquetes_estudios_disponibles').val();
        var estudios_texto = $('#select_pruebas_paquetes_estudios_disponibles option:selected').text();
        var fila = '<div id="filaEstudioN'+contB+'" class="col-md-12" onclick="marcarFilasEstudioN('+contB+');"><div class="container"><input name="monedero_estudios_id[]" hidden readonly><input name="monedero_estudios_id_estudio[]" value="'+estudios_id+'" hidden readonly><p>'+estudios_texto+'</p><input id="canceladoEstN'+contB+'" name="canceladoEst[]" type="text" hidden readonly></div></div>';
        contB++;
        $("#select_pruebas_paquetes_estudios_disponibles option:selected").remove();
        $('#td_pruebas_paquetes_estudios_detalle').append(fila);
        $("#btnGuardarEstudios"). attr("disabled", true);
    }
    function deselegirEstudio(){

        $('.eliminarEstudio').css('background', 'red');
        $('#btnGuardar').click();
    }
    function marcarFilasEstudioN(index){
        document.getElementById("canceladoEstN"+index).value = "1";
        document.getElementById("filaEstudioN"+index).style.backgroundColor  = "gray";
        $("#filaEstudioN"+index).removeClass('col-md-12');
        $("#filaEstudioN"+index).addClass('eliminarEstudio');
    }
    function marcarFilasEstudioDB(index){
        document.getElementById("canceladoEstDB"+index).value = "1";
        document.getElementById("filaEstudioDB"+index).style.backgroundColor  = "gray";
        $("#filaEstudioDB"+index).removeClass('col-md-12');
        $("#filaEstudioDB"+index).addClass('eliminarEstudio');
    }
</script>
@stop