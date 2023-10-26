"use strict"
function buscar_ventas() {
    var d1, d2, d3, d11,ajax, url, param, contenedor;
    contenedor = document.getElementById('ventas1');
    d1 = document.formu.nro_factura.value;
    d2 = document.formu.Monto_final.value;
    d3 = document.formu.Fecha.value;
    //alert(d5);
    ajax = nuevoAjax();
    url = "ajax_buscar_ventas.php"
    param = "nro_factura="+d1+"&Monto_final="+d2+"&Fecha="+d3;
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
    
