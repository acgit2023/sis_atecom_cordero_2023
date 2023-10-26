
<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

$id_formacion_terapia_complemen=$_POST["id_formacion_terapia_complemen"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

        echo"<h1>MODIFICAR FORMACIONES TERAPIAS COMPLEMENTARIAS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM formaciones_terapias_complementarias
                     WHERE id_formacion_terapia_complemen= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_formacion_terapia_complemen));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='formaciones_terapias_complementarias_modificar1.php' method='post' name='formu'>";
        echo"<center>
            <table class='listado'>
                <tr>
                    <th><b>(*)Nombre de la Formacion</b></th><td><input type='text' name='nombre_formacion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombre_formacion"]."'>
                    </td>
                </tr>
                
                <tr>
                    <th><b>(*)Lugar</b></th>
                    <td><input type='text' name='lugar' size='10' value='".$fila["lugar"]."'></td>
                </tr>
            
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR FORMACIONES TERAPIAS COMPLEMENTARIAS'  >
                  <input type='hidden' name='id_formacion_terapia_complemen' value='".$fila["id_formacion_terapia_complemen"]."'>
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