@section('title', __('Estudios'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Estudio Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Estudios">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Estudios
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.estudios.create')
						@include('livewire.estudios.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Idestudio</th>
								<th>Colortitulo</th>
								<th>Alineaciontitulo</th>
								<th>Notas Internas</th>
								<th>Indicaciones</th>
								<th>Sexo</th>
								<th>Ventaindividual</th>
								<th>Codigo</th>
								<th>Descripcion</th>
								<th>Dias</th>
								<th>Horas</th>
								<th>Minutos</th>
								<th>Depto</th>
								<th>Sucursal</th>
								<th>Nombre</th>
								<th>Abreviatura</th>
								<th>Tomas</th>
								<th>Frecuencia</th>
								<th>Tipoformato</th>
								<th>Notas</th>
								<th>Tiempoproceso</th>
								<th>Tipomuestra</th>
								<th>Instrucciones</th>
								<th>Datostecnicos</th>
								<th>Encabezado</th>
								<th>Tubo</th>
								<th>Noaplicadescuento</th>
								<th>Espaquete</th>
								<th>Fecha Act</th>
								<th>Fecha Sync</th>
								<th>Flag Sucursales</th>
								<th>Eliminar</th>
								<th>Sucproceso</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($estudios as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->idEstudio }}</td>
								<td>{{ $row->ColorTitulo }}</td>
								<td>{{ $row->AlineacionTitulo }}</td>
								<td>{{ $row->Notas_Internas }}</td>
								<td>{{ $row->Indicaciones }}</td>
								<td>{{ $row->Sexo }}</td>
								<td>{{ $row->ventaindividual }}</td>
								<td>{{ $row->Codigo }}</td>
								<td>{{ $row->Descripcion }}</td>
								<td>{{ $row->Dias }}</td>
								<td>{{ $row->Horas }}</td>
								<td>{{ $row->Minutos }}</td>
								<td>{{ $row->depto }}</td>
								<td>{{ $row->sucursal }}</td>
								<td>{{ $row->Nombre }}</td>
								<td>{{ $row->Abreviatura }}</td>
								<td>{{ $row->Tomas }}</td>
								<td>{{ $row->Frecuencia }}</td>
								<td>{{ $row->Tipoformato }}</td>
								<td>{{ $row->Notas }}</td>
								<td>{{ $row->TiempoProceso }}</td>
								<td>{{ $row->TipoMuestra }}</td>
								<td>{{ $row->Instrucciones }}</td>
								<td>{{ $row->DatosTecnicos }}</td>
								<td>{{ $row->Encabezado }}</td>
								<td>{{ $row->Tubo }}</td>
								<td>{{ $row->Noaplicadescuento }}</td>
								<td>{{ $row->espaquete }}</td>
								<td>{{ $row->fecha_act }}</td>
								<td>{{ $row->fecha_sync }}</td>
								<td>{{ $row->flag_sucursales }}</td>
								<td>{{ $row->eliminar }}</td>
								<td>{{ $row->SucProceso }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Estudio id {{$row->id}}? \nDeleted Estudios cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $estudios->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
