<?php
ob_start();
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html>
      <head>
      </head>
    <body>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta, fortercom.nombre_formacion, fortercom.lugar, terfor_tecom.* 
                    FROM terapeutas_formaciones_terapias_complementarias terfor_tecom
                    INNER JOIN terapeutas te ON te.id_terapeuta=terfor_tecom.id_terapeuta
                    INNER JOIN formaciones_terapias_complementarias fortercom ON fortercom.id_formacion_terapia_complemen=terfor_tecom.id_formacion_terapia_complemen
                    AND terfor_tecom.estado ='A' 
                    AND te.estado ='A'
                    AND fortercom.estado ='A'                    
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
                <td align='center' width='80%'><h1>LISTADO DE TERAPEUTAS CON SUS FORMACIONES</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'width='100%'>
      <tr>
      <th>Nro</th><th>TERAPEUTAS</th><th>NOMBRE DE LA FORMACION</th><th>TIEMPO DE FORMACION</th><th>AÑO DE GRADUACION</th>
    </tr>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
        <td align='center'>".$b."</td>
        <td>".$fila['terapeuta']."</td>                        
        <td>".$fila['nombre_formacion']."</td>
        <td align='center'>".$fila['tiempo_formacion']."</td>
        <td align='center'>".$fila['anio']."</td>
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