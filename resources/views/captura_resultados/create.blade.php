@extends('adminlte::page')

@section('content_header')
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
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{$solicitud->IdSolicitud}}</td>
                            <td>{{$solicitud->id_paciente}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <input id="id_estxsol" name="id_estxsol">
                <input id="id_solicitud" name="id_solicitud">
                <input id="id_estudio" name="id_estudio">
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
@stop