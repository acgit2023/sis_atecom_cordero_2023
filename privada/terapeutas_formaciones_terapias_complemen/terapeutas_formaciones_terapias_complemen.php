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
       <a  href='terapeutas_formaciones_terapias_complemen_nuevo.php'>Nueva Formacion</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>LISTADO DE TERAPEUTAS CON SUS FORMACIONES</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta, fortercom.nombre_formacion, fortercom.lugar, terfor_tecom.* 
                    FROM terapeutas_formaciones_terapias_complementarias terfor_tecom
                    INNER JOIN terapeutas te ON te.id_terapeuta=terfor_tecom.id_terapeuta
                    INNER JOIN formaciones_terapias_complementarias fortercom ON fortercom.id_formacion_terapia_complemen=terfor_tecom.id_formacion_terapia_complemen
                    AND terfor_tecom.estado <> 'X' 
                    AND te.estado <> 'X'
                    AND fortercom.estado <> 'X' 
                    ORDER BY terfor_tecom.id_terapeuta_formacion DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>TERAPEUTAS</th><th>NOMBRE DE LA FORMACION</th><th>TIEMPO DE FORMACION</th><th>AÑO DE GRADUACION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['terapeuta']."</td>                        
                        <td>".$fila['nombre_formacion']."</td>
                        <td align='center'>".$fila['tiempo_formacion']."</td>
                        <td align='center'>".$fila['anio']."</td>
                        
                        <td align='center'>
                          <form name='formModif".$fila["id_terapeuta_formacion"]."' method='post' action='terapeutas_formaciones_terapias_complemen_modificar.php'>
                            <input type='hidden' name='id_terapeuta_formacion' value='".$fila['id_terapeuta_formacion']."'>
                            <input type='hidden' name='id_terapeuta' value='".$fila['id_terapeuta']."'>
                            <input type='hidden' name='id_formacion_terapia_complemen' value='".$fila['id_formacion_terapia_complemen']."'>

                            <a href='javascript:document.formModif".$fila['id_terapeuta_formacion'].".submit();' title='Modificar Detalle de Formacion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_terapeuta_formacion"]."' method='post' action='terapeutas_formaciones_terapias_complemen_eliminar.php'>
                            <input type='hidden' name='id_terapeuta_formacion' value='".$fila["id_terapeuta_formacion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_terapeuta_formacion'].".submit();' title='Eliminar Detalle de Formacion del Sistema' 
                            onclick='javascript:return(confirm(\"Desea realmente Eliminar Detalle de Formacion del Sistema: ".$fila["terapeuta"]." ".$fila["nombre_formacion"]."".$fila["tiempo_formacion"]." ".$fila["anio"]." ?\"))'; location.href='terapeutas_formaciones_terapias_complemen_eliminar.php''> 
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