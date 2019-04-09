<?php 
   include("cabecera.php"); 
   include("funciones.php");
  
   
   if($_POST["grabar"])
   {
     if($_REQUEST["op"]=="nuevo")
	 {
	   $sw=grabando_nueva_provincia($_REQUEST["id"],$_POST["descripcion"]);
	  
	   if($sw==1){
       ?>
        <head>         
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=provincias.php?id=<?php echo  $_REQUEST["id"]; ?>">
        </head>
      <?
         }	  
	 }else
	 {
	   $sw=grabando_edicion_provincia($_REQUEST[id],$_POST["descripcion"],$_REQUEST[idprov]); 
	   if($sw==1){
       ?>
        <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=provincias.php?id=<?php echo  $_REQUEST["id"]; ?>">
        </head>
      <?
         }
	   
	   }
     
   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <? include("menu_adm.php")?>
   <div align="right">
	<h2>Configuracion: Mantenimiento de Regiones</h2><hr>
	</div>
	<div align="center">
	 
  
     <?php
	    $nombre = retorna_cadena($_REQUEST["id"],"iddepartamento",1,"departamento");
	    $descripcion = retorna_cadena($_REQUEST["idprov"],"idprovincia",1,"provincia");
	    echo "<h2>Regi&oacute;n: ".$nombre."</h2>";
	 ?>
	 <h1>Datos de la Provincia</h1>
	 
	
	 <?php 
	 
	   if($_REQUEST["op"]=="nuevo")
	   {
	      $id = $_REQUEST["id"];
	      echo "<form name='nuevo' method='post' action='provincia.php?id=$id&op=nuevo' >";
	   
	   }else
	      {
		   $idregion = $_REQUEST["id"];
		   $idprov = $_REQUEST["idprov"];
		   echo "<form name='nuevo' method='post' action='provincia.php?id=$idregion&op=editar&idprov=$idprov' >";
		  
		  }
		  
		  echo "<input name='descripcion' size='50' value='$descripcion'>";
		  echo "<input type='submit' name='grabar' value='Grabar'>";
	    echo "</form>";
	 ?>
	 
	 </div>
	
</div>
</div>

<? include("pie.php") ?>