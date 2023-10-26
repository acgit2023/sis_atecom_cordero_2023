<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo "<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript'>
            function validar() {
                cargo = document.formu.id_cargo.value;
                

                if ((document.formu.id_cargo.value == '') ) {
                alert('DEBE SELECCIONAR UNA OPCION');
                document.formu.id_cargo.focus();
            return;
        }

    ventanaCalendario = window.open('seleccionar_cargo1.php?cargo=' + cargo, 'calendario', 'width=600,height=550,left=100,top=100,scrollbars=yes,menubars=no,statusbar=NO,resizable=YES,location=NO');
  }
</script>

         </head>

 </head>
     <body>       
        <a  href='../../listado_tablas.php'>LISTADO DE TABLAS</a>
        <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
        ";
echo "<h3>USUARIO: " . $_SESSION["sesion_usuario"] . " &nbsp;&nbsp";
echo "ROL: " . $_SESSION["sesion_rol"] . "</h3>
        <h1>REPORTE PARA SELECCIONAR EL CARGO Y MOSTRAR PERSONAS</h1>";

        

            $sql = $db->Prepare("SELECT nombre, pk_id as id_cargo
                                FROM cargos
                                                      
                                    ");
            $rs = $db->GetAll($sql);

            echo "<center>
            <form method='post' name='formu'>
                            <section>
                                <table class='listado'>
                                <tr>
                                <th>SELECCIONE OPCION</th>
                                <td>
                                
                                <select name='id_cargo' id='campo'>
                                    <option value=''>SELECCIONAR</option>";
            foreach ($rs as $k => $fila) {
                echo "<option value='" . $fila['id_cargo'] . "'>" . $fila['nombre'] . "</option>";
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