<div class="modal fade" id="Antibiograma">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="AntibiogramaLabel">Antibiograma</h4>
                <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="antibiograma" enctype="multipart/form-data" method="POST">
                @csrf
                <input id="id_solicitud" name="id_solicitud" hidden readonly>
                <input id="antibiograma_validacion" name="antibiograma_validacion" hidden readonly>
                <input id="antibiograma_FechaI" name="antibiograma_FechaI" hidden readonly>
                <input id="antibiograma_FechaF" name="antibiograma_FechaF" hidden readonly>
                <input name="antibiograma_modal_selectDepto" class="modal_selectDepto" hidden readonly>
                <input name="antibiograma_modal_selectPaciente" class="modal_selectPaciente" hidden readonly>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							@foreach($antibiogramas as $antibiograma)
                            @if ($loop->first)
                            <li class="nav-item" role="presentation">
								<a  class="nav-link active" href="#Bacteria{{$antibiograma->idAntibiograma}}" data-toggle="tab" role="tab" aria-selected="false">Bacteria #{{$antibiograma->num_bacteria}}</a>
							</li>
                            @endif
                            @if ($loop->last)
                            <li class="nav-item" role="presentation">
								<a  class="nav-link" href="#Bacteria{{$antibiograma->idAntibiograma}}" data-toggle="tab" role="tab" aria-selected="false">Bacteria #{{$antibiograma->num_bacteria}}</a>
							</li>
                            @endif
                            @if ($loop->remaining == 1)
                            <li class="nav-item" role="presentation">
								<a  class="nav-link " href="#Bacteria{{$antibiograma->idAntibiograma}}" data-toggle="tab" role="tab" aria-selected="false">Bacteria #{{$antibiograma->num_bacteria}}</a>
							</li>
                            @endif
                            @endforeach
						</ul>
                        <br>
                        <div class="tab-content" >
                            
                            @foreach($antibiogramas as $antibiograma)
                            @if ($loop->first)
                            <div id="Bacteria{{$antibiograma->idAntibiograma}}" role="tabpanel" class="tab-pane active">
                                <div class="container-fluid">
                                    <!----------------------Bacteria---------------->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Bacteria #{{$antibiograma->num_bacteria}}:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="idAntibiograma{{$antibiograma->idAntibiograma}}" name="idAntibiograma[]" value="{{$antibiograma->idAntibiograma}}" hidden readonly>
                                            <select name="slcBacteria[]" class="form-control">
                                                <option value="{{$antibiograma->id_bacteria}}">{{$antibiograma->descripcion}}</option>
                                                @foreach($bacterias as $bacteria)
                                                   <option value="{{$bacteria->idBacteria}}">{{$bacteria->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Datos extra:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="txtDatosExtra[]" class="form-control" maxlength="300">{{$antibiograma->datos_extra}}</textarea>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        {{--------------------------------------Grupo Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Grupo de Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">                                           
                                            <select id="slcGrupoAntibiotico{{$antibiograma->idAntibiograma}}" name="slcGrupoAntibiotico" class="form-control" onchange="slcRecarga({{$antibiograma->idAntibiograma}});">
                                                <option>Elige</option>
                                                @foreach($grupo_antibioticos as $grupo_a)
                                                    <option value="@foreach($grupo_a->detalleGrupoAntibioticos as $grupitos){{$grupitos->antibiotico->descripcion}}{{"."}}@endforeach">{{$grupo_a->descripcion}}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        {{-------------------------------------------Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="slcAntibiotico{{$antibiograma->idAntibiograma}}" name="slcAntibiotico" class="form-control" onchange="seleccionarAntibiotico({{$antibiograma->idAntibiograma}});">
                                                @foreach($antibioticos as $antibiotico)
                                                   <option value="{{$antibiotico->idAntibiotico}}">{{$antibiotico->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tableAntibioticos{{$antibiograma->idAntibiograma}}" class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Antibiótico</th>
                                                        <th scope="col">Resultado</th>
                                                        <th scope="col">CMI (mg/L)</th>
                                                        <th scope="col" width="7%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if(session('modal_abierto') == 'si')
                                                   @foreach($antibiograma->antibiogramaDetalles as $detalles)
                                                    <tr id="filaDB{{$detalles->idAntibiogramaDetalle}}">
                                                        <td>
                                                            <input name="textoAntibiotico[]" value="{{$detalles->antibiotico}}" style="border:0;background-color: unset;" readonly>
                                                            <input name="textoidAntibiograma[]" value="{{$detalles->id_Antibiograma}}" hidden readonly>
                                                            <input name="idAntibiogramaDetalle[]" value="{{$detalles->idAntibiogramaDetalle}}" hidden readonly>
                                                        </td>
                                                        <td><input id="textoResultado{{$detalles->idAntibiogramaDetalle}}" name="textoResultado[]" class="focusNext" tabindex="{{$detalles->idAntibiogramaDetalle}}" maxlength="10" value="{{$detalles->resultado}}" onclick="seleccionarTextoResultado({{$detalles->idAntibiogramaDetalle}});" onblur="generarPalabras({{$detalles->idAntibiogramaDetalle}});"></td>
                                                        <td><input name="textoUnidad[]" class="focusNext" tabindex="1{{$detalles->idAntibiogramaDetalle}}" maxlength="50" value="{{$detalles->unidad}}"></td>
                                                        <td class="text-center">
                                                            <i onclick="eliminarBase({{$detalles->idAntibiogramaDetalle}});" style="color: #ff0000" class="fa fa-times"></i>
                                                            <input id="canceladoDB{{$detalles->idAntibiogramaDetalle}}" name="cancelado[]" type="text" hidden readonly>
                                                        </td>
                                                    </tr>
                                                   @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($loop->last)
                            <div id="Bacteria{{$antibiograma->idAntibiograma}}" role="tabpanel" class="tab-pane">
                                <div class="container-fluid">
                                    <!----------------------Bacteria---------------->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Bacteria #{{$antibiograma->num_bacteria}}:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="idAntibiograma{{$antibiograma->idAntibiograma}}" name="idAntibiograma[]" value="{{$antibiograma->idAntibiograma}}" hidden readonly>
                                            <select name="slcBacteria[]" class="form-control">
                                                <option value="{{$antibiograma->id_bacteria}}">{{$antibiograma->descripcion}}</option>
                                                @foreach($bacterias as $bacteria)
                                                   <option value="{{$bacteria->idBacteria}}">{{$bacteria->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Datos extra:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="txtDatosExtra[]" class="form-control" maxlength="300">{{$antibiograma->datos_extra}}</textarea>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        {{--------------------------------------Grupo Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Grupo de Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">                                           
                                            <select id="slcGrupoAntibiotico{{$antibiograma->idAntibiograma}}" name="slcGrupoAntibiotico" class="form-control" onchange="slcRecarga({{$antibiograma->idAntibiograma}});">
                                                <option>Elige</option>
                                                @foreach($grupo_antibioticos as $grupo_a)
                                                    <option value="@foreach($grupo_a->detalleGrupoAntibioticos as $grupitos){{$grupitos->antibiotico->descripcion}}{{"."}}@endforeach">{{$grupo_a->descripcion}}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        {{-------------------------------------------Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="slcAntibiotico{{$antibiograma->idAntibiograma}}" name="slcAntibiotico" class="form-control" onchange="seleccionarAntibiotico({{$antibiograma->idAntibiograma}});">
                                                @foreach($antibioticos as $antibiotico)
                                                   <option value="{{$antibiotico->idAntibiotico}}">{{$antibiotico->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tableAntibioticos{{$antibiograma->idAntibiograma}}" class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Antibiótico</th>
                                                        <th scope="col">Resultado</th>
                                                        <th scope="col">CMI (mg/L)</th>
                                                        <th scope="col" width="7%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(session('modal_abierto') == 'si')
                                                   @foreach($antibiograma->antibiogramaDetalles as $detalles)
                                                    <tr id="filaDB{{$detalles->idAntibiogramaDetalle}}">
                                                        <td>
                                                            <input name="textoAntibiotico[]" value="{{$detalles->antibiotico}}" style="border:0;background-color: unset;" readonly>
                                                            <input name="textoidAntibiograma[]" value="{{$detalles->id_Antibiograma}}" hidden readonly>
                                                            <input name="idAntibiogramaDetalle[]" value="{{$detalles->idAntibiogramaDetalle}}" hidden readonly>
                                                        </td>
                                                        <td><input id="textoResultado{{$detalles->idAntibiogramaDetalle}}" name="textoResultado[]" class="focusNext" maxlength="10" value="{{$detalles->resultado}}" tabindex="{{$detalles->idAntibiogramaDetalle}}" onclick="seleccionarTextoResultado({{$detalles->idAntibiogramaDetalle}});" onblur="generarPalabras({{$detalles->idAntibiogramaDetalle}});"></td>
                                                        <td><input name="textoUnidad[]" class="focusNext" tabindex="1{{$detalles->idAntibiogramaDetalle}}" maxlength="50" value="{{$detalles->unidad}}"></td>
                                                        <td class="text-center">
                                                            <i onclick="eliminarBase({{$detalles->idAntibiogramaDetalle}});" style="color: #ff0000" class="fa fa-times"></i>
                                                            <input id="canceladoDB{{$detalles->idAntibiogramaDetalle}}" name="cancelado[]" type="text" hidden readonly>
                                                        </td>
                                                    </tr>
                                                   @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($loop->remaining == 1)
                            <div id="Bacteria{{$antibiograma->idAntibiograma}}" role="tabpanel" class="tab-pane">
                                <div class="container-fluid">
                                    <!----------------------Bacteria---------------->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Bacteria #{{$antibiograma->num_bacteria}}:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="idAntibiograma{{$antibiograma->idAntibiograma}}" name="idAntibiograma[]" value="{{$antibiograma->idAntibiograma}}" hidden readonly>
                                            <select name="slcBacteria[]" class="form-control">
                                                <option value="{{$antibiograma->id_bacteria}}">{{$antibiograma->descripcion}}</option>
                                                @foreach($bacterias as $bacteria)
                                                   <option value="{{$bacteria->idBacteria}}">{{$bacteria->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Datos extra:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="txtDatosExtra[]" class="form-control" maxlength="300">{{$antibiograma->datos_extra}}</textarea>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        {{--------------------------------------Grupo Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Grupo de Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">                                           
                                            <select id="slcGrupoAntibiotico{{$antibiograma->idAntibiograma}}" name="slcGrupoAntibiotico" class="form-control" onchange="slcRecarga({{$antibiograma->idAntibiograma}});">
                                                <option>Elige</option>
                                                @foreach($grupo_antibioticos as $grupo_a)
                                                    <option value="@foreach($grupo_a->detalleGrupoAntibioticos as $grupitos){{$grupitos->antibiotico->descripcion}}{{"."}}@endforeach">{{$grupo_a->descripcion}}</option>
                                                @endforeach
                                            </select>                                            
                                        </div>
                                        {{-------------------------------------------Antibiótico------------------------------------------------}}
                                        <div class="col-md-2">
                                            <label>Antibióticos:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="slcAntibiotico{{$antibiograma->idAntibiograma}}" name="slcAntibiotico" class="form-control" onchange="seleccionarAntibiotico({{$antibiograma->idAntibiograma}});">
                                                @foreach($antibioticos as $antibiotico)
                                                   <option value="{{$antibiotico->idAntibiotico}}">{{$antibiotico->descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="tableAntibioticos{{$antibiograma->idAntibiograma}}" class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Antibiótico</th>
                                                        <th scope="col">Resultado</th>
                                                        <th scope="col">CMI (mg/L)</th>
                                                        <th scope="col" width="7%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(session('modal_abierto') == 'si')
                                                   @foreach($antibiograma->antibiogramaDetalles as $detalles)
                                                    <tr id="filaDB{{$detalles->idAntibiogramaDetalle}}">
                                                        <td>
                                                            <input name="textoAntibiotico[]" value="{{$detalles->antibiotico}}" style="border:0;background-color: unset;" readonly>
                                                            <input name="textoidAntibiograma[]" value="{{$detalles->id_Antibiograma}}" hidden readonly>
                                                            <input name="idAntibiogramaDetalle[]" value="{{$detalles->idAntibiogramaDetalle}}" hidden readonly>
                                                        </td>
                                                        <td><input id="textoResultado{{$detalles->idAntibiogramaDetalle}}" name="textoResultado[]" class="focusNext" maxlength="10" value="{{$detalles->resultado}}" tabindex="{{$detalles->idAntibiogramaDetalle}}" onclick="seleccionarTextoResultado({{$detalles->idAntibiogramaDetalle}});" onblur="generarPalabras({{$detalles->idAntibiogramaDetalle}});"></td>
                                                        <td><input name="textoUnidad[]" class="focusNext" tabindex="1{{$detalles->idAntibiogramaDetalle}}" maxlength="50" value="{{$detalles->unidad}}"></td>
                                                        <td class="text-center">
                                                            <i onclick="eliminarBase({{$detalles->idAntibiogramaDetalle}});" style="color: #ff0000" class="fa fa-times"></i>
                                                            <input id="canceladoDB{{$detalles->idAntibiogramaDetalle}}" name="cancelado[]" type="text" hidden readonly>
                                                        </td>
                                                    </tr>
                                                   @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="float-left">
                            R = Resistente I = Intermedio S = Sensible
                        </div>
                    </div>
                             
                
            </div>
            <div class="modal-footer">
                <button id="btnRecarga" type="submit" class="btn btn-primary">
                    Guardar
                </button>
                <button id="btnCancelarModal" type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            </div>
          </form>
        </div>
    </div>
</div>


