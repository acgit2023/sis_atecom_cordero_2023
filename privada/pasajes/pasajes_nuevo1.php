<?php
session_start();
require_once("../../conexion.php");

//db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_cliente = $_POST["id_cliente"];
$nro_asiento = $_POST["nro_asiento"];
$fecha_viaje = $_POST["fecha_viaje"];
$hra_salida = $_POST["hra_salida"];
$monto = $_POST["monto"];


if(($id_cliente!="") and  ($nro_asiento!="") and ($monto!="")){
   $reg = array();
   $reg["id_cliente"] = $id_cliente;
   $reg["nro_asiento"] = $nro_asiento;
   $reg["fecha_viaje"] = $fecha_viaje;
   $reg["hra_salida"] = $hra_salida;
   $reg["monto"] = $monto;

   $reg["usuarios"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("pasajes", $reg, "INSERT"); 
   header("Location: pasajes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL PASAJE";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='pasajes_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 