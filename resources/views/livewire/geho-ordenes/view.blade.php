@section('title', __('Geho Ordenes'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Geho Ordene Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Geho Ordenes">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Geho Ordenes
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.gehoOrdenes.create')
						@include('livewire.gehoOrdenes.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Ordengeho</th>
								<th>Paterno</th>
								<th>Materno</th>
								<th>Nombre</th>
								<th>Sexo</th>
								<th>Fechanacimiento</th>
								<th>Edad</th>
								<th>Edad Tipo</th>
								<th>Fechaorden</th>
								<th>Sucursal</th>
								<th>Estatus</th>
								<th>Modificado</th>
								<th>Folio</th>
								<th>Expediente</th>
								<th>Hospitalizacion</th>
								<th>Cliente</th>
								<th>Fechasyslabs</th>
								<th>Fechageho</th>
								<th>Cama</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($gehoOrdenes as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->ordenGeho }}</td>
								<td>{{ $row->paterno }}</td>
								<td>{{ $row->materno }}</td>
								<td>{{ $row->nombre }}</td>
								<td>{{ $row->sexo }}</td>
								<td>{{ $row->fechaNacimiento }}</td>
								<td>{{ $row->edad }}</td>
								<td>{{ $row->edad_tipo }}</td>
								<td>{{ $row->fechaOrden }}</td>
								<td>{{ $row->sucursal }}</td>
								<td>{{ $row->estatus }}</td>
								<td>{{ $row->modificado }}</td>
								<td>{{ $row->folio }}</td>
								<td>{{ $row->expediente }}</td>
								<td>{{ $row->hospitalizacion }}</td>
								<td>{{ $row->cliente }}</td>
								<td>{{ $row->fechaSyslabs }}</td>
								<td>{{ $row->fechaGeho }}</td>
								<td>{{ $row->cama }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Geho Ordene id {{$row->id}}? \nDeleted Geho Ordenes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $gehoOrdenes->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
