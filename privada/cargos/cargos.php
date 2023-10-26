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
       <a  href='cargos_nuevo.php'>Nuevo Cargo</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

         echo"<h1>LISTADO DE CARGOS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM cargos
                     ORDER BY pk_id DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRES DE CARGOS</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["pk_id"]."' method='post' action='cargos_modificar.php'>
                            <input type='hidden' name='pk_id' value='".$fila['pk_id']."'>


                            <a href='javascript:document.formModif".$fila['pk_id'].".submit();' title='Modificar Cargo Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["pk_id"]."' method='post' action='cargos_eliminar.php'>

                            <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
                            
                            <a href='javascript:document.formElimi".$fila['pk_id'].".submit();' title='Eliminar Cargos Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al Cargo ".$fila["nombre"]." ?\"))'; location.href='cargos_eliminar.php''> 
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