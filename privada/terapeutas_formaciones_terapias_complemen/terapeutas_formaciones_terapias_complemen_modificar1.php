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
$id_formacion_terapia_complemen= $_POST["id_formacion"];
$id_terapeuta_formacion = $_POST["id_terapeuta_formacion"];

$tiempo_formacion = $_POST["tiempo_formacion"];
$anio = $_POST["anio"];

echo" 
<<<<<$id_formacion_terapia_complemen<br>
";


if(($id_terapeuta!="") and ($id_formacion=!"") and  ($tiempo_formacion!="") and ($anio!="") ){
   $reg = array();

   $reg["id_terapeuta"] = $id_terapeuta;
   $reg["id_formacion_terapia_complemen"] = $id_formacion_terapia_complemen;
   $reg["tiempo_formacion"] = $tiempo_formacion;
   $reg["anio"] = $anio;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("terapeutas_formaciones_terapias_complementarias", $reg, "UPDATE", "id_terapeuta_formacion='".$id_terapeuta_formacion."'"); 
   header("Location: terapeutas_formaciones_terapias_complemen.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='terapeutas_formaciones_terapias_complemen.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 