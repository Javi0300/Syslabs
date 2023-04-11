<div class="modal fade" id="editAntiLabel" tabindex="-1" role="dialog" aria-labelledby="editAntiLabelLabel" aria-hidden="true">   
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="editAntiLabel">Registrar nuevo antibiótico</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form id="formulario" enctype="multipart/form-data" action="" method="POST">
                @csrf
                @method('PUT')
				<input name"_token" hidden value="{{ csrf_token() }}" type="text">
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
									<div class="row">
									  <!------------------------------------>                       
									</div>
										  
									<!----------------------descripcion---------------->
									<div class="form-group">
									  <label for="descripcion">Nombre del antibiótico:</label>
									  <input title="Sin caracteres especiales • Mínimo 2 carácteres" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 '`.-_]*" minlength="2" maxlength="100" onkeypress="return soloLetras(event)" required class="form-control" id="descripcionEdit" name="descripcionEdit" tabindex="3">
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
<script src="{{ asset('js/multiregistros.js')}}"></script>
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