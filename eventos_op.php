<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');

?>
<head>
<style>
  td
   {
      font-family: arial;
      font-size: 12px;
   }
</style>
</head>

<?
 
 $idevento=$_REQUEST["idevento"];
  
 // echo $_REQUEST["ruta"];
  if($_POST[cmproyecto]=="" && $_REQUEST['idproyecto']<>"")
  {
     $cmproyecto = $_REQUEST['idproyecto'];
     
   
  }
  
  if($_POST["grabar"])
  {
     
     $cmbproyecto = $_POST["cmbproyecto"];
	 
     $cmbactividad = $_POST["cmbactividad"];
	 
	   $conexion = conectar_base();
           mysql_select_db ("sistemaatencion",$conexion);
		
			
		$fecha = $_POST["fecha"];
        	$idarea =  $_POST["idarea"];
        	
		$responsable1 = $_POST["responsable1"];
		$responsable2 = $_POST["responsable2"];
		$responsable3 = $_POST["responsable3"];
		$responsable4 = $_POST["responsable4"];
		$nbenificiario = $_POST["nbenificiario"];
		$nbenificiariomasculinos = $_POST["nbenificiariomasculinos"]; 
                $nbeneficiariofeminas = $_POST["nbeneficiariofeminas"];
		$lugar = $_POST["lugar"];
		$idzonaintervencion = $_POST["idzonaintervencion"];
		$observacion = $_POST["observacion"];
		$idproyecto1 = $_POST["cmproyecto"];
		$idactividadproyecto1 = $_POST["cmbactividad"];		
		


                $idproyecto2 = $_POST["idproyecto2"]; 
		$textoactividad2 = $_POST["textoactividad2"]; 
                
		$tematratado  = $_POST["tematratado"];
		$numeroprovesaludservicio = $_POST["numeroprovesaludservicio"];
		$numeroprovesaludpoliciales = $_POST["numeroprovesaludpoliciales"];
		$numerofuncionarioglocal = $_POST["numerofuncionarioglocal"];

		$numerofuncionariogregional = $_POST["numerofuncionariogregional"];
		$numerofuncionarioministerio = $_POST["numerofuncionarioministerio"];
		$numerofuncionarioaltomin = $_POST["numerofuncionarioaltomin"];
		$txtfuncionariotro = $_POST["txtfuncionariotro"];
		$nrootro = $_POST["nrootro"];


		
		if($_REQUEST["op"]=="editar")
                {
		$txtupdate = "fecha='$fecha',idarea='$idarea',idactividadproyecto='$idactividad',idresponsable1='$responsable1',idresponsable2='$responsable2',idresponsable3='$responsable3',idresponsable4='$responsable4',nbenificiariomasculinos='$nbenificiariomasculinos',nbeneficiariofeminas='$nbeneficiariofeminas',lugar='$lugar',idzonaintervencion='$idzonaintervencion',observacion='$observacion',idproyecto='$cmproyecto',tematratado='$tematratado',numeroprovesaludservicio='$numeroprovesaludservicio',numeroprovesaludpoliciales='$numeroprovesaludpoliciales',numerofuncionarioglocal='$numerofuncionarioglocal',numerofuncionariogregional='$numerofuncionariogregional',numerofuncionarioministerio='$numerofuncionarioministerio',numerofuncionarioaltomin='$numerofuncionarioaltomin',txtfuncionariotro='$txtfuncionariotro',nrootro='$nrootro'";
		$cadena = "update actividades set ".$txtupdate." where idactividad='$idevento'";


		}else
                   {





$campos ="idactividad,fecha,idarea,idresponsable1,idresponsable2,idresponsable3,idresponsable4,nbenificiario,nbenificiariomasculinos,nbeneficiariofeminas,lugar,idzonaintervencion,observacion,idproyecto1,idactividadproyecto1,idproyecto2,textoactividad2,tematratado,numeroprovesaludservicio,numeroprovesaludpoliciales,numerofuncionarioglocal,numerofuncionariogregional,numerofuncionarioministerio,numerofuncionarioaltomin,txtfuncionariotro,nrootro";

$valores ="'','$fecha','$idarea','$idresponsable1','$idresponsable2','$idresponsable3','$idresponsable4','$nbenificiario','$nbenificiariomasculinos','$nbeneficiariofeminas','$lugar','$idzonaintervencion','$observacion','$idproyecto1','$idactividadproyecto1','$idproyecto2','$textoactividad2','$tematratado','$numeroprovesaludservicio','$numeroprovesaludpoliciales','$numerofuncionarioglocal','$numerofuncionariogregional','$numerofuncionarioministerio','$numerofuncionarioaltomin','$txtfuncionariotro','$nrootro'";

              $cadena = "insert into actividades $campos values $valores";



                  
            }


	    
	mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
        mysql_close($conexion);	 
		
		if($_REQUEST["ruta"]==""){ 
		?>
		 <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0;URL=proyecto_actividades.php?&idproyecto=<? echo $cmproyecto; ?>">   
          </head> 	 
		 
		<?
		 }else
		    {
			
			?>
			  <head>        
 		        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=<? echo $_REQUEST["ruta"]; ?>">  
                        </head> 	
			
			<?

  
			}
		
          
  }
  













  if($idevento)
  {
  
$fecha = retorna_cadena($_REQUEST["idevento"],"idactividad",1,"actividades");

$idarea =  retorna_cadena($_REQUEST["idevento"],"idactividad",2,"actividades");
$idactividad = retorna_cadena($_REQUEST["idevento"],"idactividad",14,"actividades");
$responsable1 = retorna_cadena($_REQUEST["idevento"],"idactividad",3,"actividades");
$responsable2 = retorna_cadena($_REQUEST["idevento"],"idactividad",4,"actividades");
$responsable3 = retorna_cadena($_REQUEST["idevento"],"idactividad",5,"actividades");
$responsable4 = retorna_cadena($_REQUEST["idevento"],"idactividad",6,"actividades");
$nbenificiario = retorna_cadena($_REQUEST["idevento"],"idactividad",7,"actividades");
$nbeneficiariomasculino = retorna_cadena($_REQUEST["idevento"],"idactividad",8,"actividades");
$nbeneficiariofeminas = retorna_cadena($_REQUEST["idevento"],"idactividad",9,"actividades");


$lugar = retorna_cadena($_REQUEST["idevento"],"idactividad",10,"actividades");
$idzonaintervencion = retorna_cadena($_REQUEST["idevento"],"idactividad",11,"actividades");
$observacion = retorna_cadena($_REQUEST["idevento"],"idactividad",12,"actividades");
$idproyecto1 = retorna_cadena($cmproyecto,"idproyecto",13,"proyecto");
$idactividadproy1  = retorna_cadena($cmproyecto,"idproyecto",14,"proyecto");
$textactividad1 = retorna_cadena($idactividadproy1,"idactividad",1,"actividadproyecto");


$idproyecto2 = retorna_cadena($cmproyecto,"idproyecto",15,"proyecto");
$textoactividad2  = retorna_cadena($cmproyecto,"idproyecto",16,"proyecto");
$tematratado  =retorna_cadena($_REQUEST["idevento"],"idactividad",17,"eventos");

$numeroprovesaludservicio = retorna_cadena($_REQUEST["idevento"],"idactividad",18,"actividades");
$numeroprovesaludpoliciales = retorna_cadena($_REQUEST["idevento"],"idactividad",19,"actividades");
$numerofuncionarioglocal = retorna_cadena($_REQUEST["idevento"],"idactividad",20,"actividades");
$numerofuncionariogregional = retorna_cadena($_REQUEST["idevento"],"idactividad",21,"actividades");
$numerofuncionarioministerio = retorna_cadena($_REQUEST["idevento"],"idactividad",22,"actividades");
$numerofuncionarioaltomin = retorna_cadena($_REQUEST["idevento"],"idactividad",23,"actividades");
$txtfuncionariotro = retorna_cadena($_REQUEST["idevento"],"idactividad",24,"actividades");
$nrootro = retorna_cadena($_REQUEST["idevento"],"idactividad",25,"actividades");
     
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
<div align="right"><b>Eventos</b></div><hr>


<? if($_REQUEST["op"]=="nuevo"){ ?>
<font face="arial" size="2"><b>Nuevo Evento</b></font><br> 
<? }else { ?>
<font face="arial" size="2"><b>Editar Evento</b></font><br> 
<? }?> 
 
 <table bgcolor="#ffffff" width='center' width='100%' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='6'><a href="proyecto_actividades.php?&idproyecto=<? echo $cmproyecto; ?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<form name='nuevaopcion' method='post' action='eventos_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"] ?>&idevento=<? echo $_REQUEST["idevento"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='eventos_op.php?&op=<?php echo $_REQUEST["op"]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"] ?>&idevento=<?php echo $_REQUEST["idevento"];?>&ruta=<? echo $_REQUEST["ruta"]; ?>'>
<? }?>




<tr ><td><b>Fecha</b></td><td>:</td><td> <input id='fecha' name='fecha' value='<? echo $fecha; ?>'>
<a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>
    <div id="calendario">
    <?php calendar_html() ?>
	</div> </td>
<td><b>Area</b></td><td>:</td><td> 
<select name='idarea'>
<? cargar_area_actividades($idarea); ?>
</select>
<!-- <input name='idarea' value='<? echo $idarea; ?>'>
-->

</td> 

<!-- <tr bgcolor="#f4dc9d"><td colspan='3'></td><td><b>Actividad</b></td><td>:</td><td> <input name='idactividad' value='<? echo $idactividad; ?>'></td></tr>

-->
<tr><td><b>Responsable 1</b></td><td>:</td><td><select name='responsable1'>
<? cargar_responsable($responsable1); ?>
</select></td>
<td><b>Responsable 2</b></td><td>:</td><td> <select name='responsable2'>
<? cargar_responsable($responsable2); ?>
</select></td>
<tr bgcolor="#f4dc9d"><td><b>Responsable 3</b></td><td>:</td><td> <select name='responsable3'>
<? cargar_responsable($responsable3); ?>
</select></td>
<td><b>Responsable 4</b></td><td>:</td><td> <select name='responsable4'>
<? cargar_responsable($responsable5); ?>
</select></td>
</tr>



<tr><td><b>Nro Benef Masculinos</b></td><td>:</td><td> <input name='nbeneficiariomasculino' value='<? echo $nbeneficiariomasculino; ?>'></td>
<td><b>Nro Benef Femenino</b></td><td>:</td><td> <input name='nbeneficiariofeminas' value='<? echo $nbeneficiariofeminas; ?>'></td></tr>

<tr><td><b>Total Beneficiarios</b></td><td>:</td><td> <input name='nbenificiario' value='<? echo $nbenificiario; ?>'></td></tr>

<tr bgcolor="#f4dc9d"><td><b>Lugar</b></td><td>:</td><td> <input name='lugar' value='<? echo $lugar; ?>'></td>
<td><b>Zona de Intervenci&oacute;n</b></td><td>:</td><td> <select  name='idzonaintervencion' value='<? echo $idzonaintervencion; ?>'>
<?cargar_zonas($idzonaintervencion); ?>   
</select>	
</td></tr>


<tr><td ><b>Observacion</b></td><td>:</td><td colspan="4"> <textarea cols="90" name='observacion' value='<? echo $observacion; ?>'><? echo $observacion; ?></textarea></td></tr>

<tr bgcolor="#f4dc9d"><td><b>Proyecto</b></td><td>:</td><td> 

<input name='cmproyecto' type="hidden" value='<? echo $cmproyecto; ?>'>
<?
$cmproyecto = $idproyecto1;
echo "<select name='cmbproyecto' id='cmbproyecto' >";
   cargar_proyecto($cmproyecto);
  echo "</select>";
?>

</td>
<td><b>Actividad</b></td><td>:</td><td> 
<? 
echo"<select name='cmbactividad' id='cmbactividad' value='$cmbactividad'>";
  echo "</select>".$txtactividad;
?>

</td>
</tr>

<tr bgcolor="#f4dc9d"><td><b>Proyecto2</b></td><td>:</td><td> 

<?
$cmproyecto2 = $idproyecto2;
echo "<select name='idproyecto2' id='cmbproyecto' >";
   cargar_proyecto($cmproyecto2);
  echo "</select>";
?>

</td>
<td><b>Actividad Proyecto 2: </b></td><td>:</td><td> <input name='textoactividad2' value="<? echo $textoactividad2; ?>">

</td>
</tr>


<tr>
<td><b>Tema Tratado</td><td>:</td><td colspan='4'><input name='tematratado' value="<? echo $tematratado; ?>" size='40'></td></tr>
<tr bgcolor="#f4dc9d"><td colspan='4'>
<b>1) Proveedoras/es o personal de salud en servicio ( diferente a  
personal de salud en puestos administrativos o de direcci&oacute;n ) Nro 
</td><td>:</td><td><input name='numeroprovesaludservicio' value="<? echo $numeroprovesaludservicio ?>"></td></tr>
<tr><td colspan='4'>
<b>2) Proveedores/as de otros servicios ( PNP, CEMS, colegios, etc. ) Nro 
</td><td>:</td><td><input name='numeroprovesaludpoliciales' value="<? echo $numeroprovesaludpoliciales; ?>"></td></tr>
<tr bgcolor="#f4dc9d"><td colspan='4'>
<b>3) Funcionaria/os de gobierno local (distrital o provincial) Nro 
</td><td>:</td><td><input name='numerofuncionarioglocal' value="<? echo $numerofuncionarioglocal; ?>"></td></tr>
<tr><td colspan='4'>
<b>4) Funcionaria/os de Gobierno regional Nro 
</td><td>:</td><td><input name='numerofuncionariogregional' value="<? echo $numerofuncionariogregional; ?>"></td></tr>

<tr bgcolor="#f4dc9d"><td colspan='4'>
<b>5) Funcionaria/os de Direcci&oacute;n Regional u otra instancia ministerial   
(Salud, Educaci&oacute;n, justicia, MIMP, PNP, etc. )Nro 
</td><td>:</td><td><input name='numerofuncionarioministerio' value="<? echo $numerofuncionarioministerio; ?>"></td></tr>

<tr><td colspan='4'>
<b>6) Funcionaria/os de Alta Direcci&oacute;n (de cualquier ministerio) Nro
</td><td>:</td><td><input name='numerofuncionarioaltomin' value="<? echo $numerofuncionarioaltomin; ?>"></td></tr>

<tr bgcolor="#f4dc9d"><td bgcolor="#f4dc9d">
<b>7) otro/a, especificar 
</td><td>:</td><td ><input size='40' name='txtfuncionariotro'value="<? echo $txtfuncionariotro; ?>"></td>
<td>Nro</td><td>:</td><td><input name='nrootro' value="<? echo $nrootro; ?>"></td>

</tr>


<tr><td colspan='6' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>



</form> 
</table>

</div>
</div>
<? include("pie.php") ?>
