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
		$cadena = "insert into tipousuario (idtipousuario,descripcion,control) values ('','$descripcion','$codigoant')";
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
		$idtipousuario = $_REQUEST["idtipousuario"];
		$cadena = "update tipousuario set descripcion='$descripcion',control='$codigoant' where idtipousuario='$idtipousuario'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		  
		  
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=tiposusuarios.php">  
          </head> 
	
		<?		
		}
		
   }
   if($_REQUEST["op"]<>"nuevo")
   {                                                        
     $descripcion = retorna_cadena($_REQUEST["idtipousuario"],"idtipousuario",1,"tipousuario");
     $codigoant = retorna_cadena($_REQUEST["idtipousuario"],"idtipousuario",2,"tipousuario");
   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE TIPOS DE USUARIO</b></div><hr>
<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVO TIPO DE USUARIO</h1></center>
<? }else { ?>
<center><h1>EDITAR TIPO DE USUARIO</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="tiposusuarios.php"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='tipousuarios_op.php?&op=<?php echo $_REQUEST["op"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='tipousuarios_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idtipousuario=<?php echo $_REQUEST["idtipousuario"];?>'>
<? }?>
<tr><td><b>Nombre Proyecto</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td><b>C&oacute;digo anterior</b></td><td>:</td><td> <input name='codigoant' value='<? echo  $codigoant; ?>'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>