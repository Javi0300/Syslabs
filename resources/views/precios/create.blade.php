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
                <form action="/precios/" method="POST">
                    @csrf
                    <div class="tabpanel">
                        
                        <div class="tab-content">
                            <div id="tarjeta1CreateEmpresa" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!---------------------Abreviatura---------------->
                                        <div class="form-group">
                                            <label>Abreviatura:</label>
                                            <input autofocus minlength="1" maxlength="10" placeholder="Abreviatura" class="form-control text-box single-line" id="CreateAbreviatura" name="CreateAbreviatura" type="text">
                                        </div>
                                        <!----Nombre------------------->
										<div class="form-group">
                                            <label class="control-label" for="FecNac">Nombre:</label>
                                            <input required class="form-control text-box single-line" placeholder="Nombre" id="nombreCreateEmpresa" maxlength="150" name="nombreCreateEmpresa" type="text">  
                                        </div>
                                        <!----predeterminado------------------->
										{{-- <div class="form-group">
                                            <input data-val="true" id="CreatePredeterminado" name="CreatePredeterminado" type="checkbox" value="1">
                                            <label style="text-align:right">¿Es predeterminado?</label>  
                                        </div> --}}
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

<script src="{{ asset('js/multiregistros.js')}}"></script>