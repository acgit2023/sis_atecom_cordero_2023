<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_personas.js'> </script>
         <script type='text/javascript' src='js/mostrar.js'> </script>
    </head>
      <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
        
        echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
        echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>FICHA TECNICA PERSONAS</h1>";

echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Parterno</b><br />
          <input type='text' name='paterno' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>Materno</b><br />
          <input type='text' name='materno' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombres' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        <th>
          <b>C.I.</b><br />
          <input type='text' name='ci' value='' size='10' onKeyUp='buscar_personas()'>
        </th>
        
        </tr>
      </table>
      </form>
      </center>
      <!------FIN BUSCADOR---------------->";
       
echo"<div id='personas1'> ";
echo"</div>";
echo "</body>
      </html> ";
       
?>