<?php
session_start();

require_once("../../conexion.php");

       
$ap1 = $_POST["ap1"];
$am1 = $_POST["am1"];
$nombres1 = $_POST["nombres1"];
$ci1 = $_POST["ci1"];

//$db->debug=true;
if($paterno or $materno or $nombres or $ci){
    $sql3 = $db->Prepare("SELECT *
                          FROM personas
                          WHERE ap LIKE ? 
                          AND am LIKE ? 
                          AND nombres LIKE ?
                          AND ci LIKE ?  
                          AND estado <> 'X'                     
                        ");
        $rs3 = $db->GetAll($sql3, array($paterno."%", $materno."%", $nombres."%", $ci."%"));
    if($rs3){
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>C.I.</th><th>PATERNO</th><th>MATERNO</th><th>NOMBRES<th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
        foreach ($rs3 as $k => $fila) {                                       
                 $str = $fila["ci"];
                 $str1 = $fila["ap"];
                 $str2 = $fila["am"];
                 $str3 = $fila["nombres"];

            echo"<tr>
                    <td align='center'>".resaltar($ci, $str)."</td>
                    <td>".resaltar($paterno, $str1)."</td>
                    <td>".resaltar($materno, $str2)."</td>
                    <td>".resaltar($nombres, $str3)."</td>
                    <td align='center'>
                        <form name='formModif".$fila["id_persona"]."' method='post' action='persona_modificar.php'>
                        <input type='hidden' name='id_persona' value='".$fila['id_persona']."'>
                            <a href='javascript:document.formModif".$fila['id_persona'].".submit();' title='Modificar Persona Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>
                            <form name='formElimi".$fila["id_persona"]."' method='post' action='persona_eliminar.php'>
                                <input type='hidden' name='id_persona' value='".$fila["id_persona"]."'>
                                <a href='javascript:document.formElimi".$fila['id_persona'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm( Desea realmente Eliminar a la persona..?))'; location.href='persona_eliminar.php''>
                                Eliminar>>
                                </a>
                              </form>                        
                            </td>
                         </tr>";
        }
            echo "</table>
            </center>";
    }else{
        echo"<center><b> LA PERSONA NO EXISTE!!</b></center><br>";

    }
}
?> 