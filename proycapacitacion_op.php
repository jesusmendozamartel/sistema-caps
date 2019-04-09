<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');


  
     $descripcionproy = retorna_cadena($_REQUEST["idproyecto"],"idproyecto",1,"proyecto");
	 
     $idproyecto = $_REQUEST["idproyecto"];
   
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
		$fecha = $_POST["fecha"];
		$lugarevento = $_POST["lugarevento"];
		$duracion = $_POST["duracion"];
		$idzonaintervencion = $_POST["idzonaintervencion"];
		$idproyecto =$_REQUEST["idproyecto"];
                $idactividad = $_POST["idactividad"];
                $responsable1 = $_POST["responsable1"];
                $responsable2 = $_POST["responsable2"];
                $responsable3 = $_POST["responsable3"];
		$responsable4 = $_POST["responsable4"];
		
		
                 $idsession = $_COOKIE["idsession"];
               
		$cadena = "insert into capacitacion (idcapacitacion,descripcion,fecha,lugarevento,duracion,idzonaintervencion,idproyecto, idactividad, responsable1, responsable2, responsable3, responsable4,idsession,bloqueado) values (NULL,'$descripcion','$fecha','$lugarevento','$duracion','$idzonaintervencion','$idproyecto', '$idactividad', '$responsable1', '$responsable2', '$responsable3', '$responsable4',$idsession,'0')";		
     // echo $cadena;	
   	mysql_query($cadena,$conexion);
        mysql_free_result($tabla);
	    mysql_close($conexion);
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		
		$descripcion = $_POST["descripcion"];
		$fecha = $_POST["fecha"];
		$lugarevento = $_POST["lugarevento"];
		$duracion = $_POST["duracion"];
		$idzonaintervencion = $_POST["idzonaintervencion"];
		$idproyecto =$_REQUEST["idproyecto"];		
		$idcapacitacion = $_REQUEST["idcapacitacion"];
               $idactividad = $_POST["idactividad"];
                $responsable1 = $_POST["responsable1"];
                $responsable2 = $_POST["responsable2"];
                $responsable3 = $_POST["responsable3"];
		$responsable4 = $_POST["responsable4"];
		
		$cadena = "update capacitacion set descripcion='$descripcion',fecha='$fecha',lugarevento='$lugarevento',duracion='$duracion',idzonaintervencion='$idzonaintervencion', idactividad = '$idactividad', responsable1='$responsable1', responsable2='$responsable2', responsable3='$responsable3', responsable4='$responsable4'  where idcapacitacion='$idcapacitacion'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);	  
		
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_capacitaciones.php?&idproyecto=<?php echo $_REQUEST["idproyecto"];?>">  
          </head> 
		 
	  
		<?		
		}
		
   }
   if($_REQUEST["op"]==editar)
	 {
	   
	   $descripcion = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",1,"capacitacion");
	   $fecha = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",2,"capacitacion");
	   $lugarevento =  retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",3,"capacitacion");
           $duracion =  retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",4,"capacitacion");
	   $idzonaintervencion =  retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",5,"capacitacion");
           $idactividad = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",7,"capacitacion");;
           $responsable1 = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",8,"capacitacion");
           $responsable2 = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",9,"capacitacion");
           $responsable3 = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",10,"capacitacion");
	   $responsable4 =retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",11,"capacitacion");
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
<center><h1>NUEVA CAPACITACION</h1></center>
<? }else { ?>
<center><h1>EDITAR CAPACITACION</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="proyecto_capacitaciones.php?&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='proycapacitacion_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='proycapacitacion_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<?php echo $_REQUEST["idproyecto"];?>&idcapacitacion=<?php echo $_REQUEST["idcapacitacion"];?>'>
<? }?>
<tr><td width="300"><b><font size="2">Actividad</b></td><td>:</td><td> 
 <?
    
    cargar_actividad_proyecto($idactividad,$idproyecto); ?>
                                     
</td></tr>
<tr><td><b><font size="2">Nombre de la actividad</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td><b><font size="2">Fecha</b></td><td>:</td><td> <input id='fecha' name='fecha' value='<? echo $fecha; ?>'>
<a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>
    <div id="calendario">
    <?php calendar_html() ?>
	</div> 
<tr><td><b><font size="2">Lugar</b></td><td>:</td><td> <input name='lugarevento' value='<? echo $lugarevento; ?>'>

<tr><td><b><font size="2">Zona de Intervenci&oacute;n</b></td><td>:</td><td> <select  name='idzonaintervencion' value='<? echo $idzonaintervencion; ?>'>
<? cargar_zonas($idzonaintervencion); ?>   
</select>	
</td></tr>
<tr><td><b><font size="2">Responsable_1</b></td><td>:</td><td> 
   <? echo "<select name='responsable1' id='responsable1' >";
     cargar_responsable($responsable1); 
     echo "</select></td></tr>" ?>
<tr><td><b><font size="2">Responsable_2</b></td><td>:</td><td> 
    <? echo "<select name='responsable2' id='responsable2' >";
   cargar_responsable($responsable2); 
  echo "</select></td></tr>" ?>
    
<tr><td><b><font size="2">Responsable_3</b></td><td>:</td><td> <? echo "<select name='responsable3' id='responsable3' >";
   cargar_responsable($responsable3); 
   echo "</select></td></tr>" ?>

<tr><td><b><font size="2">Responsable_4</b></td><td>:</td><td> <? echo "<select name='responsable4' id='responsable4' >";
   cargar_responsable($responsable4); 
  echo "</select></td></tr>" ?>



<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>
