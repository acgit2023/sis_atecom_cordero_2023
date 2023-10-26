<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_ventas.js'> </script>
         <script type='text/javascript' src='js/mostrar_ven.js'> </script>
    </head>
      <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
        
    echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
    echo"<h1>FICHA TECNICA DE VENTAS</h1>";
echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Nro Factura</b><br />
          <input type='text' name='nro_factura' value='' size='10' onKeyUp='buscar_ventas()'>
        </th>
        <th>
          <b>Monto Final</b><br />
          <input type='text' name='Monto_final' value='' size='10' onKeyUp='buscar_ventas()'>
        </th>
        <th>
          <b>Fecha</b><br />
          <input type='text' name='Fecha' value='' size='10' onKeyUp='buscar_ventas()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
       
echo"<div id='ventas1'> ";
echo"</div>";
echo "</body>
      </html> ";
       
?>