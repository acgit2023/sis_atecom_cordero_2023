<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$id_persona=$_REQUEST["pk_id"];
echo"$id_persona";

echo"<html>
     
        <head>
            <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
        </head>
    <body>";

        //$rs = $db->GetAll($sql,array($id_producto));

        $reg = array("pk_id"=>$id_persona);
        $rs1 =$db->Execute("DELETE FROM persona WHERE pk_id= ?", $reg);
        
        
        header("Location: persona.php");
        exit();

   
?>  