<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       

$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$profesion = $_POST["profesion"];




if(($nombres!="") and  ($ci!="")){
   $reg = array();
   $reg["id_asociacion"] = 1;
   $reg["nombres"] = $nombres;
   $reg["apellidos"] = $apellidos;
   $reg["ci"] = $ci;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["profesion"] = $profesion;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("terapeutas", $reg, "INSERT"); 
   header("Location: terapeutas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA TERAPEUTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='terapeutas_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 