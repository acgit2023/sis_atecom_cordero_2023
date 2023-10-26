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
       <a  href='terapeutas_pacientes_nuevo.php'>Nueva Atencion</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>LISTADO DE TERAPEUTAS CON SUS PACIENTES</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta,CONCAT_WS(' ', pa.apellidos, pa.nombres) AS paciente, tepa.* 
                    FROM terapeutas_pacientes tepa
                    INNER JOIN terapeutas te ON te.id_terapeuta=tepa.id_terapeuta
                    INNER JOIN paciente pa ON pa.id_paciente=tepa.id_paciente
                    AND tepa.estado <> 'X' 
                    AND te.estado <> 'X'
                    AND pa.estado <> 'X' 
                    ORDER BY tepa.id_terapeuta_paciente DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>TERAPEUTAS</th><th>PACIENTES</th><th>DETALLE DE CONSULTA</th><th>PRECIO DE ATENCION</th><th>FECHA DE ATENCION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['terapeuta']."</td>                        
                        <td>".$fila['paciente']."</td>
                        <td >".$fila['detalle']."</td>
                        <td align='center'>".$fila['precio']."</td>
                        <td >".$fila['fecha_atencion']."</td>
                        
                        <td align='center'>
                          <form name='formModif".$fila["id_terapeuta_paciente"]."' method='post' action='terapeutas_pacientes_modificar.php'>
                            <input type='hidden' name='id_terapeuta_paciente' value='".$fila['id_terapeuta_paciente']."'>
                            <input type='hidden' name='id_terapeuta' value='".$fila['id_terapeuta']."'>
                            <input type='hidden' name='id_paciente' value='".$fila['id_paciente']."'>

                            <a href='javascript:document.formModif".$fila['id_terapeuta_paciente'].".submit();' title='Modificar Detalle de Atencion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_terapeuta_paciente"]."' method='post' action='terapeutas_pacientes_eliminar.php'>
                            <input type='hidden' name='id_terapeuta_paciente' value='".$fila["id_terapeuta_paciente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_terapeuta_paciente'].".submit();' title='Eliminar Detalle de Atencion del Sistema' 
                            onclick='javascript:return(confirm(\"Desea realmente Eliminar Detalle de Atencion del Sistema: ".$fila["detalle"]." DE LA FECHA ".$fila["fecha_atencion"]." ?\"))'; location.href='terapeutas_pacientes_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>