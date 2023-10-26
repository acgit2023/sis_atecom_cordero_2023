<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_cliente = $_POST["id_cliente"];     
$nro_asiento = $_POST["nro_asiento"];
$monto = $_POST["monto"];

//$db->debug=true;

if($id_cliente or $nro_asiento or $monto){
    $sql3 = $db->Prepare("SELECT CONCAT_WS(' ',c.nombres, c.apellidos) AS cliente,p.*, c.*
                          FROM pasajes p
                          INNER JOIN cliente c ON p.id_cliente =c.id_cliente 
                          WHERE p.nro_asiento LIKE ? 
                          AND p.monto LIKE ? 
                          AND c.id_cliente LIKE ?
                        ");
    $rs3 = $db->GetAll($sql3, array($nro_asiento."%", $monto."%", $id_cliente."%"));
        //$db->debug=true;
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>CLIENTES</th><th>NRO DE ASIENTO</th><th>MONTO</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila['cliente'];
                 $str1 = $fila['nro_asiento'];
                 $str2 = $fila['monto'];
            echo"<tr>
            <td>".resaltar($id_cliente, $str)."</td>
                    <td>".resaltar($nro_asiento, $str1)."</td>
                    <td>".resaltar($monto, $str2)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_pasaje"]."' method='post' action='opcion_modificar.php'>
                        <input type='hidden' name='id_pasaje' value='".$fila['id_pasaje']."'>
                            <a href='javascript:document.formModif".$fila['id_pasaje'].".submit();' title='Modificar Opciones Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_pasaje"]."' method='post' action='opciones_eliminar.php'>
                                <input type='hidden' name='id_pasaje' value='".$fila["id_pasaje"]."'>
                                <input type='hidden' name='id_cliente' value='".$fila["id_pasaje"]."'>
                                <a href='javascript:document.formElimi".$fila['id_pasaje'].".submit();' title='Eliminar Opcion Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la opcion..?))'; location.href='opciones_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> EL PASAJE NO EXISTE!!</b></center><br>";

    }
}
?> 