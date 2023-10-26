<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
$pk_id= $_POST["pk_id"];    

$nombre = $_POST["nombre"];


if(($nombre!="")){
   $reg = array();
 
   $reg["nombre"] = $nombre;
     
   $rs1 =$db->AutoExecute("cargos",$reg, "UPDATE","pk_id='".$pk_id."'"); 
   header("Location: cargos.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE CARGOS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='cargos.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 