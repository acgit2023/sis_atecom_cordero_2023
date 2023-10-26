<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
            function validar() {
                cargos = document.formu.id_directorio.value;
                if ((document.formu.id_directorio.value == '') ) {
                alert('DEBE SELECCIONAR UNA OPCION');
                document.formu.id_directorio.focus();
            return;
        }
    ventanaCalendario = window.open('terapeutas_directorio1.php?cargos=' + cargos, 'calendario', 'width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,resizable=YES,location=NO');
  }
</script>


         </head>
 </head>
     <body>       
        <a  href='../../listado_tablas.php'>Listado de tablas</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
        ";
        echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
        echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
        echo"<h1>REPORTE DE TERAPEUTAS CON CARGO EN EL DIRECTORIO</h1>";
       

        $sql = $db->Prepare("SELECT  cargos, id_directorio
            FROM directorio 
            WHERE estado <> 'X' 
                              
               ");
$rs = $db->GetAll($sql);
            echo "<center>
            <form method='post' name='formu'>
                            <section>
                                <table border='1'>
                                <tr>
                                <th><h3>Seleccione el cargo </h3></th><th>:</th>
                                <td>
                                <select name='id_directorio' id='campo'>
                                    <option value=''>SELECCIONAR</option>
                                    <option value='T'>TODOS</option>";                  
            foreach ($rs as $k => $fila) {
                echo "<option value='" . $fila['id_directorio'] . "'>" . $fila['cargos'] . "</option>";
            }
            echo "</select>
                            </td>
                            </tr>
                                    <td aling='center' colspan='2'>
                                    <input type='hidden' name='accion' value=''>
                                    <input type='button' value='Aceptar' onclick='validar();' class='boton'>
                                    </td>
                                    </tr>
                                    
                                </table>
                            </section>
   
        </form>
        </center>";

echo "</body>
    </html> ";