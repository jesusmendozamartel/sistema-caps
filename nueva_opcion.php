<?

 include("cabecera.php");
 include("funciones.php");
 
 if($_POST["grabar"])
 {
     if($_POST["descripcion"])
	 {
	    $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$cadena = "insert into pregunta (idpregunta,pregunta,idencuesta) values ('','$_REQUEST[descripcion]','$_REQUEST[idencuesta]')";
	    echo $cadena;
		mysql_query($cadena,$conexion);
	    mysql_free_result($tabla);
	    mysql_close($conexion);
		
		?>
		
		  <head>        
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=adm_opciones.php?idencuesta=<?php echo  $_REQUEST['idencuesta']; ?>">
         </head> 
	
		<?
	 }  
 }

?>

<div class="div1">
<div class="contenido">
 <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br><br>
  <? include("menu_adm.php")?>
<hr>

<h1><center>CREANDO OPCI&Oacute;N</center></h1>

<table bgcolor='#000000' align="center">
<tr><td>
<table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="adm_opciones.php?idencuesta=<? echo $_REQUEST["idencuesta"]; ?>"><img src="imagenes/cerrar.jpg" border="1"></a></td></tr>
<form name='nuevaopcion' method='post' action='nueva_opcion.php?idencuesta=<? echo $_REQUEST["idencuesta"]; ?>'>
<tr><td><b>Descripci&oacute;n Opci&oacute;n</b></td><td>:</td><td> <input name='descripcion'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
</td></tr>
</table>

</div>
</div>

<? include("pie.php") ?>