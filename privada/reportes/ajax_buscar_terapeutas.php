<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$profesion = $_POST["profesion"];

//$db->debug=true;
if($nombres or $apellidos or $ci or $direccion or $telefono or $profesion){
    $sql3 = $db->Prepare("SELECT *,di.id_directorio
                          FROM terapeutas t
                          INNER JOIN directorio di ON di.id_terapeuta=t.id_terapeuta
                          WHERE t.nombres LIKE ? 
                          AND t.apellidos LIKE ? 
                          AND t.ci LIKE ?
                          AND t.direccion LIKE ? 
                          AND t.telefono LIKE ?  
                          AND t.profesion LIKE ?   
                          AND t.estado <> 'X'
                          AND di.estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($nombres."%", $apellidos."%", $ci."%", $direccion."%", $telefono."%", $profesion."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>
                  <th>C.I.</th><th>NOMBRES</th><th>APELLIDOS</th><th>DIRECCION</th><th>TELEFONO</th><th>PROFESION</th><th>CARGO</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["nombres"];
                 $str2 = $fila["apellidos"];
                 $str3 = $fila["direccion"];
                 $str4 = $fila["telefono"];
                 $str5 = $fila["profesion"];
                 $str6 = $fila["cargos"];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($nombres, $str1)."</td>
                    <td>".resaltar($apellidos, $str2)."</td>
                    <td>".resaltar($direccion, $str3)."</td>
                    <td>".resaltar($telefono, $str4)."</td>
                    <td>".resaltar($profesion, $str5)."</td>
                    <td>$str6</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_terapeuta"].") '>                       
                    </td>
                  </tr>";
        }
            echo "</table>
          </center>";
    }else{
        echo"<center><b> LA TERAPEUTA CON CARGO NO EXISTE!!</b></center><br>";
    }
}
?> 