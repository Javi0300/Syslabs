@extends('adminlte::page')


@section('content_header')
    <h1>Configuración de Grupos de Antibióticos</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
               <i class="far fa fa-plus-square"></i> Agregar
           </button> 
        </a>
        @include('detallegrupoantibioticos.create')
    </div>
    <div class="card-body">
        @if($message = Session::get("error"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("grupos"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        <div class="table-responsive">
            <table id="antibioticos" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupo_antibioticos as $grupo_antibiotico)
                    <tr>
                        <td style="width: 92%;">{{$grupo_antibiotico->descripcion}}</td>
                        <td>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{route('detallegrupoantibioticos.edit',Crypt::encrypt($grupo_antibiotico->idGrupoAntibiotico))}}" 
                                            class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-3">
                                        <form class="formulario" action="{{route("detallegrupoantibioticos.destroy",$grupo_antibiotico->idGrupoAntibiotico)}}" method ="POST">
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

@section('js')
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
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
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
        $('#antibioticos').DataTable({"order": [[ 0, 'desc' ]]});
    });
</script>
@stop