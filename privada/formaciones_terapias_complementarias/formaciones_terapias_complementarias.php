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
         <script type='text/javascript' src='js/buscar_terfor.js'> </script>
        
       </head>
       <body>
       <p> &nbsp;</p>";


echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <h1>LISTADO DE FORMACIONES TERAPIAS COMPLEMENTARIAS</h1>
    <b><a  href='formaciones_terapias_complementarias_nuevo.php'>Nueva Formacion Terapia Complementaria>>>></a></b>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Nombre Formacion</b><br />
          <input type='text' name='nombre_formacion' value='' size='10' onKeyUp='buscar_terfor()'>
        </th>
        <th>
          <b>Lugar</b><br />
          <input type='text' name='lugar' value='' size='10' onKeyUp='buscar_terfor()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";
       
echo"<div id='terapeutas1'> ";

contarRegistros($db, "formaciones_terapias_complementarias");

paginacion("formaciones_terapias_complementarias.php?");

/*$sql = $db->Prepare("SELECT *
                     FROM terapeutas
                     WHERE estado <> 'X' 
                     ORDER BY id_terapeuta DESC                      
                        ");
$rs = $db->GetAll($sql);*/

$sql2 = $db->Prepare("SELECT *
                     FROM formaciones_terapias_complementarias
                     WHERE estado <> 'X' 
                     AND id_formacion_terapia_complemen > 1
                     ORDER BY id_formacion_terapia_complemen  DESC 
                     LIMIT ? OFFSET ?                      
                        ");
$rs = $db->GetAll($sql2, array($nElem, $regIni));

   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>Nombre Formacion</th><th>Lugar</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total; 
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre_formacion']."</td>
                        <td>".$fila['lugar']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_formacion_terapia_complemen"]."' method='post' action='formaciones_terapias_complementarias_modificar.php'>
                            <input type='hidden' name='id_formacion_terapia_complemen' value='".$fila['id_formacion_terapia_complemen']."'>
                            <a href='javascript:document.formModif".$fila['id_formacion_terapia_complemen'].".submit();' title='Modificar Terapeuta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_formacion_terapia_complemen"]."' method='post' action='formaciones_terapias_complementarias_eliminar.php'>
                            <input type='hidden' name='id_formacion_terapia_complemen' value='".$fila["id_formacion_terapia_complemen"]."'>
                            <a href='javascript:document.formElimi".$fila['id_formacion_terapia_complemen'].".submit();' title='Eliminar Terapeuta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la Terapeuta ".$fila["nombre_formacion"]." ".$fila["lugar"]." ?\"))'; location.href='formaciones_terapias_complementarias_eliminar.php''> 
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