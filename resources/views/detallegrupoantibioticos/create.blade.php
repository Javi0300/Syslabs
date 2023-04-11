<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">   
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo grupo de antibióticos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form  class="frmPacientes" id="createPacientes" action="/detallegrupoantibioticos/" method="POST">
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
                                      <label for="descripcion">Nombre del grupo de antibióticos:</label>
                                      <input title="Sin caracteres especiales • Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" minlength="2" maxlength="100" required class="form-control" id="descripcion" name="descripcion" autofocus>
                                    </div>
                                          
                                        
                                         
                                      </div>                                                               
                                 </div>
                              </div>
                           <div style="text-align:right">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                 <button id="btnCreateGuardar" type="submit" class="btn btn-primary close-modal">Guardar</button>         
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
{{-- <script>
  function bloquearboton()
  {
    $("#btnCreateGuardar"). attr("disabled", true);
  }
</script> --}}