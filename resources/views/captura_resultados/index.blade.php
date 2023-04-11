@extends('adminlte::page')

@section('content_header')
    @if($message = Session::get("error"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
    @endif 
    @if($message = Session::get("Id"))
	<div style="text-align:left" class="alert alert-danger">
		<p>{{$message}}</p>
	</div>
    @endif 
    <div class="card">
        <form action="{{route('crearformatocaptura')}}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h1>Captura de Resultados</h1>
            </div>
            <div class="card-body">
                <table id="lista" class="table table-striped table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>

                        </th>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{$solicitud->IdSolicitud}}</td>
                            <td>{{$solicitud->id_paciente}}</td>
                            <td>
                                <form action="{{route('crearformatocaptura')}}">
                                    <input name="IdSolicitud" value="{{$solicitud->IdSolicitud}}">
                                    <button>Capturar</button>
                                </form>    
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@stop

@section('content')

@stop

@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/multiregistros.js')}}"></script>
<script>
    $(document).ready(function () {
       
        $('#lista').DataTable({
            "order": [[ 0, 'desc' ]],
            "lengthMenu": [[5,10,50,-1],[5,10,50, "All"]],
        });
    });
</script>
<script>
    function elegirestxsol()
    {
        select_idEstxsol = document.getElementById("select_idEstxsol").value.split('.');
        id_estxsol = select_idEstxsol[0];
        id_solicitud = select_idEstxsol[1];
        id_estudio = select_idEstxsol[2];
        $("#id_estxsol").val(id_estxsol);
        $("#id_solicitud").val(id_solicitud);
        $("#id_estudio").val(id_estudio);
    }
</script>
@stop