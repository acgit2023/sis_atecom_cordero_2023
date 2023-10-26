<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
         function validar() {
          genero=document.formu.genero.value;
          if (document.formu.genero.value == ''){
            alert('Seleccione el genero');
            documen.formu.genero.focus();
            return;
          }
            ventanaCalendario=window.open('personas_genero1.php?genero=' +genero, 'calendario','width=600,height=550, left=100,top=100 scrollbars=yes,menubars=no,statusbar=NO,satatus=NO,resizable=YES,location=NO')
         }
         </script>
    </head>
      <body>
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
            <h1>REPORTE DE PERSONA CON GENERO</h1>
        <form method='post' name='formu'>";
    echo"<center>
          <table border='1'>
            <tr>                                   
              <th><h3>*Seleccione genero</th><th>:</th>
              <td>  
            <select name='genero'>
            <option value=''>Seleccione</option>
            <option value='T'>Todos</option>
            <option value='F'>Femenino</option>
            <option value='M'>Masculino</option>
          </select>
        </td>
      </tr>  
      <tr> 
        <td align='center' colspan='6'>
          <input type='hidden' name='accion' value=''>
          <input type='button' value='Aceptar' onclick='validar();'' class='boton2'>
        </td>
      </tr>
    </table>
    </form>
    </center>";
echo "</body>
    </html>";
    
    ?>