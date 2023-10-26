<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
 
$id_cargo=$_POST["pk_id"];
$nombres = $_POST["nombres"];
$ci = $_POST["ci"];
$telef = $_POST["telef"];

//estoy colocando nombres y ci como datos obligatorios porque considero, que son datos que 
// deberian estar presentes en la tabla personas 

if(($id_cargo!="") and ($nombres!="") and ($ci!="") ){

   $reg = array();
   $reg["fk_cargo"] = $id_cargo;
   $reg["nombres"] = $nombres;
   $reg["ci"] = $ci;
   $reg["telef"] = $telef;
   
   $rs1 =$db->AutoExecute("persona", $reg, "INSERT"); 
   header("Location: persona.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA PERSONA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='persona_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 