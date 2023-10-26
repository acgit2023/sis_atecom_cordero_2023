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
       <a  href='convenios_nuevo.php'>Nueva Convenio</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>

      <h1>LISTADO DEL CONVENIO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM convenios
                     WHERE estado <> 'X' 
                     ORDER BY id_convenio DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRE DE LA INSTITUCION</th><th>NOMBRES DE PARTICIPANTES</th><th>APELLIDOS</th><th>C.I</th><th>DIRECCION</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre_institucion']."</td>
                        <td>".$fila['nombres_participantes']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['ci']."</td>
                        <td>".$fila['direccion']."</td>
                        <td>".$fila['telefono']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_convenio"]."' method='post' action='convenios_modificar.php'>
                            <input type='hidden' name='id_convenio' value='".$fila['id_convenio']."'>
                            <a href='javascript:document.formModif".$fila['id_convenio'].".submit();' title='Modificar Convenio Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_convenio"]."' method='post' action='convenios_eliminar.php'>
                            <input type='hidden' name='id_convenio' value='".$fila["id_convenio"]."'>
                            <a href='javascript:document.formElimi".$fila['id_convenio'].".submit();' title='Eliminar Convenio Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar el Convenio ".$fila["nombre_institucion"]." ".$fila["nombres_participantes"]." ".$fila["apellidos"]." ".$fila["ci"]." ".$fila["telefono"]." ?\"))'; location.href='convenios_eliminar.php''> 
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