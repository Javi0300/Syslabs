@section('title', __('Tomaxests'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Tomaxest Listing </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Tomaxests">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Tomaxests
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.tomaxests.create')
						@include('livewire.tomaxests.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Actualizar</th>
								<th>Editor Archivo</th>
								<th>Editor Texto</th>
								<th>Formula</th>
								<th>Espaquete</th>
								<th>Id Estxsol</th>
								<th>Sucursal</th>
								<th>Solicitud</th>
								<th>Muestraid</th>
								<th>Estudio</th>
								<th>Paquete</th>
								<th>Toma</th>
								<th>Fecha</th>
								<th>Claveprueba</th>
								<th>Prueba</th>
								<th>Resultado</th>
								<th>Orden</th>
								<th>Estatus</th>
								<th>Importe</th>
								<th>Dentrolimite</th>
								<th>Valores</th>
								<th>Medida</th>
								<th>Tipoformato</th>
								<th>Autoanalizador</th>
								<th>Valmin</th>
								<th>Valmax</th>
								<th>Textovalores</th>
								<th>Hora</th>
								<th>Word</th>
								<th>Fecha Act</th>
								<th>Fecha Sync</th>
								<th>Flag Sucursales</th>
								<th>Eliminar</th>
								<th>Nombreperfil</th>
								<th>Altobajo</th>
								<th>Antibiograma</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($tomaxests as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->actualizar }}</td>
								<td>{{ $row->editor_archivo }}</td>
								<td>{{ $row->editor_texto }}</td>
								<td>{{ $row->formula }}</td>
								<td>{{ $row->espaquete }}</td>
								<td>{{ $row->id_estxsol }}</td>
								<td>{{ $row->sucursal }}</td>
								<td>{{ $row->solicitud }}</td>
								<td>{{ $row->MuestraID }}</td>
								<td>{{ $row->Estudio }}</td>
								<td>{{ $row->Paquete }}</td>
								<td>{{ $row->Toma }}</td>
								<td>{{ $row->Fecha }}</td>
								<td>{{ $row->ClavePrueba }}</td>
								<td>{{ $row->Prueba }}</td>
								<td>{{ $row->Resultado }}</td>
								<td>{{ $row->Orden }}</td>
								<td>{{ $row->Estatus }}</td>
								<td>{{ $row->Importe }}</td>
								<td>{{ $row->DentroLimite }}</td>
								<td>{{ $row->Valores }}</td>
								<td>{{ $row->Medida }}</td>
								<td>{{ $row->TipoFormato }}</td>
								<td>{{ $row->autoanalizador }}</td>
								<td>{{ $row->Valmin }}</td>
								<td>{{ $row->ValMax }}</td>
								<td>{{ $row->TextoValores }}</td>
								<td>{{ $row->Hora }}</td>
								<td>{{ $row->word }}</td>
								<td>{{ $row->fecha_act }}</td>
								<td>{{ $row->fecha_sync }}</td>
								<td>{{ $row->flag_sucursales }}</td>
								<td>{{ $row->eliminar }}</td>
								<td>{{ $row->NombrePerfil }}</td>
								<td>{{ $row->altobajo }}</td>
								<td>{{ $row->antibiograma }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Tomaxest id {{$row->id}}? \nDeleted Tomaxests cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $tomaxests->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
