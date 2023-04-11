<div class="modal fade" id="updateEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="updateEmpresaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateEmpresaModalLabel">Editar empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form id="empresaFormulario" enctype="multipart/form-data" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input name"_token" hidden value="{{ csrf_token() }}" type="text">
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" href="#general2Empresa" data-toggle="tab" role="tab" aria-selected="false">Datos Generales</a>
							</li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#Opcionales2Empresa" data-toggle="tab" role="tab" aria-selected="false">Datos Opcionales</a>
                             </li>
						</ul>
                        <div class="tab-content">
                            <div id="general2Empresa" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Nombre de Empresa---------------->
                                        <div class="form-group">
                                            <label>Empresa:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" minlength="2" maxlength="250" onkeypress="return soloLetras(event)" placeholder="Nombre de la empresa" required class="form-control text-box single-line" id="NombreEditEmpresa" name="NombreEdit" type="text">
                                        </div>
                                        <!----Telefono 1------------------->
										<div class="form-group">
                                            <label class="control-label" for="tel1Edit">Teléfono 1:</label>
                                            <input title="Máximo 20 carácteres" pattern="[0-9 ]*" autofocus class="form-control text-box single-line" id="tel1EditEmpresa" maxlength="20" name="tel1Edit" type="tel">  
                                        </div>
                                        <!------------------Teléfono 2--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="tel2Edit">Teléfono 2:</label><b class="obligatorio">(*)</b>
                                            <input title="Máximo 20 carácteres" pattern="[0-9 ]*" class="form-control text-box single-line" id="tel2EditEmpresa" maxlength="20"  name="tel2Edit" type="tel" >
                                        </div>
                                        <!------------------Tipo de Empresa:--------------------->
										{{-- <div class="form-group">
                                            <label class="control-label" for="Empresaestudio">Departamento:</label><b class="obligatorio">(*)</b>
                                            <select class="form-control text-box single-line" id="Tipo_EmpresaEdit" name="Tipo_EmpresaEdit" maxlength="12"  type="text" >
                                                <option value="---">Elegir...</option>
                                                <option value="Pública">Pública</option>
                                                <option value="Privada">Privada</option>
                                            </select>   
                                        </div> --}}
                                    </div>                                                               
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="Opcionales2Empresa" >
                                <div class="card">
                                    <div class="card-body">
                                        <!--------------------RFC------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">RFC:</label>
                                            <input pattern="[0-9a-zA-Z]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="rfcEditEmpresa" minlength="15" maxlength="15" name="rfcEdit" type="text" >                            
                                        </div>
                                        <!--------------------direccionEdit------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">Dirección:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="direccionEditEmpresa" maxlength="250" name="direccionEdit" type="text" >                            
                                        </div>
                                        <!--------------------Numero------------------->
                                        {{-- <div class="form-group">                           
                                            <label class="control-label" for="rfc">Número:</label>
                                            <input autocomplete="off" class="form-control text-box single-line validanumericos" id="NumeroEdit" maxlength="100" name="NumeroEdit" type="text" >                            
                                        </div> --}}
                                        <!--------------------Colonia------------------->
                                        {{-- <div class="form-group">                           
                                            <label class="control-label" for="rfc">Colonia:</label>
                                            <input autocomplete="off" class="form-control text-box single-line validanumericos" id="ColoniaEdit" maxlength="100" name="ColoniaEdit" type="text" >                            
                                        </div> --}}
                                         <!--------------------Código Postal------------------->
                                         <div class="form-group">                           
                                            <label class="control-label" for="cp">Código Postal:</label>
                                            <input title="Código postal (5 números)." pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="CpEditEmpresa" minlength="10" maxlength="10" name="CpEdit" type="text" >                            
                                         </div>
                                        <!--------------------País------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="pais">País:</label>
                                            <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="paisEditEmpresa" minlength="2" maxlength="100" name="paisEdit" type="text" >          
                                        </div>
                                         <!--------------------Estado------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Estado">Estado:</label>
                                           <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="EstadoEditEmpresa" minlength="2" maxlength="100" name="EstadoEdit" type="text">
                                        </div>
                                        <!--------------------Municipio------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Municipio">Municipio:</label>
                                           <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="MunicipioEditEmpresa" minlength="2" maxlength="100" name="MunicipioEdit" type="text" >                            
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div style="text-align:right">
                                <a href=""><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Cancelar</button></a>
                                <button onclick="enviarDatosEditadosEmpresa()" type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                            </div>
                        </div>
                    </div>
                    <input id="redireccionadorEditEmpresa" name="redireccionador" readonly type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function enviarDatosEditadosEmpresa(){
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
</script>