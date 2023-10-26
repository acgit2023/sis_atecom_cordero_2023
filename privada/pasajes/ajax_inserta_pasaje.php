<?php
session_start();

require_once("../../conexion.php");

       
$ci1 = $_POST["ci1"];
$nombres1 = $_POST["nombres1"];
$apellidos1 = $_POST["apellidos1"];
$telefono1 = $_POST["telefono1"];


$reg = array();
$reg["ci"] = $ci1;
$reg["nombres"] = $nombres1;
$reg["apellidos"] = $apellidos1;
$reg["telefono"] = $telefono1;
$reg["usuario"] = $_SESSION["sesion_id_usuario"];   
$rs1 =$db->AutoExecute("cliente", $reg, "INSERT"); 


?> 