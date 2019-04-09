<? include("cabecera.php"); 
   include("funciones.php");
   $idencuesta = $_REQUEST["idencuesta"];
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE LUGAR DE ATENCION</b></div><hr>
<font face="arial" size="2">[+] <a href="lugaratencion_op.php?&op=nuevo">Agregar Lugar de Atenci&oacute;n</a></font><br>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n Lugar de atenci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Codigo Anterior</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from lugaratencion order by idlugar asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[2]</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td>";
	 echo "<a href='lugaratencion_op.php?&op=editar&idlugar=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>";
	
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