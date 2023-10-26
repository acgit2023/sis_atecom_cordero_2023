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
       <a  href='terapeutas_pacientes.php'>Listado de Atenciones</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>INSERTAR DETALLES DE LA ATENCION</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,apellidos, nombres) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,apellidos, nombres) as pacientes, id_paciente
                     FROM paciente
                     WHERE estado <> 'X'                        
                        ");
$rs1 = $db->GetAll($sql1);

 /*  if ($rs) {*/
        echo"<form action='terapeutas_pacientes_nuevo1.php' method='post' name='formu'>";
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
                    <th>(*)PACIENTES</th>
                    <td>          
                        </select>
                        
                        <select name='id_paciente'>
                            <option value=''>--Seleccione--</option>";
                            foreach ($rs1 as $k => $fila) {
                            echo"<option value='".$fila['id_paciente']."'>".$fila['pacientes']."</option>";    
                        } 

                echo"   </select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)DETALLE</b></th>
                    <td><input type='text' name='detalle' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)PRECIO</b></th>
                    <td><input type='number' name='precio' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)FECHA</b></th>
                    <td><input type='date' name='fecha_atencion' size='10'></td>
                  </tr>
                  
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR DETALLE DE ATENCION'><br>
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