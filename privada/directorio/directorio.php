<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,apellidos, nombres) AS terapeuta, id_terapeuta 
                     FROM terapeutas
                     WHERE estado <> 'X'                      
                        ");
            $rs = $db->GetAll($sql);

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_directorio.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='directorio_nuevo.php'>Nueva Directorio</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>DIRECTORIO</h1>"; 

$sql = $db->Prepare("SELECT CONCAT_WS(' ',t.nombres, t.apellidos) AS terapeuta,d.*,t.*
       FROM terapeutas t, directorio d
       WHERE t.id_terapeuta = d.id_terapeuta 
       AND t.estado <> 'X' 
       AND d.estado <> 'X'                   
    ");  
$rs = $db->GetAll($sql);  
echo"
     <!------INICIO BUSCADOR---------------->
<center>
  <form name='formu' method='post' action='#'>
    <table border='1' class='listado'>
      <tr>
        <th>
         <b>Terapeuta</b><br />
        <select name='id_terapeuta' onChange='buscar_directorio()'>
        <option value=''>--Seleccione--</option> oncli";      
              foreach ($rs as $fila) {
                echo "<option value='" . $fila['id_terapeuta'] . "'>" . $fila['terapeuta'] . "</option>";
              }     
echo"</select></th> 
        <th>
          <b>Cargos</b><br />
          <input type='text' name='cargos' value='' size='10' onKeyUp='buscar_directorio()'>
        </th>
      </tr>
    </table>
  </form>
</center>
<!------FIN BUSCADOR---------------->";

echo"<div id='directorio1'> ";

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>NRO</th><th>TERAPEUTAS</th><th>CARGOS</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['terapeuta']."</td>
                        <td>".$fila['cargos']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_directorio"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_directorio' value='".$fila['id_directorio']."'>
                            <input type='hidden' name='id_terapeuta' value='".$fila['id_directorio']."'>
                            <a href='javascript:document.formModif".$fila['id_directorio'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_directorio"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_directorio' value='".$fila["id_directorio"]."'>
                            <a href='javascript:document.formElimi".$fila['id_directorio'].".submit();' 
                            title='Eliminar opcion Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al opcion ".$fila["usuario"]." ?\"))'; 
                             location.href=='opcion_eliminar.php''> 
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
echo"</div>";
echo "</body>
      </html> ";

 ?>