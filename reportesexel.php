<? include("cabecera.php"); 
   include("funciones.php");
   
   $proyecto = retorna_cadena($_REQUEST["idproyecto"],"idproyecto",1,"proyecto");
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b>Listado de Reportes</b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'><br><br> <ul>
      <li><font size='2'> [+] <a href='reportesexelatenciones.php'>Reporte de atenciones especializado</a></li>
      <li><font size='2'> [+] <a href='reportesexelcapacitaciones.php'>Reporte de capacitaciones especializado</a></li>
      <li> [+] <a href='reportesexelactividades.php'>Reporte de actividades especializado</a></li>
      <li> [+] <a href='reportesexelescalpercepcion.php'>Escala de Autopercepci&oacute;n de Secuelas Psicológicas por Violencia Pol&iacute;tica</a></li>   
      <li> [+] <a href='reportesescalabienestar.php'>Reporte de la escala de bienestar</a></li>   
      <li> [+] <a href='reportesafectacion.php'>Reporte de Afectacion</a></li>   
  <!-- <li> [+] <a href='reportesexelactividades.php'>Reporte de Actividades especializado</a></li> -->
  </ul>
</td>
</tr>

</table>
</div>
</div>

<? include("pie.php") ?>
