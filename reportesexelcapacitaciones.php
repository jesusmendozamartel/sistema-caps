<? include("cabecera.php"); 
   include("funciones.php");

   if($_POST["generar"])
   {
   $anio = $_POST["anio"]; 
   $agrupado = $_POST["agrupado"];
   $tipousuario = $_POST["tipousuario"];
   //echo "$anio - $agrupado - $tipousuario"; 
   if($anio<>"" && $anio>1980)
   {
    $where = "where capacitacion.fecha like '$anio%' ";
   }
   
   $sql ="select  proyecto.descripcion, capacitacion.fecha, capacitacion.lugarevento, capacitacion.idzonaintervencion, capacitacion.responsable1, capacitacion.responsable2, capacitacion.responsable3, capacitacion.responsable4,  capacitacionuser.idcapacitado, capacitacion.descripcion, capacitacion.idactividad   from (proyecto join capacitacion on proyecto.idproyecto = capacitacion.idproyecto) join capacitacionuser on capacitacion.idcapacitacion = capacitacionuser.idcapacitacion";
   
   $cadena = "$sql $where  $agrupadoby";   
  
   
    $archivogenerado = genera_archivo_atenciones($cadena);
	//echo $cadena;

   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b><a href="reportesexel.php">Listado de Reportes</a> > Reporte de capacitaciones especializado </b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'> 
   <br><br>   
  <form name='consultex' method='post' action='reportesexelcapacitaciones.php'>
 <table>
 <tr><td align='right'>
  <font size='2'> 
   A&ntilde;o:</td><td> <input name='anio' value='<? echo $anio; ?>'> <font size='1'><br>Si no coloca ningun valor generara una consulta de toda la base</font></td></tr>
  
  
   <tr><td colspan='2' align='center'><input name='generar' type='submit' value="Generar Archivo"></td></tr>
   <? 
      if($archivogenerado==1){
    ?>  
      <tr><td><a href="reporte/xxxx.xls" target='_blank'>Descargue Archivo</a></td></tr>
      <? }else{ ?>
        <tr><td colspan='2' align="center"><font size='1'>Esta operaci&oacute;n puede demorar... no cierre esta ventana..</a></td></tr>
      <? } ?>
    
</table> 
  
  </form>

</td>
</tr>
</table>
</div>
</div>

<? include("pie.php");


function genera_archivo_atenciones($cadena)
{
    //echo $cadena;
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    mysql_query("SET NAMES utf8");
    
    $scarpeta="reporte"; //carpeta donde guardar el archivo.
    //debe tener permisos 775 por lo menos
    $sfile=$scarpeta."/xxxx.xls"; //ruta del archivo a generar
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml);
  
    $tabla = mysql_query($cadena, $conexion);

    fwrite($fp,"<table>");
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>Proyecto</td>"); 
    fwrite($fp,"<td>Fecha</td>");
    fwrite($fp,"<td>Lugar</td>");
    fwrite($fp,"<td>Zona Intervencion</td>");
    fwrite($fp,"<td> Responsable1</td>");
    fwrite($fp,"<td>Responsable2</td>");
	fwrite($fp,"<td>Responsable3</td>"); 
	fwrite($fp,"<td>Responsable4</td>");
    fwrite($fp,"<td>Nom Capacitado</td>");
    fwrite($fp,"<td>Apel Capacitado</td>");
    fwrite($fp,"<td>Dni/Documento</td>");
    fwrite($fp,"<td>Sexo</td>");
    fwrite($fp,"<td>Profesion</td>");
	fwrite($fp,"<td>Grado</td>");
	fwrite($fp,"<td>Institucion</td>");
    fwrite($fp,"<td>Email</td>");
	fwrite($fp,"<td>Actividad</td>");
	fwrite($fp,"<td>Nombre Actividad</td>");
    fwrite($fp,"</tr>");
    
   
    while ($registro = mysql_fetch_array($tabla))
    {
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>$registro[0]</td>");
    fwrite($fp,"<td>$registro[1]</td>");	
	
    $nombrelugar = retorna_cadena($registro[3],"idlugar",2,"lugaratencion"); 
    fwrite($fp,"<td>$nombrelugar</td>");
       
    $nomresponsable1 = retorna_cadena($registro[4],"idresponsable",1,"responsable")." ".retorna_cadena($registro[4],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable1</td>");

    $nomresponsable2 = retorna_cadena($registro[5],"idresponsable",1,"responsable")." ".retorna_cadena($registro[5],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable2</td>");
  
    $nomresponsable3 = retorna_cadena($registro[6],"idresponsable",1,"responsable")." ".retorna_cadena($registro[6],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable3</td>");

    $nomresponsable4 = retorna_cadena($registro[7],"idresponsable",1,"responsable")." ".retorna_cadena($registro[7],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable4</td>");
	
    $nomcapacitado = retorna_cadena($registro[8],"idcapacitado",1,"capacitados"); 
    fwrite($fp,"<td>$nomcapacitado</td>");

	$apellidocap = retorna_cadena($registro[8],"idcapacitado",2,"capacitados"); 
    fwrite($fp,"<td>$apellidocap</td>");
	$dni = retorna_cadena($registro[8],"idcapacitado",4,"capacitados"); 
    fwrite($fp,"<td>$dni</td>");
	
	$sexo = retorna_cadena($registro[8],"idcapacitado",6,"capacitados"); 
	if($sexo=="2")
      fwrite($fp,"<td>MUJER</td>");
	else 
      fwrite($fp,"<td>HOMBRE</td>");
	  
	$profesion = retorna_cadena($registro[8],"idcapacitado",8,"capacitados"); 
	fwrite($fp,"<td>$profesion</td>");
	$profesion = retorna_cadena($registro[8],"idcapacitado",8,"capacitados"); 
	fwrite($fp,"<td>$profesion</td>");
    $ngrado = retorna_cadena($registro[8],"idcapacitado",14,"capacitados"); 
	
	 $grado = retorna_cadena($ngrado,"idestudios",1,"estudios");
	
	fwrite($fp,"<td>$grado</td>");
	
	$institucion = retorna_cadena($registro[8],"idcapacitado",13,"capacitados"); 
	fwrite($fp,"<td>$institucion</td>");
	
	$email = retorna_cadena($registro[8],"idcapacitado",12,"capacitados"); 
	fwrite($fp,"<td>$email</td>");
	
	$actividad = retorna_cadena($registro[10],"idactividad",1,"actividadproyecto"); 
	fwrite($fp,"<td>$actividad</td>"); 
	
	
	$capacitacion = $registro[9]; 
	fwrite($fp,"<td>$capacitacion</td>"); 
	
	//fwrite($fp,"<td>$capacitacion</td>"); 
    fwrite($fp,"</tr>");
    }
   fwrite($fp,"</table>");
   mysql_close($conexion);
   fclose($fp);
   
    return 1;
  

}



 ?>
