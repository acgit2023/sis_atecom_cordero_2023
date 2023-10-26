<?php
session_start();

require_once("../../conexion.php");

       
$experiencia_anos1 = $_POST["experiencia_anos1"];
$salario1 = $_POST["salario1"];
$nombre1 = $_POST["nombre1"];


//$db->debug=true;
if($paterno or $materno or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM cargos_eva
                          WHERE experiencia_anos LIKE ? 
                          AND salario LIKE ? 
                          AND nombre LIKE ?
                          AND estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($experiencia_anos."%", $salario."%", $nombre."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>AÑOS DE EXPERIENCIA</th><th>SALARIOS</th><th>NOMBRES<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["experiencia_anos"];
                 $str1 = $fila["salario"];
                 $str2 = $fila["nombre"];

            echo"<tr>
                    <td align='center'>".resaltar($experiencia_anos, $str)."</td>
                    <td>".resaltar($salario, $str1)."</td>
                    <td>".resaltar($nombre, $str2)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["pk_id"]."' method='post' action='cargos_modificar.php'>
                        <input type='hidden' name='pk_id' value='".$fila['pk_id']."'>
                            <a href='javascript:document.formModif".$fila['pk_id'].".submit();' title='Modificar Directorio Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["pk_id"]."' method='post' action='cargos_eliminar.php'>
                                <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
                                <a href='javascript:document.formElimi".$fila['pk_id'].".submit();' title='Eliminar Cargo del Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar al cargo..?))'; location.href='cargos_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL CARGO NO EXISTE!!</b></center><br>";

    }
}
?> 