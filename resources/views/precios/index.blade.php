@extends('adminlte::page')

@section('content_header')
<h1>Precios</h1>
@stop

@section('content')

<div class="card">
    
    <div class="card-header">
        
        <a style="text-decoration:none;color:aliceblue;" class="float-right d-none d-sm-block">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createPrecioModal">
               <i class="far fa fa-plus-square"></i> Agregar
           </button> 
        </a>
        @include('precios.create')
        @include('precios.edit')
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="precios" class="table table-striped table-bordered">
                <thead class="thead">
                    <tr> 
                        <th scope="col">Abreviatura</th>
                        <th scope="col">Nombre</th>
                        <td scope="col">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($precios as $precio)
                    <tr>
                        <td style="width: 25%;">{{ $precio->Abreviatura }}</td>
                        <td>{{ $precio->Descripcion }}</td>
                        <td width="100">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                 
                                                <button title="Editar" style="text-align:left" type="button" id="btnModal{{$precio->idPrecio}}" value="{{$precio->idPrecio}}~{{$precio->Abreviatura}}~{{$precio->Descripcion}}" onclick="modal('{{$precio->idPrecio}}')" data-toggle="modal" data-target="#updatePrecioModal" class="btn-xs btn btn-primary fa fa fa-pencil">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                 
                                                <form class="formulario" action="{{route('precios.destroy',$precio->idPrecio)}}" method ="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="{{route('precios.edit',Crypt::encrypt($precio->idPrecio))}}" class="btn-xs btn-primary fa fa fa-pencil">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    
                                                   <button title="Eliminar lista" style="text-align:center" class="btn-xs btn btn-danger"><i class="fa fa-trash"></i></button>
                                                   
                                                </form>
                                            </div>
                                            <div class="col-md-3">
                                                 
                                                <form action="{{route('precios_detalle.index')}}">
                                                    <input hidden readonly id="iptidPrecio" name="iptidPrecio" value="{{$precio->idPrecio}}">
                                                    <input hidden readonly id="iptPrecioDescripcion" name="iptPrecioDescripcion" value="{{$precio->Descripcion}}">
                                                    <button title="Ir a los precios" class="btnCheck btn-xs btn btn-info fa fa fa-pencil">
                                                       <i style="color: #ffffff" class="fa fa-bars"></i>
                                                    </a>
                                                 </form>
                                            </div>
                                        </div>
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

<script>
    function modal(index){
        var valor_modal = document.getElementById('btnModal'+index).value.split('~');
        id = valor_modal[0];
        abreviatura = valor_modal[1];
        descripcion = valor_modal[2];
    
        var valor_seleccionado = "{{route('precios.update', 'valor' )}}";
        valor_seleccionado = valor_seleccionado.replace('valor', index);
            
        $("#formularioUpdate").attr("action", valor_seleccionado);
        $("#UpdateAbreviatura").val(abreviatura);
        $("#nombreUpdateEmpresa").val(descripcion);
    
    }
</script>

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
        text: "¡Esta lista de precios contiene configuraciones de precios que no podrán recuperarse!",

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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script>
$(document).ready(function () {
    $('#precios').DataTable({"order": [[ 0, 'asc' ]]});
});
</script> 
@stop