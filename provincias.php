<? include("cabecera.php"); 
   include("funciones.php");
?>

<div class="div1">
<div class="contenido">
  <br>
   <? include("menu_adm.php")?>
	 <div align="right">
	<h2>Configuracion: Mantenimiento de Regiones</h2>	
	</div>
	<div align="center" class="scroll2">
	 
	
	 <?php 
        	 
	    mostrar_provincias($_REQUEST["id"]); 
	 
	 ?>
	</div>
</div>
</div>

<? include("pie.php") ?>