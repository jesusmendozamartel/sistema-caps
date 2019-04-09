<? include("cabecera.php"); 
   include("funciones.php");  
   $nombres = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
   $apellidos = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
   $iduser = $_REQUEST['iduser'];
   if($_POST['grabar'])
   {
      $conexion = conectar_base(); 
      mysql_select_db ("sistemaatencion",$conexion);
	  $cadena = "select * from cuestionariotortura where iduser='$_REQUEST[iduser]'";	  
      $tabla = mysql_query($cadena, $conexion);   
      $numero = mysql_num_rows($tabla);
	  if($numero==0)
	  {
	    $cadena = "insert into cuestionariotortura (idcuestionariotortura,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,observaciones,iduser) values ('','$_POST[pregunta1]','$_POST[pregunta2]','$_POST[pregunta3]','$_POST[pregunta4]','$_POST[pregunta5]','$_POST[observaciones]',$iduser)";
		  
	     
	  }else
	     {
		//  $cadena = "update departamento set descripcion='$descripcion' where iddepartamento='$id'";
		  $cadena ="update cuestionariotortura set pregunta1='$_POST[pregunta1]',pregunta2='$_POST[pregunta2]',pregunta3='$_POST[pregunta3]',pregunta4='$_POST[pregunta4]',pregunta5='$_POST[pregunta5]',observaciones='$_POST[observaciones]'  where iduser=$iduser"; 
		 
		 }
		 //echo $cadena;
		   mysql_query($cadena,$conexion);
		   mysql_close($conexion);
		   
		   ?>
	    <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=datosusuarios.php?accion=editar&iduser=<? echo $_REQUEST["iduser"]?>">
        </head>
	   <?
   
   }
	 $pregunta1 =  retorna_cadena($_REQUEST["iduser"],"iduser",1,"cuestionariotortura");
	 $pregunta2 =  retorna_cadena($_REQUEST["iduser"],"iduser",2,"cuestionariotortura");
	 $pregunta3 =  retorna_cadena($_REQUEST["iduser"],"iduser",3,"cuestionariotortura");
	 $pregunta4 =  retorna_cadena($_REQUEST["iduser"],"iduser",4,"cuestionariotortura");
	 $pregunta5 =  retorna_cadena($_REQUEST["iduser"],"iduser",5,"cuestionariotortura");
     $observaciones = retorna_cadena($_REQUEST["iduser"],"iduser",6,"cuestionariotortura");
   
?>

<div class="div2">
<div class="contenido2">
  <br>
   <b>CUESTIONARIO POR HABER SIDO VICTIMA DE TORTURA DEL USUARIO: <?php echo $nombres." ".$apellidos; ?></b>
   <br><br>
   <?php
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from tipoafeccion";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
	echo "<form name='grabar' method='post' action='encuestatortura.php?iduser=$_REQUEST[iduser]'>";
	
	echo "Tipo de Tortura &iquest;Ha sido tratado cruelmente alguna vez? Explicaci&oacute;n del contexto en que se produjo la tortura, fechas y lugares. Tipo de tortura padecida. Autor/es de los actos de tortura)<br>";
	echo "<textarea cols='100' name='pregunta1' value='$pregunta1'>$pregunta1</textarea>";
	echo "<br><br><b>Secuelas</b><br>";
	echo "F&iacute;sicas<br>";
	echo "<textarea cols='100' name='pregunta2' value='$pregunta2'>$pregunta2</textarea>";	
	echo "<br><br>Psicol&oacute;gicas<br>";
	echo "<textarea cols='100' name='pregunta3' value='$pregunta3'>$pregunta3</textarea>";
	echo "<br><br>Sexuales<br>";
	echo "<textarea cols='100' name='pregunta4' value='$pregunta4'>$pregunta4</textarea>";
	echo "<br><br>Sociales<br>";
	echo "<textarea cols='100' name='pregunta5' value='$pregunta5'>$pregunta5</textarea>";
	echo "<br><br>Observaciones<br>";
	echo "<textarea cols='100' name='observaciones' value='$observaciones'>$observaciones</textarea>";
	echo "<center><br><input name='grabar' type='submit' value='grabar'>";
	echo "</form>";
	?>
</div>
</div>

<? include("pie.php") ?>
