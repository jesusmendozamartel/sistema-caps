<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');


  
     $descripcionproy = retorna_cadena($_REQUEST["idproyecto"],"idproyecto",1,"proyecto");
	 
     
   
   if($_POST["grabar"])
   {
      //echo $_REQUEST["idproyecto"];
	  if($_POST["descripcion"]<>"")
	   {
		 
		 
		if($_REQUEST["op"]=="nuevo")
		{
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$descripcion = $_POST["descripcion"];
		$codigoant = $_POST["codigoant"];
		$fecha = $_POST["fecha"]; 
		$idproyecto = $_REQUEST["idproyecto"];
		$cadena = "insert into actividadproyecto (idactividad,descripcion,fechactividad,idproyecto,CACTI) values (NULL,'$descripcion','$fecha','$idproyecto','$codigoant')";		
		mysql_query($cadena,$conexion);
	  //  mysql_free_result($tabla);
	    mysql_close($conexion);
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$idactividad = $_REQUEST["idactividad"];
		$descripcion = $_POST["descripcion"];
		$codigoant = $_POST["codigoant"];
		$fecha = $_POST["fecha"]; 
		$idproyecto = $_REQUEST["idproyecto"];
		$cadena = "update actividadproyecto set descripcion='$descripcion',fechactividad='$fecha',CACTI='$codigoant' where idactividad='$idactividad'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);	  
		
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_actividades.php?&idproyecto=<?php echo $_REQUEST["idproyecto"];?>">  
          </head> 
		 
	
		<?		
		}
		
   }
   if($_REQUEST["op"]==editar)
	 {
	   $descripcion = retorna_cadena($_REQUEST["idactividad"],"idactividad",1,"actividadproyecto");
	   $fecha  = retorna_cadena($_REQUEST["idactividad"],"idactividad",2,"actividadproyecto");
	   $codigoant = retorna_cadena($_REQUEST["idactividad"],"idactividad",4,"actividadproyecto");
	 
	 }
   
?>
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>
<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_proyectos.php")?>
<div align="right"><b>CONFIGURACION DE PROYECTOS: <font size="3" color="red"><? echo $descripcionproy; ?></font></b></div><hr>
<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVA ACTIVIDAD</h1></center>
<? }else { ?>
<center><h1>EDITAR ACTIVIDAD</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="proyecto_actividades.php?&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='actividad_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='actividad_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<?php echo $_REQUEST["idproyecto"];?>&idactividad=<?php echo $_REQUEST["idactividad"];?>'>
<? }?>
<tr><td><b>Nombre Actividad</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td><b>Fecha Actividad</b></td><td>:</td><td> <input id='fecha' name='fecha' value='<? echo $fecha; ?>'>
<a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>
    <div id="calendario">
    <?php calendar_html() ?>
	</div> 
	
</td></tr>
<tr><td><b>C&oacute;digo anterior</b></td><td>:</td><td> <input name='codigoant' value='<? echo  $codigoant; ?>'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>
