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
            ventanaCalendario=window.open('formaciones_terapias_complementarias1.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>

         <script type='text/javascript'>
         var ventanaCalendario=false
         function generar_pdf() {
            ventanaCalendario=window.open('formaciones_terapias_complementarias_pdf.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>
    </head>

       </head>
        <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
        echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
        echo "ROL: ".$_SESSION["sesion_rol"]."</h3>

            <h1>LISTADO DE TERAPEUTAS CON SUS FORMACIONES</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', te.apellidos, te.nombres) AS terapeuta, fortercom.nombre_formacion, fortercom.lugar, terfor_tecom.* 
                    FROM terapeutas_formaciones_terapias_complementarias terfor_tecom
                    INNER JOIN terapeutas te ON te.id_terapeuta=terfor_tecom.id_terapeuta
                    INNER JOIN formaciones_terapias_complementarias fortercom ON fortercom.id_formacion_terapia_complemen=terfor_tecom.id_formacion_terapia_complemen
                    AND terfor_tecom.estado <> 'X' 
                    AND te.estado <> 'X'
                    AND fortercom.estado <> 'X'                     
                        ");
$rs = $db->GetAll($sql);

if ($rs) {
    echo"<center>
          <table class='listado'>
            <tr>                                   
            <th>Nro</th><th>TERAPEUTAS</th><th>NOMBRE DE LA FORMACION</th><th>TIEMPO DE FORMACION</th><th>AÑO DE GRADUACION</th>
              
            </tr>";
            $b=1;
        foreach ($rs as $k => $fila) {                                       
            echo"<tr>
                    <td align='center'>".$b."</td>
                    
                    <td>".$fila['terapeuta']."</td>                        
                        <td>".$fila['nombre_formacion']."</td>
                        <td align='center'>".$fila['tiempo_formacion']."</td>
                        <td align='center'>".$fila['anio']."</td>
                    
                   
                 </tr>";
                 $b=$b+1;
        }
        echo "</table>
        <h2>
        <input type='radio' name='seleccionar' onclick='javascript:imprimir()''> Imprimir
        </h2>
        <h2>
        <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()'> Generar pdf
        </h2>
        </center>";
        }
 
echo "</body>
  </html> ";

?> 