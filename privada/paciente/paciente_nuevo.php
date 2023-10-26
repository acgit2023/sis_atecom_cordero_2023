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
       <p> &nbsp;</p>";
        echo"<form action='paciente_nuevo.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR PACIENTE</h1>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Lugar</b></th>
                    <td><input type='text' name='lugar' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Fecha</b></th>
                    <td><input type='text' name='fecha' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>Tema</b></th>
                    <td><input type='text' name='tema' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>                    
                  </tr>
                  <tr>
                    <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Apellidos</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10'></td>
                  </tr>
                
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PACIENTE'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>