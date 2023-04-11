@extends('adminlte::page')

@section('content_header')
<h2>Configuración de Pruebas</h2>
<div style="background-color:rgba(240, 248, 255, 0);">
    <div style="text-align:right" >
        <a href="/pruebas"><button type="button" class="btn btn-secondary"><i class="far fa fa-arrow-left">
        </i> Regresar</button></a>    
    </div>   
</div>
@stop

@section('content')
@if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message = "Código similar, piense en otro."}}</p>
	</div>
@endif
{{-- @if($message = Session::get("campoFaltante"))
		<div style="text-align:left" class="alert alert-danger">
		    <p>{{$message="Si desea guardar un valor de referencia, primero asegurese de registrar los datos obligatorios de las pruebas."}}</p>
		</div>
		@endif --}}
{{-- <form action="/pruebas" method="POST">
    @csrf --}}
    {!!Form::open(array('url'=>'/pruebas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="row" id="principio">
        <!----------------------------------------Primera Tarjeta------------------------------------------------------->
        <div class="col-md-6">
            <div class="card card-light">
                <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                    <div id="detalle-orden" class="container">
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Código</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="cveprueba" name="cveprueba" maxlength="10" required>
                            </div>                            
                        </div>
                        <hr>
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
                                <label>Descripción</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="descripcion" name="descripcion" maxlength="50" required>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Titulo</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="Prueba" name="Prueba" maxlength="50" required>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Clave (Hoja Trabajo)</label>
                            </div>
                            <div class="col-7">
                                <input class="form-control" id="hoja_trabajo" name="hoja_trabajo" maxlength="10">
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Departamento</label>
                            </div>
                            <div class="col-7">
                                <select id="departamento" name="departamento" data-dropup-auto="false" class="selectpicker show-tick form-control" data-width="100%" data-live-search="true">
                                    {{-- <option value="208">Escoga un departamento</option> --}}
                                    @foreach($deptos as $depto)
                                    <option value="{{$depto->id}}" data-content="<i class='fa fa-plus'></i> {{$depto->Depto}}">{{$depto->Depto}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Tipo de Muestra</label>
                            </div>
                            <div class="col-7">
                                <select data-dropup-auto="false" class="selectpicker show-tick form-control" data-width="100%" id="TipoMuestra" name="TipoMuestra">
                                    <option value="Espectoracion">Espectoracion</option>
                                    <option value="Liquidos">Liquidos</option>
                                    <option value="Materia Fecal">Materia Fecal</option>
                                    <option value="Orina">Orina</option>
                                    <option value="Plasma">Plasma</option>
                                    <option value="Raspado">Raspado</option>
                                    <option value="Sangre Total">Sangre Total</option>
                                    <option value="Secreción">Secreción</option><option value="Suero">Suero</option>
                                </select>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Método</label>
                            </div>
                            <div class="col-7">
                                <select id="metodo" name="metodo" data-dropup-auto="false" class="selectpicker show-tick form-control" data-width="100%" data-live-search="true">
                                    @foreach($metodos as $metodo)
                                    <option value="{{$metodo->idMetodo}}" data-content="<i class='fa fa-plus'></i> {{$metodo->descripcion}}">{{$metodo->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Impr. método en resultado</label>
                            </div>
                            <div class="col-7">
                                <select id="impr_metodo_resultado" data-width="fit" name="impr_metodo_resultado" class="selectpicker show-tick">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Fórmula</label>
                            </div>
                            <div class="col-7">
                                <input id="formula" name="formula" maxlength="100" class="form-control">
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 col-md-3 col-lg-2">
                                <label>Imprimir en negritas</label>
                            </div>
                            <div class="col-7">
                                <select class="selectpicker form-control show-tick" data-width="fit" id="imprimir_negritas" name="imprimir_negritas">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-check">
                                    <input data-val="true" id="antibiograma" name="antibiograma" type="checkbox" value="1">
                                    <label style="text-align:right"> Antibiograma</label>
                                </div>
                                
                            </div>
                            <div class="col-4 col-md-3 col-lg-2">
                                
                            </div>                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-check">
                                    <input data-val="true" id="editor_texto" name="editor_texto" type="checkbox" value="1">
                                    <label style="text-align:right"> Editor</label>
                                </div>
                                
                            </div>
                            <div class="col-4 col-md-3 col-lg-2">
                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------Segunda Tarjeta------------------------------------------------------->
        <div class="col-md-6">
                <div class="card card-light">
                    <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                        <div id="asignacion-orden" class="container">
                            <div class="row">
                                <div class="col-5">
                                    <label>Unidad de Medida</label>
                                </div>
                                <div class="col-7">
                                    <input id="medida" name="medida" maxlength="30" class="form-control">
                                </div>
                            </div>
                            <hr>                                
                            <div class="row">
                                <div class="col-5">
                                    <label>Sexo</label>
                                </div>
                                <div class="col-7">
                                    <select id="sexo" name="sexo" class="selectpicker show-tick form-control">
                                        <option value="Indistinto">Indistinto</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Masculino">Masculino</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Tipo de Resultado</label>
                                </div>
                                <div class="col-7">
                                    <select id="TipoResultado" name="TipoResultado" class="selectpicker form-control show-tick">
                                        <option value="1">Númerico</option>
                                        <option value="2">Texto</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Resultado predeterminado</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" placeholder="(Opcional)" id="Resultado_default" name="Resultado_default" maxlength="50">
                                </div>
                            </div>
                            <hr><!----------------------------------Tipo_Valor/valor_restringido-------------------------------------------->
                            <div class="row">
                                <div class="col-5">
                                    <label>Tipo de Valor</label>
                                </div>
                                <div class="col-7">
                                    <div class="form-check">
                                        <input onclick="ActivarFiltro()" checked="True" id="Tipo_Valor" name="Tipo_Valor" type="radio" value="A"><label class="form-check-label">Abierto</label>
                                     </div>
                                     <div class="form-check">
                                         <input onclick="ActivarFiltro()" id="Tipo_Valor1" name="Tipo_Valor" type="radio" value="R"><label class="form-check-label">Restringido</label>
                                         
                                     </div>
                                     <textarea id="valor_restringido" rows="4" cols="20" style="display: none;resize: none;" name="valor_restringido">
                                    </textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Decimales</label>
                                </div>
                                <div class="col-7">
                                    <select id="Decimales" name="Decimales" class="selectpicker form-control show-tick">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
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
                                        <option value="0">0</option><option value="1">1</option>
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
                            <div class="row">
                                <div class="col-5">
                                    <label>Indicaciones</label>
                                </div>
                                <div class="col-7">
                                    <textarea class="form-control" id="indicaciones" name="indicaciones" maxlength="70"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Notas</label>
                                </div>
                                <div class="col-7">
                                    <textarea class="form-control" id="notas" name="notas" maxlength="100"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Impr.nota en resultado</label>
                                </div>
                                <div class="col-7">
                                    <select class="selectpicker form-control show-tick"  id="impr_nota_resultado" name="impr_nota_resultado">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Notas internas</label>
                                </div>
                                <div class="col-7">
                                    <textarea class="form-control" id="notas_internas" name="notas_internas" maxlength="100"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-5">
                                    <label>Tipo de valor de normalidad</label>
                                </div>
                                <div class="col-7">
                                    <select  required class="form-control" id="tipo_valor_normalidad" name="tipo_valor_normalidad" onchange="showInp()">
                                        <option value="Texto libre">Texto libre</option>
                                        <option value="Rango númerico">Rango númerico</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="textolibre" style="display: none">
                                <div class="col-5">
                                    <label>Valor de normalidad (Texto libre)</label>
                                </div>
                                <div class="col-7">
                                    <textarea style="resize: none;" rows="4" cols="10" class="form-control" id="valor_normalidad_texto" name="valor_normalidad_texto" maxlength="200"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-------------------------------------------------------------------------------->
    </div>
    <div class="card">
        <div style="text-align:left" class="card-header">
            <input name"_token" hidden value="{{ csrf_token() }}" type="text">
            <a href="/pruebas" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
            <button type="submit" id="btnGuardarPrueba" class="btn btn-primary close-modal" >Guardar</button>                  	
        </div>   
   </div>
<div class="card" id="tabla_normalidad" style="display: none">
    <div class="card-header">
        <h3 class="float-left d-none d-sm-block">Valores de referencia</h3>
        
        <button id="btnAgregar" type="button" class="float-right d-none d-sm-block btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="bloquearboton();">
            <i class="far fa fa-plus-square"></i> Agregar
        </button>
        
        @include('pruebas.valores.valoresCreate')
        <div style="text-align:right">
            
    
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <hr>
                <div class="table-responsive">
                    <table id="valoresref" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 8%;">Sexo</th>
                                <th scope="col" style="width: 8%;">Unidad</th>
                                <th scope="col" style="width: 5%;">Edad Mínima</th>
                                <th scope="col" style="width: 5%;">Edad Máxima</th>
                                <th scope="col" style="width: 5%;">Val.Mínima</th>
                                <th scope="col" style="width: 5%;">Val.Máxima</th>
                                <th scope="col" style="width: 25%;">Valores de Referencia en texto</th>
                                <td scope="col" style="width: 8%;">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                {{-- </form> --}}
                {!!Form::close()!!} 
                </div>
            </div>
            
            
            
        </div>
    </div>
    
</div>
@stop
  
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/botonesPersonalizados.css')}}"/>
@stop

@section('js')
<script>
$(document).ready(function(){
    var cont = 1;
    $('#bt_add').click(function(){
    agregar();
    

    function agregar(){
       
        var idinventando = 1;
        var Sexo1 = document.getElementById("sexovalref").value;
        var Edad1 = document.getElementById("Edad").value;
        var EdadMin1 =  document.getElementById("EdadMin").value;
        var EdadMax1 =  document.getElementById("EdadMax").value;
        var ValMin1 =  document.getElementById("RefMin").value;
        var ValMax1 =  document.getElementById("RefMax").value; 
        var TextoValor = document.getElementById("Textos").value;
                    
        var fila = '<tr class="selected" id="fila'+cont+'"><td><input title="Escriba o seleccione --Años, meses o días--" autocomplete="off" id="sexovalrefN'+cont+'" required pattern="[Ii]ndistinto|[Ff]emenino|[Mm]asculino" list="l4'+cont+'" readonly name="sexovalref1[]" type="text" class="form-control" value="'+Sexo1+'" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);"><datalist id="l4'+cont+'"><option>Indistinto</option><option>Femenino</option><option>Masculino</option></datalist></td><td><input title="Escriba o seleccione --Años, meses o días--" autocomplete="off" id="EdadN'+cont+'" required pattern="[Aa]años|[Mm]eses|[Dd]ías" list="l3'+cont+'" readonly name="Edad1[]" type="text" class="form-control" value="'+Edad1+'" style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);"><datalist id="l3'+cont+'"><option>Años</option><option>Meses</option><option>Días</option></datalist></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="EdadMinN'+cont+'" name="EdadMin1[]" value="'+EdadMin1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="EdadMaxN'+cont+'" name="EdadMax1[]" value="'+EdadMax1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="RefMinN'+cont+'" name="RefMin1[]" value="'+ValMin1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="RefMaxN'+cont+'" name="RefMax1[]" value="'+ValMax1+'" onblur="agregarValTextN('+cont+')"></td><td><textarea id="TextoValoresN'+cont+'" readonly name="TextoValores[]" autocomplete="off" class="form-control" placeholder="0.00" max="150" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" >'+TextoValor+'</textarea></td><td><a type="button" onclick="edicionNuevasFilas('+cont+');" class="btn-xs btn-primary"><i style="color: #ffffff" class="fa fa-edit"></i></a> <a type="button" class="btn-xs btn-danger" onclick="eliminar('+cont+');"><i style="color: #ffffff" class="fa fa-minus"></i></a> <a type="button" id="btnCheckId'+cont+'" onclick="checkEdicionNuevasFilas('+cont+');" class="btn-xs btn-info"><i style="color: #ffffff" class="fa fa-check"></i></a></td></tr>';
        cont++;
        $('#valoresref').append(fila);

        $('#sexovalref').val("Indistinto");
        $('#Edad').val("Días");
        $('#EdadMin').val("1");
        $('#EdadMax').val("120");
        $('#RefMin').val("0.00");
        $('#RefMax').val("0.00");
        $('#Textos').val("0 - 0");
    }
    });  
})
</script>
<script>
    function bloquearboton(){
        document.getElementById("btnGuardarPrueba").disabled = true;
    }
    function desbloquearboton(){
        document.getElementById("btnGuardarPrueba").disabled = false;
    }
function edicionFilas(index){
    $("#fila" + index).remove();
 }
</script>
<script> function eliminar(index){
    $("#sexovalrefN"+index).attr("readonly","readonly");
  document.getElementById("sexovalrefN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#EdadN"+index).attr("readonly","readonly");
  document.getElementById("EdadN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  /* document.getElementById("Edad1_Select").hidden; */

  $("#EdadMinN"+index).attr("readonly","readonly");
  document.getElementById("EdadMinN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#EdadMaxN"+index).attr("readonly","readonly");
  document.getElementById("EdadMaxN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#RefMinN"+index).attr("readonly","readonly");
  document.getElementById("RefMinN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  
  $("#RefMaxN"+index).attr("readonly","readonly");
  document.getElementById("RefMaxN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#TextoValoresN"+index).attr("readonly","readonly");
  document.getElementById("TextoValoresN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  document.getElementById('btnGuardarPrueba').disabled = false;
  document.getElementById('btnAgregar').disabled = false;
  $(".botonEliminarB").removeAttr('disabled');
  $(".botonEditarB").removeAttr('disabled');
  $(".btnCheck").removeAttr('disabled');
    $("#fila" + index).remove();
    
 }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" 
integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    function agregarValText()
    {
        var refmin = $("#RefMin").val();
        var refmax = $("#RefMax").val();
        $("#Textos").val(refmin + " - " + refmax);
    }
    function validaNumericos(event) {
      if(event.charCode >= 48 && event.charCode <= 57){
        return true;
      }
      return false;        
    }
    function agregarValTextN(index)
    {
        var refmin = $("#RefMin1"+index).val();
        var refmax = $("#RefMax1"+index).val();
        $("#TextoValores"+index).val(refmin + " - " + refmax);
    }
    function soloLetras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
            especiales = [8, 37, 39, 46],
            tecla_especial = false;
      
        for (var i in especiales) {
            if (key == especiales[i]) {
              tecla_especial = true;
              break;
            }
        }
      
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
          
    }
</script>
<script src="{{ asset('js/inputs_selects.js')}}" rel="stylesheet"></script>
<script>

    valorseleccionado = document.getElementById("Tipo_Valor").value;
    if (valorseleccionado="A" && document.getElementById('Tipo_Valor').checked) {
        document.getElementById("valor_restringido").style.display = "none";
    }
    
    valorseleccionado2 = document.getElementById("Tipo_Valor1").value;
    if (valorseleccionado2="R" && document.getElementById('Tipo_Valor1').checked) {
        document.getElementById("valor_restringido").style.display = "inline-block";
    }

</script>
@stop