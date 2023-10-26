<?php
session_start();

require_once("../../conexion.php");

$_id_usuario = $_REQUEST["id_usuario"];

//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_USUARIO ESTA COMO HERENCIA*/
$sql = $db->Prepare("SELECT *
                     FROM usuarios_roles
                     WHERE id_usuario = ? 
                     AND estado <> 'X'                     
                        ");
$rs = $db->GetAll($sql, array($_id_usuario));

   if (!$rs) {
        $reg = array();
        $reg["estado"] = 'X';
        $reg["usuario"] = $_SESSION["sesion_id_usuario"];
        $rs1 = $db->AutoExecute("usuarios", $reg, "UPDATE", "id_usuario='".$_id_usuario."'");
        header("Location:usuarios.php"); 
        exit(); 

   }else{
    echo"<div class='mensaje'>";
        $mensage ="NO SE ELIMINARON LOS DATOS DEL USUARIO PORQUE TIENE HERENCIA";
        echo"<h1>".$mensage."</h1>";    
        
        echo"<a href='usuarios.php'>
                <input type='button'style='cursor:pointer;border-radius:10px;font-weigth: 25px;'value='VOLVER>>>>'></input>
            </a>
            ";
            echo"</div>";       
   }


echo "</body>
      </html> ";
 ?>