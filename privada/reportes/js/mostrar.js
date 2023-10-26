"use strict"
function mostrar(id_persona) {
    var d1, ventanaCalendario;
    d1 = id_persona;
    //alert(id_persona);
    ventanaCalendario = window.open("ficha_tec_personas1.php?id_persona=" +d1 , "calendario", "width=600, heigth=550,left=100,scrollbars=yes,menubars=no,statusbar=,statusbar=NO,status=NO,resizable=YES,location=NO")
}