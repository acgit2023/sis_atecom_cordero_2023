<?php
session_start();

require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$apellidos = $_POST["apellidos"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];

//$db->debug=true;

if($apellidos or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM terapeutas
                          WHERE apellidos LIKE ? 
                          AND nombres LIKE ?
                          AND ci LIKE ?  
                          AND estado <> 'X'                     
                        ");
$rs3 = $db->GetAll($sql3, array($apellidos."%", $nombres."%", $ci."%"));

    if($rs3){
        echo"<center>
              <table width='60%' border='1'>
                <tr>                                   
                  <th>C.I.</th><th>APELLIDOS</th><th>NOMBRES<th>?</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["apellidos"];
                 $str2 = $fila["nombres"];
            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($apellidos, $str1)."</td>
                    <td>".resaltar($nombres, $str2)."</td>
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='buscar_terapeuta(".$fila["id_terapeuta"].")'>
                    </td>
                  </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA TERAPEUTA NO EXISTE!!</b></center><br>";
        echo"<center>
          <table class='listado'>
          <tr>
            <td><b>(*)CI</b></td>
            <td><input type='text' name='ci1' size='10'></td>
          </tr>
          <tr>
            <td><b>Apellidos</b></td>
            <td><input type='text' name='apellidos1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>(*)Nombres</b></td>
            <td><input type='text' name='nombres1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>Direccion</b></td>
            <td><input type='text' name='direccion1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
          </tr>
          <tr>
            <td><b>Telefono</b></td>
            <td><input type='text' name='telefono1' size='10'></td>
          </tr>
          <tr>
            <td><b>Profesion</b></td>
            <td><input type='text' name='profesion1' size='10'></td>
          </tr>
          <tr>
            <td align='center' colspan='2'>
            <input type='button' value='ADICIONAR TERAPEUTA' onClick='insertar_terapeuta()' ></td>
          </tr>
        </table>
        </center>
        ";

    }
}
?> 