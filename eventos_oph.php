<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');
  $idevento=$_REQUEST["idevento"];
  if($_POST["grabar"])
  {
    
     $cmbproyecto = $_POST["cmbproyecto"];
	 
     $cmbactividad = $_POST["cmbactividad"];
	 
	 $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		
		$cadena = "update eventos set idproyecto='$cmbproyecto',idactividadproyecto='$cmbactividad' where ideventos='$idevento'";
	    
		mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);	 
		
		?>
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php">  
          </head> 
		 
		 
		<?
		
  
  }
  
  
  if($idevento)
  {
  
$fecha = retorna_cadena($_REQUEST["idevento"],"ideventos",1,"eventos");
$idarea =  retorna_cadena($_REQUEST["idevento"],"ideventos",2,"eventos");
$idactividad = retorna_cadena($_REQUEST["idevento"],"ideventos",3,"eventos");
$responsable1 = retorna_cadena($_REQUEST["idevento"],"ideventos",4,"eventos");
$responsable2 = retorna_cadena($_REQUEST["idevento"],"ideventos",5,"eventos");
$responsable3 = retorna_cadena($_REQUEST["idevento"],"ideventos",6,"eventos");
$responsable4 = retorna_cadena($_REQUEST["idevento"],"ideventos",7,"eventos");
$nbenificiario = retorna_cadena($_REQUEST["idevento"],"ideventos",8,"eventos");
$nbeneficiariofeminas = retorna_cadena($_REQUEST["idevento"],"ideventos",9,"eventos");
$lugar = retorna_cadena($_REQUEST["idevento"],"ideventos",10,"eventos");
$idzonaintervencion = retorna_cadena($_REQUEST["idevento"],"ideventos",11,"eventos");
$observacion = retorna_cadena($_REQUEST["idevento"],"ideventos",12,"eventos");
$cmproyecto = retorna_cadena($_REQUEST["idevento"],"ideventos",13,"eventos");
$cmbactividad =retorna_cadena($_REQUEST["idevento"],"ideventos",14,"eventos");
$tematratado  =retorna_cadena($_REQUEST["idevento"],"ideventos",15,"eventos");
$numeroprovesaludservicio = retorna_cadena($_REQUEST["ideventos"],"idproyecto",16,"eventos");
$numeroprovesaludpoliciales = retorna_cadena($_REQUEST["idevento"],"ideventos",17,"eventos");
$numerofuncionarioglocal = retorna_cadena($_REQUEST["idevento"],"ideventos",18,"eventos");
$numerofuncionariogregional = retorna_cadena($_REQUEST["idevento"],"ideventos",19,"eventos");
$numerofuncionarioministerio = retorna_cadena($_REQUEST["idevento"],"ideventos",20,"eventos");
$numerofuncionarioaltomin = retorna_cadena($_REQUEST["idevento"],"ideventos",21,"eventos");
$txtfuncionariotro = retorna_cadena($_REQUEST["idevento"],"ideventos",22,"eventos");
$nrootro = retorna_cadena($_REQUEST["idevento"],"ideventos",23,"eventos");
     
  }
  
?>

 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>

<div class="div3">
<div class="contenido3">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_eventos.php")?>
<div align="right"><b>MODULO DE EVENTOS</b></div><hr>
<font face="arial" size="2"><b>Nuevo Evento</b></font><br> 
 
<table>
<tr><td>Proyecto</td><td><input name="proyecto"></td></tr>
<tr><td>Codigo Actividad</td><td><input name="idactividad"></td></tr>
<tr><td>Nombre del evento</td><td><input name="evento"></td></tr>
<tr><td>Fecha</td><td><input name="evento"></td></tr>
<tr><td>Distrito</td><td><input name="evento"></td></tr>
<tr><td>Nombre Local</td><td><textarea name="evento"></textarea></td></tr>
<tr><td colspan="2"><b>Sobre participantes</b></td></tr>
<tr><td colspan="2">Numero de Hombres<input name="nhombres" size="5"> Numero de Mujeres <input name="nmujeres" size="5"></td></tr>

<tr><td colspan="2"><br><b>Perfil de participantes: (para reuni&oacute;n con autoridades):</b></td></tr>
<tr><td colspan="2">
<table width="100%" bgcolor="#ffffff">
<tr bgcolor="#b79407"><td>Descripci&oacute;n</td><td>Nro</tr></tr>
<tr>
<td >Nro L&iacute;der/ezas:</td><td><input name="nliderezas" size="5"> </td>
</tr>
<tr><td colspan='2' height="1" bgcolor="#cacaca"></td></tr>
<tr>
<td >Nro Proveedoras/es o personal de salud en servicio (para diferenciar del personal de salud en puestos administrativos o de direcci&oacute;n):</td><td><input name="nsalud" size="5"></td>
</tr>
<tr><td colspan='2' height="1" bgcolor="#cacaca"></td></tr>
<tr><td >Nro Proveedores/as de otros servicios (PNP, CEMS, colegios, etc.):
</td><td><input name='npolicial' size="5">
</td></tr>
<tr><td colspan='2' height="1" bgcolor="#cacaca"></td></tr>
<tr><td>Nro Funcionaria/os de gobierno local (distrital o provincial):</td><td><input name="ngobiernolocal" size='5'></td></tr>
<tr><td colspan='2' height="1" bgcolor="#cacaca"></td></tr>
<tr><td>Nro Funcionaria/os de Gobierno regional. Funcionaria/os de Direcci&oacute;n Regional u otra instancia ministerial (salud, educaci&oacute;n, MiMP, PNP, etc.) :</td><td><input name="ngobiernonac" size='5'></td></tr>
<tr><td colspan='2' height="1" bgcolor="#cacaca"></td></tr>
<tr><td>Nro Funcionaria/os de Alta Direcci&oacute;n (de cualquier ministerio):  </td><td><input name="naltadirecion" size='5'></td></tr>
<tr><td colspan='2' height="0" bgcolor="#cacaca"></td></tr>
<tr><td>Nro Otro/a (Especificar <input name='txtexpecifique' size="35">):</td><td><input name="notro" size='5'></td></tr>
</table>
</td></tr>
 

1 Responsable de la actividad:
2 Responsable de la actividad:
3 Responsable de la actividad:
4 Responsable de la actividad:

Presentación de la actividad/Antecedentes:


</table>



</div>
</div>
<!-- <? include("pie.php") ?>

-->