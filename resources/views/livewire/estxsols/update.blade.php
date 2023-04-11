<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Estxsol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="idEstxSol"></label>
                <input wire:model="idEstxSol" type="text" class="form-control" id="idEstxSol" placeholder="Idestxsol">@error('idEstxSol') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="id_solicitud"></label>
                <input wire:model="id_solicitud" type="text" class="form-control" id="id_solicitud" placeholder="Id Solicitud">@error('id_solicitud') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="id_estudio"></label>
                <input wire:model="id_estudio" type="text" class="form-control" id="id_estudio" placeholder="Id Estudio">@error('id_estudio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="sucursal"></label>
                <input wire:model="sucursal" type="text" class="form-control" id="sucursal" placeholder="Sucursal">@error('sucursal') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Depto"></label>
                <input wire:model="Depto" type="text" class="form-control" id="Depto" placeholder="Depto">@error('Depto') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="MuestraId"></label>
                <input wire:model="MuestraId" type="text" class="form-control" id="MuestraId" placeholder="Muestraid">@error('MuestraId') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Tomas"></label>
                <input wire:model="Tomas" type="text" class="form-control" id="Tomas" placeholder="Tomas">@error('Tomas') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Faltantes"></label>
                <input wire:model="Faltantes" type="text" class="form-control" id="Faltantes" placeholder="Faltantes">@error('Faltantes') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Importe"></label>
                <input wire:model="Importe" type="text" class="form-control" id="Importe" placeholder="Importe">@error('Importe') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Estatus"></label>
                <input wire:model="Estatus" type="text" class="form-control" id="Estatus" placeholder="Estatus">@error('Estatus') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Observaciones"></label>
                <input wire:model="Observaciones" type="text" class="form-control" id="Observaciones" placeholder="Observaciones">@error('Observaciones') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Fecha"></label>
                <input wire:model="Fecha" type="text" class="form-control" id="Fecha" placeholder="Fecha">@error('Fecha') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Imprimir"></label>
                <input wire:model="Imprimir" type="text" class="form-control" id="Imprimir" placeholder="Imprimir">@error('Imprimir') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Tubo"></label>
                <input wire:model="Tubo" type="text" class="form-control" id="Tubo" placeholder="Tubo">@error('Tubo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="abreviatura"></label>
                <input wire:model="abreviatura" type="text" class="form-control" id="abreviatura" placeholder="Abreviatura">@error('abreviatura') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="TipoFormato"></label>
                <input wire:model="TipoFormato" type="text" class="form-control" id="TipoFormato" placeholder="Tipoformato">@error('TipoFormato') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Noaplicadescuento"></label>
                <input wire:model="Noaplicadescuento" type="text" class="form-control" id="Noaplicadescuento" placeholder="Noaplicadescuento">@error('Noaplicadescuento') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="VerificadoPor"></label>
                <input wire:model="VerificadoPor" type="text" class="form-control" id="VerificadoPor" placeholder="Verificadopor">@error('VerificadoPor') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Publicado"></label>
                <input wire:model="Publicado" type="text" class="form-control" id="Publicado" placeholder="Publicado">@error('Publicado') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="WordPDF"></label>
                <input wire:model="WordPDF" type="text" class="form-control" id="WordPDF" placeholder="Wordpdf">@error('WordPDF') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Precio"></label>
                <input wire:model="Precio" type="text" class="form-control" id="Precio" placeholder="Precio">@error('Precio') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Iva"></label>
                <input wire:model="Iva" type="text" class="form-control" id="Iva" placeholder="Iva">@error('Iva') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="ivaprct"></label>
                <input wire:model="ivaprct" type="text" class="form-control" id="ivaprct" placeholder="Ivaprct">@error('ivaprct') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descimpte"></label>
                <input wire:model="descimpte" type="text" class="form-control" id="descimpte" placeholder="Descimpte">@error('descimpte') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="descprct"></label>
                <input wire:model="descprct" type="text" class="form-control" id="descprct" placeholder="Descprct">@error('descprct') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="GrupoPerfil"></label>
                <input wire:model="GrupoPerfil" type="text" class="form-control" id="GrupoPerfil" placeholder="Grupoperfil">@error('GrupoPerfil') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="EsPerfil"></label>
                <input wire:model="EsPerfil" type="text" class="form-control" id="EsPerfil" placeholder="Esperfil">@error('EsPerfil') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <label for="nombrepaciente"></label>
                <input wire:model="nombrepaciente" type="text" class="form-control" id="nombrepaciente" placeholder="Nombrepaciente">@error('nombrepaciente') <span class="error text-danger">{{ $message }}</span> @enderror
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
