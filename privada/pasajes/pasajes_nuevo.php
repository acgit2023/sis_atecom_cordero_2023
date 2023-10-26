<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
         function buscar() {
          var d1, contenedor, url;
          contenedor = document.getElementById('clientes');
          contenedor2 = document.getElementById('cliente_seleccionado');
          contenedor3 = document.getElementById('cliente_insertada');
          d1 = document.formu.ci.value;
          d2 = document.formu.nombres.value;
          d3 = document.formu.apellidos.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_pasaje.php'
          param = 'ci='+d1+'&nombres='+d2+'&apellidos='+d3;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = ajax.responseText;
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = '';
              }
          }
          ajax.send(param);
      }

          function buscar_cliente(id_cliente) {
            var d1, contenedor, url;
            contenedor = document.getElementById('cliente_seleccionado');
            contenedor2 = document.getElementById('clientes');
            document.formu.id_cliente.value = id_cliente;

            d1 = id_cliente;
          
            ajax = nuevoAjax();
            url = 'ajax_buscar_pasaje1.php';
            param = 'id_cliente='+d1;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    contenedor.innerHTML = ajax.responseText;
                    contenedor2.innerHTML = '';
                }
            }
            ajax.send(param);
        }


        function insertar_cliente() {
          var d1, contenedor, url;
          contenedor = document.getElementById('cliente_seleccionado');
          contenedor2 = document.getElementById('clientes');
          contenedor3 = document.getElementById('cliente_insertada');
          d1 = document.formu.ci1.value;
          d2 = document.formu.nombres1.value;
          d3 = document.formu.apellidos1.value;
          d4 = document.formu.telefono1.value;

          if (d1 == '') {
                alert('El ci es incorrecto o el campo esta vacio');
                document.formu.ci1.focus();
                return;
            }
          if  ((d2=='')) {
                alert('Por favor introduzca un Nombre');
                document.formu.nombres1.focus();
                return;
            }
          if  (d3 == '') {
                alert('El apellido es incorrecto o el campo esta vacio');
                document.formu.apellidos1.focus();
                return;
          }
          if  (d4 == '') {
            alert('El telefono es incorrecto o el campo esta vacio');
            document.formu.telefono1.focus();
            return;
          }
          ajax = nuevoAjax();
          url = 'ajax_inserta_pasaje.php'
          param = 'ci1='+d1+'&nombres1='+d2+'&apellidos1='+d3+'&telefono1='+d4;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          alert('llega');
          ajax.onreadystatechange = function(){
              if (ajax.readyState == 4){
                  contenedor.innerHTML = '';
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = ajax.responseText;
              }
          }
          ajax.send(param);
      }

      </script>
    </head>";
    echo"<body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='pasajes.php'>Listado de Pasajes</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
      <h1>INSERTAR PASAJE</h1>";
      
      /*$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,ap, am, nombres) AS persona, id_persona 
                     FROM personas
                     WHERE estado = 'A'                      
                        ");
$rs = $db->GetAll($sql);*/
   //if ($rs) {*/
        echo"<form action='pasajes_nuevo1.php' method='post' name='formu'>";
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>(*)Selecciona al cliente</th>
                    <td>
                      <table>
                        <tr> 
                          <td>
                            <b>Nombres</b><br />
                            <input type='text' name='nombres' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Apellidos</b><br />
                            <input type='text' name='apellidos' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>C.I.</b><br />
                            <input type='text' name='ci' value='' size='10' onkeyUp='buscar()'>
                          </td>
                          
                        </tr>
                      </table>
                    </td>
                  </tr>";
            echo"<tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3' align='center'>
                        <div id='clientes'> </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3'>
                          <div id='cliente_seleccionado'> </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                  <table width='100%'>
                    <tr>
                      <td colspan='3'>
                        <input type='hidden' name='id_cliente'>
                        <div id='cliente_insertada'> </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>";
            echo"<tr>
                  <th><b>(*)Numero asiento</b></th>
                  <td><input type='text' name='nro_asiento' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Fecha viaje</b></th>
                  <td><input type='date' name='fecha_viaje' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)hora salida</b></th>
                  <td><input type='time' name='hra_salida' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)monto</b></th>
                  <td><input type='text' name='monto' size='10'></td>
                </tr>
                <tr>
                  <td align='center' colspan='2'>
                  <input type='submit' value='ADICIONAR PASAJE'><br>
                  (*)Datos Obligarios 
                </td>
              </tr>
            </table>
          </center>";
    echo"</form>" ;
    /*}*/                      
echo "</body>
      </html> ";

 ?>