<? session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
 <?php 
  error_reporting(E_ALL ^ E_NOTICE); 
 ?>
 
<head>

	<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

	<link rel="stylesheet" type="text/css" media="screen" href="css/estilo	.css" />

	<title>Sistema de Atenciones CAPS</title>
    <script language="javascript" src="js/jquery-1.2.6.min.js"></script>
	<LINK REL="Shortcut Icon" HREF="favicon.ico">
	<script language="JavaScript">
function Abrir_ventana (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=558, height=405, top=85, left=140";
window.open(pagina,"",opciones);
}
function Abrir_ventana2 (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=600, top=85, left=140";
window.open(pagina,"",opciones);

}
</script>

	<script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#cmbdepartamento").change(function () {
   		$("#cmbdepartamento option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbdepartamento.php", { elegido: elegido }, function(data){
				$("#cmbprovincia").html(data);
				$("#cmbdistrito").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#cmbprovincia").change(function () {
   		$("#cmbprovincia option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbprovincia.php", { elegido: elegido }, function(data){
				$("#cmbdistrito").html(data);
			});			
        });
   })
   
   
   
   $("#cmbdepartamentoresidencia").change(function () {
   		$("#cmbdepartamentoresidencia option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbdepartamento.php", { elegido: elegido }, function(data){
				$("#cmbprovinciaresidencia").html(data);
				$("#cmbdistritoresidencia").html("");
			});			
        });
   })
	// Parametros para el combo2  cmbdistritoresidencia
	$("#cmbprovinciaresidencia").change(function () {
   		$("#cmbprovinciaresidencia option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbprovincia.php", { elegido: elegido }, function(data){
				$("#cmbdistritoresidencia").html(data);
			});			
        });
   })
   
   $("#cmbarea").change(function () {
   		$("#cmbarea option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbarea.php", { elegido: elegido }, function(data){
				$("#cmbsubarea").html(data);
				
			});			
        });
   })
   
   
   $("#cmbproyecto").change(function () {
   		$("#cmbproyecto option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("cmbproyecto.php", { elegido: elegido }, function(data){
				$("#cmbactividadesproy").html(data);
				
			});			
        });
   })
   
});
</script>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<?php

 if($_COOKIE["usuario"]=="")
 {
   ?>
		<SCRIPT LANGUAGE="javascript">location.href = "login.php";</SCRIPT>
	<?
  }
?>
<center>
<div id="cuerpo" span="cuerpo">
<? include("menu.php"); ?>
