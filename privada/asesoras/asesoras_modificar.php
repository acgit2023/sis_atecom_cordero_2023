
<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

$id_asesora=$_POST["id_asesora"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                     FROM asesoras
                     WHERE id_asesora= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_asesora));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='asesoras_modificar1.php' method='post' name='formu'>";
        echo"<center>
        <h1>MODIFICAR TERAPEUTA</h1>
            <table class='listado'>
                <tr>
                    <th><b>(*)Nombres</b></th>
                    <td><input type='text' name='nombres' size='10' value='".$fila["nombres"]."'></td>
                </tr>

                <tr>
                    <th><b>Apellidos</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["apellidos"]."'>
                    </td>                    
                </tr>  
                
                <tr>
                  <th><b>Telefono</b></th><td><input type='text' name='telefono' size='20' value='".$fila["telefono"]."'></td>
                </tr>

                <tr>
                  <th><b>Formacion</b></th>
                  <td><input type='text' name='formacion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["formacion"]."'></td>
                </tr>
                
                <tr>
                  <td align='center' colspan='2'>  
                    <input type='submit' value='MODIFICAR ASESORAS'  >
                    <input type='hidden' name='id_asesora' value='".$fila["id_asesora"]."'>
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