<?php 
   include("cabecera.php"); 
   include("funciones.php");
  
   
   if($_POST["grabar"])
   {
     if($_REQUEST["op"]=="nuevo")
	 {
	   $sw=grabando_nueva_region($_POST["descripcion"]);
	   if($sw==1){
       ?>
        <head>         
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=altaregion.php">
        </head>
      <?
         }	  
	 }else
	 {
	   $sw=grabando_edicion_region($_REQUEST[id],$_POST["descripcion"]); 
	   if($sw==1){
       ?>
        <head>         
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=altaregion.php">
        </head>
      <?
         }
	   
	   }
     
   }
	  
     
	$descripcion = retorna_cadena($_REQUEST["id"],"iddepartamento",1,"departamento");
	  
	  
?>

<div class="div1">
<div class="contenido">
 <? include("menu_adm.php")?>
<div align="right">
	<h2>Configuracion: Mantenimiento de Regiones</h2><hr>
	</div>
	<div align="center">
  <br>
	 <h1>Datos Regi&oacute;n</h1>
	 
	
	 <?php 
	 
	   if($_REQUEST["op"]=="nuevo")
	   {
	      echo "<form name='nuevo' method='post' action='region.php?op=nuevo' >";
	   
	   }else
	      {
		   $idregion = $_REQUEST["id"];
		   echo "<form name='nuevo' method='post' action='region.php?op=editar&id=$idregion' >";
		  
		  }
		  
		  echo "<input name='descripcion' size='50' value='$descripcion'>";
		  echo "<input type='submit' name='grabar' value='Grabar'>";
	    echo "</form>";
	 ?>
	</div>
</div>
</div>

<? include("pie.php") ?>