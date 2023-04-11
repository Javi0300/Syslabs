function autoclick(){ //Para el input radio "filtrador1"
    $("#botonEnviar").click();
    document.getElementById("slcfiltrador").style.display = "none";
}

function seleccionar(){//Sucede al seleccionar el "ver por depa" y hace que aparezca el select
    document.getElementById("slcfiltrador").style.display = "block";
}
function autoselect(){ //Para el input radio "filtrador2" y el select envíen en automático
    $("#botonEnviar").click();
   
}
function indicar(index){//Solo es al hacer click en un input de la tabla, seleccione todo el contenido
    $("#UpdatePrecio"+index).select();
}



function mostrarfiltradores(){
    document.getElementById("filtradores").style.display = "block";

    document.getElementById("listaprecios").style.display = "none";

}

function mostrarlistaprecios(){
    document.getElementById("filtradores").style.display = "none";
    document.getElementById("listaprecios").style.display = "block";
}

function cancelarCopiado(){
   document.getElementById("listaprecios").style.display = "none";
   document.getElementById("filtradores").style.display = "block";
}