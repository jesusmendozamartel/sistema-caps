<?php

   include("cabecera.php"); 
   include("funciones.php");
    $conexion = conectar_base();
    mysql_select_db ("sistemaatencion",$conexion);
	$id=$_REQUEST["id"];
	$objeto = $_REQUEST["objeto"];
	switch($objeto)
	{ 
      case 1: $cadena = "delete FROM departamento where iddepartamento='$id'";
	          $ruta = "altaregion.php";
	          break;
	   
	 }
	//echo $cadena;
	
	mysql_query($cadena, $conexion);
	
   // mysql_free_result($tabla);
	mysql_close($conexion);
altaregion.php

?>

<div class="div1">
<div class="contenido">
</div>
 <head>         Eliminando
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?php echo $ruta; ?>">
        </head>
</div>

<? include("pie.php") ?>