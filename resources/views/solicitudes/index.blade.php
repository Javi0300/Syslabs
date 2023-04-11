@extends('adminlte::page')

@section('content_header')
<h1>Configuración del monedero</h1>
@stop

@section('content')
<table>
    
</table>
<button data-toggle="modal" data-target="#Monedero" class="btn btn-primary">Monedero</button>

@include('monedero.monedero_modal')
@stop

@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#lista').DataTable({
            "lengthMenu": [[5,10,50,-1],[5,10,50, "All"]],
            "order": [[ 0, 'desc' ]]
        });
    });
</script>
@stop