
<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_convenio=$_POST["id_convenio"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='convenios.php'>Listado de Convenios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>

      <h1>MODIFICAR CONVENIO</h1>";

$sql = $db->Prepare("SELECT *
                     FROM convenios
                     WHERE id_convenio= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_convenio));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='convenios_modificar1.php' method='post' name='formu'>";
        echo"<center>
            <table class='listado'>
                <tr>
                    <th><b>(*)Nombre Institucion</b></th>
                    <td><input type='text' name='nombre_institucion' size='10' value='".$fila["nombre_institucion"]."'></td>
                </tr>

                <tr>
                    <th><b>Nombres Participantes</b></th>
                    <td><input type='text' name='nombres_participantes' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombres_participantes"]."'></td>
                </tr>

                <tr>
                    <th><b>Apellidos</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["apellidos"]."'>
                    </td>                    
                </tr>               

              <tr>
                <th><b>(*)C.I.</b></th>
                <td><input type='text' name='ci' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["ci"]."'></td>
              </tr>

              <tr>
                <th><b>Dirección</b></th>
                <td><input type='text' name='direccion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'></td>
              </tr>

              <tr>
                <th><b>Telefono</b></th><td><input type='text' name='telefono' size='20' value='".$fila["telefono"]."'></td>
              </tr>
            
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR CONVENIO'  >
                  <input type='hidden' name='id_convenio' value='".$fila["id_convenio"]."'>
                </td>
              </tr>

            </table>
            </center>";
      echo"</form>" ;     
        /*}*/                


    }
                                       
echo "</body>
      </html> ";

 ?>