function desbloquearBotonEmpresa(){
    document.getElementById('btnPlusGuardar').disabled = false;
}
cont = 1;
    function elegirEmpresa(){
        var empresa_id = $('#select_empresas_disponibles').val();
        var empresa_texto = $('#select_empresas_disponibles option:selected').text();
        var fila = '<div id="filaN'+cont+'" class="col-md-12" onclick="marcarFilasN('+cont+');"><div class="container"><input name="monedero_id[]" hidden readonly><input name="monedero_id_empresa[]" value="'+empresa_id+'" hidden readonly><p>'+empresa_texto+'</p><input id="canceladoN'+cont+'" name="cancelado[]" type="text" hidden readonly></div></div>';
        cont++;
        $("#select_empresas_disponibles option:selected").remove();
        $('#td_empresas_detalle').append(fila);
        $("#btnPlusGuardar"). attr("disabled", true);
    }
    function deselegirEmpresa(){

        $('.eliminar').css('background', 'red');
        $('#btnGuardar').click();
    }
    function marcarFilasN(index){
        document.getElementById("canceladoN"+index).value = "1";
        document.getElementById("filaN"+index).style.backgroundColor  = "gray";
        $("#filaN"+index).removeClass('col-md-12');
        $("#filaN"+index).addClass('eliminar');
    }
    function marcarFilasDB(index){
        document.getElementById("canceladoDB"+index).value = "1";
        document.getElementById("filaDB"+index).style.backgroundColor  = "gray";
        $("#filaDB"+index).removeClass('col-md-12');
        $("#filaDB"+index).addClass('eliminar');
    }
    function activar(){
        $('#indicador').html('Activado');
    }
    function desactivar(){
        $('#indicador').html('Desactivado');
        
    }