@extends('adminlte::page')

@section('content_header')
    <h2>Configuración de Paquetes</h2>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="paquetes/create" style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info">
               <i class="far fa fa-plus-square"></i> Agregar
           </button> 
        </a>
    </div>
    <div class="card-body">
        @if($message = Session::get("error"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("infoestxsol"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("infoprecios_detalle"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("infotarifas"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("infomonedero_estudios"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        <div class="table-responsive">
            <table id="paquetes" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 20%;">Abreviatura</th>
                        <th scope="col" style="width: 55%;">Nombre</th>
                        <th scope="col" style="width: 10%;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paquetes as $paquete)
                        <tr>
                            <td>{{$paquete->Abreviatura}}</td>
                            <td>{{$paquete->Nombre}}</td>
                            <td>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{route('paquetes.edit',Crypt::encrypt( $paquete->idEstudio ))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-3">
                                            <form class="formulario" action="{{route('paquetes.destroy',$paquete->idEstudio)}}" method ="POST">
                                                @csrf
                                                @method('DELETE')
                                                
                                            
                                               <button class="btn-xs btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js') {{--SweetAlert Vista--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('eliminar')=='Echo')
<script>
    Swal.fire(
      '¡Eliminado!',
      'El registro ha sido eliminado.',
      'Cumplido.'
    )
</script>
@endif

<script>
$('.formulario').click(function(e){
    e.preventDefault();
        Swal.fire({
          title: '¿Estás seguro?',
          text: "Al aceptar y borrar el paquete, estará eliminando todo su contenido.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, ¡Eliminalo!'
        }).then((result) => {
    if (result.isConfirmed) {
       this.submit();
    }})
});   
</script>
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script>
$(document).ready(function () {
    $('#paquetes').DataTable({"order": [[ 0, 'asc' ]]});
});
</script> 
@stop