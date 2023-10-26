<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function imprimir() {
            ventanaCalendario=window.open('persona_cargos1.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>
    </head>

       </head>
        <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

        echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
        echo "ROL: ".$_SESSION["sesion_rol"]."</h3>

            <h1>REPORTE DE PERSONA CON CARGOS</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS('',pe.nombres) as persona, car.nombre
                     FROM persona pe
                     INNER JOIN cargos car ON pe.pk_id =car.pk_id             
                        ");
$rs = $db->GetAll($sql);
if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Nro</th><th>PERSONAS</th><th>NOMBRE DE CARGOS</th>
              
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>
                    
                    <td>".$fila['persona']."</td>
                    <td>".$fila['nombre']."</td>
                    
                   
                 </tr>";
                 $b=$b+1;
        }
        echo "</table>
        <h2>
        <input type='radio' name'seleccionar' onclick='javascript:imprimir()''> Imprimir
        </h2>
        </center>";
        }
 
echo "</body>
  </html> ";

?> 