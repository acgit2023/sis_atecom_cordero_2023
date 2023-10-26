"use strict"
function buscar_directorio(){
    var d1, d2, ajax, url, param, contenedor;
    contenedor = document.getElementById('directorio1');
    d1 = document.formu.id_terapeuta.value;
    d2 = document.formu.cargos.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_directorio.php'
    param = 'id_terapeuta='+d1+'&cargos='+d2;
    //alert(param)s
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        if(ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}