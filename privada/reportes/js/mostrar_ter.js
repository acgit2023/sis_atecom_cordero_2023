"use strict"
function mostrar(id_directorio) {
    var d1, ventanaCalendario;
    d1 = id_directorio;
    //alert(id_persona);
    ventanaCalendario = window.open("ficha_tec_terapeutas_directorio1.php?id_directorio=" +d1 , "calendario", "width=600, heigth=550,left=100,scrollbars=yes,menubars=no,statusbar=,statusbar=NO,status=NO,resizable=YES,location=NO")
}