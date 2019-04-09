<?php 
   include("cabecera.php"); 
   include("funciones.php");
  
   
   if($_POST["grabar"])
   {
     if($_REQUEST["op"]=="nuevo")
	 {
	   $sw=grabando_nueva_distrito($_REQUEST["idprov"],$_POST["descripcion"]);
	  
	   if($sw==1){
       ?>
       <head>         
 		 <META HTTP-EQUIV="Refresh" CONTENT="0; URL=distritos.php?id=<?php echo  $_REQUEST["id"]; ?>&idprov=<? echo $_REQUEST["idprov"]; ?>">
        </head>
		
      <?
         }	  
	 }else
	 {
	   $sw=grabando_edicion_distrito($_REQUEST[idprov],$_POST["descripcion"],$_REQUEST[iddist]); 
	   if($sw==1){
       ?>
         <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=distritos.php?id=<?php echo  $_REQUEST["id"]; ?>&idprov=<? echo $_REQUEST["idprov"]; ?>">
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
	    $depa = retorna_cadena($_REQUEST["id"],"iddepartamento",1,"departamento");
	    $prov = retorna_cadena($_REQUEST["idprov"],"idprovincia",1,"provincia");
		$descripcion = retorna_cadena($_REQUEST["iddist"],"iddistrito",1,"distrito");
	    echo "<h2>Regi&oacute;n: ".$depa." > ".$prov."</h2>";
	 ?><hr>
	 <h1>Datos del distrito/ Centro Poblado</h1>
	 
	
	 <?php 
	 
	   if($_REQUEST["op"]=="nuevo")
	   {
	      $id = $_REQUEST["id"];
		  $idprov = $_REQUEST["idprov"];
		 
	      echo "<form name='nuevo' method='post' action='distrito.php?id=$id&idprov=$idprov&op=nuevo' >";
	   
	   }else
	      {
		   $idregion = $_REQUEST["id"];
		   $idprov = $_REQUEST["idprov"];
		   $iddist = $_REQUEST["iddist"];
		   echo "<form name='nuevo' method='post' action='distrito.php?id=$idregion&op=editar&idprov=$idprov&iddist=$iddist' >";
		  
		  }
		  
		  echo "<input name='descripcion' size='50' value='$descripcion'>";
		  echo "<input type='submit' name='grabar' value='Grabar'>";
	    echo "</form>";
	 ?>
	</div>
</div>
</div>

<? include("pie.php") ?>