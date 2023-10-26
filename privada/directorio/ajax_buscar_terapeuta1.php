<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$id_terapeuta = $_POST["id_terapeuta"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                      FROM terapeutas
                      WHERE id_terapeuta = ? 
                      AND estado <> 'X'                     
                    ");
$rs3 = $db->GetAll($sql3, array($id_terapeuta));

echo"<center>
      <table width='60%' border='1'>
        <tr>                                   
          <th colspan='4'>Datos Terapeuta</th>
        </tr>
    ";
foreach ($rs3 as $k => $fila) { 
    echo"<tr>                                      
            <td align='center'>".$fila["ci"]."</td>
            <td>".$fila["apellidos"]."</td>
            <td>".$fila["nombres"]."</td>
        </tr>";
  }
echo"</table>
    </center>";
?> 