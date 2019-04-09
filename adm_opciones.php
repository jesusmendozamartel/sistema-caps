<? include("cabecera.php"); 
   include("funciones.php");
   $idencuesta = $_REQUEST["idencuesta"];
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br><br>
  <? include("menu_adm.php")?>
<hr>
 <table width='100%'>
 <tr bgcolor=''>
 <td width='50' colspan='2'><font size='2' ><b><a href="nueva_opcion.php?idencuesta=<? echo $idencuesta?>">[+] Agregar Opci&oacute;n</a> </td>
 <td><font size='2' ><b><a href="adm_opciones.php?idencuesta=<? echo $_REQUEST["idencuesta"]; ?>">[Actualizar]</a></td>
 
 </tr>
 </table>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='50'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from pregunta where idencuesta = $idencuesta order by idpregunta asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr>";
	 echo "<td>$i</td>";
	 echo "<td>$registro[1]</td>";
	 echo "<td>";
	 echo "<a href='editar_pregunta.php?idpregunta=$registro[0]&idencuesta=$idencuesta'><img border='0' src='imagenes/editar.gif' height='20'>[Editar]</a>";
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