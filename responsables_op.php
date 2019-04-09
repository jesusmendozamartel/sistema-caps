<? include("cabecera.php"); 
   include("funciones.php");



   if($_POST["grabar"])
   {
	  if($_POST["nombre"]<>"" and $_POST["apellido"]<>"" )
	   {
		
		if($_REQUEST["op"]=="nuevo")
		{
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$dni = $_POST["dni"];
		$codigoant = $_POST["codigoant"];
		$cadena = "insert into responsable (idresponsable,nombre,apellido,dni,control) values ('','$nombre','$apellido','$dni','$codigoant')";
		//echo $cadena;
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		}else 
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$dni = $_POST["dni"];
		$codigoant = $_POST["codigoant"];
		$idresponsable = $_REQUEST["idresponsable"];
		$cadena = "update responsable set nombre='$nombre',apellido='$apellido',dni='$dni',control='$codigoant'  where idresponsable='$idresponsable'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);
		  
		  
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=responsables.php">  
          </head> 
	
		<?		
		}
		
   }
   if($_REQUEST["op"]<>"nuevo")
   {                                                        

	 $nombre = retorna_cadena($_REQUEST["idresponsable"],"idresponsable",1,"responsable");
	 $apellido = retorna_cadena($_REQUEST["idresponsable"],"idresponsable",2,"responsable");
	 $dni = retorna_cadena($_REQUEST["idresponsable"],"idresponsable",3,"responsable");
	 $codigoant = retorna_cadena($_REQUEST["idresponsable"],"idresponsable",4,"responsable");
   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE RESPONSABLES</b></div><hr>
<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVO RESPONSABLE</h1></center>
<? }else { ?>
<center><h1>EDITAR RESPONSABLE</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="responsables.php"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>   
<form name='nuevaopcion' method='post' action='responsables_op.php?&op=<?php echo $_REQUEST["op"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='responsables_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idresponsable=<?php echo $_REQUEST["idresponsable"];?>'>
<? }?>
<tr><td><b>Nombre</b></td><td>:</td><td> <input name='nombre' size="35" value='<? echo $nombre; ?>' ></td></tr>
<tr><td><b>Apellido</b></td><td>:</td><td> <input name='apellido' size="35" value='<? echo $apellido; ?>' ></td></tr>
<tr><td><b>dni</b></td><td>:</td><td> <input name='dni' size="35" value='<? echo $dni; ?>' ></td></tr>
<tr><td><b>C&oacute;digo anterior</b></td><td>:</td><td> <input name='codigoant' value='<? echo  $codigoant; ?>'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>