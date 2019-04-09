<? include("cabecera.php"); 
    include("funciones.php");
   $idusersession = $_REQUEST["idusersession"];
   $nombre  = retorna_cadena($idusersession,"id",5,"usersession");
   if($_POST["asignar"])
   {
      $cadena = "select * from proyecto_usersession where idusersession = '$idusersession' and  idproyecto='$_POST[proyecto]' ";
      $sw = cuenta_rows($cadena); 
      if($sw=='0')
      {

        $conexion = conectar_base(); 
        mysql_select_db ("sistemaatencion",$conexion);
        $cadena = "insert into proyecto_usersession (id,idusersession,idproyecto) values ('','$idusersession','$_POST[proyecto]')";
        mysql_query($cadena, $conexion);   
        mysql_free_result($tabla);
        mysql_close($conexion);

        $error = "Proyecto Asignado";
      }else
          {
             $error = "No se puede asignar 2 veces el mismo proyecto";
           }

   }

   if($_REQUEST['quitozo']=='1')
   {
        $conexion = conectar_base(); 
        mysql_select_db ("sistemaatencion",$conexion);
        $cadena = "delete from proyecto_usersession where idusersession='$idusersession' and idproyecto='$_REQUEST[idproyecto]'";
       // echo $cadena;
        mysql_query($cadena, $conexion);   
        mysql_free_result($tabla);
        mysql_close($conexion);

        $error = "Proyecto eliminado de la relacion";

   }

?>

<div class="div1">
<div class="contenido">
  
 

  
  <br>
  <div align="right"><b>USUARIOS DEL SISTEMA</b></div>
  <br>
  <h2><? echo $nombre; ?></h2> 
  <hr>
  <form name='proyectex' method='post' action='session_proyectos.php?idusersession=<? echo $_REQUEST[idusersession]; ?>'>
  Proyecto: <? 
   echo "<select name='proyecto'>"; 
     cargar_proyecto($proyecto);
    echo "</select>";
   ?> 
   <input type='submit' name='asignar' value="asignarle"> 
   <? echo "<font size='2' color='red'>".$error."</font>"; ?>
   </form>
  <hr>
  <div id='Layer1' style=' height:450px; overflow: scroll;'>
  
  <table align='center' width="500" border='1'>
  <tr bgcolor='#000000'><td><font size='2' color='#fff'>Id</td><td><font size='2' color='#fff'>Proyecto Asignado a la session Usuario</td><td><font size='2' color='#fff'>Operacion</td></tr>
  <? lista_proyectos_relacionado($_REQUEST[idusersession]); ?> 

  </table>
  
   </div>
  
</div>
</div>

<? include("pie.php");

function lista_proyectos_relacionado($idusersession)
{

   
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena = "select * from proyecto join proyecto_usersession on proyecto.idproyecto  =  proyecto_usersession.idproyecto where  	proyecto_usersession.idusersession='$idusersession'";
   $tabla = mysql_query($cadena, $conexion);   
   $i=1;
   while ($registro = mysql_fetch_array($tabla))
   {
      echo "<tr>";  
      echo "<td>$i</td>";
      echo "<td>$registro[1]</td>";
      echo "<td><a href='session_proyectos.php?idusersession=$idusersession&idproyecto=$registro[0]&quitozo=1'>Quitar</a></td>";
      echo "</tr>";
      $i = $i + 1;
    }
  
    mysql_free_result($tabla);
   mysql_close($conexion);




}

?>
