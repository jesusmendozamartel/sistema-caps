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
		$codigoant = $_POST["codigoant"];
		$cadena = "insert into lugaratencion (idlugar,codigoviejo,descripcion) values ('','$codigoant','$descripcion')";
		//echo $cadena;
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$descripcion = $_POST["descripcion"];
		$codigoant = $_POST["codigoant"];
		$idlugar = $_REQUEST["idlugar"];
		$cadena = "update lugaratencion set descripcion='$descripcion',codigoviejo='$codigoant' where idlugar='$idlugar'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		  
		  
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=lugaratencion.php">  
          </head> 
	
		<?		
		}
		
   }
     if($_REQUEST["op"]<>"nuevo")
   {
     $descripcion = retorna_cadena($_REQUEST["idlugar"],"idlugar",2,"lugaratencion");
     $codigoant = retorna_cadena($_REQUEST["idlugar"],"idlugar",1,"lugaratencion");
	 
   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE PROYECTOS</b></div><hr>
<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVO LUGAR DE ATENCION</h1></center>
<? }else { ?>
<center><h1>EDITAR LUGAR DE ATENCION</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="lugaratencion.php"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='lugaratencion_op.php?&op=<?php echo $_REQUEST["op"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='lugaratencion_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idlugar=<?php echo $_REQUEST["idlugar"];?>'>
<? }?>


<tr><td><b>Nombre Lugar</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td><b>C&oacute;digo anterior</b></td><td>:</td><td> <input name='codigoant' value='<? echo  $codigoant; ?>'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>