@section('title', __('Estxsols'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Estxsol Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Estxsols">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Estxsols
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.estxsols.create')
						@include('livewire.estxsols.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Idestxsol</th>
								<th>Id Solicitud</th>
								<th>Id Estudio</th>
								<th>Sucursal</th>
								<th>Depto</th>
								<th>Muestraid</th>
								<th>Tomas</th>
								<th>Faltantes</th>
								<th>Importe</th>
								<th>Estatus</th>
								<th>Observaciones</th>
								<th>Fecha</th>
								<th>Imprimir</th>
								<th>Tubo</th>
								<th>Abreviatura</th>
								<th>Tipoformato</th>
								<th>Noaplicadescuento</th>
								<th>Verificadopor</th>
								<th>Publicado</th>
								<th>Wordpdf</th>
								<th>Precio</th>
								<th>Iva</th>
								<th>Ivaprct</th>
								<th>Descimpte</th>
								<th>Descprct</th>
								<th>Grupoperfil</th>
								<th>Esperfil</th>
								<th>Fecha Act</th>
								<th>Fecha Sync</th>
								<th>Flag Sucursales</th>
								<th>Eliminar</th>
								<th>Nombreperfil</th>
								<th>Nombrepaciente</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($estxsols as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->idEstxSol }}</td>
								<td>{{ $row->id_solicitud }}</td>
								<td>{{ $row->id_estudio }}</td>
								<td>{{ $row->sucursal }}</td>
								<td>{{ $row->Depto }}</td>
								<td>{{ $row->MuestraId }}</td>
								<td>{{ $row->Tomas }}</td>
								<td>{{ $row->Faltantes }}</td>
								<td>{{ $row->Importe }}</td>
								<td>{{ $row->Estatus }}</td>
								<td>{{ $row->Observaciones }}</td>
								<td>{{ $row->Fecha }}</td>
								<td>{{ $row->Imprimir }}</td>
								<td>{{ $row->Tubo }}</td>
								<td>{{ $row->abreviatura }}</td>
								<td>{{ $row->TipoFormato }}</td>
								<td>{{ $row->Noaplicadescuento }}</td>
								<td>{{ $row->VerificadoPor }}</td>
								<td>{{ $row->Publicado }}</td>
								<td>{{ $row->WordPDF }}</td>
								<td>{{ $row->Precio }}</td>
								<td>{{ $row->Iva }}</td>
								<td>{{ $row->ivaprct }}</td>
								<td>{{ $row->descimpte }}</td>
								<td>{{ $row->descprct }}</td>
								<td>{{ $row->GrupoPerfil }}</td>
								<td>{{ $row->EsPerfil }}</td>
								<td>{{ $row->fecha_act }}</td>
								<td>{{ $row->fecha_sync }}</td>
								<td>{{ $row->flag_sucursales }}</td>
								<td>{{ $row->eliminar }}</td>
								<td>{{ $row->NombrePerfil }}</td>
								<td>{{ $row->nombrepaciente }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Estxsol id {{$row->id}}? \nDeleted Estxsols cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $estxsols->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
