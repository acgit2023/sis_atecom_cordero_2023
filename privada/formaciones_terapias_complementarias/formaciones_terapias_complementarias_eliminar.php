<?php
session_start();
require_once("../../conexion.php");

$_id_formacion_terapia_complemen = $_REQUEST["id_formacion_terapia_complemen"];

require_once("../../libreria_menu.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM formaciones_terapias_complementarias
                     WHERE id_formacion_terapia_complemen = ? 
                     AND estado <> 'X'                     
                        ");
$rs = $db->GetAll($sql, array($_id_formacion_terapia_complemen));


   if (!$rs) {
        $reg = array();
        $reg["estado"] = 'X';
        $reg["usuario"] = $_SESSION["sesion_id_usuario"];
        $rs1 = $db->AutoExecute("formaciones_terapias_complementarias", $reg, "UPDATE", "id_formacion_terapia_complemen='".$_id_formacion_terapia_complemen."'");
        header("Location:formaciones_terapias_complementarias.php"); 
        exit(); 

   }else{
    echo"<div class='mensaje'>";
        $mensage ="NO SE ELIMINARON LOS DATOS DE FORMACIONES TERAPIAS COMPLEMENTARIAS PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";    
        
        echo"<a href='formaciones_terapias_complementarias.php'>
                <input type='button'style='cursor:pointer;border-radius:10px;font-weigth: 25px;'value='VOLVER>>>>'></input>
            </a>
            ";
            echo"</div>";       
   }


echo "</body>
      </html> ";
 ?>