<? include("cabecera.php"); 
   include("funciones.php");
   $descipcioncapacitacion = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",1,"capacitacion");
   
   if($_POST["grabar"])
   {
      $idcapacitado = retorna_cadena($_POST["documento"],"documento",0,"capacitados");
      if($idcapacitado>0)
	  {
	   $idcapacitacion = $_REQUEST["idcapacitacion"];
	   $cadena = "SELECT * FROM capacitacionuser WHERE idcapacitacion='$idcapacitacion' and  idcapacitado='$idcapacitado'";
       $conexion = conectar_base(); 
       mysql_select_db ("sistemaatencion",$conexion);
	   $tabla = mysql_query($cadena, $conexion);   
       $numero = mysql_num_rows($tabla);
	   mysql_free_result($tabla);
	   
	   if($numero == 0)
	   {
	     
		 $cadena = "insert into capacitacionuser (idcapacitacionuser,idcapacitacion,idcapacitado) values (NULL,'$idcapacitacion','$idcapacitado')";
		 mysql_query($cadena, $conexion);   
		 $sw=10;
	   
	   }else
	   {
	     $mensaje = "Ya esta Aignado";
	   }
	   mysql_close($conexion);
	   }else
	     {
		   $mensaje = "Cree primero el Capacitado";
		   $creando = "1";
		 }
		 if($sw==10)
		 {
		 
		 ?>
		 
		 <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=capacitaciones_capacitados.php?editablelist=1&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>&idcapacitacion=<? echo $_REQUEST["idcapacitacion"];?>">  
          </head> 
		 
		 
		 <?
		 
		 }
	   
   }
?>

<div class="div1">
<div class="contenido">
 
   <b>MODULO DE CAPACITADOS</b>
   
<? include("menu_capacitado.php"); ?><hr>
<table width="100%"><tr><td>
<div align="left"><b>Lista de capacitados:</b> <font color="red" size="3"><b><? echo $descipcioncapacitacion; ?></b></font> </div></td>
<td></td></table>
 <div class="scroll2">
 
<center><h2>Asignando Capacitado </h2></center>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>

<tr bgcolor="#c1a404"><td colspan='3'><a href="capacitaciones_capacitados.php?editablelist=1&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>&idcapacitacion=<? echo $_REQUEST["idcapacitacion"];?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>

<form name='nuevaopcion' method='post' action='asignando_capacitado.php?editablelist=1&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>&idcapacitacion=<? echo $_REQUEST["idcapacitacion"];?>'>

<tr><td><b>Documento</b></td><td>:</td><td> <input name='documento' value='<? echo $documento; ?>'>

<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
 <h1><center><? echo $mensaje; 
  if($creando=="1")
  {
     echo "<a href='capacitado.php?editablelist=1&idproyecto=$_REQUEST[idproyecto]&idcapacitacion=$_REQUEST[idcapacitacion]&op=nuevo'> Aqui</a>"; 

  }
       
?></center></h1>
 
 
</div>
</div>
</div>

<? include("pie.php") ?>
