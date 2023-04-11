@extends('adminlte::page')

@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <label class="control-label">Tipo de busqueda:</label>
            <div class="form-check">
                <label class="form-check-label mr-5 mr-xl-5" for="PorFecha">
                    <input class="form-check-input" type="radio" name="filtrador" id="PorFecha" value="3" onclick="porfecha();" checked>
                    Por Fecha
                </label>
                <label class="form-check-label mr-5 mr-xl-5" for="PorPaciente">
                    <input class="form-check-input" type="radio" name="filtrador" id="PorPaciente" value="1" onclick="porpaciente();">
                    Paciente
                </label>
                <label class="form-check-label mr-5 mr-xl-5" for="PorDepto">
                    <input class="form-check-input" type="radio" name="filtrador" id="PorDepto" value="2" onclick="pordepto();">
                    Por Departamento
                </label>
            </div>
        </div>
        <form id="TipoBusqueda">
            @csrf
            <div class="card-body">
                <input id="validacion" name="validacion" value="2" hidden readonly>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" id="txtpaciente">Paciente:</label>
                                <div id="contenedorselect">
                                    <select id="BuscarPaciente" name="BuscarPaciente" class="select2-multiple form-control" data-width="100%" disabled>
                                        @foreach ($pacientes as $paciente)
                                        <option value="{{$paciente->idPaciente}}">{{$paciente->Paciente}}</option>
                                        @endforeach
                                    </select>
                                    <input id="muestraid" name="muestraid" class="form-control" placeholder="Buscar por ID Muestra" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha Inicio:</label>
                                <input name="fechainic" id="BuscarxFecha" type="date" class="form-control" value="{{session('hoy')}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Fecha Fin:</label>
                                <input name="fechafin" id="BuscarxFechaFin" type="date" class="form-control" value="{{session('hoy')}}">     
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Departamento:</label>
                                <select name="depto" id="BuscarxDepto" disabled class="select2-multiple form-control" data-width="100%">
                                    @foreach ($deptos as $depto)
                                    <option value="{{$depto->id}}">{{$depto->Depto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" id="buscar">
                    Buscar
                </button>
            </div>
        </form>
    </div>
    <br>
    @if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
    @endif
    <div class="row" style="font-size: 14px;">
        <div class="col-md-4" >
            <div class="card" id="resSol" >
                <div class="card-header alert alert-dark" role="alert">
                    Lista de solicitudes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="lista" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Captura</th>
                                    <th>Fecha</th>
                                    <th>Folio</th>
                                    <th>Estudios</th>
                                    {{-- <th>Nombre</th> --}}
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($rresultados) >= 1)
                                    @foreach($rresultados as $resultado)
                                        <tr>
                                            <td>
                                                <form>
                                                    @csrf
                                                    <input name="IdSolicitud" value="{{$resultado->IdSolicitud}}" hidden readonly class="IdSolicitud">
                                                    {{-- <input name="id_estxsol" value="{{$resultado->id_estxsol}}" hidden readonly> --}}
                                                    <input name="inValidador" hidden readonly class="inValidador">
                                                    <input name="selectPaciente" hidden readonly class="selectPaciente">
                                                    <input name="inFechaI" hidden readonly class="inFechaI">
                                                    <input name="inFechaF" hidden readonly class="inFechaF">
                                                    <input name="selectDepto" hidden readonly class="selectDepto">
                                                    <button id="submit" class="btn btn-primary" type="submit" title="Ver estudios">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td nowrap>
                                                {{$resultado->solicitudFecha}} <br> {{$resultado->Paciente}}
                                            </td>
                                            <td>{{$resultado->Folio}}</td>
                                            <td nowrap>{{$resultado->solicitudEstudios}}</td>
                                            {{-- <td rowspan="2">{{$resultado->Paciente}}</td> --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No hay ningún registro. Genera nuevas solicitudes <a href="#">aquí</a></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8" style="font-size: 14px;">
            {{-- <form action="{{route('guardarPDF')}}">
                <input name="PDF_resultado" type="file">
                <button class="btn btn-primary">PDF</button>
            </form> --}}
            <div class="table-responsive">
                <form action="{{route('registro_resultados.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <button id="btnGuardarResultados" class="btn btn-success" onclick="cambiarValor();">Guardar</button>
                    
                    <div class="alert alert-info" id="viewResultados">
                        Area de captura
                    </div>
                   
                    <div class="card overflow-auto">
                        <div class="row text-center">
                            <div class="col-2 text-left">
                                <strong>Prueba</strong>
                            </div>
                            <div class="col-2">
                                <strong>Resultado</strong>
                            </div>
                            <div class="col-2">
                                <strong>Limites</strong>
                            </div>
                            <div class="col-2">
                                <strong>Medida</strong>
                            </div>
                            
                            <div class="col-2">
                                <strong>Fórmula</strong>
                            </div>
                            
                            <div class="col-1">
                                
                            </div>
                            <div class="col-1">
                                <strong>Validado</strong>
                            </div>
                        </div>
                        @foreach ($estxsoles as $estxsol)
                            <div class="desplegable" style="display: block;" >
                                @if($encabezado != $estxsol->Nombre)
                                    @if($estxsol->espaquete == 1)
                                    <div class="alert alert-primary" role="danger" onclick="desplegar('{{$estxsol->Estudio}}');">
                                        {{$estxsol->Nombre}}
                                    </div>
                                    @else
                                    <div class="alert alert-secondary" role="danger" onclick="desplegar('{{$estxsol->Estudio}}');">
                                        {{$estxsol->Nombre}}
                                        <div class="text-right">
                                            <select name="lista_estatus">
                                                <option value="0">Incompleto</option>
                                                <option value="1">En captura</option>
                                                <option value="3">Verificado</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                <div class="row text-center" hidden>{{$encabezado = $estxsol->Nombre}}</div>
                                <div id="contenido" class="contenido{{$estxsol->Estudio}}" style="display: block;">
                                    <div class="row text-center">
                                        <div class="col-2 text-left">
                                            {{-- Prueba --}}
                                        </div>
                                        <div class="col-2">
                                            {{-- Resultado --}}
                                        </div>
                                        <div class="col-2">
                                            {{-- Limites --}}
                                        </div>
                                        <div class="col-2">
                                            {{-- Medida --}}
                                        </div>
                                        
                                        <div class="col-2">
                                            {{-- Fórmula --}}
                                        </div>
                                        
                                        <div class="col-1">
                                            
                                        </div>
                                        <div class="col-1">
                                            
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        
                                    
                                        <div class="col-2">
                                            {{-- @if($estxsol->espaquete == 1)

                                                <label>{{$estxsol->Paquete}}</label>
                                            
                                            @endif --}}
                                            {{$estxsol->Prueba}}
                                        </div>
                                        <div class="col-2">
                                            <div class="input-group">
                                                @if($estxsol->Resultado >= $estxsol->Valmin && $estxsol->Resultado <= $estxsol->ValMax)
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i id="palomita{{$estxsol->id}}" class="fa fa-check" aria-hidden="true" style="color:green"></i>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($estxsol->Resultado > $estxsol->ValMax)
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i id="palomita{{$estxsol->id}}" class="fa fa-arrow-up" aria-hidden="true" style="color:red"></i>
                                                        </div>
                                                    </div>
                                                @endif
    
                                                @if($estxsol->Resultado < $estxsol->Valmin)
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i id="palomita{{$estxsol->id}}" class="fa fa-arrow-up" aria-hidden="true" style="color:red"></i>
                                                        </div>
                                                    </div>
                                                @endif
    
                                                @if($estxsol->Resultado == "")
                                                <input id="Resultado{{$estxsol->id}}" name="Resultado[]" class="form-control {{$estxsol->ClavePrueba}} text-box single-line" tabindex="{{$estxsol->id}}" type="number" placeholder="0" onfocus="usarformula({{$estxsol->id}});" onclick="seleccionarResultado({{$estxsol->id}});" onchange="estatus({{$estxsol->id}});">
                                                <p id="mensaje_formula_error{{$estxsol->id}}" style="color: red;"></p>
                                                @else
                                                <input id="Resultado{{$estxsol->id}}" name="Resultado[]" class="form-control {{$estxsol->ClavePrueba}} text-box single-line" tabindex="{{$estxsol->id}}" type="number" value="{{$estxsol->Resultado}}" onfocus="usarformula({{$estxsol->id}});" onclick="seleccionarResultado({{$estxsol->id}});" onchange="estatus({{$estxsol->id}});">
                                                <p id="mensaje_formula_error{{$estxsol->id}}" style="color: red;"></p>
                                                @endif
                                                    
                                                <input name="id[]" hidden readonly value="{{$estxsol->id}}">
                                                    
                                            </div>
                                        </div>
                                        @if($estxsol->TextoValores == "")
                                            <div class="col-2 text-center">
                                                No hay valores
                                            </div>
                                        @else
                                            <div class="col-2 text-center">
                                                {{$estxsol->TextoValores}}
                                                <input id="ValMin{{$estxsol->id}}" hidden readonly value="{{$estxsol->Valmin}}">
                                                <input id="ValMax{{$estxsol->id}}" hidden readonly value="{{$estxsol->ValMax}}">
                                            </div>
                                        @endif
                                        <div class="col-2 text-center">
                                            {{$estxsol->Medida}}
                                        </div>
                                        <div class="col-2 text-center">
                                            @if($estxsol->formula != null)
                                            <input id="txtformula{{$estxsol->id}}" value="{{$estxsol->formula}}" readonly style="border: 0px; text-align: center;">
                                            @endif  
                                        </div>
                                        <div class="col-1 text-center">
                                            @if($estxsol->antibiograma == 1)
                                            <button title="Ver antibiograma" class="btn btn-primary" type="button" onclick="llamarformulario({{$estxsol->id}});">
                                                <i class="fa fa-archive" aria-hidden="true"></i>
                                            </button>
                                            @endif
                                            @if($estxsol->editor_texto == 1)
                                            <button title="Usar Editor de Texto" class="btn btn-primary" type="button" onclick="llamarEditorTexto({{$estxsol->id}});">
                                                <i class="fa fa-file" aria-hidden="true"></i>
                                            </button>
                                            @endif
                                        </div>
                                        <div class="col-1 text-center">
                                            <input id="Estado{{$estxsol->id}}" type="checkbox" {{$estxsol->Estatus=="1"?'Checked':''}} class="form-check-input" onclick="cambiarEstado({{$estxsol->id}});">
                                            <input id="EstadoDB{{$estxsol->id}}" name="Estado[]" hidden readonly value="{{$estxsol->Estatus}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($estxsoles as $estxsol)
        @if($estxsol->antibiograma == 1)
        <form action="{{route('registro_resultados.index')}}" id="frmContencion{{$estxsol->id}}" hidden  method="GET">
            @csrf
            <input id="modal_IdSolicitud{{$estxsol->id}}" name="modal_IdSolicitud" hidden readonly class="modal_IdSolicitud">
            <input id="modal_inValidador{{$estxsol->id}}" name="modal_inValidador" hidden readonly class="modal_inValidador">
            <input id="modal_selectPaciente{{$estxsol->id}}" name="modal_selectPaciente" hidden readonly class="modal_selectPaciente">
            <input id="modal_inFechaI{{$estxsol->id}}" name="modal_inFechaI" hidden readonly class="modal_inFechaI">
            <input id="modal_inFechaF{{$estxsol->id}}" name="modal_inFechaF" hidden readonly class="modal_inFechaF">
            <input id="modal_selectDepto{{$estxsol->id}}" name="modal_selectDepto" hidden readonly class="modal_selectDepto">

            <input id="modal_tomaxest_id{{$estxsol->id}}" name="modal_tomaxest_id" value="{{$estxsol->id}}" hidden readonly>
            <button id="btnfrmContencion{{$estxsol->id}}" class="btn btn-primary" type="submit">
                <i class="fa fa-archive" aria-hidden="true"></i>
            </button>
            <input name="btnAntibiograma" class="btnAntibiograma"  readonly>
        </form>
        @endif
    @endforeach
    @foreach ($estxsoles as $estxsol)
        @if($estxsol->editor_texto == 1)
        <form action="{{route('registro_resultados.index')}}" id="frmEditorTex{{$estxsol->id}}" hidden method="GET">
            @csrf
            <input id="editor_IdSolicitud{{$estxsol->id}}" name="modal_IdSolicitud" hidden readonly class="modal_IdSolicitud">
            <input id="editor_inValidador{{$estxsol->id}}" name="modal_inValidador" hidden readonly class="modal_inValidador">
            <input id="editor_selectPaciente{{$estxsol->id}}" name="modal_selectPaciente" hidden readonly class="modal_selectPaciente">
            <input id="editor_inFechaI{{$estxsol->id}}" name="modal_inFechaI" hidden readonly class="modal_inFechaI">
            <input id="editor_inFechaF{{$estxsol->id}}" name="modal_inFechaF" hidden readonly class="modal_inFechaF">
            <input id="editor_selectDepto{{$estxsol->id}}" name="modal_selectDepto" hidden readonly class="modal_selectDepto">
            <input id="editor_tomaxest_id{{$estxsol->id}}" name="modal_tomaxest_id" value="{{$estxsol->id}}" hidden readonly>
            <button id="btnfrmEditor{{$estxsol->id}}" class="btn btn-primary" hidden type="submit">
                <i class="fa fa-archive" aria-hidden="true"></i>
            </button>
            <input name="btnEditorTexto" class="btnEditorTexto" hidden readonly>
        </form>
        @endif
    @endforeach
    @include('registro_resultados.antibiogramaU')
    @include('registro_resultados.editor_textual')
@stop
@section('css')
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('plugins.Select2', true)
{{-- @section('plugins.Datatables', true) --}}

@section('js')
<script>
    $(document).ready(function () {
        $('.select2-multiple').select2();

        $('#lista').DataTable({
            "order": [[ 0, 'desc' ]],
            "lengthMenu": [[5,10,50,-1],[5,10,50, "All"]],
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script src="{{ asset('js/multiregistros.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script>
CKEDITOR.replace( 'editor' );
</script>
<script>
    document.addEventListener('keydown', function(evt) {
    if (evt.key === 'Enter') {
        evt.preventDefault(); // Evitar que se envíe el formulario
        let element = evt.target;
        let tabIndex = element.tabIndex + 1;
        var next = document.querySelector('[tabindex="'+tabIndex+'"]');

        // Si encontramos un elemento
        if (next) {
            next.focus();
            next.select();
        } else {
            // Si no encontramos un elemento, hacer focus al primer input
            var first = document.querySelector('[tabindex="1"]');
            first.focus();
            first.select();
        }
    }
    });
    function seleccionarResultado(index){
        $("#Resultado"+index).select();
        /* document.getElementById(inputS).focus(); */
    }
    function seleccionarTextoResultado(index){
        $("#textoResultado"+index).select();
        /* document.getElementById(inputS).focus(); */
    }
    function llamarformulario(index){
        $(".btnAntibiograma").val(1);
        $("#btnfrmContencion"+index).click();
    }
    function cambiarValor(){
        $(".btnAntibiograma").val(2);
        
    }
    function llamarEditorTexto(index){
        $(".btnEditorTexto").val(1);
        $("#btnfrmEditor"+index).click();
    }
</script>
@if(session('modal_abierto') == 'si')
<script>
$('#Antibiograma').modal('toggle');
</script>
@endif 

@if(session('editor_abierto') == 'si')
<script>
    $('#EditorTextual').modal('toggle');
</script>
@endif

<script src="{{ asset('js/registro_resultados.js')}}" rel="stylesheet"></script>
@if($desplegado == '2')
<script>
    $('#BuscarPaciente').prop('disabled', 'disabled');
    $('#BuscarxDepto').prop('disabled', 'disabled');
    $('#PorFecha').prop('checked', true);
    $("#validacion").val(2);
    document.getElementById("BuscarPaciente").style.display = "block";
    $("#BuscarxFecha").val('{{$finicio}}');
    $("#BuscarxFechaFin").val('{{$ffin}}');
</script>
@endif

@if($desplegado == '1')
<script>
   $('#BuscarPaciente').prop('disabled', false);
    $('#BuscarxDepto').prop('disabled', 'disabled');
    $('#PorPaciente').prop('checked', true);
    $("#BuscarPaciente").val({{$slcPaciente}});
    $("#validacion").val(1);
    document.getElementById("BuscarPaciente").style.display = "block";
    $("#BuscarxFecha").val('{{$finicio}}');
    $("#BuscarxFechaFin").val('{{$ffin}}');
</script>
@endif
@if($desplegado == '3')
<script>
    $('#BuscarPaciente').prop('disabled', 'disabled');
    $('#BuscarxDepto').prop('disabled', false);
    $('#PorDepto').prop('checked', true);
    $("#BuscarxDepto").val({{$idDepto}});
    $("#validacion").val(3);
    document.getElementById("BuscarPaciente").style.display = "block";
    $("#BuscarxFecha").val('{{$finicio}}');
    $("#BuscarxFechaFin").val('{{$ffin}}');
</script>
@endif

@stop