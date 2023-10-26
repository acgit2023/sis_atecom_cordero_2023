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
          contenedor = document.getElementById('terapeutas');
          contenedor2 = document.getElementById('terapeuta_seleccionado');
          contenedor3 = document.getElementById('terapeuta_insertada');
          d1 = document.formu.apellidos.value;
          d2 = document.formu.nombres.value;
          d3 = document.formu.ci.value;
          ajax = nuevoAjax();
          url = 'ajax_buscar_terapeuta.php'
          param = 'apellidos='+d1+'&nombres='+d2+'&ci='+d3;
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

          function buscar_terapeuta(id_terapeuta) {
            var d1, contenedor, url;
            contenedor = document.getElementById('terapeuta_seleccionado');
            contenedor2 = document.getElementById('terapeutas');
            document.formu.id_terapeuta.value = id_terapeuta;

            d1 = id_terapeuta;
          
            ajax = nuevoAjax();
            url = 'ajax_buscar_terapeuta1.php';
            param = 'id_terapeuta='+d1;
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
";
echo"
        function insertar_terapeuta() {
          var d1, contenedor, url;
          contenedor = document.getElementById('terapeuta_seleccionado');
          contenedor2 = document.getElementById('terapeutas');
          contenedor3 = document.getElementById('terapeuta_insertada');
          d1 = document.formu.apellidos1.value;
          d2 = document.formu.nombres1.value;
          d3 = document.formu.ci1.value;
          d4 = document.formu.direccion1.value;
          d5 = document.formu.telefono1.value;
          d6 = document.formu.profesion1.value;
          if (d3 == '') {
                alert('El ci es incorrecto o el campo esta vacio');
                document.formu.ci1.focus();
                return;
            }
          if  (d1== '') {
                alert('Los apellidos es incorrecto o el campo esta vacio');
                document.formu.apellidos1.focus();
                return;
            }
          if  (d2 == '') {
                alert('El nombre es incorrecto o el campo esta vacio');
                document.formu.nombres1.focus();
                return;
          }
          ajax = nuevoAjax();
          url = 'ajax_inserta_terapeuta.php'
          param = 'apellidos1='+d1+'&nombres1='+d2+'&ci1='+d3+'&direccion1='+d4+'&telefono1='+d5+'&profesion1='+d6;
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
";
  echo"    </script>
    </head>";
    echo"<body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='directorio.php'>Listado del Directorio</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>
      <h1>INSERTAR DIRECTORIO</h1>";
      
      $sql = $db->Prepare("SELECT CONCAT_WS(' ' ,apellidos, nombres) AS terapeuta, id_terapeuta 
                     FROM terapeutas
                     WHERE estado = 'A'                      
                        ");
$rs = $db->GetAll($sql);
   //if ($rs) {*/
        echo"<form action='directorio_nuevo1.php' method='post' name='formu'>";
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>(*)Selecciona a las terapeutas</th>
                    <td>
                      <table>
                        <tr> 
                          <td>
                            <b>Apellidos</b><br />
                            <input type='text' name='apellidos' value='' size='10' onKeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Nombres</b><br />
                            <input type='text' name='nombres' value='' size='10' onKeyUp='buscar()'>
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
                        <div id='terapeutas'> </div>
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
                          <div id='terapeuta_seleccionado'> </div>
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
                        <input type='hidden' name='id_terapeuta'>
                        <div id='terapeuta_insertada'> </div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>";
            echo"<tr>
                  <th><b>(*)Nombre del cargo</b></th>
                  <td><input type='text' name='cargos' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Fecha de inicio</b></th>
                  <td><input type='date' name='fecha_inicio' size='10'></td>
                </tr>
                <tr>
                  <th><b>(*)Fecha final</b></th>
                  <td><input type='date' name='fecha_final' size='10'></td>
                </tr>
                <tr>
                  <td align='center' colspan='2'>
                  <input type='submit' value='ADICIONAR DIRECTORIO'><br>
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