<?php
session_start();

require_once("../../conexion.php");

       
$apellidos1 = $_POST["apellidos1"];
$nombres1 = $_POST["nombres1"];
$ci1 = $_POST["ci1"];
$direccion1 = $_POST["direccion1"];
$telefono1 = $_POST["telefono1"];
$profesion1 = $_POST["profesion1"];


$reg = array();
$reg["id_asociacion"] = 1;
$reg["apellidos"] = $apellidos1;
$reg["nombres"] = $nombres1;
$reg["ci"] = $ci1;
$reg["direccion"] = $direccion1;
$reg["telefono"] = $telefono1;
$reg["profesion"] = $profesion1;
$reg["fec_insercion"] = date("Y-m-d H:i:s");
$reg["estado"] = 'A';
$reg["usuario"] = $_SESSION["sesion_id_usuario"];   
$rs1 =$db->AutoExecute("terapeutas", $reg, "INSERT"); 


?> 