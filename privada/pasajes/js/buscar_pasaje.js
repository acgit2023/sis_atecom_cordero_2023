"use strict"
function buscar_pasaje(){
    var d1, d2, d3, ajax, url, param, contenedor;
    contenedor = document.getElementById('pasaje1');
    d1 = document.formu.id_cliente.value;
    d2 = document.formu.nro_asiento.value;
    d3 = document.formu.monto.value;
    //alert(d1);
    ajax = nuevoAjax();
    url = 'ajax_buscar_pasa.php'
    param = 'id_cliente='+d1+'&nro_asiento='+d2+'&monto='+d3;
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