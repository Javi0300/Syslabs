<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar nueva bacteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  class="frmPacientes" id="createPacientes" action="/bacterias/" method="POST">
                @csrf
                   <div id="frm-pacientes" class="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="#Primero" data-toggle="tab" role="tab" aria-selected="false">Datos Generales</a>
                            </li>
                           
                       </ul>
                       <div class="tab-content">
                           <div role="tabpanel" class="tab-pane active" id="Primero">
                               <div class="card">
            
                                   <div class="card-body">
                                    <div class="row">
                                      <!------------------------------------>                       
                                    </div>
                                        
                                       <!----------------------descripcion---------------->
                                       <div class="form-group">
                                          <label for="descripcion">Nombre de la bacteria:</label>
                                          <input title="Sin caracteres especiales • Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" required class="form-control" id="descripcionCreate" name="descripcionCreate" minlength="2" maxlength="100">
                                        </div>
                                        
                                      
                                       
                                    </div>                                                               
                               </div>
                            </div>
                         <div style="text-align:right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                               <button type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                           </div>
                        </div>
                   </div>
               </form>
        </div>
      </div>
    </div>
  </div>
<link rel="stylesheet" href="/css/app.css">
<script>
  function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
    }
    return false;        
  }
</script>
<script src="{{ asset('js/multiregistros.js')}}"></script>
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