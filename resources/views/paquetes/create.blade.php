@extends('adminlte::page')

@section('content_header')
<h2>Configuración de Paquetes</h2>
<div style="background-color:rgba(240, 248, 255, 0);">
    <div style="text-align:right" >
        <a href="/paquetes"><button type="button" class="btn btn-secondary">Regresar</button></a>    
    </div>   
</div>
@stop

@section('content')
<form action="/paquetes" method="POST">
@csrf
    <div class="row" id="principio">
        <!----------------------------------------Primera Tarjeta------------------------------------------------------->
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                    <div id="detalle-orden" class="container">
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Abreviatura</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="abreviatura" name="abreviatura" maxlength="10" required>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Nombre</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="descripcion" name="descripcion" maxlength="50" required>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <label>Indicaciones</label>
                            </div>
                            <div class="col-7">
                                <textarea class="form-control" id="indicaciones" name="indicaciones" maxlength="150"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <label>Notas internas</label>
                            </div>
                            <div class="col-7">
                                <textarea class="form-control" id="notas_internas" name="notas_internas" maxlength="150"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <label>Tiempo de Proceso</label>
                            </div>
                            <div class="col-7">
                                <label>Días: </label>
                                <select class="selectpicker show-tick" data-dropup-auto="false" data-width="fit" id="dias" name="dias">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                                <label>Horas: </label>                       
                                <select id="horas" class="selectpicker show-tick" data-dropup-auto="false" data-width="fit" name="horas">
                                    <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                    <option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
                                    <option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                    <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                                    <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
                                    <option value="21">21</option><option value="22">22</option><option value="23">23</option>
                                </select>
                                <label>Minutos: </label>
                                <select class="selectpicker show-tick" data-dropup-auto="false" data-width="fit" id="minutos" name="minutos">
                                    <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                    <option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
                                    <option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                    <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                                    <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
                                    <option value="21">21</option><option value="22">22</option><option value="23">23</option></option><option value="24">24</option>
                                    <option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option>
                                    <option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option>
                                    <option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option>
                                    <option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option>
                                    <option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option>
                                    <option value="45">45 </option><option value="46">46</option><option value="47">47</option><option value="48">48 </option>
                                    <option value="49">49 </option><option value="50">50</option><option value="51">51</option><option value="52">52</option>
                                    <option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option>
                                    <option value="57">57</option><option value="58">58</option><option value="59">59</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card">
        <div style="text-align:left" class="card-header">
            <input name"_token" hidden value="{{ csrf_token() }}" type="text">
            <a href="/paquetes" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
            <button type="submit" class="btn btn-primary close-modal" >Guardar</button>                  	
        </div>   
   </div>   
   @if($message = Session::get("error"))
   <div style="text-align:left" class="alert alert-danger">
       <p>{{$message}}</p>
       <p>Error.</p>
   </div>
@endif
<div class="card" id="tabla_normalidad">
    <div class="card-header">
        <h3 class="float-left d-none d-sm-block">Estudios del Formato</h3>
        @if(count($estudios) >= 1)
        <select id="slcBuscador" name="slcBuscador" data-width="fit" data-live-search="true" data-dropup-auto="false" class="selectpicker">
            <option>Elige</option>
            <option>Separador</option>
            @foreach ($estudios as $estudio)
            <option value="{{$estudio->idEstudio}}_{{$estudio->Nombre}}">Estudio-{{$estudio->idEstudio}}-{{$estudio->Nombre}}</option>
            @endforeach
        </select>
        @else
        No existe el departamento "Paquete" en el catalogo de Departamentos. Favor de registrarlo <a href="deptos">aquí</a>
        @endif

    </div>
    <div class="card-body">
        <p style="color: brown">* Para modificar el orden de los estudios arrastre los estudios hacia arriba y abajo</p>
        <p style="color: brown">* Los cambios se verán reflejados en ordenes <strong>NUEVAS</strong></p>
        <p style="color: brown">* Al terminar de ordenar los estudios debes dar click en <strong>Guardar</strong></p>
        <div class="container-fluid">
            {{-- <div class="table-responsive"> --}}
                <div class="row" id="tabla_paquetes">
                    
                    
                </div>
                {!!Form::close()!!} 
            {{-- </div>  --}}       
        </div>
    </div>
</div>
@stop
  
  
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet"/>
@stop

@section('js')
<script src="{{ asset('js/multiregistros.js')}}" rel="stylesheet"></script>
<script> 
function eliminar(index){
    $("#fila" + index).remove();
}
var cont = 1;
$('#slcBuscador').on('change', function() {
    datosEstudio=document.getElementById('slcBuscador').value.split('_');
    id_estudio = datosEstudio[0];
    estudioNombre = datosEstudio[1];
    separador = "1";/*defecto se refiere a una llave foranea para poder registrar*/

    var pruebaTexto = $('#slcBuscador option:selected').text();
    var fila = '<div id="fila'+cont+'" class="col-md-12"><div class="card card-light" style="background-color:rgba(128, 128, 128, 0.226);"><div class="card-body" style="margin: 5px !important; padding: 5px !important;"><div class="container"><div class="row"><input name="separador[]" value="'+0+'" hidden readonly><input type="hidden" name="id_estudio[]" value="'+id_estudio+'"><input type="hidden" name="estudioNombre[]" value="'+estudioNombre+'"><div class="col-1"><button style="border:0;background-color: #9e616700;" type="button" class="handle float-left"><i class="fa fa-arrows"></i></button></div><div class="col-7"><input class="form-control" name="pruebaTexto" readonly value="'+pruebaTexto+'" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);"></div><div class="col-2"><button style="border:0;background-color: #dc354600;" type="button" class="botonEliminarB float-right" onclick="eliminar('+cont+');"><i style="color: #ff0000" class="fa fa-times"></i></button></div></div></div></div></div></div><br>';
    cont++;

    if($("#slcBuscador").val() == "Separador"){
        var fila = '<div id="fila'+cont+'" class="col-md-12"><div class="card card-light" style="background-color:rgba(128, 128, 128, 0.226);"><div class="card-body" style="margin: 5px !important; padding: 5px !important;"><div class="container"><div class="row"><div class="col-1"><button style="border:0;background-color: #9e616700;" type="button" class="handle float-left"><i class="fa fa-arrows"></i></button></div><div class="col-7"><input name="separador[]" value="'+separador+'" hidden readonly><input type="hidden" name="id_estudio[]" value="'+"{{$defecto->idEstudio}}"+'"><input class="form-control" type="text" id="estudioNombre'+cont+'" name="estudioNombre[]" maxlength="50"></div><div class="col-2"><button style="border:0;background-color: #dc354600;" type="button" class="botonEliminarB float-right" onclick="eliminar('+cont+');"><i style="color: #ff0000" class="fa fa-times"></i></button></div></div></div></div></div></div><br>';
        cont++;
    }

    if($("#slcBuscador").val() == "Elige"){
        var fila = '<div id="fila'+cont+'" class="col-md-12"><div class="card card-light" style="background-color:rgba(128, 128, 128, 0.226);"><div class="card-body" style="margin: 5px !important; padding: 5px !important;"><div class="container"><div class="row"><div class="col-1"><button style="border:0;background-color: #9e616700;" type="button" class="handle float-left"><i class="fa fa-arrows"></i></button></div><div class="col-7"><input name="separador[]" value="'+separador+'" hidden readonly><input type="hidden" name="id_estudio[]" value="'+"{{$defecto->idEstudio}}"+'"><input class="form-control" type="text" id="estudioNombre'+cont+'" name="estudioNombre[]" maxlength="50"></div><div class="col-2"><button style="border:0;background-color: #dc354600;" type="button" class="botonEliminarB float-right" onclick="eliminar('+cont+');"><i style="color: #ff0000" class="fa fa-times"></i></button></div></div></div></div></div></div><br>';
        cont++;
    }
    document.getElementById('slcBuscador').value = "Elige";
    $('#tabla_paquetes').append(fila);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
new Sortable(tabla_paquetes, {
    handle: '.handle',
    animation: 150,
    ghostClass: 'bg-blue-100',
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" 
integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop