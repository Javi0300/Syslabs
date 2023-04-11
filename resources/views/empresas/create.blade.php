<div class="modal fade" id="createEmpresaModal" tabindex="-1" role="dialog" aria-labelledby="createEmpresaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEmpresaModalLabel">Registrar empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!----------------------------------------Empieza formulario---------------------------------------------------->
            <div class="modal-body">
                <form action="/empresas/" method="POST">
                    @csrf
                    <div class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" href="#tarjeta1CreateEmpresa" data-toggle="tab" role="tab" aria-selected="false">Datos Generales</a>
							</li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#tarjeta2CreateEmpresa" data-toggle="tab" role="tab" aria-selected="false">Datos Opcionales</a>
                             </li>
						</ul>
                        <div class="tab-content">
                            <div id="tarjeta1CreateEmpresa" role="tabpanel" class="tab-pane active">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!----------------------Nombre de Empresa---------------->
                                        <div class="form-group">
                                            <label>Empresa:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" minlength="2" maxlength="250" onkeypress="return soloLetras(event)" placeholder="Nombre de la empresa" autocomplete="off" required class="form-control text-box single-line" id="NombreCreateEmpresa" name="NombreCreate" type="text">
                                        </div>
                                        <!----Telefono 1------------------->
										<div class="form-group">
                                            <label class="control-label" for="FecNac">Teléfono 1:</label>
                                            <input title="Máximo 20 carácteres" pattern="[0-9 ]*" autofocus class="form-control text-box single-line" id="tel1CreateEmpresa" maxlength="20" name="tel1Create" type="tel">  
                                        </div>
                                        <!------------------Teléfono 2--------------------->
                                        <div class="form-group">
                                            <label class="control-label" for="Sexo">Teléfono 2:</label><b class="obligatorio">(*)</b>
                                            <input title="Máximo 20 carácteres" pattern="[0-9 ]*" class="form-control text-box single-line" id="tel2CreateEmpresa" maxlength="20"  name="tel2Create" type="tel" >
                                        </div>
                                        <!------------------PRECIO/TARIFA--------------------->
                                        {{-- <div class="form-group">
                                            <label class="control-label" for="Tarifa">Tarifa:</label><b class="obligatorio">(*)</b>
                                            <select>
                                                @foreach ($tarifas as $tarifa)
                                                    <option value="{{$tarifa->idtarifa}}"></option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <!------------------Tipo de Empresa:--------------------->
										{{-- <div class="form-group">
                                            <label class="control-label" for="Empresaestudio">Departamento:</label><b class="obligatorio">(*)</b>
                                            <select class="form-control text-box single-line" id="Tipo_EmpresaCreate" name="Tipo_EmpresaCreate" maxlength="12"  type="text" >
                                                <option value="---">Elegir...</option>
                                                <option value="Pública">Pública</option>
                                                <option value="Privada">Privada</option>
                                            </select>   
                                        </div> --}}
                                    </div>                                                               
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tarjeta2CreateEmpresa" >
                                <div class="card">
                                    <div class="card-body">
                                        <!--------------------RFC------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">RFC:</label>
                                            <input pattern="[0-9a-zA-Z]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="rfcCreateEmpresa" minlength="15" maxlength="15" name="rfcCreate" type="text" >                            
                                        </div>
                                        <!--------------------direccionCreate------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="rfc">Dirección:</label>
                                            <input pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="direccionCreateEmpresa" maxlength="250" name="direccionCreate" type="text" >                            
                                        </div>
                                        <!--------------------Numero------------------->
                                        {{-- <div class="form-group">                           
                                            <label class="control-label" for="rfc">Número:</label>
                                            <input autocomplete="off" class="form-control text-box single-line validanumericos" id="NumeroCreate" maxlength="100" name="NumeroCreate" type="text" >                            
                                        </div> --}}
                                        <!--------------------Colonia------------------->
                                        {{-- <div class="form-group">                           
                                            <label class="control-label" for="rfc">Colonia:</label>
                                            <input autocomplete="off" class="form-control text-box single-line validanumericos" id="ColoniaCreate" maxlength="100" name="ColoniaCreate" type="text" >                            
                                        </div> --}}
                                         <!--------------------Código Postal------------------->
                                         <div class="form-group">                           
                                            <label class="control-label" for="cp">Código Postal:</label>
                                            <input title="Código postal (5 números)." pattern="[0-9]*" autocomplete="off" class="form-control text-box single-line validanumericos" id="CpCreateEmpresa" minlength="10" maxlength="10" name="CpCreate" type="text" >                            
                                         </div>
                                        <!--------------------País------------------->
                                        <div class="form-group">                           
                                            <label class="control-label" for="pais">País:</label>
                                            <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="paisCreateEmpresa" minlength="2" maxlength="100" name="paisCreate" type="text" >          
                                        </div>
                                         <!--------------------Estado------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Estado">Estado:</label>
                                           <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="EstadoCreateEmpresa" minlength="2" maxlength="100" name="EstadoCreate" type="text" >          
                                        </div>
                                        <!--------------------Municipio------------------->
                                        <div class="form-group">                           
                                           <label class="control-label" for="Municipio">Municipio:</label>
                                           <input title="Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="MunicipioCreateEmpresa" minlength="2" maxlength="100" name="MunicipioCreate" type="text" >                            
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
                    <input id="redireccionadorCreateEmpresa" name="redireccionador" readonly type="hidden">
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function redireccionador(){
        
        
    }
</script> --}}