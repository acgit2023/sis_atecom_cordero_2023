<?php
session_start();
require_once("../../conexion.php");

//$db->debug = true;

$id_terapeuta = $_POST["id_terapeuta"];
$id_paciente = $_POST["id_paciente"];
$id_terapeuta_paciente = $_POST["id_terapeuta_paciente"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='terapeutas_pacientes.php'>Listado de los Detalles de Atencion</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

echo "<h3>USUARIO: " . $_SESSION["sesion_usuario"] . "  &nbsp;&nbsp; ";
echo "ROL: " . $_SESSION["sesion_rol"] . "</h3>";

echo "<h1>MODIFICAR DETALLES DE LA ATENCION </h1>";

$sql = $db->Prepare("SELECT * 
                    FROM terapeutas_pacientes
                    WHERE id_terapeuta_paciente=?
                    AND estado='A'
                    ");
$rs = $db->GetAll($sql, array($id_terapeuta_paciente));

// CONSULTAS PARA LOS TERAPEUTAS

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ',apellidos, nombres) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE id_terapeuta=?
                     AND estado = 'A'                        
                        ");
$rs1 = $db->GetAll($sql1, array($id_terapeuta));


$sql2 = $db->Prepare("SELECT CONCAT_WS(' ',apellidos, nombres) as terapeuta, id_terapeuta
                     FROM terapeutas
                     WHERE id_terapeuta <>?
                     AND estado = 'A'                        
                        ");
$rs2 = $db->GetAll($sql2, array($id_terapeuta));

// CONSULTAS PARA LOS PACIENTES 

$sql3 = $db->Prepare("SELECT CONCAT_WS(' ',apellidos, nombres) as paciente, id_paciente
                     FROM paciente
                     WHERE id_paciente=?
                     AND estado = 'A'                        
                        ");
$rs3 = $db->GetAll($sql3, array($id_paciente));


$sql4 = $db->Prepare("SELECT CONCAT_WS(' ',apellidos, nombres) as paciente, id_paciente
                     FROM paciente
                     WHERE id_paciente <>?
                     AND estado = 'A'                        
                        ");
$rs4 = $db->GetAll($sql4, array($id_paciente));


/*  if ($rs) {*/
echo "<form action='terapeutas_pacientes_modificar1.php' method='post' name='formu'>";
echo "<center>
                <table class='listado'>
                  <tr>
                    <th>(*)TERAPEUTA</th>
                    <td>
                      <select name='id_terapeuta'>";

foreach ($rs1 as $k => $fila) {
    echo "<option value='" . $fila['id_terapeuta'] . "'>" . $fila['terapeuta'] . "</option>";
}
foreach ($rs2 as $k => $fila) {
    echo "<option value='" . $fila['id_terapeuta'] . "'>" . $fila['terapeuta'] . "</option>";
}
echo "</select>
                    </td>
                  </tr>
                  <tr>
                    <th>(*)PACIENTES</th>
                    <td>
                      <select name='id_paciente'>";

foreach ($rs3 as $k => $fila) {
    echo "<option value='" . $fila['id_paciente'] . "'>" . $fila['paciente'] . "</option>";
}
foreach ($rs4 as $k => $fila) {
    echo "<option value='" . $fila['id_paciente'] . "'>" . $fila['paciente'] . "</option>";
}
echo "</select>
                    </td>
                  </tr>";


foreach ($rs as $k => $fila) {
    echo "<tr>
            <th><b>(*)DETALLE</b></th>
            <td><input type='text' name='detalle' size='20' value='" . $fila["detalle"] . "'></td>
        </tr>

        <tr>
            <th><b>(*)PRECIO</b></th>
            <td><input type='number' name='precio' size='20' value='" . $fila["precio"] . "'></td>
        </tr>

        <tr>
            <th><b>(*)FECHA</b></th>
            <td><input type='date' name='fecha_atencion' size='20' value='" . $fila["fecha_atencion"] . "'></td>
        </tr>
        <tr>
        <td align='center' colspan='2'>  
        <input type='submit' value='MODIFICAR DETALLE DE ATENCION'><br>
        (*)Datos Obligatorios
        <input type='hidden' name='id_terapeuta_paciente' value='".$fila["id_terapeuta_paciente"]."'>
        </td>
    </tr>";
}
echo "                                                   
                </table>
                </center>";
echo "</form>";
/*}*/

echo "</body>
      </html> ";

      