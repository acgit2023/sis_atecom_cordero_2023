<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$_id_persona = $_REQUEST["id_persona"];

$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE id_persona = ? 
                     AND estado <> 'X'    

                  ");
$rs = $db->GetAll($sql, array($_id_persona));

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
                <td align='center' width='80%'><h1>FICHA TECNICA DE PERSONAS</h1></td>
            </tr>
        </table>";
    echo"
    <center>
     <table border ='1' cellspacing='0'>";
    $b=1;
    foreach($rs as $k=>$fila){
        echo"<tr>
               <th align='right'>CI</th><th>:</th>
               <td><input type='text' name='ci' value='".$fila['ci']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Nombres</th><th>:</th>
              <td><input type='text' name='nombres' value='".$fila['nombres']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Apellido Paterno</th><th>:</th>
              <td><input type='text' name='ap' value='".$fila['ap']."' disabled=''> </td>
            </tr>
            <tr>
              <th align='right'>Apellido Materno</th><th>:</th>
              <td><input type='text' name='am' value='".$fila['am']."' disabled=''> </td>
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
             <th align='right'>Genero</th> <th>:</th>
             <td> ";
            if (($fila['genero'])== 'F'){
              echo"<input type='text' name='genero' value='FEMENINO' disabled=''>";
            }else{
              echo"<input type='text' name='genero' value='MASCULINO' disabled=''>";
            }
        echo"</td>
            </tr>
            </table>";
            $b=$b+1;   
    }
  }         
    echo"</body>
    </html>";
?>