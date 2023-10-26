<?php
session_start();

require_once("../../conexion.php");

$id_terapeuta_paciente=$_REQUEST["id_terapeuta_paciente"];

echo"$id_terapeuta_paciente hola";

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
        $rs1 = $db->AutoExecute("terapeutas_pacientes", $reg, "UPDATE", "id_terapeuta_paciente='".$id_terapeuta_paciente."'");
        header("Location:terapeutas_pacientes.php"); 
        exit(); 



echo "</body>
      </html> ";
 ?>