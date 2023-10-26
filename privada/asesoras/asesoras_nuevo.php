<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

        

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='asesoras_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR ASESORA</h1>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Apellidos</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  
                  
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Profesion</b></th>
                    <td><input type='text' name='profesion' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR ASESORA'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>