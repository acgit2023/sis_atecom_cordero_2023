<?php
session_start();

require_once("../../conexion.php");

$id_terapeuta_formacion=$_REQUEST["id_terapeuta_formacion"];



//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
/*LAS CONSULTAS SE TIENEN QUE HACER CON TODAS LAS TABLAS EN LAS QUE ID_USUARIO ESTA COMO HERENCIA*/

        $reg = array();
        $reg["estado"] = 'X';
        $reg["usuario"] = $_SESSION["sesion_id_usuario"];
        $rs1 = $db->AutoExecute("terapeutas_formaciones_terapias_complementarias", $reg, "UPDATE", "id_terapeuta_formacion='".$id_terapeuta_formacion."'");
        header("Location:terapeutas_formaciones_terapias_complemen.php"); 
        exit(); 
echo "</body>
      </html> ";
 ?>