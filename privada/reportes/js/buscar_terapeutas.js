"use strict"
function buscar_terapeutas() {
    var d1, d2, d3, d4, d5, d6, d11,ajax, url, param, contenedor;
    contenedor = document.getElementById('terapeutas1');
    d1 = document.formu.nombres.value;
    d2 = document.formu.apellidos.value;
    d3 = document.formu.ci.value;
    d4 = document.formu.direccion.value;
    d5 = document.formu.telefono.value;
    d6 = document.formu.profesion.value;
    //alert(d5);
    ajax = nuevoAjax();
    url = "ajax_buscar_terapeutas.php"
    param = "nombres="+d1+"&apellidos="+d2+"&ci="+d3+"&direccion="+d4+"&telefono="+d5+"&profesion="+d6;
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
    
