

function eliminar(index){
    $("#cardlightN" + index).css('background', 'red');
    $("#canceladoN" + index).val(1);
}

function deshacer(index){
    /* $("#filaDB" + index).remove(); */
    $("#cardlightDB" + index).css('background', 'red');
    $("#canceladoDB" + index).val(1);
}