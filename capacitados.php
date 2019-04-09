<? include("cabecera.php"); 
   include("funciones.php");
   
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>MODULO DE CAPACITADOS</b>
   <br>

<? include("menu_capacitado.php"); ?>  
   <hr>
<table><tr><td>
<font face="arial" size="2"><a  href="capacitado.php?&op=nuevo">[+] Agregar Capacitado</a></font></td><td>
</td></tr>
</table>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>APELLIDO</td>
 <td><font size='2' color='#ffffff'><b>NOMBRE</td>
 <td><font size='2' color='#ffffff'><b>DNI</td>
 <td><font size='2' color='#ffffff'><b>SEXO</td>

 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from capacitados order by apellidos,nombre asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[2]</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td><font face='arial' size='2'>$registro[4]</td>";
	 echo "<td><font face='arial' size='2'>";
	 
	 
	 $sexo = retorna_cadena($registro[6],"idsexo",1,"sexo");
	 echo $sexo;
	 echo "</td>";
	 echo "<td>";
	 echo "<a href='capacitado.php?&op=editar&idcapacitado=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>";
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