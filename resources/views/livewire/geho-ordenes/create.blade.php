<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Geho Ordene</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="ordenGeho"></label>
                <input wire:model="ordenGeho" type="text" class="form-control" id="ordenGeho" placeholder="Ordengeho">@error('ordenGeho') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="paterno"></label>
                <input wire:model="paterno" type="text" class="form-control" id="paterno" placeholder="Paterno">@error('paterno') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="materno"></label>
                <input wire:model="materno" type="text" class="form-control" id="materno" placeholder="Materno">@error('materno') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="sexo"></label>
                <input wire:model="sexo" type="text" class="form-control" id="sexo" placeholder="Sexo">@error('sexo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaNacimiento"></label>
                <input wire:model="fechaNacimiento" type="text" class="form-control" id="fechaNacimiento" placeholder="Fechanacimiento">@error('fechaNacimiento') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="edad"></label>
                <input wire:model="edad" type="text" class="form-control" id="edad" placeholder="Edad">@error('edad') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="edad_tipo"></label>
                <input wire:model="edad_tipo" type="text" class="form-control" id="edad_tipo" placeholder="Edad Tipo">@error('edad_tipo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaOrden"></label>
                <input wire:model="fechaOrden" type="text" class="form-control" id="fechaOrden" placeholder="Fechaorden">@error('fechaOrden') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="sucursal"></label>
                <input wire:model="sucursal" type="text" class="form-control" id="sucursal" placeholder="Sucursal">@error('sucursal') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="estatus"></label>
                <input wire:model="estatus" type="text" class="form-control" id="estatus" placeholder="Estatus">@error('estatus') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="modificado"></label>
                <input wire:model="modificado" type="text" class="form-control" id="modificado" placeholder="Modificado">@error('modificado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="folio"></label>
                <input wire:model="folio" type="text" class="form-control" id="folio" placeholder="Folio">@error('folio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="expediente"></label>
                <input wire:model="expediente" type="text" class="form-control" id="expediente" placeholder="Expediente">@error('expediente') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="hospitalizacion"></label>
                <input wire:model="hospitalizacion" type="text" class="form-control" id="hospitalizacion" placeholder="Hospitalizacion">@error('hospitalizacion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="cliente"></label>
                <input wire:model="cliente" type="text" class="form-control" id="cliente" placeholder="Cliente">@error('cliente') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaSyslabs"></label>
                <input wire:model="fechaSyslabs" type="text" class="form-control" id="fechaSyslabs" placeholder="Fechasyslabs">@error('fechaSyslabs') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fechaGeho"></label>
                <input wire:model="fechaGeho" type="text" class="form-control" id="fechaGeho" placeholder="Fechageho">@error('fechaGeho') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="cama"></label>
                <input wire:model="cama" type="text" class="form-control" id="cama" placeholder="Cama">@error('cama') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>
