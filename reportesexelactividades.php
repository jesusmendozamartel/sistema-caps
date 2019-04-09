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
		 $where = "where actividades.fecha like '$anio%' ";
	    }

         $cadena = "select * from  actividades $where ";   
  
   
     $archivogenerado = genera_archivo_atenciones($cadena);

   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b><a href="reportesexel.php">Listado de Reportes</a> > Reporte de actividades especializado </b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'> 
   <br><br>   
  <form name='consultex' method='post' action='reportesexelactividades.php'>
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

    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES 'utf8'");
    
    $scarpeta="reporte"; 
    $sfile=$scarpeta."/xxxx.xls"; 
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml);
  
    $tabla = mysql_query($cadena, $conexion);

    fwrite($fp,"<table>");
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>Fecha</td>"); 
    fwrite($fp,"<td>Proyecto</td>");
    fwrite($fp,"<td>Id Actividad Proyecto</td>");
    fwrite($fp,"<td>Area</td>");
    fwrite($fp,"<td>Responsable1</td>");
    fwrite($fp,"<td> Responsable2</td>");
    fwrite($fp,"<td>Responsable3</td>");
	fwrite($fp,"<td>Responsable4</td>");
    fwrite($fp,"<td>nroparticipantes</td>");
    fwrite($fp,"<td>Nvarones</td>");
    fwrite($fp,"<td>NMujeres</td>");
    fwrite($fp,"<td>Lugar</td>");
    fwrite($fp,"<td>Zona Interv</td>");
    fwrite($fp,"<td>Responsable Elab</td>");
	fwrite($fp,"<td>Nombre Actividad</td>");
    fwrite($fp,"<td>Perfil Participante</td>");
    fwrite($fp,"<td>breveresena</td>");
	fwrite($fp,"<td>prog escifico</td>");
	fwrite($fp,"<td>desarrolloactividad</td>");
	fwrite($fp,"<td>resultadobalance</td>");
	fwrite($fp,"<td>resultadoprueba</td>");
	fwrite($fp,"<td>Recomendaciones</td>");
    fwrite($fp,"</tr>");
    

    while ($registro = mysql_fetch_array($tabla))
    {
    fwrite($fp,"<tr>");
	
    fwrite($fp,"<td>$registro[1]</td>"); 
	$proyecto = retorna_cadena($registro[2],"idproyecto",1,"proyecto");
    fwrite($fp,"<td>$proyecto</td>");
	$actividadpro = retorna_cadena($registro[23],"idactividad",1,"actividadproyecto");
    fwrite($fp,"<td>$actividadpro</td>");
	
	$areapro = retorna_cadena($registro[3],"idarea",1,"area");
    fwrite($fp,"<td>$areapro</td>");
	
	$nomresponsable1 = retorna_cadena($registro[4],"idresponsable",1,"responsable")." ".retorna_cadena($registro[4],"idresponsable",2,"responsable");
    fwrite($fp,"<td>$nomresponsable1</td>");
	$nomresponsable2 = retorna_cadena($registro[5],"idresponsable",1,"responsable")." ".retorna_cadena($registro[5],"idresponsable",2,"responsable");
    fwrite($fp,"<td>$nomresponsable2</td>");
	$nomresponsable3 = retorna_cadena($registro[6],"idresponsable",1,"responsable")." ".retorna_cadena($registro[6],"idresponsable",2,"responsable");
    fwrite($fp,"<td>$nomresponsable3</td>");
	$nomresponsable4 = retorna_cadena($registro[7],"idresponsable",1,"responsable")." ".retorna_cadena($registro[7],"idresponsable",2,"responsable");
	fwrite($fp,"<td>$nomresponsable4</td>");
	
	
    fwrite($fp,"<td>$registro[8]</td>");
    fwrite($fp,"<td>$registro[9]</td>");
    fwrite($fp,"<td>$registro[10]</td>");
	fwrite($fp,"<td>$registro[11]</td>");
	$nombrelugar = retorna_cadena($registro[12],"idlugar",2,"lugaratencion"); 
    fwrite($fp,"<td>$nombrelugar</td>");
	
    $nomresponsable5 = retorna_cadena($registro[22],"idresponsable",1,"responsable")." ".retorna_cadena($registro[22],"idresponsable",2,"responsable");
    fwrite($fp,"<td>$nomresponsable5</td>");
	
	fwrite($fp,"<td>$registro[13]</td>");
    fwrite($fp,"<td>$registro[14]</td>");
    fwrite($fp,"<td>$registro[15]</td>");
	fwrite($fp,"<td>$registro[16]</td>");
	fwrite($fp,"<td>$registro[17]</td>");
	fwrite($fp,"<td>$registro[18]</td>");
	fwrite($fp,"<td>$registro[19]</td>");
	fwrite($fp,"<td>$registro[20]</td>");
	
    fwrite($fp,"</tr>");
    }
   fwrite($fp,"</table>");
   mysql_close($conexion);
   fclose($fp);
   
    return 1;
  

}



 ?>
