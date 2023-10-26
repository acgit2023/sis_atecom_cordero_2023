<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_opcion.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>OPCIONES</h1>";   
       $sql = $db->Prepare("SELECT CONCAT_WS(' ',g.grupo) AS grupo,o.opcion,o.contenido,o.id_opcion,g.id_grupo,o.usuario
       FROM grupos g, opciones o
       WHERE g.id_grupo = o.id_opcion
       AND g.estado <> 'X' 
       AND o.estado <> 'X'                   
   ");  
   $rs = $db->GetAll($sql);
echo"
<!------INICIO BUSCADOR---------------->
    <center>
     <form action='#'' method='post' name='formu'>
     <table border='1' class='listado'>
    <tr>
    <th>
     <b>Grupo</b><br />
    <select name='grupo' onChange='buscar_opcion()'>
     <option value=''>--Seleccione--</option>
     <option value='HERRAMIENTAS'>HERRAMIENTAS</option>
     <option value='PARAMETROS'>PARAMETROS</option>
     <option value='ATECOM-BOLIVIA'>ATECOM-BOLIVIA</option>
     <option value='REPORTES'>REPORTES</option>
     <option value='EVA PRIMER BIMESTRE-DWII'>EVA PRIMER BIMESTRE-DWII</option>
     <option value='SEGUNDO BIMESTRE-DWII'>SEGUNDO BIMESTRE-DWII</option>
     <option value='SEGUNDO BIMESTRE-BDII'>SEGUNDO BIMESTRE-BDII</option>           
</select>
</th> 
        <th>
          <b>Opcion</b><br />
          <input type='text' name='opcion' value='' size='10' onKeyUp='buscar_opcion()'>
        </th>
        <th>
          <b>Contenido</b><br />
          <input type='text' name='contenido' value='' size='10' onKeyUp='buscar_opcion()'>
        </th>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='opciones1'> ";

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>NRO</th><th>GRUPOS</th><th>OPCIONES</th><th>CONTENIDO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['grupo']."</td>
                        <td>".$fila['opcion']."</td>
                        <td>".$fila['contenido']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_opcion"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila['id_opcion']."'>
                            <input type='hidden' name='id_grupo' value='".$fila['id_opcion']."'>
                            <a href='javascript:document.formModif".$fila['id_opcion'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_opcion"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_opcion' value='".$fila["id_opcion"]."'>
                            <a href='javascript:document.formElimi".$fila['id_opcion'].".submit();' 
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