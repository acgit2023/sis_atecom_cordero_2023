"use strict"
function buscar_opcion(){
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('opciones1');
    d1 = document.formu.grupo.value;
    d2 = document.formu.opcion.value;
    d3 = document.formu.contenido.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_opciones.php'
    param = 'grupo='+d1+'&opcion='+d2+'&contenido='+d3;
    //alert(param)
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}