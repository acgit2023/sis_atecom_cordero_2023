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
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='terapeutas.php'>Listado de Terapeutas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
       echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";

        

/*$sql = $db->Prepare("SELECT *
                     FROM _personas
                     WHERE _estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);*/
 /*  if ($rs) {*/
        echo"<form action='terapeutas_nuevo1.php' method='post' name='formu'>";
        echo"<center>
        <h1>INSERTAR TERAPEUTA</h1>
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
                    <th><b>(*)CI</b></th>
                    <td><input type='text' name='ci' size='10'></td>
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
                      <input type='submit' value='ADICIONAR TERAPEUTA'  >
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>