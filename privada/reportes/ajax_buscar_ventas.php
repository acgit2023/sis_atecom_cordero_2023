<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");
       
$nro_factura = $_POST["nro_factura"];
$Monto_final = $_POST["Monto_final"];
$Fecha = $_POST["Fecha"];

//$db->debug=true;
if($nro_factura or $Monto_final or $Fecha){
    $sql3 = $db->Prepare("SELECT *, CONCAT_WS(' ', cli.Nombre, cli.apellido_paterno, cli.apellido_materno) AS cliente
                          FROM ventas v
                          INNER JOIN clientes cli ON cli.id_cliente=v.id_cliente
                          WHERE v.nro_factura LIKE ? 
                          AND v.Monto_final LIKE ? 
                          AND v.Fecha LIKE ?                    
                        ");
        $rs3 = $db->GetAll($sql3, array($nro_factura."%", $Monto_final."%", $Fecha."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>
                  <th>NRO DE FACTURA</th><th>MONTO FINAL</th><th>FECHA</th><th>CLIENTE</th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["nro_factura"];
                 $str1 = $fila["Monto_final"];
                 $str2 = $fila["Fecha"];
                 $str3 = $fila["cliente"];

            echo"<tr>
                    <td align='center'>".resaltar($nro_factura, $str)."</td>
                    <td>".resaltar($Monto_final, $str1)."</td>
                    <td>".resaltar($Fecha, $str2)."</td>
                    
                   
                    <td align='center'>
                      <input type='radio' name='opcion' value='' onClick='mostrar(".$fila["id_venta"].") '>                       
                    </td>
                  </tr>";
        }
            echo "</table>
          </center>";
    }else{
        echo"<center><b> LA VENTA NO EXISTE!!</b></center><br>";
    }
}
?> 