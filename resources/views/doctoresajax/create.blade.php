
<!-- boostrap company model -->
<div class="modal fade" id="company-modal" aria-hidden="true" >{{-- style="padding-left:400px;" --}}
  <div class="modal-dialog modal-lg">
     <div class="modal-content"> {{-- style="width:60%;" --}}
         <div class="modal-header">
             <h4 class="modal-title" id="CompanyModal"></h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">X</span>
            </button>
         </div>
         <div class="modal-body" >
             <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="formulario" method="POST" enctype="multipart/form-data">
                  <div class="tabpanel">
                      <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item" role="presentation">
                              <a class="nav-link active" href="#Primero" data-toggle="tab" role="tab" aria-selected="false">Datos Personales</a>
                          </li>
                          <li class="nav-item" role="presentation">
                              <a class="nav-link" href="#Opcional" data-toggle="tab" role="tab" aria-selected="false">Datos de Dirección (Opcional)</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="Primero">
                              <div class="card">
                                  <div class="card-body">
                                      <input type="hidden" name="id" id="id">
                                      <!--------------------Nombre------------------->
                                      <div class="form-group">
                                        <label class="control-label">Doctor:</label><b class="obligatorio">(*)</b>
                                        <input autofocus autocomplete="off" onkeypress="return soloLetras(event)" required class="form-control text-box single-line" id="Doctor" minlength="2" maxlength="30" name="Doctor" type="text" required tabindex="4">
                                      </div>
                                      
                                       <!--------------------Especialidad1------------------->
                                       <div class="form-group">
                                           <label class="control-label">Especialidad:</label>
                                           <input autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="especialidad1" maxlength="30" name="especialidad1" type="text" required tabindex="7">                                        
                                       </div>
                                       <!------------------CedProf--------------------->
                                       <div class="form-group">                           
                                           <label class="control-label" for="cedprof">Cédula Profesional:</label>                                                        
                                           <input autofocus class="form-control text-box single-line" id="cedprof" minlength="6" maxlength="30" name="cedprof" type="text">                          
                                       </div>
                                       <!---------------------Centro--------------------->
                                       <div class="form-group">
                                           <label class="control-label" for="centro">Centro:</label><br>
                                           <input class="form-control text-box single-line" id="centro" maxlength="30"  name="centro" type="tel" >
                                        </div>
                                       <!--------------------------------------->
                                       {{-- <div class="form-group">
                                           <label class="control-label" for="sexo">Género:</label><b class="obligatorio">(*)</b>
                                           <div class="form-check">
                                              <input  required class="form-check-input" id="sexoh" name="sexoh" type="radio" value="H"><label class="form-check-label">H</label>
                                           </div>
                                           <div class="form-check">
                                               <input  class="form-check-input" id="sexom" name="sexom" type="radio" required><label class="form-check-label">M</label>
                                           </div>
                                       </div> --}}
                                       <!---------------------Tels--------------------->
                                       <div class="form-group">
                                          <label class="control-label" for="tels">Teléfono:</label><br>
                                          <input autocomplete="off" onkeypress='return validaNumericos(event)' class="form-control text-box single-line" id="tels" minlength="10" maxlength="10" name="tels" type="tel" >
                                       </div>
                                       <!---------------------Email--------------------->
                                      <div class="form-group">
                                          <label class="control-label" for="Email">Email:</label>
                                          <input class="form-control text-box single-line" id="Email" maxlength="70" name="Email" type="Email" >
                                       </div>
                                  </div>
                              </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="Opcional">
                              <div class="card">
                                  <div class="card-body">
                                   
                                   
                                       <!-----------------------Dirección---------------------------->
                                       <div class="form-group">                           
                                        <label class="control-label" for="Direccion">Dirección:</label>
                                        <input class="form-control text-box single-line" id="direccion" minlength="10" maxlength="50" name="direccion" type="text" >                            
                                    </div>
                                    <!-----------------------Colonia---------------------------->
                                    <div class="form-group">                           
                                      <label class="control-label" for="Colonia">Colonia:</label>                            
                                      <input class="form-control text-box single-line" id="Colonia" minlength="2" maxlength="99" name="Colonia" type="text" >                            
                                 </div>
                                 <!-----------------------Código Postal---------------------------->
                                <div class="form-group">                           
                                     <label class="control-label" for="Cp">Código Postal:</label>
                                     <input autocomplete="off" onkeypress='return validaNumericos(event)' class="form-control text-box single-line" id="Cp" minlength="5" maxlength="5" name="Cp" type="text" >                            
                                 </div>
                                 <!-----------------------Estado---------------------------->
                                 <div class="form-group">                           
                                     <label class="control-label" for="Estado">Estado:</label>
                                     <input autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" id="Estado" minlength="2" maxlength="25" name="Estado" type="text" >          
                                  </div>
                                  <!-----------------------Municipio---------------------------->
                                  <div class="form-group">                           
                                     <label class="control-label" for="Municipio">Municipio:</label>
                                     <input autocomplete="off" onkeypress="return soloLetras(event)" class="form-control text-box single-line" minlength="2" maxlength="25" id="Municipio" name="Municipio" type="text" >                            
                                  </div>
                                       
                                   </div>                                                               
                              </div>
                           </div>
                      </div>
                  </div>
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
                  </div>
             </form>
          </div>
      </div>
  </div>
</div>
<!-- end bootstrap model -->
<link rel="stylesheet" href="/css/app.css">
<script>
  function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
  </script>
  
  <script>
      
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