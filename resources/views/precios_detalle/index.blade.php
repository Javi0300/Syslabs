@extends('adminlte::page')
@section('title', __('Configuración de precios'))
@section('content_header')
<h1>Configuración de Precios </h1>
<h4><strong>{{$PrecioDescripcion}}</strong></h4>
<a href="/precios"><button type="button" class="btn btn-secondary"><i class="far fa fa-arrow-left"></i> Regresar</button></a>
{{-- <a href="{{route('/precios',Crypt::encrypt( $iptidPrecio ))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a> --}}
@stop

@section('content')
<div class="card">
    <div style="text-align:left" class="card-header">
        <form action="archivoExcel">
            <a href="reporte" target="_blank"><button id="btnReporte" class="btn btn-primary" type="button"><i style="color: #ffffff" class="fa fa-check"></i> Reporte</button></a>
            <button id="btnConfiguracion" class="btn btn-primary" type="button" onclick="mostrarfiltradores();"><i style="color: #ffffff" class="fa fa-check"></i> Configurar precios</button>
            <button id="btnListaPrecios" class="btn btn-primary" type="button" onclick="mostrarlistaprecios();"><i style="color: #ffffff" class="fa fa-check"></i> Copiar Lista de Precios</button>
       
 
           
            
            <input name="idListaPrecio" value="{{$iptidPrecio}}" hidden readonly>
            <button id="btnImportar" class="btn btn-primary" type="submit">
                <i style="color: #ffffff" class="fa fa-check"></i> Importar Archivo de Precios
            </button>
        </form>
    </div>
   
    <div class="card-body">
        <table style="width: 100%;">
            <tr>
                <th style="width: 50%;">
                    <div id="filtradores" style="display: block">
                        <form action="{{route('precios_detalle.index')}}">
                            <input id="filtrador1" name="filtrador" checked type="radio" value="todo" onclick="autoclick();"><label>Ver todo</label>                                        
                            <input id="filtrador2" name="filtrador" style="text-align:right" type="radio" value="departamento" onclick="seleccionar();"><label>Ver por departamento</label>
                            <select id="slcfiltrador" name="slcfiltrador" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" style="display: none" onchange="autoselect();">
                                @foreach ($deptos as $depto)
                                <option value="{{$depto->id}}">{{$depto->Depto}}</option>
                                @endforeach                    
                            </select>
                            <input name="idPrecio" hidden readonly value="{{$iptidPrecio}}">
                            <input name="PrecioDescripcion" hidden readonly value="{{$PrecioDescripcion}}">
                            <button id="botonEnviar" class="btn btn-primary" hidden type="submit">Filtrar</button>
                        </form>
                    </div>
                </th>


                <th style="width: 50%;">
                    <div id="listaprecios" style="display: none">
                        <form action="{{route('precios_detalle.index')}}">
                            <strong>Elige una lista de precios: </strong>
                            <br>
                            <select id="slcprecios" name="slcprecios" class="formn-control" style="width: 250px;height: 36px;">
                                @foreach ($listasprecios as $lista)
                                    <option value="{{$lista->idPrecio}}">{{$lista->Descripcion}}</option>
                                @endforeach
                            </select>
                            <button id="btnEjecutar" class="btn btn-primary">Copiar lista de precios a: {{$PrecioDescripcion}}</button>
                            
                            <input name="idPrecio" hidden readonly value="{{$iptidPrecio}}">
                            <input name="PrecioDescripcion" hidden readonly value="{{$PrecioDescripcion}}">
                            <button id="btnCancelar" class="btn btn-secondary" type="button" onclick="cancelarCopiado();">Cancelar</button>
                        </form>
                    </div>
                </th>
            </tr>
        </table>
 
    </div>
</div>
<div class="card">
    @if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
    @endif
    <div class="card-header">
        {{-- <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createPrecioModal">
               <i class="far fa fa-plus-square"></i> Agregar
           </button> 
        </a> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
           
            <table id="preciosdetalle" class="table table-striped table-bordered">
                <thead class="thead">
                    <tr> 
                        <th scope="col">Tipo</th>
                        <th scope="col">Estudios/Paquetes</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>
                <form action="{{route('precios_detalle.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <tbody>
                        @foreach($preciosdetalle as $precio)
                        {{-- @if() --}}
                        <tr>
                            {{-- @if($paciente->Sexo === "H")
                            <td style="height: 10px;width:10;"><center>{{ $paciente->Sexo = "Hombre" }}</center></td>
                            @endif --}}
                            @if($precio->espaquete === "1")
                            
                            <td style="width: 20%;">PAQUETE -> {{ $precio->Depto}}</td>
                            @endif
                            @if($precio->espaquete === "0")
                            <td style="width: 20%;">ESTUDIO -> {{ $precio->Depto}}</td>
                           
                            @endif
                            <td style="width: 45%;">{{ $precio->nombreEstudio}}</td>
                            <td style="width: 5.5%;">
                                <input step="0.01" style="text-align:center;" onclick="indicar({{$funcionIndicatoria++}});" onchange="Registrar({{$sumatoriaFuncion++}});" onblur="Actualizar({{$sumatoriaFuncion2++}});" id="UpdatePrecio{{$sumatoria++}}" name="UpdatePrecio[]" class=" form-control UpdatePrecio" value="{{$precio->precio}}" placeholder="0.00" type="number">{{-- style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" --}}
                                <input id="marcador{{$sumatoriaCheckbox++}}" name="marcador[]" class="marcador" type="text" hidden readonly>

                                <input id="idEstudio" name="idEstudio[]" value="{{$precio->idEstudio}}" hidden readonly>
                                <input id="idPrecioDetalle{{$sumatoriaidPrecioDetalle++}}" name="idPrecioDetalle[]" hidden readonly value="{{$precio->idPrecioDetalle}}">
                                <input name="idPrecio[]" hidden readonly value="{{$iptidPrecio}}">
                            </td>
                        </tr>
                        {{-- @elseif($horario->id_cancha == 1)
                        

                        @endif --}}
                        @endforeach
                    </tbody>
            </table>
           

        </div>
        
    </div>
</div>
    <button id="btnGuardar" class="btn btn-primary" type="submit" onclick="forzarclick();">Guardar</button>
</form>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
<script>
    $(document).ready(function () {
        /* $(".UpdatePrecio").attr('disabled','disabled');
        $("#btnGuardar").attr('disabled','disabled'); */
    });
</script>
<script src="{{ asset('js/listadePrecios.js')}}" rel="stylesheet"></script>
@if($activarfiltrador1 == 'si')
<script>
    //document.getElementById('').checked;
    $("#filtrador1").prop("checked", true);
</script>
@endif

@if($activarfiltrador2 == 'si')
<script>
    
        //document.getElementById('').checked;
        $("#filtrador2").prop("checked", true);
        $("#filtrador1").prop("checked", false);
    
        document.getElementById("slcfiltrador").style.display = "block";
        $("#slcfiltrador").val({{$departamento}});
        /* departamento = $("#depa").val();
        $("#slcfiltrador").val(departamento);  */   

</script>
@endif

@if($activarfiltrador3 == 'si')
<script>
    document.getElementById("filtradores").style.display = "none";
    document.getElementById("listaprecios").style.display = "block";
    $("#slcprecios").val({{$listaId}});
</script>
@endif



<script>
    function Registrar(index){
        $("#marcador"+index).val("0");

        var original = $("#UpdatePrecio"+index).val();
    
        if ($("#idPrecioDetalle"+index).val() == "") {
            $("#marcador"+index).val("1");
        }
        
    }
    
    


</script>
@stop