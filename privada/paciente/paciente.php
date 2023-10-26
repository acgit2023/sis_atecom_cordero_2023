<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");


//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript' src='js/buscar_pacientes.js'> </script>
       </head>
       <body>
       <p> &nbsp;</p>";


echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <h1>LISTADO DE PACIENTE</h1>
    <b><a  href='paciente_nuevo.php'>Nuevo Paciente>>>></a></b>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Lugar</b><br />
          <input type='text' name='lugar' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
        <th>
          <b>Fecha</b><br />
          <input type='text' name='fecha' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
        <th>
          <b>Tema</b><br />
          <input type='text' name='tema' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombres' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
        <th>
          <b>Apellidos</b><br />
          <input type='text' name='apellidos' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
        <th>
          <b>Telefono</b><br />
          <input type='text' name='telefono' value='' size='10' onKeyUp='buscar_pacientes()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
       
echo"<div id='paciente1'> ";

contarRegistros($db, "paciente");

paginacion("paciente.php?");

/*$sql = $db->Prepare("SELECT *
                     FROM terapeutas
                     WHERE estado <> 'X' 
                     ORDER BY id_terapeuta DESC                      
                        ");
$rs = $db->GetAll($sql);*/

$sql2 = $db->Prepare("SELECT *
                     FROM paciente
                     WHERE estado <> 'X' 
                     AND id_paciente   > 1
                     ORDER BY id_paciente  DESC 
                     LIMIT ? OFFSET ?                      
                        ");
$rs = $db->GetAll($sql2, array($nElem, $regIni));

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>Lugar</th><th>Fecha</th><th>Tema</th><th>Nombres</th><th>Apellidos</th><th>Telefono</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total; 
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['lugar']."</td>
                        <td>".$fila['fecha']."</td>
                        <td>".$fila['tema']."</td>
                        <td>".$fila['nombres']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['telefono']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_paciente"]."' method='post' action='paciente_modificar.php'>
                            <input type='hidden' name='id_paciente' value='".$fila['id_paciente']."'>
                            <a href='javascript:document.formModif".$fila['id_paciente'].".submit();' title='Modificar Terapeuta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_paciente"]."' method='post' action='paciente_eliminar.php'>
                            <input type='hidden' name='id_paciente' value='".$fila["id_paciente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_paciente'].".submit();' title='Eliminar Terapeuta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Terapeuta ".$fila["lugar"]." ".$fila["fecha"]." ".$fila["tema"]." ".$fila["nombres"]." ".$fila["apellidos"]." ".$fila["telefono"]." ?\"))'; location.href='paciente_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }
echo"</div>";
echo"<!------PAGINACION---------------->";
echo"<table border=0 align='center'>
<tr>
<td>";
if (!empty($urlback)){
  echo"<a href=".$urlback." style='font-family:Verdana;font-size:9px;cursor:pointer'; >&laquo;Anterior</a>"; 
}
if (!empty($paginas)){
  foreach ($paginas as $k => $pagg){
    if ($pagg["npag"]== $pag){
      if ($pag != '1'){
        echo"|"; 
      }
      echo"<b style='color:#FB992F;font-size: 12px;'>";
    }else
    echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";
  }
}
if (($nPags > $nBotones) and (!empty($urlnext)) and ($pag < $nPags)){
  echo" | <a href=".$urlnext." style='font-family: verdadera;font-size:9px;cursor:pointer'>siguiente&raquo;</a>"; 
}
echo"</td>
</tr>
</table>";
echo"<!------PAGINACION---------------->";
echo "</body>
      </html> ";

 ?>
 