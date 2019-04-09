<? include("cabecera.php"); 
   include("funciones.php");
   
   $area = retorna_cadena($_REQUEST["idarea"],"idarea",1,"area");
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>AREA: <font size="3" color="RED"><?php echo $area; ?></font></b></div>

<font face="arial" size="2">[+] <a href="subarea_op.php?&op=nuevo&idarea=<?php echo $_REQUEST["idarea"]; ?>">Agregar SubArea</a></font><br>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n - Sub Area</td>
 <td><font size='2' color='#ffffff'><b>Control - Usado para el Orden</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from subarea where idarea = $_REQUEST[idarea] order by idsubarea asc";
	
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td><font face='arial' size='2'>$registro[3]</td>";
	 echo "<td width='230'>";
	 echo "<a href='subarea_op.php?&op=editar&idsubarea=$registro[0]&idarea=$registro[2]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>";

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