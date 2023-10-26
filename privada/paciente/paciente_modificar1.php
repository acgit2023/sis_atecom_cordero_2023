<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
     
$id_paciente= $_POST["id_paciente"];    

$lugar = $_POST["lugar"];
$fecha = $_POST["fecha"];
$tema = $_POST["tema"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$telefono = $_POST["telefono"];


if(($lugar!="") and  ($fecha!="")){
   $reg = array();
 
   $reg["lugar"] = $lugar;
   $reg["fecha"] = $fecha;
   $reg["tema"] = $tema;
   $reg["nombres"] = $nombres;
   $reg["apellidos"] = $apellidos;
   $reg["telefono"] = $telefono;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("paciente",$reg, "UPDATE","id_paciente='".$id_paciente."'"); 
   header("Location: paciente.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL PACIENTE";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='paciente.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 