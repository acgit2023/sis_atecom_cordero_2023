
<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;

$id_terapeuta=$_POST["id_terapeuta"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
        
$sql = $db->Prepare("SELECT *
                     FROM terapeutas
                     WHERE id_terapeuta= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_terapeuta));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='terapeutas_modificar1.php' method='post' name='formu'>";
        echo"<center>
        <h1>MODIFICAR TERAPEUTA</h1>

            <table class='listado'>
                <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombres"]."'>
                    </td>
                </tr>
                <tr>
                    <th><b>Apellidos</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["apellidos"]."'></td>
                </tr>
                <tr>
                    <th><b>(*)CI</b></th>
                    <td><input type='text' name='ci' size='10' value='".$fila["ci"]."'></td>
                </tr>
                <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'>
                    </td>
                </tr>
                <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='20' value='".$fila["telefono"]."'>
                    </td>
                </tr>
                <tr>
                    <th><b>Profesion</b></th>
                    <td><input type='text' name='profesion' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["profesion"]."'>
                    </td>                    
                </tr> 
            
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR TERAPEUTA'  >
                  <input type='hidden' name='id_terapeuta' value='".$fila["id_terapeuta"]."'>
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