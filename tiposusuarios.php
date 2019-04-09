<? include("cabecera.php"); 
   include("funciones.php");
   
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br>
  <? include("menu_adm.php")?>
<div align="right"><b>CONFIGURACION DE TIPOS DE USUARIO</b></div><hr>
<font face="arial" size="2">[+] <a href="tipousuarios_op.php?&op=nuevo">Agregar Tipo Usuario</a></font><br>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Codigo de control</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from tipousuario order by idtipousuario asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td><font face='arial' size='2'>$registro[2]</td>";
	 echo "<td>";
	 echo "<a href='tipousuarios_op.php?&op=editar&idtipousuario=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>";
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