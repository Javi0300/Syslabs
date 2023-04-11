@extends('adminlte::page')

@section('content_header')
<h1>Catalogo de Pacientes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
        @endif
        {{-- <select id="idPacienteSelect" class="form-control show-tick">
            {{-- @foreach ($pacientes2 as $paciente)
                <option value="{{$paciente->idPaciente}}" selected>{{$paciente->Paciente}}</option>
            @endforeach
    </select> --}}
        <a href="/pacientes-pdf" target="_blank" style="text-decoration:none;color:aliceblue;"><button type="button" class="btn btn-info" >Imprimir Reporte</button></a>
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createPaciente">
               <i class="far fa fa-plus-square"></i> Agregar Paciente
           </button> 
        </a>
        @include('pacientes.create')
        {{-- @include('pacientes.create2') --}}
        @include('pacientes.update')
    </div>
    @if($message = Session::get("integrityviolation"))
    <div class="alert alert-danger">
        <p>{{$message="Este paciente podríar esta siendo usado por otros registros."}}</p>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table id="pacientes" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Paciente</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{$paciente->Paciente}}</td>
                        <td>{{$paciente->email}}</td>
						<td>{{/* date('d/m/Y', strtotime( */ $paciente->FecNacFormateada/* )) */}}</td>   
                        <td><center>
                            
                            <form class="formulario" action="{{route('pacientes.destroy',$paciente->idPaciente)}}" method ="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <a href="{{route('metodos.edit',Crypt::encrypt($metodo->id))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a> --}}
                                <button type="button" id="btnModal{{$paciente->idPaciente}}" value="{{$paciente->idPaciente}}~{{$paciente->Paciente}}~{{$paciente->FecNac}}~{{$paciente->Sexo}}~{{$paciente->id_Empresa}}~{{$paciente->Telefono}}~{{$paciente->email}}~{{$paciente->Rfc}}~{{$paciente->Calle}}~{{$paciente->Numero}}~{{$paciente->Colonia}}~{{$paciente->Cp}}~{{$paciente->Pais}}~{{$paciente->Estado}}~{{$paciente->Municipio}}" onclick="modal('{{$paciente->idPaciente}}')" data-toggle="modal" data-target="#updatePaciente" class="btn-xs btn btn-primary fa fa fa-pencil">
                                    <i class="fa fa-edit"></i>
                                </button>
                               <button class="btn-xs btn btn-danger"><i class="fa fa-trash"></i></button>
                                
                            </form></center>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js') 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<script>
function modal(index){
    /* window.location = "#Opcional"; */
    /* document.getElementById("Form").reset(); */
    var valor_modal = document.getElementById('btnModal'+index).value.split('~');
    id = valor_modal[0];
    paciente = valor_modal[1];
    fechaNac = valor_modal[2];
    sexo = valor_modal[3];
    empresa = valor_modal[4];
    telefono = valor_modal[5];
    email = valor_modal[6];
    rfc = valor_modal[7];
    calle = valor_modal[8];
    numero = valor_modal[9];
    colonia = valor_modal[10];
    cp = valor_modal[11];
    pais = valor_modal[12];
    estado = valor_modal[13];
    municipio = valor_modal[14];
    var valor_seleccionado = "{{route('pacientes.update', 'valor' )}}";
    valor_seleccionado = valor_seleccionado.replace('valor', index);

    if(sexo=="H"){
        $("#SexoEditH").prop("checked", true);
    }
    if(sexo==""){
            $("#SexoEditH").prop("checked", false);
            $("#SexoEditM").prop("checked", false);
    }
    if(sexo=="M"){
        $("#SexoEditM").prop("checked", true);
        /* alert('Mujer'); */
    }
    
    $("#formulario").attr("action", valor_seleccionado);
    $("#id").val(id);
    $("#PacienteEdit").val(paciente);
    $("#FecNacEdit").val(fechaNac);
    $("#EmpresaEdit").val(empresa);
    $("#TelefonoEdit").val(telefono);
    $("#emailEdit").val(email);
    $("#CpEdit").val(cp);
    $("#rfcEdit").val(rfc);
    $("#calleEdit").val(calle);
    $("#NumeroEdit").val(numero);
    $("#ColoniaEdit").val(colonia);
    $("#paisEdit").val(pais);
    $("#EstadoEdit").val(estado);
    $("#MunicipioEdit").val(municipio);
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" 
integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('#pacientes').DataTable({"order": [[ 0, 'asc' ]]});
    });
</script>
@stop