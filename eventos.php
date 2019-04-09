<? include("cabecera.php"); 
   include("funciones.php");
   $idencuesta = $_REQUEST["idencuesta"];
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_eventos.php")?>
<div align="right"><b>MODULO DE EVENTOS</b></div><hr>
<font face="arial" size="2">[+] <a href="eventos_op.php?op=nuevo">Agregar Eventos</a></font><br>
 <div class="scroll2">
<?
  
    $TAMANO_PAGINA = 50;
	$pagina = $_REQUEST["pagina"];
    if (!$pagina) {
       $inicio = 0;
       $pagina=1;
    }
    else {
      $inicio = ($pagina - 1) * $TAMANO_PAGINA;
    }
    
    
	$conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from eventos";
	$tabla = mysql_query($cadena, $conexion);
	
	 $num_total_registros = mysql_num_rows($tabla);
//calculo el total de páginas
    $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);	
	
	$inicio = ($pagina - 1) * 50;
  
  
  for ($i = 1; $i <= $total_paginas; $i++) {
    if($i==$pagina)
	   echo "[$i] ";
	else
     echo "<font size='2'><a href='eventos.php?pagina=$i'>".$i."</a> ";
	
}


?>

 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Fecha</td>
 <td><font size='2' color='#ffffff'><b>Area</td>
 <td><font size='2' color='#ffffff'><b>Actividad</td>
 <td><font size='2' color='#ffffff'><b>Responsable</td>
 <td><font size='2' color='#ffffff'><b>Proyecto</td>
 <td><font size='2' color='#ffffff'><b>Act. Proyecto</td>
 <td><font size='2' color='#ffffff'><b>Operaci&oacute;n</td>
 </tr>
 <?
  
	$cadena ="select * from eventos limit $inicio, 50";
	$tabla = mysql_query($cadena, $conexion);
	
    
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 $area = retorna_cadena($registro[2],"control",1,"areaeventos");
	 echo "<td><font face='arial' size='2'>$area</td>"; //area
	 $actividad = retorna_cadena($registro[3],"idactividad",1,"areaeventosactvidad");
	 echo "<td><font face='arial' size='2'>$actividad</td>"; //actividad
	 $responsable = retorna_cadena($registro[4],"idresponsable",1,"responsable");
	 $responsable2 = retorna_cadena($registro[4],"idresponsable",2,"responsable");
	 echo "<td><font face='arial' size='2'>$responsable2/$responsable </td>"; //Responable
	 
	 $proyecto =  retorna_cadena($registro[13],"idproyecto",1,"proyecto");
	 echo "<td><font face='arial' size='2'>$proyecto</td>"; //proyecto
	 $actividadproy =  retorna_cadena($registro[14],"idactividad",1,"actividadproyecto");
	 echo "<td><font face='arial' size='2'>$actividadproy</td>"; //Activi Proyecto
	 
	 echo "<td>";
	 echo "<a href='eventos_op.php?op=editar?&idevento=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'>Editar<font face='2' face='arial'></font></a>";
	 echo "</td>";	 
	 echo "</tr>";
	 
	 $i = $i +1;
    }
 
 ?>
 </table>
</div>

<br><br>
</div>

</div>

<? include("pie.php") ?>