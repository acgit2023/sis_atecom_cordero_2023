"use strict"
function buscar_persona(){
    var d1, d2,d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('personas1');
    d1 = document.formu.nombres.value;

    /*ESTO ES PARA QUE CUANDO BORRE TODO NO DESAPAREZCA EL LISTADO*/
    /*d11 =document.formu.paterno.value;
    d11= event.keyCode; 
    if ((d11 == 8) && (d1.length==0)){
        d1 = '%';
    }*/


    d2 = document.formu.ci.value;
    d3 = document.formu.telef.value;
 
    ajax = nuevoAjax();
    url = "ajax_buscar_persona.php"
    param = "nombres="+d1+"&ci="+d2+"&telef="+d3;
    //alet(param);
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    ajax.onreadystatechange = function(){
        if (ajax.readyState == 4){
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}