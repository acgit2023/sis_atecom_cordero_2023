<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
$id_asesora= $_POST["id_asesora"]; 

$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$telefono = $_POST["telefono"]; 
$formacion = $_POST["formacion"];

   if(($nombres!="") and  ($apellidos!="")){
      $reg = array();
      $reg["id_asociacion"] = 1;
      $reg["nombres"] = $nombres;
      $reg["apellidos"] = $apellidos;
      $reg["telefono"] = $telefono;
      $reg["formacion"] = $formacion;
      $reg["fec_insercion"] = date("Y-m-d H:i:s");
      $reg["estado"] = 'A';
      $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
      $rs1 =$db->AutoExecute("asesoras",$reg, "UPDATE","id_asesora='".$id_asesora."'"); 
      header("Location: asesoras.php");
      exit();

} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA ASESORA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='asesoras.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 