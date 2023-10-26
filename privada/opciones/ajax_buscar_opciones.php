<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$grupo = $_POST["grupo"];     
$opcion = $_POST["opcion"];
$contenido = $_POST["contenido"];

//$db->debug=true;

if($opcion or $grupo or $contenido ){
    $sql3 = $db->Prepare("SELECT o.*, g.*
                          FROM opciones o
                          INNER JOIN grupos g ON o.id_grupo=g.id_grupo
                          WHERE o.opcion LIKE ? 
                          AND o.contenido LIKE ? 
                          AND g.grupo LIKE ? 
                          AND o.estado <> 'X'
                          AND g.estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($opcion."%", $contenido."%", $grupo."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>GRUPOS</th><th>OPCIONES</th><th>CONTENIDO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['grupo'];
                 $str1 = $fila['opcion'];
                 $str2 = $fila['contenido'];

            echo"<tr>
            <td>".resaltar($grupo, $str)."</td>
                    <td>".resaltar($opcion, $str1)."</td>
                    <td>".resaltar($contenido, $str2)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                        <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                            <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opciones Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_opcion"]."' method='post' action='opciones_eliminar.php'>
                                <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                                <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la opcion..?))'; location.href='opciones_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA OPCION NO EXISTE!!</b></center><br>";

    }
}
?> 