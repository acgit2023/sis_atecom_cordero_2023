<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$paterno = $_POST["paterno"];
$materno = $_POST["materno"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

//$db->debug=true;
if($paterno or $materno or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM personas
                          WHERE ap LIKE ? 
                          AND am LIKE ? 
                          AND nombres LIKE ?
                          AND ci LIKE ?  
                          AND estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($paterno."%", $materno."%", $nombres."%", $ci."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["ap"];
                 $str2 = $fila["am"];
                 $str3 = $fila["nombres"];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($paterno, $str1)."</td>
                    <td>".resaltar($materno, $str2)."</td>
                    <td>".resaltar($nombres, $str3)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_persona"].") '>                       
                    </td>
                  </tr>";
        }
            echo "</table>
          </center>";
    }else{
        echo"<center><b> LA PERSONA NO EXISTE!!</b></center><br>";
    }
}
?> 