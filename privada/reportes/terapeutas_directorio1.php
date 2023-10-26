<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$cargos = $_REQUEST["cargos"];
$fecha = DATE("Y-m-d H:i:s");

if ($cargos=="T"){

    $sql = $db->Prepare("SELECT CONCAT_WS(' ', ter.nombres, ter.apellidos) AS terapeuta, dir.cargos
            FROM terapeutas ter
            INNER JOIN directorio dir ON ter.id_terapeuta = dir.id_terapeuta
            WHERE ter.estado <> 'X' 
            AND dir.estado <> 'X'                       
               ");
$rs = $db->GetAll($sql);
}else {
    $sql = $db->Prepare("SELECT CONCAT_WS(' ', ter.nombres, ter.apellidos) AS terapeuta, dir.cargos
            FROM terapeutas ter
            INNER JOIN directorio dir ON ter.id_terapeuta = dir.id_terapeuta
            WHERE dir.id_directorio = ?
            AND ter.estado <> 'X' 
            AND dir.estado <> 'X'                       
               ");
$rs = $db->GetAll($sql, array($cargos));
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
                    <td align='center' width='80%'><h1>REPORTE DE TERAPEUTAS CON CARGO EN EL DIRECTORIO</h1></td>
                </tr>
            </table>";
        echo"
    <center>             
                <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>TERAPEUTAS</th><th>CARGO DEL DIRECTORIO</th>
                    </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
        <td align='center'>".$b."</td>
        <td>".$fila['terapeuta']."</td>
        <td><i>".$fila['cargos']."</i></td>
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
