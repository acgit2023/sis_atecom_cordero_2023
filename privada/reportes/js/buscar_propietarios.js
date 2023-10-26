"use strict"
function buscar_propietarios() {
    var d1, d2, d3, d4, d5, ajax, url, param, contenedor;
    contenedor = document.getElementById('propietario1');
    d1 = document.formu.placa.value;
    d2 = document.formu.nombre.value;
    d3 = document.formu.ap.value;
    d4 = document.formu.am.value;
    d5 = document.formu.direccion.value;
    //alert(d5);
    ajax = nuevoAjax();
    url = "ajax_buscar_propietarios.php"
    param = "placa="+d1+"&nombre="+d2+"&ap="+d3+"&am="+d4+"&direccion="+d5;
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
    
