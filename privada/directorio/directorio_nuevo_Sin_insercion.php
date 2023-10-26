<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

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
      
       <h1>INSERTAR DIRECTORIO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombres, apellidos) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='directorio_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Terapeuta</th>
                    <td>
                      <select name='id_terapeuta'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_terapeuta']."'>".$fila['terapeuta']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)Nombre de cargo</b></th>
                    <td><input type='text' name='cargos' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha_Inicio</b></th>
                    <td><input type='date' name='fecha_inicio' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha_Final</b></th>
                    <td><input type='date' name='fecha_final' size='10'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR DIRECTORIO'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>