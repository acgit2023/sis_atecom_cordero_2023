<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_terapeuta = $_POST["id_terapeuta"];
$cargos = $_POST["cargos"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_final = $_POST["fecha_final"];


if(($id_terapeuta!="") and  ($cargos!="") and ($fecha_inicio!="")){
   $reg = array();
   $reg["id_terapeuta"] = $id_terapeuta;
   $reg["cargos"] = $cargos;
   $reg["fecha_inicio"] = $fecha_inicio;
   $reg["fecha_final"] = $fecha_final;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("directorio", $reg, "INSERT"); 
   header("Location:directorio.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL DIRECTORIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='directorio_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 