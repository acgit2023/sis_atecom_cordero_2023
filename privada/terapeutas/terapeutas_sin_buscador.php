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
       <a  href='terapeutas_nuevo.php'>Nueva Terapeuta</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

         echo"<h1>LISTADO DE TERAPEUTAS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM terapeutas
                     WHERE estado <> 'X' 
                     ORDER BY id_terapeuta DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRES</th><th>APELLIDOS</th><th>C.I.</th><th>DIRECCION</th><th>TELEFONO</th><th>PROFESION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombres']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['ci']."</td>
                        <td>".$fila['direccion']."</td>
                        <td>".$fila['telefono']."</td>
                        <td>".$fila['profesion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_terapeuta"]."' method='post' action='terapeutas_modificar.php'>
                            <input type='hidden' name='id_terapeuta' value='".$fila['id_terapeuta']."'>


                            <a href='javascript:document.formModif".$fila['id_terapeuta'].".submit();' title='Modificar Terapeuta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_terapeuta"]."' method='post' action='terapeuta_eliminar.php'>
                            <input type='hidden' name='id_terapeuta' value='".$fila["id_terapeuta"]."'>
                            <input type='hidden' name='id_terapeuta' value='".$fila["id_terapeuta"]."'>
                            <a href='javascript:document.formElimi".$fila['id_terapeuta'].".submit();' title='Eliminar Terapeuta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Terapeuta ".$fila["nombres"]." ".$fila["apellidos"]." ".$fila["ci"]." ".$fila["direccion"]." ".$fila["telefono"]." ".$fila["profesion"]." ?\"))'; location.href='terapeuta_eliminar.php''> 
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