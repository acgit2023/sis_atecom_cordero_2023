<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$cliente = $_REQUEST["cliente"];
$fecha = DATE("Y-m-d H:i:s");




if ($cliente=="T"){
    $sql = $db->Prepare("SELECT *, CONCAT_WS(' ', cli.Nombre, cli.apellido_paterno, cli.apellido_materno) AS cliente 
                     FROM clientes cli
                     INNER JOIN ventas v  ON v.id_cliente=cli.id_cliente                                                                        
                     ");

    $rs = $db->GetAll($sql);
}else{
    $sql = $db->Prepare("SELECT *, CONCAT_WS(' ', cli.Nombre, cli.apellido_paterno, cli.apellido_materno) AS cliente 
                FROM clientes cli
                INNER JOIN ventas v ON v.id_cliente=cli.id_cliente
                WHERE v.id_venta=?                                                                         
                     ");                 
    $rs = $db->GetAll($sql, array($cliente));
}

$sql1 = $db->Prepare("SELECT *
                        FROM asociacion
                        WHERE id_asociacion = 1
                        AND estado<>'X'
                        ");
    $rs1=$db->GetAll($sql1);
    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];

echo "<html> 
        <head>
            <script type='text/javascript'>
                var ventanaCalendario=false
                function imprimir() {
                    if (confirm(' Desea Imprimir ?')){
                    window.print();
                    }
                }
            </script>
        </head>
        <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

        if($rs){
            echo"<table width='100%' border='0'>
                 <tr>
                    <td><img src='../asociacion/logos/{$logo}' width='30%'></td>
                    <td align='center' width='80%'><h1>REPORTE DE VENTAS CON CLIENTE</h1></td>
                </tr>
            </table>";
        echo"
    <center>             
                <table border='1' cellspacing='0'>
                    <tr>
                        <th>NRO FACTURA</th><th>MONTO FINAL</th><th>FECHA</th><th>CLIENTE</th>
                    </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
                
                <td align='center'>" . $fila['nro_factura'] . "</td>
                <td align='center'>" . $fila['Monto_final'] . "</td>
                <td align='center'>" . $fila['Fecha'] . "</td>
                <td align='center'>" . $fila['cliente'] . "</td>
        </tr>";
        $b++;
    }
    echo"</table></br>";
    echo"<table><br>
                    <b>Fecha :</b>".$fecha."</b></center>";

      
    echo"        
            </center>";
}
echo "</body>
    </html>";
?>
