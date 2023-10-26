<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$placa = $_POST["placa"];
$nombre = $_POST["nombre"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$direccion = $_POST["direccion"];

//$db->debug=true;
if($placa or $nombre or $ap or $am or $direccion){
    $sql3 = $db->Prepare("SELECT flo.*,pro.*
                          FROM flotas flo
                          INNER JOIN propietarios pro ON flo.id_flota=pro.id_flota
                          WHERE flo.placa LIKE ?
                          AND pro.nombre LIKE ?
                          AND pro.ap LIKE ?
                          AND pro.am LIKE ?
                          AND pro.direccion LIKE ?
                        ");
        $rs3 = $db->GetAll($sql3, array($placa."%", $nombre."%", $ap."%", $am."%", $direccion."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>
                  <th>PLACA</th><th>NOMBRE</th><th>APELLIDO PATERNO</th><th>APELLIDO MATERNO</th><th>DIRECCION</th><th>SELECCIONE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["placa"];
                 $str1 = $fila["nombre"];
                 $str2 = $fila["ap"];
                 $str3 = $fila["am"];
                 $str4 = $fila["direccion"];

            echo"<tr>
                    <td align='center'>".resaltar($placa, $str)."</td>
                    <td>".resaltar($nombre, $str1)."</td>
                    <td>".resaltar($ap, $str2)."</td>
                    <td>".resaltar($am, $str3)."</td>
                    <td>".resaltar($direccion, $str4)."</td>
                    
                   
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_propietario"].") '>                       
                    </td>
                  </tr>";
        }
            echo "</table>
          </center>";
    }else{
        echo"<center><b> EL PROPIETARIO NO EXISTE!!</b></center><br>";
    }
}
?> 