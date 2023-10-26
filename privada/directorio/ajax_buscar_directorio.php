<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_terapeuta = $_POST["id_terapeuta"];     
$cargos = $_POST["cargos"];

//$db->debug=true;

if($id_terapeuta or $cargos){
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ',t.nombres, t.apellidos) AS terapeuta,d.*, t.*
                          FROM directorio d
                          INNER JOIN terapeutas t ON d.id_terapeuta =t.id_terapeuta 
                          WHERE d.cargos LIKE ? 
                          AND t.id_terapeuta LIKE ?
                          AND d.estado <> 'X'
                          AND t.estado <> 'X'                     
                        ");
    $rs3 = $db->GetAll($sql3, array($cargos."%", $id_terapeuta."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>TERAPEUTAS</th><th>CARGOS</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['terapeuta'];
                 $str1 = $fila['cargos'];
            echo"<tr>
            <td>".resaltar($id_terapeuta, $str)."</td>
                    <td>".resaltar($cargos, $str1)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_directorio"]."' method='post' action='opcion_modificar.php'>
                        <input type='hidden' name='id_directorio' value='".$fila['id_directorio']."'>
                            <a href='javascript:document.formModif".$fila['id_directorio'].".submit();' title='Modificar Opciones Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_directorio"]."' method='post' action='opciones_eliminar.php'>
                                <input type='hidden' name='id_directorio' value='".$fila["id_directorio"]."'>
                                <a href='javascript:document.formElimi".$fila['id_directorio'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la opcion..?))'; location.href='opciones_eliminar.php''>
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