"use strict"
function mostrar(id_propietario) {
    var d1, ventanaCalendario;
    d1 = id_propietario;
    //alert(id_propietario);
    ventanaCalendario = window.open("ficha_tec_propietario_placa1.php?id_propietario=" + d1 , "calendario", "width=600, heigth=550,left=100,scrollbars=yes,menubars=no,statusbar=,statusbar=NO,status=NO,resizable=YES,location=NO")
}