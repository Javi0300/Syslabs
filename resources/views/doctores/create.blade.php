<!-- Modal -->
<div class="modal fade" id="createDoctor" tabindex="-1" role="dialog" aria-labelledby="createDoctorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDoctorLabel">Registrar doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form action="/doctores/" method="POST">
                    @csrf
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" href="#PersonalesDoctor" data-toggle="tab" role="tab" aria-selected="false">Datos Personales</a>
							</li>
							<li class="nav-item" role="presentation">
							   <a class="nav-link" href="#OpcionalesDoctor" data-toggle="tab" role="tab" aria-selected="false">Datos Opcionales</a>
							</li>
						</ul>
                        <div class="tab-content">
                            <div id="PersonalesDoctor" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Doctor---------------->
                                        <div class="form-group">
                                            <label>Doctor:</label>
                                            <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 '`.]*" required class="form-control" id="DoctorCreate" name="DoctorCreate" minlength="2" maxlength="150">
                                        </div>
                                        <!----Fecha de nacimiento------------------->
										{{-- <div class="form-group">
                                            <label class="control-label" for="FecNac">Fecha de nacimiento:</label>
                                            <input required class="form-control text-box single-line" id="FecNacCreateDoctor" maxlength="10" name="FecNacCreate" type="date">
                                        </div> --}}
                                        <!----------------------Especialidad1---------------->
                                        <div class="form-group">
                                            <label>Especialidad 1:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="Especialidad1Create" name="Especialidad1Create" maxlength="30">
                                        </div>
                                        <!----------------------Especialidad2---------------->
                                        <div class="form-group">
                                            <label>Especialidad 2:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="Especialidad2Create" name="Especialidad2Create" maxlength="30">
                                        </div>
                                        <!----------------------CedProf---------------->
                                        <div class="form-group">
                                            <label>Cedula Profesional:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="CedProfCreate" name="CedProfCreate" maxlength="100">
                                        </div>
                                        <!------------------Sexo--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Sexo">Género:</label><b class="obligatorio">(*)</b>
                                            <div class="form-check">
                                                <input required class="form-check-input" id="SexoCreateDoctorH" name="SexoCreate" type="radio" value="H"><label class="form-check-label">H</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="SexoCreateDoctorM" name="SexoCreate" type="radio" value="M" required><label class="form-check-label">M</label>
                                            </div>
                                        </div>
                                        <!------------------Teléfono--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Telefono">Teléfono:</label><br>
                                            <input title="Mínimo 10 números" pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="TelsCreate" maxlength="100" name="TelsCreate" type="tel">
                                        </div>
                                        <!------------------email--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email:</label>
                                            <input class="form-control text-box single-line" id="emailCreateDoctor" maxlength="100" name="emailCreate" type="email" >
                                        </div>
                                    </div>                                                               
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="OpcionalesDoctor" >
                                <div class="card">
                                    <div class="card-body">
                                        <!--------------------Dirección------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="cp">Dirección:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="DireccionCreateDoctor" maxlength="100" name="DireccionCreate" type="text" >                            
                                         </div>
                                       <!--------------------código Postal------------------->
                                       <div class="form-group">
                                        <label class="control-label" for="cp">Código Postal:</label>
                                        <input title="Código postal (5 números)." pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="cpCreateDoctor" minlength="5" maxlength="5" name="cpCreate" type="text" >                            
                                        </div>
                                        <!--------------------Pais------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="País">País:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line" id="PaisCreateDoctor" maxlength="100" name="PaisCreateDoctor" type="text" >          
                                         </div>
                                        <!--------------------Estado------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Estado">Estado:</label>
                                           <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line" id="EstadoCreateDoctor" maxlength="100" name="EstadoCreate" type="text" >          
                                        </div>
                                        <!--------------------Municipio------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Municipio">Municipio:</label>
                                           <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control text-box single-line" id="MunicipioCreateDoctor" maxlength="100" name="MunicipioCreate" type="text" >                            
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div style="text-align:right">
                                
                                <a href=""><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Cancelar</button></a>
                                <button type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                            </div>
                        </div>
                    </div>
                    <input id="redireccionadorDoctor" name="redireccionador" readonly type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>