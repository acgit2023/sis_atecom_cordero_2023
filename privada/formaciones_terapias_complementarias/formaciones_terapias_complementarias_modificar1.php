<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
$id_formacion_terapia_complemen= $_POST["id_formacion_terapia_complemen"];    

$nombre_formacion = $_POST["nombre_formacion"];
$lugar = $_POST["lugar"];

if(($nombre_formacion!="") and  ($lugar!="")){
   $reg = array();
   $reg["nombre_formacion"] = $nombre_formacion;
   $reg["lugar"] = $lugar;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("formaciones_terapias_complementarias",$reg, "UPDATE","id_formacion_terapia_complemen='".$id_formacion_terapia_complemen."'"); 
   header("Location: formaciones_terapias_complementarias.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE FORMACIONES TERAPIAS COMPLEMENTARIAS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='formaciones_terapias_complementarias.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 