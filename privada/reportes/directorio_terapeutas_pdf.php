<?php
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html>
      <head>
      </head>
      <body>";
$sql = $db->Prepare("SELECT CONCAT_WS(' ', ter.nombres, ter.apellidos) AS terapeuta, dir.*
            FROM terapeutas ter
            INNER JOIN directorio dir ON ter.id_terapeuta = dir.id_terapeuta
            WHERE ter.estado <> 'X' 
            AND dir.estado <> 'X'                    
               ");
$rs = $db->GetAll($sql);
$sql1 = $db->Prepare("SELECT *
                        FROM asociacion
                        WHERE id_asociacion=1
                        AND estado<>'x'
                        
                        ");
$rs1 = $db->GetAll($sql1);

$nombre = $rs1[0]["nombre"];
$logo = $rs1[0]["logo"];
$fecha = date("y-m-d H:i:s");
if ($rs) {
    echo"<table border='0' width='100%'>
             <tr>
                <td><img src='http://".$_SERVER['HTTP_HOST']."/sis_atecom_cordero_2023/privada/asociacion/logos/{$logo}' width='100%'>
                </td>
                <td text-align='center' width='80%'><h1>REPORTE DE DIRECTORIO CON TERAPEUTAS </h1></td>
            </tr>
        </table>";
    echo "
    <center>
      <table border ='1' cellspacing='0'width='100%'>
      <tr>
       <th>Nro</th><th>PERSONAS</th><th>NOMBRE DE USUARIO</th>
    </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
                    <td align='center'>" . $b . "</td>
                    
                    <td>" . $fila['terapeuta'] . "</td>
                    <td>" . $fila['cargos'] . "</td>
                    
                   
                 </tr>";
        $b = $b + 1;
    }
    echo "</table><br>
    <b>Fecha: </b>" . $fecha . "</center>";
}
echo "</body>
    </html>";

    $html=ob_get_clean();
    //echo $html;
    
    require_once("../dompdf/autoload.inc.php");
    use Dompdf\Dompdf;
    $dompdf =new Dompdf();
    
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);
    
    $dompdf->loadHtml($html);
    
    $dompdf->setPaper('letter');
    //$dompdf->setPaper('A4', 'landscape');
    
    $dompdf->render();
    
    $dompdf->stream("archivo.pdf", array("Attachment" => false));

    ?>
