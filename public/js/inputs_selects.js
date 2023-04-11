/*----------------------------Función para editar las filas a conveniencia-------------------------------------------------------- */
function edicionFilas(index){
  /*Para el select de tipo de Sexo*/
  $("#sexovalref1"+index).removeAttr("readonly");
  document.getElementById("sexovalref1"+index).style.borderColor = 'blue';
  /*Para el select de tipo de Sexo*/

  /*Para el select de tipo de Unidad/Edad*/
  $("#Edad1"+index).removeAttr("readonly");
  document.getElementById("Edad1"+index).style.borderColor = 'blue';
/*   $("#Edad1"+index).removeAttr("readonly");
  document.getElementById("Edad1"+index).style.borderColor = 'blue';
  $(document).on("click",'#Edad1'+index,function(){
  var val = $(this).val();
  $(this).replaceWith('<select id="Edad1_Select" class="form-control"><option value="'+val+'" selected>'+val+'</option><option value="Días">Días</option><option value="Meses">Meses</option><option value="Años">Años</option></select>');
  });
 $(document).on("change",'#Edad1_Select',function(){
 $(this).replaceWith('<input readonly style="border-color: blue;" id="Edad1'+index+'" class="form-control" name="Edad1[]" value="'+$(this).val()+'"/>');
  }); */
  /*Para el select de tipo de Unidad/Edad*/

  $("#EdadMin1"+index).removeAttr("readonly");
  document.getElementById("EdadMin1"+index).style.borderColor = 'blue';

  $("#EdadMax1"+index).removeAttr("readonly");
  document.getElementById("EdadMax1"+index).style.borderColor = 'blue';

  $("#RefMin1"+index).removeAttr("readonly");
  document.getElementById("RefMin1"+index).style.borderColor = 'blue';

  $("#RefMax1"+index).removeAttr("readonly");
  document.getElementById("RefMax1"+index).style.borderColor = "blue";

  $("#TextoValores"+index).removeAttr("readonly");
  document.getElementById("TextoValores"+index).style.borderColor = "blue";

  $(".btnCheck").attr('disabled','disabled');
  document.getElementById('btnGuardarPrueba').disabled = true;
  document.getElementById('btnAgregar').disabled = true;
  $(".botonEliminarB").attr('disabled','disabled');
  $(".botonEditarB").attr('disabled','disabled');
  document.getElementById('btnCheckDB'+index).disabled = false;
}

/*----------------------------Función para "guardar el estado de la información"-------------------------------------------------------- */
function checkEdicionFilas(index){
  $("#sexovalref1"+index).attr("readonly","readonly");
  document.getElementById("sexovalref1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#Edad1"+index).attr("readonly","readonly");
  document.getElementById("Edad1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  /* document.getElementById("Edad1_Select").hidden; */

  $("#EdadMin1"+index).attr("readonly","readonly");
  document.getElementById("EdadMin1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#EdadMax1"+index).attr("readonly","readonly");
  document.getElementById("EdadMax1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#RefMin1"+index).attr("readonly","readonly");
  document.getElementById("RefMin1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  
  $("#RefMax1"+index).attr("readonly","readonly");
  document.getElementById("RefMax1"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#TextoValores"+index).attr("readonly","readonly");
  document.getElementById("TextoValores"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  document.getElementById('btnGuardarPrueba').disabled = false;
      document.getElementById('btnAgregar').disabled = false;
      $(".botonEliminarB").removeAttr('disabled');
      $(".botonEditarB").removeAttr('disabled');
      $(".btnCheck").removeAttr('disabled');

}
/*----------------------------Función para "guardar el estado de la información"-------------------------------------------------------- */

function showInp(){
  getSelectValue = document.getElementById("tipo_valor_normalidad").value;
  if(getSelectValue=="Texto libre"){
    document.getElementById("textolibre").style.display = "block";
    document.getElementById("tabla_normalidad").style.display = "none";
  }

  else if(getSelectValue=="Rango númerico"){
    document.getElementById("textolibre").style.display = "none";
    document.getElementById("tabla_normalidad").style.display = "block";
    location.hash = "#valoresref";
  }
} 

function ActivarFiltro() {
  valorseleccionado = document.getElementById("Tipo_Valor").value;
  if (valorseleccionado="A" && document.getElementById('Tipo_Valor').checked) {
      document.getElementById("valor_restringido").style.display = "none";
  }
  
  valorseleccionado2 = document.getElementById("Tipo_Valor1").value;
  if (valorseleccionado2="R" && document.getElementById('Tipo_Valor1').checked) {
      document.getElementById("valor_restringido").style.display = "inline-block";
  }
} 


/*Toma los datos del select y hace que la página por defecto muestra la tabla de valores o el Textarea*/
getSelectValue = document.getElementById("tipo_valor_normalidad").value;
if(getSelectValue=="Texto libre"){
  document.getElementById("textolibre").style.display = "block";
  document.getElementById("tabla_normalidad").style.display = "none";
  
}

else if(getSelectValue=="Rango númerico"){
  document.getElementById("textolibre").style.display = "none";
  document.getElementById("tabla_normalidad").style.display = "inline-block";
  /* location.hash = "#valoresref"; */
}
// $('#tipo_valor_normalidad').on('change', function() {
//   var valor_seleccionado = this.value;
//   $('.resultado22').val(valor_seleccionado);
// });

function edicionNuevasFilas(index){
  $("#sexovalrefN"+index).removeAttr("readonly");
  document.getElementById("sexovalrefN"+index).style.borderColor = 'blue';
  
   $("#EdadN"+index).removeAttr("readonly");
  document.getElementById("EdadN"+index).style.borderColor = 'blue';

  $("#EdadMinN"+index).removeAttr("readonly");
  document.getElementById("EdadMinN"+index).style.borderColor = 'blue';

  $("#EdadMaxN"+index).removeAttr("readonly");
  document.getElementById("EdadMaxN"+index).style.borderColor = 'blue';

  $("#RefMinN"+index).removeAttr("readonly");
  document.getElementById("RefMinN"+index).style.borderColor = 'blue';

  $("#RefMaxN"+index).removeAttr("readonly");
  document.getElementById("RefMaxN"+index).style.borderColor = "blue";

  $("#TextoValoresN"+index).removeAttr("readonly");
  document.getElementById("TextoValoresN"+index).style.borderColor = "blue";

  $(".btnCheck").attr('disabled','disabled');
  document.getElementById('btnGuardarPrueba').disabled = true;
  document.getElementById('btnAgregar').disabled = true;
  $(".botonEliminarB").attr('disabled','disabled');
  $(".botonEditarB").attr('disabled','disabled');
  document.getElementById('btnCheckId'+index).disabled = false;
}
/*------------------------------------------------------------------------------------*/
function checkEdicionNuevasFilas(index){
  $("#sexovalrefN"+index).attr("readonly","readonly");
  document.getElementById("sexovalrefN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#EdadN"+index).attr("readonly","readonly");
  document.getElementById("EdadN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  /* document.getElementById("Edad1_Select").hidden; */

  $("#EdadMinN"+index).attr("readonly","readonly");
  document.getElementById("EdadMinN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#EdadMaxN"+index).attr("readonly","readonly");
  document.getElementById("EdadMaxN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#RefMinN"+index).attr("readonly","readonly");
  document.getElementById("RefMinN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';
  
  $("#RefMaxN"+index).attr("readonly","readonly");
  document.getElementById("RefMaxN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  $("#TextoValoresN"+index).attr("readonly","readonly");
  document.getElementById("TextoValoresN"+index).style.borderColor = 'rgba(255, 255, 255, 0)';

  document.getElementById('btnGuardarPrueba').disabled = false;
  document.getElementById('btnAgregar').disabled = false;
  $(".botonEliminarB").removeAttr('disabled');
  $(".botonEditarB").removeAttr('disabled');
  $(".btnCheck").removeAttr('disabled');
}