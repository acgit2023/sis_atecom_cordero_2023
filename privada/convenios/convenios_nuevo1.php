<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$nombre_institucion = $_POST["nombre_institucion"];
$nombres_participantes = $_POST["nombres_participantes"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

if(($nombre_institucion!="") and  ($nombres_participantes!="")){
   $reg = array();
   $reg["id_asociacion"] = 1;
   $reg["nombre_institucion"] = $nombre_institucion;
   $reg["nombres_participantes"] = $nombres_participantes;
   $reg["apellidos"] = $apellidos;
   $reg["ci"] = $ci;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("convenios", $reg, "INSERT"); 
   header("Location: convenios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL CONVENIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='convenios_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 