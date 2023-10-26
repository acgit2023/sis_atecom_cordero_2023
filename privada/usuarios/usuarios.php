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
       <a  href='usuario_nuevo.php'>Nuevo Usuario</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"<h1>LISTADO DE USUARIOS</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', p.ap, p.am, p.nombres) AS persona, u.* 
                     FROM personas p, usuarios u
                     WHERE p.id_persona = u.id_persona
                     AND p.estado <> 'X' 
                     AND u.estado <> 'X' 
                     ORDER BY u.id_usuario DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PERSONA</th><th>USUARIO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['persona']."</td>                        
                        <td>".$fila['usuario']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_usuario"]."' method='post' action='usuario_modificar.php'>
                            <input type='hidden' name='id_usuario' value='".$fila['id_usuario']."'>
                            <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>

                            <a href='javascript:document.formModif".$fila['id_usuario'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_usuario"]."' method='post' action='usuario_eliminar.php'>
                            <input type='hidden' name='id_usuario' value='".$fila["id_usuario"]."'>
                            <a href='javascript:document.formElimi".$fila['id_usuario'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["usuario"]." ?\"))'; location.href='usuario_eliminar.php''> 
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