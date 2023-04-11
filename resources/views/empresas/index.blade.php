@extends('adminlte::page')

@section('content_header')
<h1>Catalogo de Empresas</h1>
@stop

@section('content')
@if($message = Session::get("error"))
<div class="alert alert-danger">
    <h2>Problema:</h2>
    <p>{{$message="Empresa previamente registrado."}}</p>
    <p>{{$message="Si intenta eliminar alguna empresa, esta puede estar ligada a un paciente."}}</p>
</div>
@endif
<div class="card">
    <div class="card-header">
        <a href="/empresas-pdf" target="_blank" style="text-decoration:none;color:aliceblue;"><button type="button" class="btn btn-info" >Imprimir Reporte</button></a>
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createEmpresaModal">
               <i class="far fa fa-plus-square"></i> Agregar Empresa
           </button> 
        </a>
        @include('empresas.create')
        @include('empresas.update')
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="empresas" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead">
                    <tr> 
                        <th scope="col">Sucursal</th>
                        <th scope="col">Nombre</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr>
                        <td style="width: 5%;">{{ $empresa->sucursal }}</td>
                        <td>{{ $empresa->Nombre }}</td>
                        <td width="90">
                            <form class="formulario" action="{{route('empresas.destroy',$empresa->idEmpresa)}}" method ="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <a href="{{route('metodos.edit',Crypt::encrypt($metodo->id))}}" class="btn-xs btn-primary fa fa fa-pencil"><i class="fa fa-edit"></i></a> --}}
                                <button type="button" id="btnModal{{$empresa->idEmpresa}}" value="{{$empresa->idEmpresa}}~{{$empresa->Nombre}}~{{$empresa->tel1}}~{{$empresa->tel2}}~{{$empresa->rfc}}~{{$empresa->direccion}}~{{$empresa->cp}}~{{$empresa->pais}}~{{$empresa->Entidad}}~{{$empresa->Ciudad}}" onclick="modal('{{$empresa->idEmpresa}}')" data-toggle="modal" data-target="#updateEmpresaModal" class="btn-xs btn btn-primary fa fa fa-pencil">
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
    empresa = valor_modal[1];
    tel1 = valor_modal[2];
    tel2 = valor_modal[3];
    rfc = valor_modal[4];
    direccion = valor_modal[5];
    cp = valor_modal[6];
    pais = valor_modal[7];
    estado = valor_modal[8];
    ciudad = valor_modal[9];

    var valor_seleccionado = "{{route('empresas.update', 'valor' )}}";
    valor_seleccionado = valor_seleccionado.replace('valor', index);
        
    $("#empresaFormulario").attr("action", valor_seleccionado);
    $("#NombreEditEmpresa").val(empresa);
    $("#tel1EditEmpresa").val(tel1);
    $("#tel2EditEmpresa").val(tel2);
    $("#rfcEditEmpresa").val(rfc);
    $("#direccionEditEmpresa").val(direccion);
    $("#CpEditEmpresa").val(cp);
    $("#paisEditEmpresa").val(pais);
    $("#EstadoEditEmpresa").val(estado);
    $("#MunicipioEditEmpresa").val(ciudad);
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
    $('#empresas').DataTable({"order": [[ 0, 'desc' ]]});
});
</script>
@stop