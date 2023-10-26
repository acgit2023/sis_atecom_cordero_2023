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
       <a  href='terapeutas_formaciones_terapias_complemen.php'>Listado de Formaciones</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>INSERTAR TERAPEUTAS CON SUS FORMACIONES</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,apellidos, nombres) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);

$sql1 = $db->Prepare("SELECT nombre_formacion AS formacion, id_formacion_terapia_complemen AS id_formacion
                     FROM formaciones_terapias_complementarias
                     WHERE estado <> 'X'                        
                        ");
$rs1 = $db->GetAll($sql1);

$sql2 = $db->Prepare("SELECT tiempo_formacion, año
                     FROM terapeutas_formaciones_terapias_complementarias
                     WHERE estado <> 'X'                        
                        ");
$rs2 = $db->GetAll($sql2);

 /*  if ($rs) {*/
        echo"<form action='terapeutas_formaciones_terapias_complemen_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)TERAPEUTAS</th>
                    <td>
                        <select name='id_terapeuta'>
                            <option value=''>--Seleccione--</option>";
                            foreach ($rs as $k => $fila) {
                            echo"<option value='".$fila['id_terapeuta']."'>".$fila['terapeuta']."</option>";  
                            }
                    echo"
                    </td>
                  </tr>
                  <tr>
                    <th>(*)NOMBRE DE FORMACION</th>
                    <td>
                        <select name='id_formacion'>
                            <option value=''>--Seleccione--</option>";
                            foreach ($rs1 as $k => $fila) {
                            echo"<option value='".$fila['id_formacion']."'>".$fila['formacion']."</option>";  
                            }
                    echo"
                    </td>
                  </tr>";
            
            echo"
                  <tr>
                    <th><b>(*)TIEMPO DE FORMACION</b></th>
                    <td><input type='text' name='tiempo_formacion' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)AÑO DE GRADUACION</b></th>
                    <td><input type='date' name='anio' size='10'></td>
                  </tr>                               
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR NOMBRE DE LA FORMACION'><br>
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