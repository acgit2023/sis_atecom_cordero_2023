<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_terapeuta = $_REQUEST["id_terapeuta"];

$sql = $db->Prepare("SELECT t.*,di.*
                     FROM directorio di
                     INNER JOIN terapeutas t ON di.id_terapeuta=t.id_terapeuta
                     WHERE di.id_terapeuta = ? 
                     AND t.estado <> 'X' 
                     AND di.estado <> 'X'                      
                  ");
$rs = $db->GetAll($sql, array($id_terapeuta));

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
                <td align='center' width='80%'><h1>FICHA TECNICA DE TERAPEUTAS CON CARGO EN EL DIRECTORIO</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"
            <tr>
              <th align='right'>CARGO EN DIRECTORIO</th><th>:</th>
              <td><input type='text' name='cargo' value='".$fila['cargos']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Nombres</th><th>:</th>
              <td><input type='text' name='nombres' value='".$fila['nombres']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Apellidos</th><th>:</th>
              <td><input type='text' name='apellidos' value='".$fila['apellidos']."' disabled=''> </td>
            </tr>
            <tr>
               <th align='right'>CI</th><th>:</th>
               <td><input type='text' name='ci' value='".$fila['ci']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Direccion</th><th>:</th>
              <td><input type='text' name='direccion' value='".$fila['direccion']."' disabled=''> </td>
            </tr>
            <tr>
             <th align='right'>Telefono</th><th>:</th>
             <td><input type='text' name='telefono' value='".$fila['telefono']."' disabled=''> </td>
            </tr>
            <tr>
             <th align='right'>Profesion</th><th>:</th>
             <td><input type='text' name='profesion' value='".$fila['profesion']."' disabled=''> </td>
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