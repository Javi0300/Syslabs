@extends('adminlte::page')


@section('title', 'Doctores')


@section('content_header')
    <h1>Catálogo de Doctores</h1>
@stop


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-light">  
            <div class="card-header" hidden>
                <h3 class="card-title">Buscar Doctor</h3>
            </div> 
           
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="card-header">
            <h5 class="card-title">Lista de Doctores</h5> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @include('doctoresajax.create')
               <a class="btn btn-info" onClick="add()" href="javascript:void(0)"><i class="far fa fa-plus-square"></i> Agregar Doctor</a>
               <a href="/doctores-pdf" style="text-decoration:none;color:aliceblue;"> <button type="button" class="btn btn-info" >Imprimir Reporte</button></a>
               <hr>

                <table class="table table-striped" style="width:100%" id="ajax-crud-datatable">
                    <thead class="thead">
                       <tr>
                           <th scope="col">Doctor</th>
                           <th scope="col">Email</th>
                           <th scope="col">Fecha de Nacimiento</th>
                           <th scope="col">Acciones</th>
                       </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@include('doctoresajax.create')
@stop

@section('footer')
<footer class="main-footer">
    <div class="float-right d-none d-sm-block"><b>Versión</b> a.0.0.0.20210310</div>
    <strong>©2022 <a href="https://www.inadware.com.mx/">Inadware de México, S. de R.L.</a></strong>
</footer>
@stop

@section('css')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#ajax-crud-datatable').DataTable({
    // processing: true,
    serverSide: true,
    ajax: "{{ url('doctoresajax') }}",
    columns: [
    { data: 'doctor', name: 'doctor'},
    { data: 'email', name: 'email' },
    { data: 'FecNac', name: 'FecNac' },
    {data: 'action', name: 'action', orderable: false},
    ],
    order: [[0, 'desc']]
    });
    });
    function add(){
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Registro de doctores");
    $('#company-modal').modal('show');
    $('#id').val('');
    }   
    function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('doctoresajaxedit') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#CompanyModal').html("Editar doctor");
$('#company-modal').modal('show');
$('#id').val(res.id);
$('#Doctor').val(res.doctor);
/* $('#paterno').val(res.Paterno);
$('#materno').val(res.Materno); */
$('#fecnac').val(res.FecNac);
$('#especialidad1').val(res.Especialidad1);
$('#cedprof').val(res.CedProf);
$('#centro').val(res.Centro);
$('#sexo').val(res.Sexo);
$('#tels').val(res.Tels);
$('#Email').val(res.email);
$('#direccion').val(res.Direccion);
$('#colonia').val(res.Colonia);
$('#Cp').val(res.cp);
$('#estado').val(res.Estado);
$('#municipio').val(res.Municipio);
}
});
} 
    function deleteFunc(id){
    if (confirm("Delete Record?") == true) {
    var id = id;
    // ajax
    $.ajax({
    type:"POST",
    url: "{{ url('doctoresajaxdestroy') }}",
    data: { id: id },
    dataType: 'json',
    success: function(res){
    var oTable = $('#ajax-crud-datatable').dataTable();
    oTable.fnDraw(false);
    }
    });
    }
    }
    $('#CompanyForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type:'POST',
    url: "{{ url('doctoresajaxstore')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    success: (data) => {
    $("#company-modal").modal('hide');
    var oTable = $('#ajax-crud-datatable').dataTable();
    oTable.fnDraw(false);
    $("#btn-save").html('Submit');
    $("#btn-save"). attr("disabled", false);
    },
    error: function(data){
    console.log(data);
    }
    });
    });
    </script>
@stop
