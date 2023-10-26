<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$sql = $db->Prepare("SELECT placa
                     FROM flotas                     
                        ");
            $rs = $db->GetAll($sql);

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_propietarios.js'> </script>
         <script type='text/javascript' src='js/mostrar_propietarios.js'> </script>
    </head>
      <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
        
    echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
    echo"<h1>FICHA TECNICA DE PROPIETARIOS</h1>";
    $sql = $db->Prepare("SELECT *
                     FROM flotas                      
                        ");
        $rs = $db->GetAll($sql);
echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
        <b>Placa</b><br />
        <select name='placa' onChange='buscar_propietarios()'>
          <option value=''>--Seleccione--</option>";
          foreach ($rs as $k => $fila) {
          echo"<option value='".$fila['placa']."'>".$fila['placa']."</option>";    
          }  
  echo"</select>
        </th>
        <th>
          <b>Nombre</b><br />
          <input type='text' name='nombre' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        <th>
          <b>Apellido Paterno</b><br />
          <input type='text' name='ap' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        <th>
          <b>Apellido Materno</b><br />
          <input type='text' name='am' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
        <th>
          <b>Direccion</b><br />
          <input type='text' name='direccion' value='' size='10' onKeyUp='buscar_propietarios()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
       
echo"<div id='propietario1'> ";
echo"</div>";
echo "</body>
      </html> ";
       
?>