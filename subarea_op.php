<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');


  
     $area = retorna_cadena($_REQUEST["idarea"],"idarea",1,"area");
	 
     
   
   if($_POST["grabar"])
   {
      //echo $_REQUEST["idproyecto"];
	  if($_POST["descripcion"]<>"" and $_POST["control"]<>"")
	   {
		 
		 
		if($_REQUEST["op"]=="nuevo")
		{
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$descripcion = $_POST["descripcion"];
		$control = $_POST["control"];
		
		$idarea = $_REQUEST["idarea"];
		$cadena = "insert into subarea (idsubarea,descripcion,idarea,control) values (NULL,'$descripcion','$idarea','$control')";		
		mysql_query($cadena,$conexion);
	  //  mysql_free_result($tabla);
	    mysql_close($conexion);
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$idsubarea = $_REQUEST["idsubarea"];
		$descripcion = $_POST["descripcion"];
		$control = $_POST["control"];
		$idarea = $_REQUEST["idarea"];
		$cadena = "update subarea set descripcion='$descripcion',control='$control' where idsubarea='$idsubarea'";
		
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);	  
		
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=subarea.php?&idarea=<? echo $_REQUEST["idarea"]; ?>">  
          </head> 
		 
	
		<?		
		}
		
   }
   if($_REQUEST["op"]==editar)
	 {
	   $descripcion = retorna_cadena($_REQUEST["idsubarea"],"idsubarea",1,"subarea");
	   $control = retorna_cadena($_REQUEST["idsubarea"],"idsubarea",3,"subarea");
	 
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
  <? include("menu_adm.php")?>
  <div align="right"><b>AREA: <font size="3" color="RED"><?php echo $area; ?></font></b></div>

<br>
 <div class="scroll2">
<br>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<center><h1>NUEVA SUB AREA</h1></center>
<? }else { ?>
<center><h1>EDITAR SUB AREA</h1></center>
<? }?>
 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="subarea.php?&idarea=<? echo $_REQUEST["idarea"]; ?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='subarea_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idarea=<? echo $_REQUEST["idarea"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='subarea_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idarea=<?php echo $_REQUEST["idarea"];?>&idsubarea=<?php echo $_REQUEST["idsubarea"];?>'>
<? }?>
<tr><td><b>Nombre Sub Area</b></td><td>:</td><td> <input name='descripcion' size="35" value='<? echo $descripcion; ?>' ></td></tr>
<tr><td><b>Control</b></td><td>:</td><td> <input name='control' value='<? echo  $control; ?>'></td></tr>
<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
 
</div>
</div>
</div>

<? include("pie.php") ?>
