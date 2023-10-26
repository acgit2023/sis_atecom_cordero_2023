<?php
session_start();
require_once("../../conexion.php");

$_id_asesora = $_REQUEST["id_asesora"];
require_once("../../libreria_menu.php");

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM asesoras
                     WHERE id_asesora = ? 
                     AND estado <> 'X'                     
                        ");
$rs = $db->GetAll($sql, array($_id_asesora));

   if (!$rs) {
        $reg = array();
        $reg["estado"] = 'X';
        $reg["usuario"] = $_SESSION["sesion_id_usuario"];
        $rs1 = $db->AutoExecute("asesoras", $reg, "UPDATE", "id_asesora='".$_id_asesora."'");
        header("Location:asesoras.php"); 
        exit(); 

   }else{
    echo"<div class='mensaje'>";
        $mensage ="NO SE ELIMINARON LOS DATOS DE LA ASESORA PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";    
        
        echo"<a href='asesoras.php'>
                <input type='button'style='cursor:pointer;border-radius:10px;font-weigth: 25px;'value='VOLVER>>>>'></input>
            </a>
            ";
            echo"</div>";       
   }


echo "</body>
      </html> ";
 ?>