$(document).ready(function () {
    $("#redireccionadorDoctor").val("doctor");
    $('#redireccionadorCreateEmpresa').val("empresa");
});

$('#idEmpresaSelect').on('change', function() {
        $('#redireccionadorEditEmpresa').val(this.value);
        var datosEmpresaEdit = document.getElementById('idEmpresaSelect').value.split('~');
        idEmpresa = datosEmpresaEdit[0];
        empresa = datosEmpresaEdit[1];
        tel1Empresa = datosEmpresaEdit[2];
        tel2Empresa = datosEmpresaEdit[3];
        rfcEmpresa = datosEmpresaEdit[4];
        direccionEmpresa = datosEmpresaEdit[5];
        cpEmpresa = datosEmpresaEdit[6];
        paisEmpresa = datosEmpresaEdit[7];
        entidadEmpresa = datosEmpresaEdit[8];
        municipioEmpresa = datosEmpresaEdit[9];
    
        var valor_seleccionadoEmpresa = "{{route('empresas.update', 'valor' )}}";
        valor_seleccionadoEmpresa = valor_seleccionadoEmpresa.replace('valor', idEmpresa); 

        $("#empresaFormulario").attr("action", valor_seleccionadoEmpresa);
        $("#NombreEditEmpresa").val(empresa);
        $("#tel1EditEmpresa").val(tel1Empresa);
        $("#tel2EditEmpresa").val(tel2Empresa);
        $("#rfcEditEmpresa").val(rfcEmpresa);
        $("#direccionEditEmpresa").val(direccionEmpresa);
        $("#CpEditEmpresa").val(cpEmpresa);
        $("#paisEditEmpresa").val(paisEmpresa);
        $("#DireccionEditDoctor").val(direccionDoctor);
        $("#cpEditDoctor").val(cpDoctor);
        $("#EstadoEditEmpresa").val(entidadEmpresa);
        $("#MunicipioEditEmpresa").val(municipioEmpresa);
});

$('#idDoctorSelect').on('change', function() {
    $('#redireccionadorDoctorEdit').val(this.value);
    var datosDoctorEdit = document.getElementById('idDoctorSelect').value.split('~');
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
    estadoDoctor = datosDoctorEdit[11];
    municipioDoctor = datosDoctorEdit[12];

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
    $("#EstadoEditDoctor").val(estadoDoctor);
    $("#MunicipioEditDoctor").val(municipioDoctor);
});

$('#idPacienteSelect').on('change', function() {
        $('#redireccionadorEdit').val(this.value);
        var datosPacienteEdit = document.getElementById('idPacienteSelect').value.split('~');
        id = datosPacienteEdit[0];
        paciente = datosPacienteEdit[1];
        fechaNac = datosPacienteEdit[2];
        sexo = datosPacienteEdit[3];
        empresa = datosPacienteEdit[4];
        telefono = datosPacienteEdit[5];
        email = datosPacienteEdit[6];
        rfc = datosPacienteEdit[7];
        calle = datosPacienteEdit[8];
        numero = datosPacienteEdit[9];
        colonia = datosPacienteEdit[10];
        cp = datosPacienteEdit[11];
        pais = datosPacienteEdit[12];
        estado = datosPacienteEdit[13];
        municipio = datosPacienteEdit[14];
       
        var valor_seleccionado = "{{route('pacientes.update', 'valor' )}}";
        valor_seleccionado = valor_seleccionado.replace('valor', id); 
    
        if(sexo=="H"){
            $("#SexoEditH").prop("checked", true);

        }
        if(sexo==""){
            $("#SexoEditH").prop("checked", false);
            $("#SexoEditM").prop("checked", false);
        }
        if(sexo=="M"){
            $("#SexoEditM").prop("checked", true);
           
        }
        
    
    $("#formulario").attr("action", valor_seleccionado);
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
});