"use strict"
function buscar_personas(){
    var d1, d2,d3, d4, ajax, url, param, contenedor;
    contenedor = document.getElementById('personas1');
    d1 = document.formu.paterno.value;

    /*ESTO ES PARA QUE CUANDO BORRE TODO NO DESAPAREZCA EL LISTADO*/
    /*d11 =document.formu.paterno.value;
    d11= event.keyCode; 
    if ((d11 == 8) && (d1.length==0)){
        d1 = '%';
    }*/


    d2 = document.formu.materno.value;
    d3 = document.formu.nombres.value;
    d4 = document.formu.ci.value;
    ajax = nuevoAjax();
    url = "ajax_buscar_persona.php"
    param = "paterno="+d1+"&materno="+d2+"&nombres="+d3+"&ci="+d4;
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