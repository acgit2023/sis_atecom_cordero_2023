<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_terapeuta = $_POST["id_terapeuta"];
$id_directorio = $_POST["id_directorio"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='directorio.php'>Listado del Directorio</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>

      <h1>MODIFICAR DIRECTORIO</h1>";

$sql = $db->Prepare("SELECT * 
                    FROM directorio
                    WHERE id_directorio=?
                    AND estado='A'
                    ");
$rs=$db->GetAll($sql, array($id_directorio));


$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombres, apellidos) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE id_terapeuta=?
                     AND estado = 'A'                        
                        ");
$rs1=$db->GetAll($sql1, array($id_terapeuta));


$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,nombres, apellidos) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE id_terapeuta <>?
                     AND estado = 'A'                        
                        ");
$rs2=$db->GetAll($sql2, array($id_terapeuta));


 /*  if ($rs) {*/
        echo"<form action='directorio_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Terapeuta</th>
                    <td>
                      <select name='id_terapeuta'>";
                        
                        foreach ($rs1 as $k => $fila) {
                            echo"<option value='".$fila['id_terapeuta']."'>".$fila['terapeuta']."</option>";    
                        }
                        foreach ($rs2 as $k => $fila) {
                            echo"<option value='".$fila['id_terapeuta']."'>".$fila['terapeuta']."</option>";    
                        }
                        


                echo"</select>
                    </td>
                  </tr>";

                  
                  foreach ($rs as $k => $fila){
                    echo"<tr>
                    <th><b>(*)Nombre de Cargo</b></th>
                    <td><input type='text' name='cargos' size='10' value='".$fila["cargos"]."'></td>
                    </tr>

                    <tr>
                        <th><b>(*)Fecha Inicio</b></th>
                        <td><input type='date' name='fecha_inicio' size='10'></td>
                    </tr>

                    <tr>
                        <th><b>(*)Fecha Final</b></th>
                        <td><input type='date' name='fecha_final' size='10'></td>
                    </tr>

                    <tr>
                        <td align='center' colspan='2'>  
                        <input type='submit' value='MODIFICAR DIRECTORIO'><br>
                        (*)Datos Obligatorios
                        <input type='hidden' name='id_directorio' value='".$fila["id_directorio"]."'>
                        </td>
                    </tr>";
                    
                  }
                echo"                                                   
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>