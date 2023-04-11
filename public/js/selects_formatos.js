

function eliminar(index){
    $("#cardlightN" + index).css('background', 'red');
    $("#canceladoN" + index).val(1);
}

function deshacer(index){
    $("#cardlightDB" + index).css('background', 'red');
    $("#canceladoDB" + index).val(1);
}