
<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$pk_id=$_POST["pk_id"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='cargos.php'>Listado de Cargos</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

        echo"<h1>MODIFICAR CARGOS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM cargos
                     WHERE pk_id= ?                      
                        ");
$rs = $db->GetAll($sql,array($pk_id));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='cargos_modificar1.php' method='post' name='formu'>";
        echo"<center>
            <table class='listado'>
                <tr>
                    <th><b>(*)Nombres</b></th>
                    <td><input type='text' name='nombre' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombre"]."'>
                    </td>
                </tr>
            
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR CARGOS'  >
                  <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
                </td>
              </tr>

            </table>
            </center>";
      echo"</form>" ;     
        /*}*/                


    }
                                       
echo "</body>
      </html> ";

 ?>