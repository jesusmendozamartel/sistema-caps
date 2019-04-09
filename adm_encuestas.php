<? include("cabecera.php"); 
   include("funciones.php");

?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br><br>
  <? include("menu_adm.php")?>
  
 <table width='100%'>
 
 <tr bgcolor='#766508'>
 <td width='50'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from encuesta order by idencuesta ASC";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr>";
	 echo "<td>$i</td>";
	 echo "<td>$registro[1]</td>";
	 echo "<td><a href='adm_opciones.php?idencuesta=$registro[0]'><img border='0' src='imagenes/encuesta.jpg' height='20'>[Custionario]</a>";
	 echo "<img border='0' src='imagenes/editar.gif' height='20'>[Editar]</a>";
	 echo "</td>";	 
	 echo "</tr>";
	 $i = $i +1;
    }
 
 ?>
 </table>
	
</div>
</div>

<? include("pie.php") ?>