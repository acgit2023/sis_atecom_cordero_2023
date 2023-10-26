
<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");


//$db->debug=true;

$id_paciente=$_POST["id_paciente"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
        
$sql = $db->Prepare("SELECT *
                     FROM paciente
                     WHERE id_paciente= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_paciente));
 /*  if ($rs) {*/

    foreach($rs as $k => $fila){
        echo"<form action='paciente_modificar1.php' method='post' name='formu'>";
        echo"<center>
        <h1>MODIFICAR PACIENTE</h1>

        <table class='listado'>
        <tr>
            <th><b>(*)Lugar</b></th><td><input type='text' name='lugar' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["lugar"]."'>
            </td>
        </tr>
        <tr>
            <th><b>Fecha</b></th>
            <td><input type='date' name='fecha' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["fecha"]."'></td>
        </tr>
        <tr>
            <th><b>(*)Tema</b></th>
            <td><input type='text' name='tema' size='10' value='".$fila["tema"]."'></td>
        </tr>
        <tr>
            <th><b>Nombres</b></th>
            <td><input type='text' name='nombres' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["nombres"]."'>
            </td>
        </tr>
        <tr>
            <th><b>Apellidos</b></th>
            <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["apellidos"]."'>
            </td>                    
        </tr> 
        <tr>
            <th><b>Telefono</b></th><td><input type='text' name='telefono' size='20' value='".$fila["telefono"]."'>
            </td>
        </tr>
    
      <tr>
        <td align='center' colspan='2'>  
          <input type='submit' value='MODIFICAR PACIENTE'  >
          <input type='hidden' name='id_paciente' value='".$fila["id_paciente"]."'>
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