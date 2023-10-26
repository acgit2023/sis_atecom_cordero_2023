<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo" <html>
    <head>
        <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        <script type='text/javascript'>
        function validar() {
        fecha1 = document.formu.date1.value;
        fecha2 = document.formu.date2.value;
        if ((document.formu.date1.value=='' ) || (document.formu.date2.value == '') || (document.formu.date1.value > document.formu.date2.value )) {
        alert('Las fechas son incorrectas');
        document.formu.date1.focus();
        return;
        }
        ventanaCalendario = window.open('personas_fechas1.php?fecha1=' + fecha1 + '&fecha2=' +fecha2 , 'calendario', 'width=600, height=550, left=100, top=100, scrollbars=yes menubars=no, statusbar=NO, status=No, resizable=YES, location=N0')
    }
</script>
</head>

    </head>
    <body>
    <a href='../../listado_tablas.php'>Listado de tablas</a>
    <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

    echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>
    
    <h1>REPORTES DE PERSONAS CON FECHAS DE INSERCION</h1>
    <form method='post' name='formu'>";
    echo"<center>
    <table border='1'>
        <tr>
        <th>*Fecha Inicio </th><th>:</th>
        <td><input type='date' name='date1' class='tcal' value='' size='10'></td>
        <th>*Fecha Fin</th><th>:</th>
        <td><input type='date' name='date2' class=tcal' value='' size='10'></td>
        </tr>
    <tr>
        <td align='center' colspan='6'>
        <input type='hidden' name='accion' value=''>
        <input type='button' value='Aceptar' onclick='validar();'' class='boton2'>
        </td>
    </tr>
    </table>
    </form>
    </center>";


echo "</body>
</html>";

?>



