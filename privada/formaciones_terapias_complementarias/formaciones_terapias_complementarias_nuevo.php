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
        echo"<form action='formaciones_terapias_complementarias_nuevo.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR FORMACION DE TERAPIA COMPLEMENTARIA </h1>
                <table class='listado'>
                  <tr>
                    <th><b>(*)Nombre Formacion</b></th>
                    <td><input type='text' name='nombre_formacion' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>Lugar</b></th>
                    <td><input type='text' name='lugar' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>        
                
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR FORMACION TERAPIA COMPLEMENTARIA'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>