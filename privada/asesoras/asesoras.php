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
         <script type='text/javascript' src='js/buscar_asesoras.js'> </script>
       </head>
       <body>
       <p> &nbsp;</p>";


echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <h1>LISTADO DE ASESORAS</h1>
    <b><a  href='asesoras_nuevo.php'>Nueva Asesora>>>></a></b>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombres' value='' size='10' onKeyUp='buscar_asesoras()'>
        </th>
        <th>
          <b>Apellidos</b><br />
          <input type='text' name='apellidos' value='' size='10' onKeyUp='buscar_asesoras()'>
        </th>
        <th>
          <b>Telefono</b><br />
          <input type='text' name='telefono' value='' size='10' onKeyUp='buscar_asesoras()'>
        </th>
        <th>
          <b>Formacion</b><br />
          <input type='text' name='formacion' value='' size='10' onKeyUp='buscar_asesoras()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
       
echo"<div id='asesoras1'> ";

contarRegistros($db, "asesoras");

paginacion("asesoras.php?");

/*$sql = $db->Prepare("SELECT *
                     FROM terapeutas
                     WHERE estado <> 'X' 
                     ORDER BY id_terapeuta DESC                      
                        ");
$rs = $db->GetAll($sql);*/

$sql2 = $db->Prepare("SELECT *
                     FROM asesoras
                     WHERE estado <> 'X' 
                     AND id_asesora > 1
                     ORDER BY id_asesora DESC 
                     LIMIT ? OFFSET ?                      
                        ");
$rs = $db->GetAll($sql2, array($nElem, $regIni));

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>NOMBRES</th><th>APELLIDOS</th><th>TELEFONO</th><th>FORMACION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total; 
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombres']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['telefono']."</td>
                        <td>".$fila['formacion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_asesora"]."' method='post' action='asesoras_modificar.php'>
                            <input type='hidden' name='id_asesora' value='".$fila['id_asesora']."'>
                            <a href='javascript:document.formModif".$fila['id_asesora'].".submit();' title='Modificar Terapeuta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_asesora"]."' method='post' action='asesoras_eliminar.php'>
                            <input type='hidden' name='id_asesora' value='".$fila["id_asesora"]."'>
                            <a href='javascript:document.formElimi".$fila['id_asesora'].".submit();' title='Eliminar Terapeuta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Terapeuta ".$fila["nombres"]." ".$fila["apellidos"]." ".$fila["telefono"]." ".$fila["formacion"]." ?\"))'; location.href='asesoras_eliminar.php''> 
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