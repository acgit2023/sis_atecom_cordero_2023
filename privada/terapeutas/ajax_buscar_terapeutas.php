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
    $sql3 = $db->Prepare("SELECT *
                          FROM terapeutas
                          WHERE nombres LIKE ? 
                          AND apellidos LIKE ? 
                          AND ci LIKE ?
                          AND direccion LIKE ? 
                          AND telefono LIKE ?  
                          AND profesion LIKE ?   
                          AND estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($nombres."%", $apellidos."%", $ci."%", $direccion."%", $telefono."%", $profesion."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>
                  <th>C.I.</th><th>NOMBRES</th><th>APELLIDOS</th><th>DIRECCION</th><th>TELEFONO</th><th>PROFESION<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["nombres"];
                 $str2 = $fila["apellidos"];
                 $str3 = $fila["direccion"];
                 $str4 = $fila["telefono"];
                 $str5 = $fila["profesion"];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($nombres, $str1)."</td>
                    <td>".resaltar($apellidos, $str2)."</td>
                    <td>".resaltar($direccion, $str3)."</td>
                    <td>".resaltar($telefono, $str4)."</td>
                    <td>".resaltar($profesion, $str5)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_terapeuta"]."' method='post' action='terapeutas_modificar.php'>
                        <input type='hidden' name='id_terapeuta' value='".$fila['id_terapeuta']."'>
                            <a href='javascript:document.formModif".$fila['id_terapeuta'].".submit();' title='Modificar Terapeuta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_terapeuta"]."' method='post' action='terapeuta_eliminar.php'>
                                <input type='hidden' name='id_terapeuta' value='".$fila["id_terapeuta"]."'>
                                <a href='javascript:document.formElimi".$fila['id_terapeuta'].".submit();' title='Eliminar Terapeuta Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la Terapeuta..?))'; location.href='terapeuta_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA TERAPEUTA NO EXISTE!!</b></center><br>";

    }
}
?> 