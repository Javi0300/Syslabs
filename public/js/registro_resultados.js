function cambiarEstado(index)
{
    //$("#EstadoDB"+index).val(1);
    /* if($("#EstadoDB"+index).val() == "1")
    {
        $("#EstadoDB"+index).val(0);
    } */

    if($("#EstadoDB"+index).val() == "1")
    {
        $("#EstadoDB"+index).val(0);
    }
    else
    {
        $("#EstadoDB"+index).val(1);
    }
}
function usarformula(id){
    var formula = document.getElementById('txtformula'+id).value.split(' ');
    var formuOriginal = document.getElementById('txtformula'+id).value;
    var error = false;
    
    for (var a = 0; a < formula.length; a++){
        if(formula[a].substring(0,1) == "["){
            quitacorchete1 =  formula[a].replace('[', "");
            quitacorchete2 = quitacorchete1.replace(']', "");
            mcodigoprueba = quitacorchete2;
            formulaNumerica = $("."+mcodigoprueba).val();           
            formuOriginal = formuOriginal.replace(formula[a], formulaNumerica);
        }
    }
    
    try {
      $('#Resultado'+id).val(eval(formuOriginal));
    } catch (e) {
        error = true;
        document.getElementById("Resultado"+id).style.borderColor = 'red';
        $('#mensaje_formula_error'+id).html("La fórmula es inválida, revise la sintaxis. O alguno de los valores son inválidos.");
        setTimeout(function(){
            document.getElementById("mensaje_formula_error"+id).style.display = "none";
        }, 5000);
        document.getElementById("Resultado"+id).style.borderColor = '';
    }

}

function estatus(IdResultado){
    valmin = document.getElementById("ValMin"+IdResultado).value;
    valmax = document.getElementById("ValMax"+IdResultado).value;
    resultado = document.getElementById("Resultado"+IdResultado).value;

    var valmin = parseFloat(valmin);
    var valmax =parseFloat(valmax);
    var resultado =parseFloat(resultado);
    if(resultado >= valmin && resultado <= valmax){
        $('#palomita'+IdResultado).addClass('fa fa-arrow-down');
        $('#palomita'+IdResultado).addClass('fa fa-arrow-up');
        $("#palomita"+IdResultado).addClass('fa fa-check');
        document.getElementById("palomita"+IdResultado).style.color = "green";
    }
   if(resultado > valmax){
        $("#palomita"+IdResultado).removeClass('fa fa-check');
        $('#palomita'+IdResultado).addClass('fa fa-arrow-down');
        $('#palomita'+IdResultado).addClass('fa fa-arrow-up');
        document.getElementById('palomita'+IdResultado).style.color = "red";
    }
    if(resultado < valmin){
        $("#palomita"+IdResultado).removeClass('fa fa-check');
        $("#palomita"+IdResultado).removeClass('fa fa-arrow-up');
        $('#palomita'+IdResultado).addClass('fa fa-arrow-down');

        document.getElementById('palomita'+IdResultado).style.color = "red";
    }
}
function desplegar(index){
    //alert("hola");
    $(".contenido"+index).toggle(500);    
    //document.getElementById("contenido"+index).style.display = "none";
   // alert("si pasi");
}
function porpaciente(){
    $('#BuscarPaciente').prop('disabled', false);
    $('#BuscarxDepto').prop('disabled', 'disabled');
    
    $('#validacion').val(1);
    document.getElementById("BuscarPaciente").style.display = "block";
    document.getElementById("muestraid").style.display = "none";
}
function porfecha(){
    $('#BuscarPaciente').prop('disabled', 'disabled');
    $('#BuscarxDepto').prop('disabled', 'disabled');
    
    $('#validacion').val(2);
    document.getElementById("BuscarPaciente").style.display = "block";
    document.getElementById("BuscarxDepto").style.display = "block";
}
function pordepto(){
    $('#BuscarPaciente').prop('disabled', 'disabled');
    $('#BuscarxDepto').prop('disabled', false);


    $('#validacion').val(3);
    

    document.getElementById("BuscarPaciente").style.display = "block";
    document.getElementById("muestraid").style.display = "none";
}

$(document).ready(function() {
    $(".inValidador").val(document.getElementById("validacion").value);
    $(".selectPaciente").val(document.getElementById("BuscarPaciente").value);
    $(".inFechaI").val(document.getElementById("BuscarxFecha").value);
    $(".inFechaF").val(document.getElementById("BuscarxFechaFin").value);
    $(".selectDepto").val(document.getElementById("BuscarxDepto").value);

    $("#Validador").val(document.getElementById("validacion").value);
    $("#selectPaciente").val(document.getElementById("BuscarPaciente").value);
    $("#inFechaI").val(document.getElementById("BuscarxFecha").value);
    $("#inFechaF").val(document.getElementById("BuscarxFechaFin").value);
    $("#selectDepto").val(document.getElementById("BuscarxDepto").value);
    
    $("#antibiograma_validacion").val(document.getElementById("validacion").value);
    $("#id_solicitud").val($(".IdSolicitud").val());
    $("#antibiograma_FechaI").val(document.getElementById("BuscarxFecha").value);
    $("#antibiograma_FechaF").val(document.getElementById("BuscarxFechaFin").value);

    $(".modal_IdSolicitud").val($(".IdSolicitud").val());
    $(".modal_inValidador").val(document.getElementById("validacion").value);
    $(".modal_selectPaciente").val(document.getElementById("BuscarPaciente").value);
    $(".modal_inFechaI").val(document.getElementById("BuscarxFecha").value);
    $(".modal_inFechaF").val(document.getElementById("BuscarxFechaFin").value);
    $(".modal_selectDepto").val(document.getElementById("BuscarxDepto").value);
});
var cuenta = 1;
var tabindex3 = 400;
var tabindex4 = 500;
function slcRecarga(index){
    var idAntibiograma = document.getElementById("idAntibiograma"+index).value;
    textoAntibiotico = $('#slcGrupoAntibiotico'+index+' option:selected').val().split('.');
    numeroAntibioticos = textoAntibiotico.length;
    if(numeroAntibioticos -1 == 0){
        alert("Este grupo no contiene ningún antibiótico.");
    }
    /* alert(numeroAntibioticos - 1); */
    

    for(var i=0; i<numeroAntibioticos-1; i++) {
        var nombreAntibiotico = textoAntibiotico[i];
        var filas = '<tr id="filaGA'+cuenta+'"><td><input name="textoAntibiotico[]" value="'+nombreAntibiotico+'" style="border:0;background-color: unset;" readonly><input name="textoidAntibiograma[]" value="'+idAntibiograma+'" hidden readonly><input name="idAntibiogramaDetalle[]" value="0" hidden readonly></td><td><input id="textoResultado'+cuenta+'" name="textoResultado[]" tabindex="'+tabindex3+'" onblur="generarPalabras('+cuenta+');" maxlength="10"></td><td><input name="textoUnidad[]" tabindex="'+tabindex4+'" maxlength="50"></td><td class="text-center"><i onclick="eliminarGA('+cuenta+');" style="color: #ff0000" class="fa fa-times"></i><input id="canceladoGA'+cuenta+'" name="cancelado[]" type="text" hidden readonly></td></tr>';
        cuenta++;
        tabindex3++;
        tabindex4++;
        $('#tableAntibioticos'+index).append(filas);
        //$('#slcGrupoAntibiotico'+index+' option:selected').remove();
        
    }
    $('#slcGrupoAntibiotico'+index+' option:selected').remove();
}

var cont = 1;
var tabindex1 = 100;
var tabindex2 = 200;
function seleccionarAntibiotico(index) {
    var idAntibiograma = document.getElementById("idAntibiograma"+index).value;
    var textoAntibiotico = $('#slcAntibiotico'+index+' option:selected').text();
    var fila = '<tr id="fila'+cont+'"><td><input name="textoAntibiotico[]" value="'+textoAntibiotico+'" style="border:0;background-color: unset;" readonly><input name="textoidAntibiograma[]" value="'+idAntibiograma+'" hidden readonly><input name="idAntibiogramaDetalle[]" value="0" hidden readonly></td><td><input id="textoResultado'+cont+'" name="textoResultado[]" tabindex="'+tabindex1+'" onblur="generarPalabras('+cont+');" maxlength="10"></td><td><input name="textoUnidad[]" tabindex="'+tabindex2+'" maxlength="50"></td><td class="text-center"><i onclick="eliminar('+cont+');" style="color: #ff0000" class="fa fa-times"></i><input id="cancelado'+cont+'" name="cancelado[]" type="text" hidden readonly></td></tr>';
    cont++;
    tabindex1++;
    tabindex2++;

    $('#tableAntibioticos'+index).append(fila);
}
function eliminar(index){
    //$("#fila" + index).remove();
    document.getElementById("fila"+index).style.backgroundColor  = "red";
    $("#cancelado" + index).val(1);
}
function eliminarGA(index){
    //$("#filaGA" + index).remove();
    document.getElementById("filaGA"+index).style.backgroundColor  = "red";
    $("#canceladoGA" + index).val(1);
}
function eliminarBase(index){
    //$("#filaDB" + index).remove();
    document.getElementById("filaDB"+index).style.backgroundColor  = "red";
    $("#canceladoDB" + index).val(1);
}
function generarPalabras(index) {
    if ($("#textoResultado"+index).val() == "r" || $("#textoResultado"+index).val() == "R") {
        $("#textoResultado"+index).val("RESISTENTE");
    }
    if ($("#textoResultado"+index).val() == "i" || $("#textoResultado"+index).val() == "I") {
        $("#textoResultado"+index).val("INTERMEDIO");
    }
    if ($("#textoResultado"+index).val() == "s" || $("#textoResultado"+index).val() == "S") {
        $("#textoResultado"+index).val("SENSIBLE");
    }
}