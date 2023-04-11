<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Editar método</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formulario" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                       <div class="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="#Primero" data-toggle="tab" role="tab" aria-selected="false">Datos Generales</a>
                                </li> 
                           </ul>
                           <div class="tab-content">
                               <div role="tabpanel" class="tab-pane active">
                                   <div class="card">
                                      <div class="card-body">  
                                        <!----------------------descripcion---------------->
                                        <div class="form-group">
                                          <label>Nombre del método:</label>
                                          <input title="Sin caracteres especiales • Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" required class="form-control" id="Descripcion" name="Descripcion" maxlength="50">
                                        </div> 
                                      </div>                                                               
                                   </div>
                                </div>
                             <div style="text-align:right">
                              <input name"_token" hidden value="{{ csrf_token() }}" type="text">
                              <a href="/metodos"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Regresar</button></a>
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
