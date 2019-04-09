<? include("cabecera.php"); 
   include("funciones.php");


  
   if($_POST["grabar"])
   {
	  if($_POST["descripcion"]<>"")
	   {
		
		if($_REQUEST["op"]=="nuevo")
		{
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$descripcion = $_POST["descripcion"];
		$cadena = "insert into zonaintervencion (idzonaintervencion,descripcion) values (NULL,'$descripcion')";
		//echo $cadena;
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$descripcion = $_POST["descripcion"];
		$idzonaintervencion = $_REQUEST["idzonaintervencion"];
		$cadena = "update zonaintervencion set descripcion='$descripcion' where idzonaintervencion='$idzonaintervencion'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		  
		  
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=zonaintervencion.php">  
          </head> 
	
		<?		
		}
		
   }
    if($_REQUEST["op"]<>"nuevo")
   {
     $descripcion = retorna_cadena($_REQUEST["idzonaintervencion"],"idzonaintervencion",1,"zonaintervencion");
     
   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE ZONA DE INTERVENCION</b></div><hr>
<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVA ZONA DE INTERVENCION</h1></center>
<? }else { ?>
<center><h1>EDITAR ZONA DE INTERVENCION</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="zonaintervencion.php"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='zonaintervencion_op.php?&op=<?php echo $_REQUEST["op"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='zonaintervencion_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idzonaintervencion=<?php echo $_REQUEST["idzonaintervencion"];?>'>
<? }?>
<tr><td><b>Zona de intervenci&oacute;n</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>
