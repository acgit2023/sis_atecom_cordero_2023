<?php
session_start();
require_once("../../conexion.php");
//$db->debug=true;
echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function generar_pdf() {
            ventanaCalendario=window.open('terapeuta_paciente_pdf.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>
         <script type='text/javascript'>
         var ventanaCalendario=false
         function reporte_grafico() {
            ventanaCalendario=window.open('Highcharts/examples/3d-pie-donut/index.php','calendario','width=600,height=550, left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>
    </head>
    <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
            <h1>EVALUACIÓN DEL TERCER BIMESTRE </h1>";

    echo"<center>
          <table class='listado'>
            <tr>                                   
              <th>Seleccione</th>  
            </tr>";

        echo "<tr>
                <td>
                   <input type='radio' name='seleccionar' onclick='javascript:generar_pdf()'>generar_pdf: Reporte en PDF
                </td>
               </tr>
               <tr>
                <td>
                   <input type='radio' name='seleccionar' onclick='javascript:reporte_grafico()'>reporte_grafico: Reporte Gráfico 
                </td>
               </tr>";

         echo"</table>

         </center>";
 
echo "</body>
  </html> ";

?> 