document.getElementById('btnPlusGuardar').disabled = true;
let lstNumeroAntibioticos = document.getElementsByClassName("id_Antibiotico"), arrayAntibioticos = [];
for (var i = 0; i < lstNumeroAntibioticos.length; i++) {    
    arrayAntibioticos[i] = lstNumeroAntibioticos[i].value;
    $('#select_disponible option[value="'+lstNumeroAntibioticos[i].value+'"]').remove();
}