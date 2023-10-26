<?php
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
      <head>
      </head>
    <body>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta, pac.nombres, pac.apellidos, ter_pac.* 
                    FROM terapeutas_pacientes ter_pac
                    INNER JOIN terapeutas te ON te.id_terapeuta=ter_pac.id_terapeuta
                    INNER JOIN paciente pac ON pac.id_paciente =ter_pac.id_paciente 
                    AND ter_pac.estado ='A' 
                    AND te.estado ='A'
                    AND pac.estado ='A'                    
                        ");
$rs = $db->GetAll($sql);

    /*$sql=$db->Prepare("SELECT CONCAT_WS('',nombres,ap,am) as persona, usuario 
                                    FROM vista_pers_usu");
                                    $rs = $db->GetAll($sql);*/

    $sql1=$db->Prepare("SELECT *
                        FROM asociacion
                        WHERE id_asociacion=1
                        AND estado<>'x'
                        ");
    $rs1=$db->GetAll($sql1);
    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];
    $fecha=date("Y-m-d H:i:s");
    if($rs){
        echo"<table border='0' width='100%'>
             <tr>
                <td><img src='http://".$_SERVER['HTTP_HOST']."/sis_atecom_cordero_2023/privada/asociacion/logos/{$logo}' width='100%'>
                </td>
                <td align='center' width='80%'><h1>LISTADO DE TERAPEUTAS CON SUS PACIENTES</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'width='100%'>
      <tr>
      <th>Nro</th><th>TERAPEUTAS</th><th>PACIENTES</th><th>FECHA DE ATENCIÓN</th><th>DETALLER</th><th>PRECIO</th>
    </tr>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
        <td align='center'>".$b."</td>
        <td>".$fila['terapeuta']."</td>                        
        <td>".$fila['nombres']."</td>
        <td align='center'>".$fila['fecha_atencion']."</td>
        <td align='center'>".$fila['detalle']."</td>
        <td align='center'>".$fila['precio']."</td>
            </tr>";
        $b=$b+1;
    }
    echo"</table><br>
    <b>Fecha: </b>".$fecha."</center>";             
    }
    echo"</body>
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