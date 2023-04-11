@extends('adminlte::page')

@section('content')
<div class="card-body" >
  <form enctype="multipart/form-data" action="/metodos/{{$metodo->id}}" method="POST">
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
                            <input required class="form-control" id="Descripcion" name="Descripcion" maxlength="50">
                          </div> 
                        </div>                                                               
                     </div>
                  </div>
               <div style="text-align:right">
                <a href="/metodos"><button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa fa-arrow-left"></i> Regresar</button></a>
                <button type="submit" class="btn btn-primary close-modal" >Guardar</button>         
                 </div>
              </div>
         </div>
  </form>
</div>
<script src="{{ asset('js/multiregistros.js')}}"></script>
@stop