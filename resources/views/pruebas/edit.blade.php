@extends('adminlte::page')
@section('content_header')
<h2>Configuración de Pruebas</h2>
<div style="background-color:rgba(240, 248, 255, 0);">
    <div style="text-align:right" >
        <a href="/pruebas"><button type="button" class="btn btn-secondary"><i class="far fa fa-arrow-left">
            </i> Regresar</button>
        </a>    
    </div>   
</div>
@stop

@section('content')

@if($message = Session::get("duplicidadClave"))
	<div class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
@endif

@if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message = "Código similar, piense en otro."}}</p>
	</div>
@endif
<form enctype="multipart/form-data" action="/pruebas/{{$prueba->idPrueba}}" method="POST">
        @csrf
        @method('PUT')
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
                                    <input class="form-control" id="idss" name="idss" value="{{$prueba->cveprueba}}" maxlength="10" required>
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Abreviatura</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="abreviatura" name="abreviatura" value="{{$prueba->abreviatura}}" maxlength="10" required>
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Descripción</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="descripcion" name="descripcion" value="{{$prueba->Descripcion}}" maxlength="50" required>
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Titulo</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="Prueba" name="Prueba" value="{{$prueba->Prueba}}" maxlength="50" required>
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Clave (Hoja Trabajo)</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="hoja_trabajo" name="hoja_trabajo" value="{{$prueba->hoja_trabajo}}" maxlength="10">
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Departamento</label>
                                </div>
                                <div class="col-7">
                                    <select data-dropup-auto="false" id="departamento" class="selectpicker show-tick form-control" data-width="100%" name="departamento" data-live-search="true">
                                        {{-- <option value="208">Escoga un departamento</option> --}}
                                        @foreach($deptos as $depto)
                                        <option value="{{$depto->id}}" {{($depto->id == $prueba->id_Departamento)?'selected':''}} data-content="<i class='fa fa-edit'></i> {{$depto->Depto}}">{{$depto->Depto}}</option>
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
                                        <option value="{{$prueba->TipoMuestra}}" data-content="<i class='fa fa-edit'></i> {{$prueba->TipoMuestra}}" selected>{{$prueba->TipoMuestra}}</option>
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
                                    <select data-dropup-auto="false" class="selectpicker show-tick form-control"  data-width="100%" id="metodo" name="metodo" data-live-search="true">
                                        @foreach($metodos as $metodo)
                                        <option value="{{$metodo->idMetodo}}" data-content="<i class='fa fa-edit'></i> {{$metodo->descripcion}}" {{($metodo->idMetodo == $prueba->id_Metodo)?'selected':''}}>{{$metodo->descripcion}}</option>
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
                                        <option value="{{$prueba->impr_metodo_Resultado}}" data-content="<i class='fa fa-edit'></i> {{$prueba->impr_metodo_Resultado}}" selected>{{$prueba->impr_metodo_Resultado}}</option>
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
                                    <input value="{{$prueba->formula}}" id="formula" name="formula" maxlength="100" class="form-control">
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <label>Imprimir en negritas</label>
                                </div>
                                <div class="col-7">
                                    <select class="selectpicker form-control show-tick" data-width="fit" id="imprimir_negritas" name="imprimir_negritas">
                                        <option value="{{$prueba->imprimir_negritas}}" data-content="<i class='fa fa-edit'></i>{{$prueba->imprimir_negritas}}" selected>{{$prueba->imprimir_negritas}}</option>
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                    </select>
                                </div>                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <input id="antibiograma" name="antibiograma" type="checkbox" {{$prueba->antibiograma=="1"?'Checked':''}} value="1">{{-- <input name="antibiograma" type="hidden" value="1"> --}}
                                    <label style="text-align:left"> Antibiograma</label>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <input id="editor_texto" name="editor_texto" type="checkbox" {{$prueba->editor_texto=="1"?'Checked':''}} value="1">{{-- <input name="antibiograma" type="hidden" value="1"> --}}
                                    <label style="text-align:left"> Editor</label>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------------------------------Segunda Parte---------------------------------------------------->
            <div class="col-md-6">
                    <div class="card card-light">
                        <div class="card-body" style="margin: 5px !important; padding: 5px !important;">
                            <div id="asignacion-orden" class="container">
                                <div class="row">
                                    <div class="col-5">
                                        <label>Unidad de Medida</label>
                                    </div>
                                    <div class="col-7">
                                        <input value="{{$prueba->Medida}}" id="medida" name="medida" maxlength="30" class="form-control">
                                    </div>
                                </div>
                                <hr>                                
                                <div class="row">
                                    <div class="col-5">
                                        <label>Sexo</label>
                                    </div>
                                    <div class="col-7">
                                        <select id="sexo" name="sexo" class="selectpicker show-tick form-control">
                                            <option value="{{$prueba->sexo}}" data-content="<i class='fa fa-edit'></i> {{$prueba->sexo}}" selected>{{$prueba->sexo}}</option>
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
                                            @if($prueba->TipoResultado === "1")
                                            <option value="{{$prueba->TipoResultado}}" data-content="<i class='fa fa-edit'></i> {{$prueba->TipoResultado = "Númerico"}}" selected>{{$prueba->TipoResultado="Númerico"}}</option>
                                            @endif
                                            @if($prueba->TipoResultado === "2")
                                            <option value="{{$prueba->TipoResultado}}" data-content="<i class='fa fa-edit'></i> {{$prueba->TipoResultado = "Texto"}}" selected>{{$prueba->TipoResultado = "Texto"}}</option>
                                            @endif
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
                                        <input class="form-control" placeholder="(Opcional)" value="{{$prueba->Resultado_default}}" id="Resultado_default" name="Resultado_default" maxlength="50">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Tipo de Valor</label>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-check">
                                            <input onclick="ActivarFiltro()" {{$prueba->Tipo_Valor=="A"?'Checked':''}} id="Tipo_Valor" name="Tipo_Valor" type="radio" value="A"><label class="form-check-label">Abierto</label>
                                         </div>
                                        <div class="form-check">
                                            <input onclick="ActivarFiltro()" id="Tipo_Valor1" name="Tipo_Valor" {{$prueba->Tipo_Valor=="R"?'Checked':''}} type="radio" value="R"><label class="form-check-label">Restringido</label>
                                             
                                        </div>
                                        <textarea id="valor_restringido" rows="4" cols="20" style="display: none;resize: none;" name="valor_restringido">{{$prueba->valor_restringido}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Decimales</label>
                                    </div>
                                    <div class="col-7">
                                        <select id="Decimales" name="Decimales" class="selectpicker form-control show-tick">
                                            <option value="{{$prueba->Decimales}}" data-content="<i class='fa fa-edit'></i> {{$prueba->Decimales}}" selected>{{$prueba->Decimales}}</option>
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
                                            <option class="show-tick" value="{{$prueba->dias}}" selected>{{$prueba->dias}}</option>
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
                                            <option value="{{$prueba->horas}}" selected>{{$prueba->horas}}</option><option value="0">0</option>
                                            <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                            <option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
                                            <option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                                            <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                                            <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
                                            <option value="21">21</option><option value="22">22</option><option value="23">23</option>
                                        </select>
                                        <label>Minutos: </label>
                                        <select class="selectpicker show-tick" data-dropup-auto="false" data-width="fit" id="minutos" name="minutos">
                                            <option value="{{$prueba->minutos}}" selected>{{$prueba->minutos}}</option><option value="0">0</option>
                                            <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
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
                                        <textarea class="form-control" id="indicaciones" name="indicaciones" maxlength="70">{{$prueba->indicaciones}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Notas</label>
                                    </div>
                                    <div class="col-7">
                                        <textarea class="form-control" id="notas" name="notas" maxlength="100">{{$prueba->notas}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Impr.nota en resultado</label>
                                    </div>
                                    <div class="col-7">
                                        <select class="selectpicker form-control show-tick" id="impr_nota_resultado" name="impr_nota_resultado">
                                            <option value="{{$prueba->impr_Nota_Resultado}}" data-content="<i class='fa fa-edit'></i> {{$prueba->impr_Nota_Resultado}}" selected>{{$prueba->impr_Nota_Resultado}}</option>
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
                                        <textarea class="form-control" id="notas_internas" name="notas_internas" maxlength="100">{{$prueba->notas_internas}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        <label>Tipo de valor de normalidad</label>
                                    </div>
                                    <div class="col-7">
                                        <select class="selectpicker show-tick form-control" id="tipo_valor_normalidad" name="tipo_valor_normalidad" onchange="showInp()">
                                            <option value="{{$prueba->tipo_valor_normalidad}}" data-content="<i class='fa fa-edit'></i> {{$prueba->tipo_valor_normalidad}}" selected>{{$prueba->tipo_valor_normalidad}}</option>
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
                                        <textarea rows="4" cols="10" class="form-control" id="valor_normalidad_texto" name="valor_normalidad_texto" maxlength="200">{{$prueba->valor_normalidad_texto}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
            </div>
        </div>
        <div class="card">
            <div style="text-align:left" class="card-header">
                <a href="/pruebas" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                <button id="btnGuardarPrueba" type="submit" class="btn btn-primary close-modal" >Guardar</button>      
            </div>   
       </div>


<center><div class="card" id="tabla_normalidad" style="display: none">
    <div class="card-header">
        <h3 class="float-left">Valores de referencia</h3>
        <button type="button" id="btnAgregar" class="float-right d-none d-sm-block btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="bloquearboton();">
            <i class="far fa fa-plus-square"></i> Agregar    
        </button>
        @include('pruebas.valores.valoresCreate')
        
        <div class="card-body">
            <div class="container-fluid">
                <hr>
                <div class="table-responsive">
                    <table id="valoresref" class="table table-striped table-bordered table-sm">
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
                            @if($valoresreferancias->count()>0)
                            @foreach ($valoresreferancias as $valoresreferancia)
                                <tr id="filaDB{{$valoresreferancia->idValorReferencia}}">
                                    <td>
                                        <input name="id_valoref[]" readonly value="{{$valoresreferancia->idValorReferencia}}" hidden readonly>
                                        <input id="canceladoDB{{$valoresreferancia->idValorReferencia}}" name="cancelado[]" hidden readonly>
                                        <input autocomplete="off" id="sexovalref1{{$valoresreferancia->idValorReferencia}}" required pattern="[Ii]ndistinto|[Ff]emenino|[Mm]asculino" list="l1{{$valoresreferancia->idValorReferencia}}" readonly name="sexovalref1[]" type="text" class="form-control" value="{{$valoresreferancia->Sexo}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" title="Escriba o seleccione --Indistinto, Femenino o Masculino--">
                                        <datalist id="l1{{$valoresreferancia->idValorReferencia}}">
                                            <option>Indistinto</option>
                                            <option>Femenino</option>
                                            <option>Masculino</option>
                                        </datalist>
                                    </td>
                                    <td>
                                        <input autocomplete="off" id="Edad1{{$valoresreferancia->idValorReferencia}}" required pattern="[Aa]años|[Mm]eses|[Dd]ías" list="l2{{$valoresreferancia->idValorReferencia}}" readonly name="Edad1[]" type="text" class="form-control" value="{{$valoresreferancia->Edad}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" title="Escriba o seleccione --Años, meses o días--">
                                        <datalist id="l2{{$valoresreferancia->idValorReferencia}}">
                                            <option value="Años"></option>
                                            <option>Meses</option>
                                            <option>Días</option>
                                        </datalist>
                                    </td>
                                    <td><input id="EdadMin1{{$valoresreferancia->idValorReferencia}}" readonly name="EdadMin1[]" autocomplete="off" class="form-control" type="number" max="100" value="{{$valoresreferancia->EdadMin}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);"></td>
                                    <td><input id="EdadMax1{{$valoresreferancia->idValorReferencia}}" readonly name="EdadMax1[]" autocomplete="off" class="form-control" type="number" max="120" value="{{$valoresreferancia->EdadMax}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" ></td>
                                    <td><input id="RefMin1{{$valoresreferancia->idValorReferencia}}" readonly name="RefMin1[]" autocomplete="off" class="form-control" step="0.01" placeholder="0.00" type="number" max="100" value="{{$valoresreferancia->ValMin}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);"></td>
                                    <td><input id="RefMax1{{$valoresreferancia->idValorReferencia}}" readonly name="RefMax1[]" autocomplete="off" class="form-control" step="0.01" placeholder="0.00" type="number" max="100" value="{{$valoresreferancia->ValMax}}" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" onblur="agregarValTextDB({{$valoresreferancia->idValorReferencia}});"></td>
                                    <td>
                                        <textarea id="TextoValores{{$valoresreferancia->idValorReferencia}}" readonly name="TextoValores[]" autocomplete="off" class="form-control" placeholder="0.00" max="150" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" >{{$valoresreferancia->TextoValores}}</textarea>
                                    </td>
                                    <td>
                                        <a type="button" id="btnEditar" data-toggle="modal" onclick="edicionFilas('{{$valoresreferancia->idValorReferencia}}');" class="btn-xs btn-primary">
                                            <i style="color: #ffffff" class="fa fa-edit"></i>
                                        </a>
                                        <a type="button" id="btnEliminar" onclick="deshacer('{{$valoresreferancia->idValorReferencia}}');" class="btn-xs btn-danger">
                                            <i style="color: #ffffff" class="fa fa-trash"></i>
                                        </a>
                                        <a type="button" id="btnCheckDB{{$valoresreferancia->idValorReferencia}}" onclick="checkEdicionFilas('{{$valoresreferancia->idValorReferencia}}');" class="btn-xs btn-info">
                                            <i style="color: #ffffff" class="fa fa-check"></i>
                                        </a>
                                    </td> 
                                </tr>
                            @endforeach
                            @endif
                        </tbody>                        
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div></center>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
<script>
function deshacer(index){
    $("#filaDB" + index).css('background', 'red');
    $("#canceladoDB" + index).val(1);
}
</script>

<script>
    function bloquearboton(){
        $(this).select();
        document.getElementById("btnGuardarPrueba").disabled = true;      
    }
    function desbloquearboton(){
        document.getElementById("btnGuardarPrueba").disabled = false;
    }
    function agregarValTextDB(index)
    {
        var refmin = $("#RefMin1"+index).val();
        var refmax = $("#RefMax1"+index).val();
        $("#TextoValores"+index).val(refmin + " - " + refmax);
    }
    function agregarValTextN(index)
    {
        var refmin = $("#RefMin1"+index).val();
        var refmax = $("#RefMax1"+index).val();
        $("#TextoValores"+index).val(refmin + " - " + refmax);
    }
    function agregarValText()
    {
        var refmin = $("#RefMin").val();
        var refmax = $("#RefMax").val();
        $("#Textos").val(refmin + " - " + refmax);
    }
function edicionNuevasFilas(index){
  $("#sexovalrefN"+index).removeAttr("readonly");
  document.getElementById("sexovalrefN"+index).style.borderColor = 'blue';
  
   $("#EdadN"+index).removeAttr("readonly");
  document.getElementById("EdadN"+index).style.borderColor = 'blue';

  $("#EdadMinN"+index).removeAttr("readonly");
  document.getElementById("EdadMinN"+index).style.borderColor = 'blue';

  $("#EdadMaxN"+index).removeAttr("readonly");
  document.getElementById("EdadMaxN"+index).style.borderColor = 'blue';

  $("#RefMinN"+index).removeAttr("readonly");
  document.getElementById("RefMinN"+index).style.borderColor = 'blue';

  $("#RefMaxN"+index).removeAttr("readonly");
  document.getElementById("RefMaxN"+index).style.borderColor = "blue";

  $("#TextoValoreN"+index).removeAttr("readonly");
  document.getElementById("TextoValoresN"+index).style.borderColor = "blue";

  $(".btnCheck").attr('disabled','disabled');
      document.getElementById('btnGuardarPrueba').disabled = true;
      document.getElementById('btnAgregar').disabled = true;
      $(".botonEliminarB").attr('disabled','disabled');
      $(".botonEditarB").attr('disabled','disabled');
      document.getElementById('btnCheckId'+index).disabled = false;
}
/*------------------------------------------------------------------------------------*/
function checkEdicionNuevasFilas(index){
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
}
</script>

<script>
$(document).ready(function(){
    var cont = 1;
    var modal = "include";
    var modal2 = "('pruebas/valores/valoresUpdate2')";
    $('#bt_add').click(function(){
        agregar(); 
        function agregar(){
            var Sexo1 = document.getElementById("sexovalref").value;
            var Edad1 = document.getElementById("Edad").value;
            var EdadMin1 =  document.getElementById("EdadMin").value;
            var EdadMax1 =  document.getElementById("EdadMax").value;
            var ValMin1 =  document.getElementById("RefMin").value;
            var ValMax1 =  document.getElementById("RefMax").value; 
            var TextoValor =  document.getElementById("Textos").value;
                    
            var fila = '<tr class="selected" id="fila'+cont+'"><td><input name="id_valoref[]" hidden readonly><input id="canceladoN'+cont+'" name="cancelado[]" hidden readonly><input title="Escriba o seleccione --Años, meses o días--" autocomplete="off" id="sexovalrefN'+cont+'" required pattern="[Ii]ndistinto|[Ff]emenino|[Mm]asculino" list="l4'+cont+'" readonly name="sexovalref1[]" type="text" class="form-control" value="'+Sexo1+'" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);"><datalist id="l4'+cont+'"><option>Indistinto</option><option>Femenino</option><option>Masculino</option></datalist></td><td><input title="Escriba o seleccione --Años, meses o días--" autocomplete="off" id="EdadN'+cont+'" required pattern="[Aa]años|[Mm]eses|[Dd]ías" list="l3'+cont+'" readonly name="Edad1[]" type="text" class="form-control" value="'+Edad1+'" style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);"><datalist id="l3'+cont+'"><option>Años</option><option>Meses</option><option>Días</option></datalist></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="EdadMinN'+cont+'" name="EdadMin1[]" value="'+EdadMin1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="EdadMaxN'+cont+'" name="EdadMax1[]" value="'+EdadMax1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="RefMinN'+cont+'" name="RefMin1[]" value="'+ValMin1+'"></td><td><input autocomplete="off" class="form-control" readonly style="border-color:rgba(0, 0, 0, 0); background-color: rgba(0, 255, 255, 0);" type="text" id="RefMaxN'+cont+'" name="RefMax1[]" value="'+ValMax1+'" onblur="agregarValTextN('+cont+')"></td><td><textarea id="TextoValoresN'+cont+'" readonly name="TextoValores[]" autocomplete="off" class="form-control" placeholder="0.00" max="150" style="border-color: rgba(255, 255, 255, 0);background-color:rgba(0, 0, 0, 0);" >'+TextoValor+'</textarea></td><td><a type="button" onclick="edicionNuevasFilas('+cont+');" class="btn-xs btn-primary"><i style="color: #ffffff" class="fa fa-edit"></i></a> <a type="button" class="btn-xs btn-danger" onclick="eliminar('+cont+');"><i style="color: #ffffff" class="fa fa-minus"></i></a> <a type="button" id="btnCheckId'+cont+'" onclick="checkEdicionNuevasFilas('+cont+');" class="btn-xs btn-info"><i style="color: #ffffff" class="fa fa-check"></i></a></td></tr>';
            cont++;
            $('#valoresref').append(fila);
            // $('#updateModal2').on('shown.bs.modal', function () {
            //     $('#myInput').trigger('focus')
            // })

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
function eliminar(index){
    $("#fila" + index).css('background', 'red');
    $("#canceladoN" + index).val(1);
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" 
integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="{{ asset('js/inputs_selects.js')}}" rel="stylesheet"></script>
<script src="{{ asset('js/multiregistros.js')}}" rel="stylesheet"></script>

<script>
if(sexo=="M"){
    $("#SexoEdit").prop("checked", true);
    /* alert('Mujer'); */
}
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