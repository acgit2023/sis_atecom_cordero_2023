<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombres, apellidos) AS cliente, id_cliente 
                     FROM cliente                    
                        ");
            $rs = $db->GetAll($sql);

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_pasaje.js'> </script>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='pasajes_nuevo.php'>Nueva Pasaje</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

       echo"<h1>PASAJES</h1>"; 

$sql = $db->Prepare("SELECT CONCAT_WS(' ',c.nombres, c.apellidos) AS cliente,p.*,c.*
       FROM cliente c, pasajes p
       WHERE c.id_cliente = p.id_cliente                   
    ");  
$rs = $db->GetAll($sql);  
echo"
     <!------INICIO BUSCADOR---------------->
<center>
  <form name='formu' method='post' action='#'>
    <table border='1' class='listado'>
      <tr>
        <th>
         <b>Cliente</b><br />
        <select name='id_cliente' onChange='buscar_pasaje()'>
        <option value=''>--Seleccione--</option> oncli";      
              foreach ($rs as $fila) {
                echo "<option value='" . $fila['id_cliente'] . "'>" . $fila['cliente'] . "</option>";
              }     
echo"</select></th> 
        <th>
          <b>Nro de Asiento</b><br />
          <input type='text' name='nro_asiento' value='' size='10' onKeyUp='buscar_pasaje()'>
        </th>
        <th>
          <b>Monto</b><br />
          <input type='text' name='monto' value='' size='10' onKeyUp='buscar_pasaje()'>
        </th>
      </tr>
    </table>
  </form>
</center>
<!------FIN BUSCADOR---------------->";

echo"<div id='pasaje1'> ";

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                <th>NRO</th><th>CLIENTES</th><th>NRO DE ASIENTO</th><th>MONTO</th><th>FECHA DE VIAJE</th><th>HORA DE SALIDA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                <td align='center'>".$b."</td>
                        <td align='center'>".$fila['cliente']."</td>
                        <td>".$fila['nro_asiento']."</td>
                        <td>".$fila['monto']."</td>
                        <td>".$fila['fecha_viaje']."</td>
                        <td>".$fila['hra_salida']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_pasaje"]."' method='post' action='opcion_modificar.php'>
                            <input type='hidden' name='id_pasaje' value='".$fila['id_pasaje']."'>
                            
                            <a href='javascript:document.formModif".$fila['id_pasaje'].".submit();' title='Modificar Opcion Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_pasaje"]."' method='post' action='opcion_eliminar.php'>
                            <input type='hidden' name='id_pasaje' value='".$fila["id_pasaje"]."'>
                            <a href='javascript:document.formElimi".$fila['id_pasaje'].".submit();' 
                            title='Eliminar opcion Sistema'
                             onclick='javascript:return(confirm(\"Desea realmente Eliminar al opcion ".$fila["id_pasaje"]." ?\"))'; 
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