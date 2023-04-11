@extends('adminlte::page')

@section('content_header')
    <h2>Configuración de Pruebas</h2>
@stop

@section('content')

<div class="card">
    
    <div class="card-header">
        
        <a style="text-decoration:none;color:aliceblue;" href="/pruebas/create" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
               <i class="far fa fa-plus-square"></i> Agregar
           </button> 
        </a>
    </div>
    <div class="card-body">
        @if($message = Session::get("errorforaneo"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        @if($message = Session::get("formatos"))
		<div class="alert alert-danger">
		    <p>{{$message}}</p>
		</div>
		@endif
        <div class="table-responsive">
            <table id="pruebas" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Clave</th>
                        <th scope="col">Abreviatura</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pruebas as $prueba)
                    <tr>
                        <td style="width: 10%;">{{$prueba->cveprueba}}</td>
                        <td style="width: 10%;">{{$prueba->abreviatura}}</td>
                        <td style="width: 70%;">{{$prueba->Descripcion}}</td>
                        <td style="width: 10%;">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{route('pruebas.edit',Crypt::encrypt( $prueba->idPrueba ))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-3">
                                        <form class="formulario" action="{{route('pruebas.destroy',$prueba->idPrueba)}}" method ="POST">
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
            text: "¡Si esta prueba contiene información de valores de referencia también serán eliminados!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, ¡Eliminalo!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                this.submit();
            }
        })
        });
        
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script>
$(document).ready(function () {
    $('#pruebas').DataTable({"order": [[ 0, 'desc' ]]});
});
</script> 
@stop