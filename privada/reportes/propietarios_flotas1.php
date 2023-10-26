<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_flota = $_REQUEST["id_flota"];
$fecha = DATE("Y-m-d H:i:s");

if($id_flota == "T"){
    $sql = $db->Prepare("SELECT pro.nombre,pro.ap,pro.am,pro.ci,pro.telefono,CONCAT_WS (' - ',flo.placa, flo.nro_asientos) AS flota
                    FROM flotas flo
                    INNER JOIN propietarios pro ON flo.id_flota=pro.id_flota 					
                    ");
$rs = $db->GetAll($sql);
}else {
    $sql = $db->Prepare("SELECT pro.nombre,pro.ap,pro.am,pro.ci,pro.telefono,CONCAT_WS (' - ',flo.placa, flo.nro_asientos) AS flota
    FROM flotas flo
    INNER JOIN propietarios pro ON flo.id_flota=pro.id_flota
    WHERE pro.id_flota=?
    ");
    $rs = $db->GetAll($sql, array($id_flota));
}

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
                if(confirm(' Desea imprimir ?')){
                    window.print();
                }
            }
           </script>
           </head>
           <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

            if ($rs){
                echo"<table width='100%' border='0'>
                <tr>
                    <td><img src='../asociacion/logos/{$logo}' width='70%'></td>
                    <td align='center'  width='80%'><h1>REPORTES DE PROPIETARIOS POR FLOTAS</h1></td>
                    </tr>
                    </table>";
                echo"
                <center>
                    <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>NOMBRE</th><th>AP</th><th>AM</th><th>CI</th><th>TELEFONO</th><th>FLOTA</th>
                    </tr>";
                    $b=1;
                    foreach($rs as $k => $fila){
                        echo"<tr>
                            <td aling='center'>".$b."</td>
                            <td>".$fila['nombre']."</td>
                            <td>".$fila['ap']."</td>
                            <td>".$fila['am']."</td>
                            <td>".$fila['ci']."</td>
                            <td>".$fila['telefono']."</td>
                            <td><i>".$fila['flota']."</i></td>
                        </tr>";
                        $b=$b+1;
                    }
                    echo"<table><br>
                    <b>Fecha :</b>".$fecha."</b></center>";

            }
            echo"</body>
            </html>";

?>