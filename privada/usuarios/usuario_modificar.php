<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_persona = $_POST["id_persona"];
$id_usuario = $_POST["id_usuario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='usuarios.php'>Listado de Usuarios</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

         echo"<h1>MODIFICAR USUARIO</h1>";

$sql = $db->Prepare("SELECT * 
                    FROM usuarios
                    WHERE id_usuario=?
                    AND estado='A'
                    ");
$rs=$db->GetAll($sql, array($id_usuario));


$sql1 = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as persona, id_persona
                     FROM personas
                     WHERE id_persona=?
                     AND estado = 'A'                        
                        ");
$rs1=$db->GetAll($sql1, array($id_persona));


$sql2 = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) as persona, id_persona
                     FROM personas
                     WHERE id_persona <>?
                     AND estado = 'A'                        
                        ");
$rs2=$db->GetAll($sql2, array($id_persona));


 /*  if ($rs) {*/
        echo"<form action='usuario_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Persona</th>
                    <td>
                      <select name='id_persona'>";
                        
                        foreach ($rs1 as $k => $fila) {
                            echo"<option value='".$fila['id_persona']."'>".$fila['persona']."</option>";    
                        }
                        foreach ($rs2 as $k => $fila) {
                            echo"<option value='".$fila['id_persona']."'>".$fila['persona']."</option>";    
                        }
                        


                echo"</select>
                    </td>
                  </tr>";

                  
                  foreach ($rs as $k => $fila){
                    echo"<tr>
                    <th><b>(*)Nombre de usuario</b></th>
                    <td><input type='text' name='usuario' size='10' value='".$fila["usuario"]."'></td>
                    </tr>

                    <tr>
                        <th><b>(*)Clave</b></th>
                        <td><input type='password' name='clave' size='10'></td>
                    </tr>

                    <tr>
                        <td align='center' colspan='2'>  
                        <input type='submit' value='MODIFICAR USUARIO'><br>
                        (*)Datos Obligatorios
                        <input type='hidden' name='id_usuario' value='".$fila["id_usuario"]."'>
                        </td>
                    </tr>";
                    
                  }
                echo"                                                   
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>