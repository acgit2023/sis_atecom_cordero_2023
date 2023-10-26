<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
$pk_id = $_POST["pk_id"];
$id_cargo=$_POST["fk_cargo"];


$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$telef = $_POST["telef"];


if(($id_cargo!="") and ($nombres!="") and  ($ci!="")){
   $reg = array();
   $reg["fk_cargo"] = $id_cargo;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["telef"] = $telef;
   
 
   $rs1 =$db->AutoExecute("persona",$reg, "UPDATE","pk_id='".$pk_id."'"); 
   header("Location: persona.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='persona.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 