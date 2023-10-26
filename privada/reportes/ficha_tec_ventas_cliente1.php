<?php
session_start();
require_once("../../conexion.php");


//$db->debug=true;

$id_venta = $_REQUEST["id_venta"];


$sql = $db->Prepare("SELECT *, CONCAT_WS(' ', cli.Nombre, cli.apellido_paterno, cli.apellido_materno) AS cliente 
                     FROM ventas v
                     INNER JOIN clientes cli ON cli.id_cliente=v.id_cliente
                     WHERE v.id_venta = ?                     
                  ");
$rs = $db->GetAll($sql, array($id_venta));

$sql1 = $db->Prepare("SELECT *
                        FROM asociacion
                        WHERE id_asociacion = 1
                        AND estado<>'X'
                        ");
    $rs1=$db->GetAll($sql1);
    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];

    echo"<html>
      <head>
          <script type='text/javascript'>
          var ventanaCalendario=false
          function imprimir(){
            if(confirm(' Desea Imprimir ?')){
                window.print();
            }
        }
        </script>
    </head>
    <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

    if($rs){
        echo"<table width='100%' border='0'>
             <tr>
                <td><img src='../asociacion/logos/{$logo}' width='70%'></td>
                <td align='center' width='80%'><h1>FICHA TECNICA DE VENTAS</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"
            <tr>
              <th align='right'>CLIENTES</th><th>:</th>
              <td><input type='text' name='cliente' value='".$fila['cliente']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Nro Factura</th><th>:</th>
              <td><input type='text' name='nro_factura' value='".$fila['nro_factura']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Monto Final</th><th>:</th>
              <td><input type='text' name='Monto_final' value='".$fila['Monto_final']."' disabled=''> </td>
            </tr>
            <tr>
               <th align='right'>Fecha</th><th>:</th>
               <td><input type='text' name='Fecha' value='".$fila['Fecha']."' disabled=''> </td>
            </tr>";  
        echo"</td>
            </tr>
            </table>";
            $b++;   
    }
  }         
    echo"</body>
    </html>";
?>