<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_propietario = $_REQUEST["id_propietario"];

$sql = $db->Prepare("SELECT pro.*,flo.*,CONCAT_WS (' - ',flo.placa, flo.nro_asientos) AS flota
                     FROM propietarios pro
                     INNER JOIN flotas flo ON flo.id_flota =pro.id_flota 
                     WHERE pro.id_propietario  = ?                     
                  ");
$rs = $db->GetAll($sql, array($id_propietario));

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
                <td align='center' width='80%'><h1>FICHA TECNICA DE PROPIETARIOS POR FLOTAS</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"
            <tr>
              <th align='right'>NOMBRE</th><th>:</th>
              <td><input type='text' name='nombre' value='".$fila['nombre']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>APELLIDO PATERNO</th><th>:</th>
              <td><input type='text' name='ap' value='".$fila['ap']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>APELLIDO MATERNO</th><th>:</th>
              <td><input type='text' name='am' value='".$fila['am']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>TELEFONO</th><th>:</th>
              <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled=''> </td>
            </tr>
            <tr>
               <th align='right'>CI</th><th>:</th>
               <td><input type='text' name='ci' value='".$fila['ci']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>DIRECCION</th><th>:</th>
              <td><input type='text' name='direccion' value='".$fila['direccion']."' disabled=''> </td>
            </tr>
            
            <tr>
             <th align='right'>FLOTA</th><th>:</th>
             <td><input type='text' name='placa' value='".$fila['flota']."' disabled=''> </td>
            </tr> ";  
        echo"</td>
            </tr>
            </table>";
            $b++;   
    }
  }         
    echo"</body>
    </html>";
?>