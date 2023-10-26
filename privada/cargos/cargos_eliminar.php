<?php
session_start();
require_once("../../conexion.php");

$id_cargo = $_REQUEST["pk_id"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;

/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_PERSONA ESTA COMO HERENCIA*/

$sql = $db->Prepare("SELECT *
                     FROM persona
                     WHERE fk_cargo = ? 
                                       
                        ");
$rs = $db->GetAll($sql, array($id_cargo));


   if (!$rs) {
    
    $reg = array("pk_id"=>$id_cargo);
    $rs1 =$db->Execute("DELETE FROM cargos WHERE pk_id= ?", $reg);
    header("Location: cargos.php");
    exit();

   }else{
    echo"<div class='mensaje'>";
        $mensage ="NO SE ELIMINARON LOS DATOS DE CARGO PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";    
        
        echo"<a href='cargos.php'>
                <input type='button'style='cursor:pointer;border-radius:10px;font-weigth: 25px;'value='VOLVER>>>>'></input>
            </a>
            ";
            echo"</div>";       
   }


echo "</body>
      </html> ";
 ?>