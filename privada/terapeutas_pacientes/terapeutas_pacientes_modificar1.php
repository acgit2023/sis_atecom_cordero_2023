<?php
session_start();
require_once("../../conexion.php");

//db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_terapeuta = $_POST["id_terapeuta"];
$id_paciente = $_POST["id_paciente"];
$id_terapeuta_paciente = $_POST["id_terapeuta_paciente"];

$detalle = $_POST["detalle"];
$precio = $_POST["precio"];
$fecha_atencion = $_POST["fecha_atencion"];

if(($id_terapeuta!="") and ($id_paciente!="") and  ($detalle!="") and ($precio!="") and ($fecha_atencion!="")){
   $reg = array();
   $reg["id_terapeuta"] = $id_terapeuta;
   $reg["id_paciente"] = $id_paciente;
   $reg["fecha_atencion"] = $fecha_atencion;
   $reg["detalle"] = $detalle;
   $reg["precio"] = $precio;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuarios"] = $_SESSION["sesion_id_terapeuta_paciente"];   
   $rs1 = $db->AutoExecute("terapeutas_pacientes", $reg, "UPDATE", "id_terapeuta_paciente='".$id_terapeuta_paciente."'"); 
   header("Location: terapeutas_pacientes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DEL DETALLE DE ATENCION";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='terapeutas_pacientes_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 