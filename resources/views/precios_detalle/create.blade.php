<div class="modal fade" id="createPrecioModal" tabindex="-1" role="dialog" aria-labelledby="createPrecioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPrecioModalLabel">Datos del precio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form action="/precios_detalle/" method="POST">
                    @csrf
                    <div class="tabpanel">
                        
                        <div class="tab-content">
                            <div id="tarjeta1CreateEmpresa" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Nombre Precio---------------->
                                        <div class="form-group">
                                            <label>Precio/Tarifa:</label>
                                            <select class="form-control select2-hidden-accessible" id="CreateidPrecio" name="CreateidPrecio">
                                                @foreach ($precios as $precio)
                                                    <option value="{{$precio->idPrecio}}">{{$precio->Descripcion}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!----Estudio------------------->
										<div class="form-group">
                                            <label class="control-label" for="FecNac">Estudio:</label>
                                            <select class="form-control select2-hidden-accessible" id="CreateEstudio" name="CreateEstudio">
                                                @foreach ($estudios as $estudio)
                                                    <option value="{{$estudio->idEstudio}}">{{$estudio->Nombre}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                        <div class="form-group">
                                            <label class="float-left" for="descripcion">Precio:</label>
                                            <input class="form-control" id="Createprecio" name="Createprecio" step="0.01" value="0.00" placeholder="0.00" type="number">
                                        </div>
                                    </div>                                                               
                                </div>
                            </div>
                            
                            <div style="text-align:right">
                                <a href=""><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button></a>
                                <button type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>