@extends('adminlte::page')
@section('title', __('Departamentos'))
@section('content_header')
<h1>Catalogo de Departamentos</h1>
@stop

@section('content')
@if($message = Session::get("error"))
<div class="alert alert-danger">
    <h2>Problema:</h2>
    <p>{{$message="Error."}}</p>
</div>
@endif

@if($message = Session::get("errorEliminar"))
<div class="alert alert-danger">
    <h2>Problema:</h2>
    <p>{{$message}}</p>
</div>
@endif
@if($message = Session::get("estudios"))
<div class="alert alert-danger">
    <p>{{$message}}</p>
</div>
@endif
@if($message = Session::get("pruebas"))
<div class="alert alert-danger">
    <p>{{$message}}</p>
</div>
@endif
<div class="card">
    <div class="card-header">
        <a href="/deptos-pdf" target="_blank" style="text-decoration:none;color:aliceblue;"><button type="button" class="btn btn-info" >Imprimir Reporte</button></a>
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
               <i class="far fa fa-plus-square"></i> Agregar Departamento
           </button> 
        </a>
        @include('deptos.create')
        @include('deptos.update')
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="departamentos" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead">
                    <tr> 
                        <th scope="col">Nombre</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departamentos as $departamento)
                    <tr>
                        <td>{{ $departamento->Depto }}</td>
                        <td width="90">
                            <form class="formulario" action="{{route('deptos.destroy',$departamento->id)}}" method ="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <a href="{{route('metodos.edit',Crypt::encrypt($metodo->id))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a> --}}
                                <button type="button" id="btnModal{{$departamento->id}}" value="{{$departamento->id}}~{{$departamento->Depto}}" onclick="modal('{{$departamento->id}}')" data-toggle="modal" data-target="#updateModal" class="btn-xs btn btn-primary fa fa fa-pencil">
                                    <i class="fa fa-edit"></i>
                                </button>
                               <button class="btn-xs btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form> 	
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<script>
function modal(index){
    var valor_modal = document.getElementById('btnModal'+index).value.split('~');
    id = valor_modal[0];
    depto = valor_modal[1];

    var valor_seleccionado = "{{route('deptos.update', 'valor' )}}";
    valor_seleccionado = valor_seleccionado.replace('valor', index);
        
    $("#formulario").attr("action", valor_seleccionado);
    $("#deptoEdit").val(depto);

}
</script>
    
{{--SweetAlert Vista--}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
<script>
$('.formulario').submit(function(e){
        e.preventDefault();
        Swal.fire({
           title: '¿Estás seguro?',
           text: "¡No podrás revertir esta acción!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Si, ¡Eliminalo!',
           cancelButtonText: 'Cancelar'
        }).then((result) => {
           if (result.isConfirmed) {
              this.submit();
            }
        })
    }); 
</script>
    
    
<script>
$(document).ready(function () {
    $('#departamentos').DataTable({"order": [[ 0, 'desc' ]]});
});
</script>
@stop