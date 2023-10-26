<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$fk_cargo = $_POST["fk_cargo"];
$pk_id = $_POST["pk_id"];

echo"cargo: $fk_cargo";
echo"persona: $pk_id";

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='persona.php'>Listado de Personas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

         echo"<h1>MODIFICAR PERSONA</h1>";

$sql = $db->Prepare("SELECT * 
                    FROM persona
                    WHERE pk_id=?                   
                    ");
$rs=$db->GetAll($sql, array($pk_id));


$sql1 = $db->Prepare("SELECT *
                     FROM cargos
                     WHERE pk_id=?
                                             
                        ");
$rs1=$db->GetAll($sql1, array($fk_cargo));


$sql2 = $db->Prepare("SELECT *
                     FROM cargos
                     WHERE pk_id <>?
                                             
                        ");
$rs2=$db->GetAll($sql2, array($fk_cargo));


 /*  if ($rs) {*/
        echo"<form action='persona_modificar1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)CARGO</th>
                    <td>
                      <select name='fk_cargo'>";
                        
                        foreach ($rs1 as $k => $fila) {
                            echo"<option value='".$fila['pk_id']."'>".$fila['nombre']."</option>";    
                        }
                        foreach ($rs2 as $k => $fila) {
                            echo"<option value='".$fila['pk_id']."'>".$fila['nombre']."</option>";    
                        }
                        


                echo"</select>
                    </td>
                  </tr>";

                  
                  foreach ($rs as $k => $fila){
                    echo"<tr>
                    <th><b>(*)NOMBRE DE PERSONA</b></th>
                    <td><input type='text' name='nombres' size='10' value='".$fila["nombres"]."'></td>
                    </tr>
                    <tr>
                    <th><b>(*)C.I.</b></th>
                    <td><input type='text' name='ci' size='10' value='".$fila["ci"]."'></td>
                    </tr>
                    <tr>
                    <th><b>TELEFONO</b></th>
                    <td><input type='text' name='telef' size='10' value='".$fila["telef"]."'></td>
                    </tr>

                   

                    <tr>
                        <td align='center' colspan='2'>  
                        <input type='submit' value='MODIFICAR PERSONA'><br>
                        (*)Datos Obligatorios
                        <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
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