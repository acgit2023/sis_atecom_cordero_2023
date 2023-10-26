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
$id_formacion = $_POST["id_formacion"];

$tiempo_formacion = $_POST["tiempo_formacion"];
$anio = $_POST["anio"];

echo"
$id_terapeuta <br>
$id_formacion <br>
$tiempo_formacion <br>
$anio <br>

";



if(($id_formacion!="") and ($id_terapeuta!="") and ($tiempo_formacion!="") and ($anio!="")){
   $reg = array();
   $reg["id_terapeuta"] = $id_terapeuta;
   $reg["id_formacion_terapia_complemen"] = $id_formacion;
   $reg["tiempo_formacion"] = $tiempo_formacion;
   $reg["anio"] = $anio;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("terapeutas_formaciones_terapias_complementarias", $reg, "INSERT"); 
 
   header("Location: terapeutas_formaciones_terapias_complemen.php");
   exit();

  
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA FORMACION DEL TERAPEUTA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='terapeutas_formaciones_terapias_complemen_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 