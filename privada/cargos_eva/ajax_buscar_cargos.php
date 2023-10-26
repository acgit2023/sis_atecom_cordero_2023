<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$experiencia_anos = $_POST["experiencia_anos"];
$salario = $_POST["salario"];
$nombre = $_POST["nombre"];


$db->debug=true;
if($experiencia_anos or $salario or $nombre){
    $sql3 = $db->Prepare("SELECT *
                          FROM cargos_eva
                          WHERE experiencia_anos LIKE ? 
                          AND salario LIKE ? 
                          AND nombre LIKE ? 
                                          
                        ");
        $rs3 = $db->GetAll($sql3, array($experiencia_anos."%", $salario."%", $nombre."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>AÑOS DE EXPERIENCIA</th><th>SALARIO</th><th>NOMBRES<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
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
                            <a href='javascript:document.formModif".$fila['pk_id'].".submit();' title='Modificar Cargo Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["pk_id"]."' method='post' action='cargos_eliminar.php'>
                                <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
                                <a href='javascript:document.formElimi".$fila['pk_id'].".submit();' title='Eliminar Cargo Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar al Cargo..?))'; location.href='cargos_eliminar.php''>
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