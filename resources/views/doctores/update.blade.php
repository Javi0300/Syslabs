<!-- Modal -->
<div class="modal fade" id="updateDoctor" tabindex="-1" role="dialog" aria-labelledby="updateDoctorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDoctorLabel">Editar doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form id="formularioCreateDoctor" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" href="#SegundoDoctor" data-toggle="tab" role="tab" aria-selected="false">Datos Personales</a>
							</li>
							<li class="nav-item" role="presentation">
							   <a class="nav-link" href="#OpcionalDoctorUpdate" data-toggle="tab" role="tab" aria-selected="false">Datos Opcionales</a>
							</li>
						</ul>
                        <div class="tab-content">
                            <div id="SegundoDoctor" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Doctor---------------->
                                        <div class="form-group">
                                            <label>Doctor:</label>
                                            <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 '`.]*" autocomplete="off" required class="form-control" id="DoctorEdit" name="DoctorEdit" minlength="2" maxlength="150">
                                        </div>
                                        <!----Fecha de nacimiento------------------->
										{{-- <div class="form-group">
                                            <label class="control-label" for="FecNac">Fecha de nacimiento:</label>
                                            <input required class="form-control text-box single-line" id="FecNacEditDoctor" maxlength="10" name="FecNacEdit" type="date">
                                        </div> --}}
                                        <!----------------------Especialidad1---------------->
                                        <div class="form-group">
                                            <label>Especialidad 1:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="Especialidad1Edit" name="Especialidad1Edit" maxlength="30">
                                        </div>
                                        <!----------------------Especialidad2---------------->
                                        <div class="form-group">
                                            <label>Especialidad 2:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="Especialidad2Edit" name="Especialidad2Edit" maxlength="30">
                                        </div>
                                        <!----------------------CedProf---------------->
                                        <div class="form-group">
                                            <label>Cedula Profesional:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" class="form-control" id="CedProfEdit" name="CedProfEdit" maxlength="100">
                                        </div>
                                        <!------------------Sexo--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Sexo">Género:</label><b class="obligatorio">(*)</b>
                                            <div class="form-check">
                                                <input required class="form-check-input" id="SexoEditDoctorH" name="SexoEdit" type="radio" value="H"><label class="form-check-label">H</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="SexoEditDoctorM" name="SexoEdit" type="radio" value="M" required><label class="form-check-label">M</label>
                                            </div>
                                        </div>
                                        <!------------------Teléfono--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Telefono">Teléfono:</label><br>
                                            <input title="Mínimo 10 números" pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="TelsEdit" maxlength="100" name="TelsEdit" type="tel" >
                                        </div>
                                        <!------------------email--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email:</label>
                                            <input class="form-control text-box single-line" id="emailEditDoctor" maxlength="100" name="emailEdit" type="email" >
                                        </div>
                                    </div>                                                               
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="OpcionalDoctorUpdate" >
                                <div class="card">
                                    <div class="card-body">
                                        <!--------------------Dirección------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="cp">Dirección:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="DireccionEditDoctor" maxlength="100" name="DireccionEdit" type="text" >                            
                                         </div>
                                       <!--------------------código Postal------------------->
                                       <div class="form-group">                           
                                        <label class="control-label" for="cp">Código Postal:</label>
                                        <input title="Código postal (5 números)." pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="cpEditDoctor" minlength="5" maxlength="5" name="cpEdit" type="text" >                            
                                     </div>
                                     <!--------------------Estado------------------->
                                     <div class="form-group">                           
                                        <label class="control-label" for="Estado">País:</label>
                                        <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line" id="PaisEditDoctor" maxlength="100" name="PaisEditDoctor" type="text" >          
                                     </div>
                                         <!--------------------Estado------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Estado">Estado:</label>
                                           <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="EstadoEditDoctor" maxlength="100" name="EstadoEdit" type="text" >          
                                        </div>
                                        <!--------------------Municipio------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Municipio">Municipio:</label>
                                           <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="MunicipioEditDoctor" maxlength="100" name="MunicipioEdit" type="text" >                            
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div style="text-align:right">
                                <input name"_token" hidden value="{{ csrf_token() }}" type="text">
                                <a href=""><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Cancelar</button></a>
                                <button type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                            </div>
                        </div>
                    </div>
                    <input id="redireccionadorDoctorEdit" name="redireccionador" readonly type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    function enviarDatosEditadosDoctor(){
        var FecNacModal = document.getElementById("FecNacEdit").value;
        if(document.getElementById("SexoEditM").checked == true){
            $("#tSexo10Edit").val(ObtenerSexo("M"));
            document.getElementById("SexoEditH").checked = false;
        }
        if(document.getElementById("SexoEditH").checked == true){
            $("#tSexo10Edit").val(ObtenerSexo("H"));
            document.getElementById("SexoEditM").checked = false;
        }
        var EmpresaModal = document.getElementById("EmpresaEdit").value;
        var TelefonoModal = document.getElementById("TelefonoEdit").value;
        
    
        $("#tFecNac10Edit").val(FecNacModal);
        $("#tEdad10").val(ObtenerEdad(FecNacModal));
        $("#tTipoEdad10").val(tipo);
        $("#tidEmpresa10Edit").val(EmpresaModal);
        $("#tTelefono10Edit").val(TelefonoModal);
    }
</script> --}}