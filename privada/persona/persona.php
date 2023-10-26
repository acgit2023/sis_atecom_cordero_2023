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
         <script type='text/javascript' src='js/buscar_persona.js'> </script>
       </head>
       <body>
       <p> &nbsp;</p>";
echo"
<!------INICIO BUSCADOR---------------->
    <center>
    <h1>LISTADO DE PERSONAS</h1>
    <b><a  href='persona_nuevo.php'>Nueva Persona>>>></a></b>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>Nombres</b><br />
          <input type='text' name='nombres' value='' size='10' onKeyUp='buscar_persona()'>
        </th>
        <th>
          <b>C.I.</b><br />
          <input type='text' name='ci' value='' size='10' onKeyUp='buscar_persona()'>
        </th>
        <th>
        <b>Telefono</b><br />
          <input type='text' name='telef' value='' size='10' onKeyUp='buscar_persona()'>
        </th>
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR---------------->";

echo"<div id='persona1'> ";

contarRegistros($db, "persona");

paginacion("persona.php?");

/*$sql = $db->Prepare("SELECT *
                     FROM personas
                     WHERE estado <> 'X' 
                     ORDER BY id_persona DESC                      
                        ");
$rs = $db->GetAll($sql);*/

$sql = $db->Prepare("SELECT *
                     FROM persona
                     ORDER BY pk_id DESC   
                     LIMIT ? OFFSET ?                   
                        ");
$rs = $db->GetAll($sql, array($nElem, $regIni));
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>NOMBRES</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total; 
                $b= $b+1+$a;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['nombres']."</td>
                        <td>".$fila['telef']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["pk_id"]."' method='post' action='persona_modificar.php'>
                            <input type='hidden' name='pk_id' value='".$fila['pk_id']."'>
                            <a href='javascript:document.formModif".$fila['pk_id'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["pk_id"]."' method='post' action='persona_eliminar.php'>
                            <input type='hidden' name='pk_id' value='".$fila["pk_id"]."'>
                            <a href='javascript:document.formElimi".$fila['pk_id'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la persona ".$fila["nombres"]." ".$fila["telef"]." ?\"))'; location.href='persona_eliminar.php''> 
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
 