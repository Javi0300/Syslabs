<!-- Modal -->
<div class="modal fade" id="updatePaciente" tabindex="-1" role="dialog" aria-labelledby="updatePacienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePacienteLabel">Editar paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form id="formulario" enctype="multipart/form-data" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" href="#Primero" data-toggle="tab" role="tab" aria-selected="false">Datos Personales</a>
							</li>
							<li class="nav-item" role="presentation">
							   <a class="nav-link" href="#Opcional" data-toggle="tab" role="tab" aria-selected="false">Datos Opcionales</a>
							</li>
						</ul>
                        <div class="tab-content">
                            <div id="Primero" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Paciente---------------->
                                        <div class="form-group">
                                            <label>Paciente:</label>
                                            <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 '`.]*" required class="form-control" id="PacienteEdit" name="PacienteEdit" maxlength="150">
                                        </div>
                                        <!----Fecha de nacimiento------------------->
										<div class="form-group">
                                            <label class="control-label" for="FecNac">Fecha de nacimiento:</label>
                                            <input required class="form-control text-box single-line" id="FecNacEdit" maxlength="10" name="FecNacEdit" type="date">
                                        </div>
                                        <!------------------Sexo--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Sexo">Género:</label><b class="obligatorio">(*)</b>
                                            <div class="form-check">
                                                <input required class="form-check-input" id="SexoEditH" name="SexoEdit" type="radio" value="H"><label class="form-check-label">H</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="SexoEditM" name="SexoEdit" type="radio" value="M" required><label class="form-check-label">M</label>
                                            </div>
                                        </div>
                                        <!------------------EmpresaEdit--------------------->
										<div class="form-group">
                                            <label class="control-label" for="Empresaestudio">Empresa:</label><b class="obligatorio">(*)</b>
                                            <select class="form-control select2-hidden-accessible" id="EmpresaEdit" name="EmpresaEdit" tabindex="-1" aria-hidden="true">
                                                @foreach($empresas as $empresa)
                                                <option value="{{$empresa->idEmpresa}}">{{$empresa->Nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!------------------Teléfono--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Telefono">Teléfono:</label><br>
                                            <input title="Solo números • Sin espacios • 10 números" pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="TelefonoEdit" minlength="10" maxlength="10" name="TelefonoEdit" type="tel" >
                                        </div>
                                        <!------------------email--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email:</label>
                                            <input title="Sin acentos • Sin espacios" pattern="[A-Za-z0-9_.@]*" class="form-control text-box single-line" id="emailEdit" maxlength="100" name="emailEdit" type="email" >
                                        </div>
                                    </div>                                                               
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="Opcional" >
                                <div class="card">
                                    <div class="card-body">
                                        <!--------------------RFC------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">RFC:</label>
                                            <input title="Sin caracteres especiales" pattern="[A-Za-z0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="rfcEdit" minlength="13" maxlength="15" name="rfcEdit" type="text" >                            
                                        </div>
                                        <!--------------------Calle------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">Calle:</label>
                                            <input title="Sin caracteres especiales" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 -.]*" class="form-control text-box single-line validanumericos" id="calleEdit" maxlength="100" name="calleEdit" type="text" >                            
                                        </div>
                                        <!--------------------Numero------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">Número:</label>
                                            <input autocomplete="off" class="form-control text-box single-line validanumericos" id="NumeroEdit" maxlength="100" name="NumeroEdit" type="text" >                            
                                        </div>
                                        <!--------------------Colonia------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">Colonia:</label>
                                            <input title="Sin caracteres especiales" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 -.]*" class="form-control text-box single-line validanumericos" id="ColoniaEdit" maxlength="100" name="ColoniaEdit" type="text" >                            
                                        </div>
                                         <!--------------------Código Postal------------------->
                                         <div class="form-group">                           
                                            <label class="control-label" for="cp">Código Postal:</label>
                                            <input title="Solo números • Sin espacios • 5 números" pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="CpEdit" minlength="5" maxlength="5" name="CpEdit" type="text" >                            
                                         </div>
                                        <!--------------------País------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="pais">País:</label>
                                            <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 ]*" class="form-control text-box single-line" id="paisEdit" minlength="2" maxlength="100" name="paisEdit" type="text" >          
                                        </div>
                                         <!--------------------Estado------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Estado">Estado:</label>
                                           <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 ]*" class="form-control text-box single-line" id="EstadoEdit" minlength="2" maxlength="100" name="EstadoEdit" type="text" >          
                                        </div>
                                        <!--------------------Municipio------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Municipio">Municipio:</label>
                                           <input title="Solo letras • Mínimo 2 carácteres" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1 ]*" class="form-control text-box single-line" id="MunicipioEdit" minlength="2" maxlength="100" name="MunicipioEdit" type="text" >                            
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <div style="text-align:right">
                                <input name"_token" hidden value="{{ csrf_token() }}" type="text">
                                <a href=""><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Cancelar</button></a>
                                <button onclick="enviarDatosEditadosPaciente()" type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                            </div>
                        </div>
                    </div>
                    <input id="redireccionadorEdit" name="redireccionador" readonly type="hidden">
                    <input id="tFecNac10Edit" name="tFecNac10" readonly type="hidden">
                    <input id="tEdad10Edit" name="tEdad10" readonly type="hidden">
                    <input id="tTipoEdad10Edit" name="tTipoEdad10" readonly type="hidden">
                    <input id="tSexo10Edit" name="tSexo10" readonly type="hidden">
                    <input id="tTelefono10Edit" name="tTelefono10" readonly type="hidden">
                    <input id="tidEmpresa10Edit" name="tidEmpresa10" readonly type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function enviarDatosEditadosPaciente(){
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
    $("#tEdad10").val(CalcularEdad(FecNacModal));
    $("#tTipoEdad10").val(tipo);
    $("#tidEmpresa10Edit").val(EmpresaModal);
    $("#tTelefono10Edit").val(TelefonoModal);
}
</script>