<? include("cabecera.php"); 
   include("funciones.php");
   $idproyecto = $_REQUEST["idproyecto"];
   $proyecto = retorna_cadena($idproyecto,"idproyecto",1,"proyecto");
  

   if($_REQUEST[op]=='editar' || $_REQUEST[op]=="eliminar")
   {
       $idactividad = $_REQUEST["idactividad"];
       $actividad = retorna_cadena($idactividad,"idactividad",1,"actividadproyecto");
       $codigo  = retorna_cadena($idactividad,"idactividad",4,"actividadproyecto");

   }
   if($_POST["grabar"])
   {

      $actividad = $_POST["actividad"];
      $codigo  = $_POST["codigo"];
      $idproyecto = $_REQUEST["idproyecto"];
      $fecha = date("d-m-Y H:i:s");
      if($_REQUEST["op"]=="nuevo")
      {
        $variables = "idactividad,descripcion,fechactividad,idproyecto,CACTI";
        $valores = "NULL,'$actividad','$fecha','$idproyecto','$codigo'";
        $cadena = "insert into actividadproyecto ($variable) values ($valores)";
      }else
          {
            $idactividad = $_REQUEST["idactividad"];
            $cadena = "update actividadproyecto set descripcion='$actividad',fechactividad='$fecha',CACTI='$codigo' where idactividad = '$idactividad'";    
           }
   
       if($cadena<>"")
       {
            $conexion = conectar_base();
            mysql_select_db ("sistemaatencion",$conexion);
            mysql_query("SET NAMES utf8");	
	    mysql_query($cadena,$conexion);
            mysql_close($conexion);
           ?>
 
  	   <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_actividadp.php?idproyecto=<? echo $idproyecto; ?>">
            </head>

            <?

        }
   }
   if($_POST["eliminar"])
   {
     $cadena = "delete from actividadproyecto where idactividad = '$idactividad' ";

            $conexion = conectar_base();
            mysql_select_db ("sistemaatencion",$conexion);	
	    mysql_query($cadena,$conexion);
            mysql_close($conexion);
           ?>

  	   <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_actividadp.php?idproyecto=<? echo $idproyecto; ?>">
            </head>

            <?
  
   }

?>

<div class="div1">
<div class="contenido">

<div align="right"><a href="proyecto_actividadp.php?idproyecto=<? echo $idproyecto; ?>"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
<br><br>
<?

   if($_REQUEST['op']=='nuevo')
   {
?>

<form name="grabando" action='actividadproyecto2_op.php?op=<? echo $_REQUEST[op]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"];  ?>' method='post'>

<?
   }else{

?>
   <form name="grabando" action='actividadproyecto2_op.php?op=<? echo $_REQUEST[op]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>&idactividad=<? echo $_REQUEST[idactividad];?>' method='post'>
<?

}

?>
<table  align='center' cellspacing= 1 cellpalding= 1 bgcolor='#000000'><tr><td>
<table  bgcolor='#ffffff'>
   
  <tr><td bgcolor='#000000' colspan='2'><font color='#ffffff'>ACTIVIDAD-CMB</td></tr>
   <tr><td><b>Proyecto:</b> </td><td><?
     echo $proyecto;

    ?></td></tr>
  <tr><td><b>Nombre de la Actividad - CMB:</b> </td><td>
  <? if($_REQUEST["op"]=="eliminar"){ ?> 
   <? echo $actividad; ?>

  <? }else{ ?>
   <input value='<? echo $actividad; ?>' name='actividad'>
<? }?>
</td></tr>
  <tr><td><b>Variable libre:</b> </td><td>
  <? if($_REQUEST["op"]=="eliminar"){ ?> 
     <? echo $codigo; ?>
  <? }else{ ?>
    <input value="<? echo $codigo; ?>" name='codigo'></td></tr>
    
  <? }?>
  <tr><td colspan='2' align="center">
   <? if($_REQUEST["op"]=="eliminar"){ ?> 
    <input name='eliminar' type='submit' value='eliminar'> <br><br><font size='2'>Esta eliminaci&oacute;n debe hacerlo si esta seguro, sino habra actividades inconsistentes
   <? }else{ ?>
     <input name='grabar' type='submit' value='grabar'>
   <? } ?>
 </td></tr>
</table>
</td></tr></table>
</form>
</div></div>

<?

?>
