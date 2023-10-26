<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
  
$ci = $_POST["ci"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];



//$db->debug=true;

if($nombres or $apellidos or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM cliente
                          WHERE ci LIKE ? 
                          AND nombres LIKE ? 
                          AND apellidos LIKE ?                     
                        ");
$rs3 = $db->GetAll($sql3, array($ci."%", $nombres."%", $apellidos."%"));

    if($rs3){
        echo"<center>
              <table width='60%' border='1'>
                <tr>                                   
                  <th>C.I.</th><th>NOMBRES</th><th>APELLIDOS</th><th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["nombres"];
                 $str2 = $fila["apellidos"];
            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($nombres, $str1)."</td>
                    <td>".resaltar($apellidos, $str2)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_cliente(".$fila["id_cliente"].")'>
                    </td>
                  </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL CLIENTE NO EXISTE!!</b></center><br>";
        echo"<center>
          <table class='listado'>
          <tr>
            <td><b>(*)CI</b></td>
            <td><input type='text' name='ci1' size='10'></td>
          </tr>
          <tr>
            <td><b>Nombres</b></td>
            <td><input type='text' name='nombres1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>Apellidos</b></td>
            <td><input type='text' name='apellidos1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>(*)Telefono</b></td>
            <td><input type='text' name='telefono1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          
          <tr>
            <td align='center' colspan='2'>
            <input type='button' value='ADICIONAR CLIENTE' onClick='insertar_cliente()' ></td>
          </tr>
        </table>
        </center>
        ";

    }
}
?> 