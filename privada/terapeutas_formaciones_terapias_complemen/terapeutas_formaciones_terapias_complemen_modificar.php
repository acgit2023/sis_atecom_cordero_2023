<?php
session_start();
require_once("../../conexion.php");

//$db->debug = true;


$id_terapeuta = $_POST["id_terapeuta"];
$id_formacion_terapia_complemen = $_POST["id_formacion_terapia_complemen"];
$id_terapeuta_formacion = $_POST["id_terapeuta_formacion"];

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='terapeutas_formaciones_terapias_complemen.php'>Listado Formacion de los Terapeutas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

echo "<h3>USUARIO: " . $_SESSION["sesion_usuario"] . "  &nbsp;&nbsp; ";
echo "ROL: " . $_SESSION["sesion_rol"] . "</h3>";

echo "<h1>MODIFICAR LA FORMACION DE LAS TERAPEUTAS </h1>";

$sql = $db->Prepare("SELECT * 
                    FROM terapeutas_formaciones_terapias_complementarias
                    WHERE id_terapeuta_formacion=?
                    AND estado='A'
                    ");
$rs = $db->GetAll($sql, array($id_terapeuta_formacion));


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

// CONSULTAS PARA FORMACION DE TERAPEUTA 


$sql3 = $db->Prepare("SELECT *
                     FROM formaciones_terapias_complementarias
                     WHERE id_formacion_terapia_complemen =?
                     AND estado = 'A'                        
                        ");
$rs3 = $db->GetAll($sql3, array($id_formacion_terapia_complemen ));


$sql4 = $db->Prepare("SELECT *
                     FROM formaciones_terapias_complementarias
                     WHERE id_formacion_terapia_complemen  <>?
                     AND estado = 'A'                        
                        ");
$rs4 = $db->GetAll($sql4, array($id_formacion_terapia_complemen ));


/*  if ($rs) {*/
echo "<form action='terapeutas_formaciones_terapias_complemen_modificar1.php' method='post' name='formu'>";
echo "<center>
                <table class='listado'>
                  <tr>
                    <th>(*)NOMBRE DEL TERAPEUTA</th>
                    <td>
                      <select name='id_terapeuta'>";


foreach ($rs1 as $k => $fila) {
    echo "<option value='" . $fila['id_terapeuta'] . "'>" . $fila['terapeuta'] . "</option>";
}
foreach ($rs2 as $k => $fila) {
    echo "<option value='" . $fila['id_terapeuta'] . "'>" . $fila['terapeuta'] . "</option>";
}

echo"</select>
                    </td>
                  </tr>";


echo "<center>
                
                  <tr>
                    <th>(*)NOMBRE DE LA FORMACION</th>
                    <td>
                      <select name='id_formacion'>";

foreach ($rs3 as $k => $fila) {
    echo "<option value='" . $fila['id_formacion_terapia_complemen'] . "'>" . $fila['nombre_formacion'] . "</option>";
}
foreach ($rs4 as $k => $fila) {
    echo "<option value='" . $fila['id_formacion_terapia_complemen'] . "'>" . $fila['nombre_formacion'] . "</option>";
}
echo"</select>
                    </td>
                  </tr>";


foreach ($rs as $k => $fila) {
    echo "<tr>
            <th><b>(*)TIEMPO DE FORMACION</b></th>
            <td><input type='text' name='tiempo_formacion' size='20' value='" . $fila["tiempo_formacion"] . "'></td>
        </tr>

        <tr>
            <th><b>(*)FECHA</b></th>
            <td><input type='date' name='anio' size='20' value='" . $fila["anio"] . "'></td>
        </tr>
        <tr>
        <td align='center' colspan='2'>  
        <input type='submit' value='MODIFICAR FORMACION DE TERAPEUTA'><br>
        (*)Datos Obligatorios
        <input type='hidden' name='id_terapeuta_formacion' value='".$fila["id_terapeuta_formacion"]."'>
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

      