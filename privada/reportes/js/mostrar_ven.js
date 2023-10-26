"use strict"
function mostrar(id_venta) {
    var d1, ventanaCalendario;
    d1 = id_venta;
    //alert(id_venta);
    ventanaCalendario = window.open("ficha_tec_ventas_cliente1.php?id_venta=" + d1 , "calendario", "width=600, heigth=550,left=100,scrollbars=yes,menubars=no,statusbar=,statusbar=NO,status=NO,resizable=YES,location=NO")
}