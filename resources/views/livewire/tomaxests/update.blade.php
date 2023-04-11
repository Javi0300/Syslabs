<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Tomaxest</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="actualizar"></label>
                <input wire:model="actualizar" type="text" class="form-control" id="actualizar" placeholder="Actualizar">@error('actualizar') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="editor_archivo"></label>
                <input wire:model="editor_archivo" type="text" class="form-control" id="editor_archivo" placeholder="Editor Archivo">@error('editor_archivo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="editor_texto"></label>
                <input wire:model="editor_texto" type="text" class="form-control" id="editor_texto" placeholder="Editor Texto">@error('editor_texto') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="formula"></label>
                <input wire:model="formula" type="text" class="form-control" id="formula" placeholder="Formula">@error('formula') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="espaquete"></label>
                <input wire:model="espaquete" type="text" class="form-control" id="espaquete" placeholder="Espaquete">@error('espaquete') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="id_estxsol"></label>
                <input wire:model="id_estxsol" type="text" class="form-control" id="id_estxsol" placeholder="Id Estxsol">@error('id_estxsol') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="sucursal"></label>
                <input wire:model="sucursal" type="text" class="form-control" id="sucursal" placeholder="Sucursal">@error('sucursal') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="solicitud"></label>
                <input wire:model="solicitud" type="text" class="form-control" id="solicitud" placeholder="Solicitud">@error('solicitud') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="MuestraID"></label>
                <input wire:model="MuestraID" type="text" class="form-control" id="MuestraID" placeholder="Muestraid">@error('MuestraID') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Estudio"></label>
                <input wire:model="Estudio" type="text" class="form-control" id="Estudio" placeholder="Estudio">@error('Estudio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Paquete"></label>
                <input wire:model="Paquete" type="text" class="form-control" id="Paquete" placeholder="Paquete">@error('Paquete') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Toma"></label>
                <input wire:model="Toma" type="text" class="form-control" id="Toma" placeholder="Toma">@error('Toma') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Fecha"></label>
                <input wire:model="Fecha" type="text" class="form-control" id="Fecha" placeholder="Fecha">@error('Fecha') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="ClavePrueba"></label>
                <input wire:model="ClavePrueba" type="text" class="form-control" id="ClavePrueba" placeholder="Claveprueba">@error('ClavePrueba') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Prueba"></label>
                <input wire:model="Prueba" type="text" class="form-control" id="Prueba" placeholder="Prueba">@error('Prueba') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Resultado"></label>
                <input wire:model="Resultado" type="text" class="form-control" id="Resultado" placeholder="Resultado">@error('Resultado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Orden"></label>
                <input wire:model="Orden" type="text" class="form-control" id="Orden" placeholder="Orden">@error('Orden') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Estatus"></label>
                <input wire:model="Estatus" type="text" class="form-control" id="Estatus" placeholder="Estatus">@error('Estatus') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Importe"></label>
                <input wire:model="Importe" type="text" class="form-control" id="Importe" placeholder="Importe">@error('Importe') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="DentroLimite"></label>
                <input wire:model="DentroLimite" type="text" class="form-control" id="DentroLimite" placeholder="Dentrolimite">@error('DentroLimite') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Valores"></label>
                <input wire:model="Valores" type="text" class="form-control" id="Valores" placeholder="Valores">@error('Valores') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Medida"></label>
                <input wire:model="Medida" type="text" class="form-control" id="Medida" placeholder="Medida">@error('Medida') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="TipoFormato"></label>
                <input wire:model="TipoFormato" type="text" class="form-control" id="TipoFormato" placeholder="Tipoformato">@error('TipoFormato') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="autoanalizador"></label>
                <input wire:model="autoanalizador" type="text" class="form-control" id="autoanalizador" placeholder="Autoanalizador">@error('autoanalizador') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Valmin"></label>
                <input wire:model="Valmin" type="text" class="form-control" id="Valmin" placeholder="Valmin">@error('Valmin') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="ValMax"></label>
                <input wire:model="ValMax" type="text" class="form-control" id="ValMax" placeholder="Valmax">@error('ValMax') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="TextoValores"></label>
                <input wire:model="TextoValores" type="text" class="form-control" id="TextoValores" placeholder="Textovalores">@error('TextoValores') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Hora"></label>
                <input wire:model="Hora" type="text" class="form-control" id="Hora" placeholder="Hora">@error('Hora') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="word"></label>
                <input wire:model="word" type="text" class="form-control" id="word" placeholder="Word">@error('word') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha_act"></label>
                <input wire:model="fecha_act" type="text" class="form-control" id="fecha_act" placeholder="Fecha Act">@error('fecha_act') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="fecha_sync"></label>
                <input wire:model="fecha_sync" type="text" class="form-control" id="fecha_sync" placeholder="Fecha Sync">@error('fecha_sync') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="flag_sucursales"></label>
                <input wire:model="flag_sucursales" type="text" class="form-control" id="flag_sucursales" placeholder="Flag Sucursales">@error('flag_sucursales') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="eliminar"></label>
                <input wire:model="eliminar" type="text" class="form-control" id="eliminar" placeholder="Eliminar">@error('eliminar') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="NombrePerfil"></label>
                <input wire:model="NombrePerfil" type="text" class="form-control" id="NombrePerfil" placeholder="Nombreperfil">@error('NombrePerfil') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="altobajo"></label>
                <input wire:model="altobajo" type="text" class="form-control" id="altobajo" placeholder="Altobajo">@error('altobajo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="antibiograma"></label>
                <input wire:model="antibiograma" type="text" class="form-control" id="antibiograma" placeholder="Antibiograma">@error('antibiograma') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>
