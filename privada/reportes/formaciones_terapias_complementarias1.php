<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

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
    $sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta, fortercom.nombre_formacion, fortercom.lugar, terfor_tecom.* 
                    FROM terapeutas_formaciones_terapias_complementarias terfor_tecom
                    INNER JOIN terapeutas te ON te.id_terapeuta=terfor_tecom.id_terapeuta
                    INNER JOIN formaciones_terapias_complementarias fortercom ON fortercom.id_formacion_terapia_complemen=terfor_tecom.id_formacion_terapia_complemen
                    AND terfor_tecom.estado <> 'X' 
                    AND te.estado <> 'X'
                    AND fortercom.estado <> 'X'                     
                        ");
$rs = $db->GetAll($sql);
    $sql1=$db->Prepare("SELECT *
                        FROM asociacion
                        WHERE id_asociacion=1
                        AND estado<>'x'
                        ");
    $rs1=$db->GetAll($sql1);

    $nombre=$rs1[0]["nombre"];
    $logo=$rs1[0]["logo"];
    $fecha=date("y-m-d H:i:s");
    if($rs){
        echo"<table width='100%' border='0'>
             <tr>
                <td><img src='../asociacion/logos/{$logo}' width='30%'></td>
                <td text-align='center' width='70%'><h1>LISTADO DE TERAPEUTAS CON SUS FORMACIONES</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>
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
?>