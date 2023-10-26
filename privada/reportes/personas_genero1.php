<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$genero = $_REQUEST["genero"];
$fecha = date("Y-m-d H:i:s");

if ($genero == "T"){
    $sql=$db->Prepare("SELECT CONCAT_WS('', ap, am, nombres) as persona, if (genero = 'F', 'FEMENINO','MASCULINO') AS genero
                        FROM personas 
                        WHERE estado <> 'X'                  
                    ");
    $rs=$db->GetAll($sql);
} else {
    $sql=$db->Prepare("SELECT CONCAT_WS('', ap, am, nombres) as persona, if (genero = 'F', 'FEMENINO','MASCULINO') AS genero
                        FROM personas 
                        WHERE genero = ?
                        AND estado <> 'X'                  
                    ");
    $rs=$db->GetAll($sql, array($genero));
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
                <td><img src='../asociacion/logos/{$logo}' width='30%'></td>
                <td align='center' width='80%'><h1>REPORTE DE PERSONAS CON GENERO</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>
      <tr>
       <th>Nro</th><th>PERSONAS</th><th>GENERO</th>
    </tr>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
               <td align='center'>".$b."</td>
               <td>".$fila['persona']."</td>
               <td><i>".$fila['genero']."</i></td>
            </tr>";
        $b=$b+1;
    }
    echo"</table><br>
    <b>Fecha: </b>".$fecha."</b></center>";             
    }
    echo"</body>
    </html>";
?>