<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

$cargo = $_REQUEST["cargo"];


$sql = $db->Prepare("SELECT p.*,c.nombre
                     FROM cargos c
                     INNER JOIN persona p ON c.pk_id=p.fk_cargo
                     WHERE p.fk_cargo=?                                       
                     ");

$rs = $db->GetAll($sql, array($cargo));

$sql1 = $db->Prepare("SELECT *
                    FROM asociacion
                    WHERE id_asociacion = 1
                    AND estado <> 'X'
                    ");
$rs1 = $db->GetAll($sql1);

$nombre = $rs1[0]["nombre"];
$logo = $rs1[0]["logo"];

echo "<html> 
        <head>
            <script type='text/javascript'>
                var ventanaCalendario=false
                function imprimir() {
                    if (confirm(' Desea Imprimir ?')){
                    window.print();
                    }
                }
            </script>
        </head>
        <body style='cursor:pointer;cursor:hand' onClick='imprimir();'>";

if ($rs) {
    echo "<table width='100%'' border='0'>
    <tr>
    <td ><img src='../asociacion/logos/{$logo}' width='30%' ></td>
    <td align='center' width='80%'><h1>REPORTE DE CARGOS Y PERSONAS</h1></td>
    </tr>
            </table>";
    echo "<center>             
                <table border='1' cellspacing='0'>
                    <tr>
                        <th>Nro</th><th>CARGO</th><th>NOMBRE DE PERSONA</th>
                    </tr>";
    $b = 1;
    foreach ($rs as $k => $fila) {
        echo "<tr>
                <td align='center'>" . $b . "</td>
                <td>" . $fila['nombre'] . "</td>
                <td>" . $fila['nombres'] . "</i></td>
                
        </tr>";
        $b++;
    }
    echo"</table></br>";

    $sql2 = $db->Prepare("SELECT nombre
			FROM cargos
			WHERE pk_id=?	
		    			
				");
    $rs2 = $db->GetAll($sql2, array($cargo));
    

    foreach ($rs2 as $k => $fila) {
        echo "              
                <p>DEL CARGO: " . $fila['nombre'] . "</p>";      
        
    }

    
    echo"        
            </center>";
}
echo "</body>
    </html>";
?>