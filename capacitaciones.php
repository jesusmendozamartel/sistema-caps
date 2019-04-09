<? include("cabecera.php"); 
   include("funciones.php");
   
?>

<div class="div1">
<div class="contenido">
 <br>
   <b>MODULO DE CAPACITADOS</b>
   <br>
   
<? include("menu_capacitado.php"); ?><hr>
Lista de Capacitaciones
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Proyecto</td>
 <td><font size='2' color='#ffffff'><b>Capacitaci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Fecha</td>
 <td><font size='2' color='#ffffff'><b>Lugar Capacitacion</td>

 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select proyecto.idproyecto, proyecto.descripcion, capacitacion.descripcion, fecha, lugarevento, capacitacion.idcapacitacion from proyecto join capacitacion on proyecto.idproyecto = capacitacion.idproyecto order by proyecto.idproyecto desc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td><font face='arial' size='2'>$registro[2]</td>";
	 echo "<td><font face='arial' size='2'>$registro[3]</td>";
	 echo "<td><font face='arial' size='2'>$registro[4]</td>";
	 echo "<td>";
	 echo "<a href='capacitaciones_capacitados.php?&idproyecto=$registro[0]&idcapacitacion=$registro[5]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Asignar]</font></a>";
	 echo "</td>";	 
	 echo "</tr>";
	 
	 $i = $i +1;
    }
 
 ?>
 </table>
</div>
</div>
</div>

<? include("pie.php") ?>