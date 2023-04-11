@extends('adminlte::page')

@section('content_header')
<h1>Catalogo de Doctores</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="/doctores-pdf" target="_blank" style="text-decoration:none;color:aliceblue;"><button type="button" class="btn btn-info" >Imprimir Reporte</button></a>
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createDoctor">
               <i class="far fa fa-plus-square"></i> Agregar Doctor
           </button> 
        </a>
        @include('doctores.create')
        @include('doctores.update')
    </div>
    
    <div class="card-body">
						
        <div class="table-responsive">
            <table id="doctores" class="table table-striped table-bordered" style="width:100%" >

                <thead class="thead">
                    <tr> 
                        <th scope="col">Doctor</th>							
                        <th scope="col">Email</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctores as $doctor)
                    <tr>								
                        <td>{{ $doctor->doctor }}</td>																
                        <td>{{ $doctor->email }}</td>
                        <td>{{$doctor->FecNacFormateada}}</td>
                        <td width="90">
                            <form class="formulario" action="{{route('doctores.destroy',$doctor->idDoctor)}}" method ="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <a href="{{route('metodos.edit',Crypt::encrypt($metodo->id))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a> --}}
                                <button type="button" id="btnModal{{$doctor->idDoctor}}" value="{{$doctor->idDoctor}}~{{$doctor->doctor}}~{{$doctor->FecNac}}~{{$doctor->Especialidad1}}~{{$doctor->Especialidad2}}~{{$doctor->CedProf}}~{{$doctor->Sexo}}~{{$doctor->Tels}}~{{$doctor->email}}~{{$doctor->Direccion}}~{{$doctor->cp}}~{{$doctor->Pais}}~{{$doctor->Estado}}~{{$doctor->Municipio}}" onclick="modal('{{$doctor->idDoctor}}')" data-toggle="modal" data-target="#updateDoctor" class="btn-xs btn btn-primary fa fa fa-pencil">
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
    /* window.location = "#Opcional"; */
    /* document.getElementById("Form").reset(); */
    var datosDoctorEdit = document.getElementById('btnModal'+index).value.split('~');
    idDoctor = datosDoctorEdit[0];
    doctor = datosDoctorEdit[1];
    fechaNacDoctor = datosDoctorEdit[2];
    Especialidad1 = datosDoctorEdit[3];
    Especialidad2 = datosDoctorEdit[4];
    cedprof = datosDoctorEdit[5];
    sexoDoctor = datosDoctorEdit[6];
    tels = datosDoctorEdit[7];
    emailDoctor = datosDoctorEdit[8];
    direccionDoctor = datosDoctorEdit[9];
    cpDoctor = datosDoctorEdit[10];
    PaisDoctor = datosDoctorEdit[11];
    estadoDoctor = datosDoctorEdit[12];
    municipioDoctor = datosDoctorEdit[13];

    var valor_seleccionadoDoctor = "{{route('doctores.update', 'valor' )}}";
    valor_seleccionadoDoctor = valor_seleccionadoDoctor.replace('valor', idDoctor);

        if(sexoDoctor=="H"){
            $("#SexoEditDoctorH").prop("checked", true);

        }
        if(sexoDoctor==""){
            $("#SexoEditDoctorH").prop("checked", false);
            $("#SexoEditDoctorM").prop("checked", false);
        }
        if(sexoDoctor=="M"){
            $("#SexoEditDoctorM").prop("checked", true);
           
        }
    
    $("#formularioCreateDoctor").attr("action", valor_seleccionadoDoctor);
    $("#DoctorEdit").val(doctor);
    $("#FecNacEditDoctor").val(fechaNacDoctor);
    $("#Especialidad1Edit").val(Especialidad1);
    $("#Especialidad2Edit").val(Especialidad2);
    $("#CedProfEdit").val(cedprof);
    $("#TelsEdit").val(tels);
    $("#emailEditDoctor").val(emailDoctor);
    $("#DireccionEditDoctor").val(direccionDoctor);
    $("#cpEditDoctor").val(cpDoctor);
    $("#PaisEditDoctor").val(PaisDoctor);
    $("#EstadoEditDoctor").val(estadoDoctor);
    $("#MunicipioEditDoctor").val(municipioDoctor);
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
        $('#doctores').DataTable({"order": [[ 0, 'asc' ]]});
    });
</script>
@stop