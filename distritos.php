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
        	 
	    mostrar_distritos($_REQUEST["id"],$_REQUEST["idprov"]); 
	 
	 ?>
	</div>
</div>
</div>

<? include("pie.php") ?>