@extends('adminlte::page')

@section('content_header')
<h1>Configuración del Grupo de Antibióticos</h1>
@stop

@section('content')
<form enctype="multipart/form-data" action="/detallegrupoantibioticos/{{$grupo_antibiotico->idGrupoAntibiotico}}" method="POST">
    @csrf
    @method('PUT')
    <div class="tabpanel">
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Primero">
                <div class="card">
                    <div class="card-body">
                        <!----------------------descripcion---------------->
                        <div class="form-group">
                            <label for="descripcion">Descipción:</label>
                            <input title="Sin caracteres especiales • Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" value="{{$grupo_antibiotico->descripcion}}" minlength="2" maxlength="100" required class="form-control" id="descripcion" name="descripcion" autofocus>
                        </div>
                            
                    </div>                                                          
                </div>
            </div>
        </div>
    </div>
    <div style="text-align:right">
        <a href="/detallegrupoantibioticos"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Regresar</button></a>
        <button id="btnGuardar" type="submit" class="btn btn-primary close-modal" >Guardar</button>         
    </div>
    @if($message = Session::get("error"))
        <div style="text-align:left" class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif
    <!------------------------------------------------------------------------------------------------------------>
    <div class="card">
        <div class="card-header"><h4>Antibióticos del Grupo</h4></div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Antibióticos Disponibles</th>
                            <th></th>
                            <th>Antibióticos Asignados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!----------------------------Select de Disponible---------------------------->
                            <td style="width: 40%;">
                                <select id="select_disponible" name="select_disponible" class="form-control" size="20" onchange="desbloquearBotonGuardar();">
                                    @foreach($antibioticos as $antibiotico)
                                    <option value="{{$antibiotico->idAntibiotico}}">{{$antibiotico->descripcion}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 20%;text-align:center;">
                                <br><br>
                                <button id="btnPlusGuardar" type="button" class="btn btn-info" onclick="elegirAntibiotico();"><i class="far fa fa-plus"></i></button>
                                <br><br>
                                <button id="btnEliminar" type="submit" class="btn btn-info" onclick="deselegirAntibiotico();"><i class="far fa fa-minus"></i></button> 
                            </td>
                            <!--------------------Select de Detalles------------------------------------>
                            <td id="td_detalleGrupoAnt_detalle" class="table-responsive">
                                @foreach($detallesGA as $ga)
                                <div id="filaAntibioticoDB{{$ga->idDetalleGrupoAntibiotico}}" class="col-md-12" onclick="marcarFilasAntibioticoDB({{$ga->idDetalleGrupoAntibiotico}});">
                                    <div class="container">
                                        <input name="idDetalleGrupoAntibiotico[]" value="{{$ga->idDetalleGrupoAntibiotico}}" hidden readonly>
                                        <input name="id_Antibiotico[]" class="id_Antibiotico" value="{{$ga->id_Antibiotico}}" hidden readonly>
                                        <p>{{$ga->antibiotico->descripcion}}</p>
                                        <input id="canceladoDB{{$ga->idDetalleGrupoAntibiotico}}" name="cancelado[]" type="text" hidden readonly>
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

@stop

@section('js')
<script src="{{ asset('js/detalle_grupo_antibioticos.js')}}"></script>
<script src="{{ asset('js/multiregistros.js')}}"></script>
<script>
    function desbloquearBotonGuardar(){
        document.getElementById('btnPlusGuardar').disabled = false;
    }
    contB = 1;
    function elegirAntibiotico(){
        var antibioticos_id = $('#select_disponible').val();
        var antibioticos_texto = $('#select_disponible option:selected').text();
        var fila = '<div id="filaAntibioticoN'+contB+'" class="col-md-12" onclick="marcarFilasAntibioticoN('+contB+');"><div class="container"><input name="idDetalleGrupoAntibiotico[]" hidden readonly><input name="id_Antibiotico[]" value="'+antibioticos_id+'" hidden readonly><p>'+antibioticos_texto+'</p><input id="canceladoN'+contB+'" name="cancelado[]" type="text" hidden readonly></div></div>';
        contB++;
        $("#select_disponible option:selected").remove();
        $('#td_detalleGrupoAnt_detalle').append(fila);
        $("#btnPlusGuardar"). attr("disabled", true);
    }

    function deselegirAntibiotico(){
        $('.eliminarAntibiotico').css('background', 'red');
    }
  function marcarFilasAntibioticoN(index){
    document.getElementById("canceladoN"+index).value = "1";
    document.getElementById("filaAntibioticoN"+index).style.backgroundColor  = "gray";
    $("#filaAntibioticoN"+index).removeClass('col-md-12');
    $("#filaAntibioticoN"+index).addClass('eliminarAntibiotico');
  }
  function marcarFilasAntibioticoDB(index){
    document.getElementById("canceladoDB"+index).value = "1";
    document.getElementById("filaAntibioticoDB"+index).style.backgroundColor  = "gray";
    $("#filaAntibioticoDB"+index).removeClass('col-md-12');
    $("#filaAntibioticoDB"+index).addClass('eliminarAntibiotico');
  }
  function validaNumericos(event) {
      if(event.charCode >= 48 && event.charCode <= 57){
        return true;
      }
      return false;        
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
@stop