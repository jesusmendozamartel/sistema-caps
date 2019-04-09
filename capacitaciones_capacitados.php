<? include("cabecera.php"); 
   include("funciones.php");
    $descipcioncapacitacion = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",1,"capacitacion");
   $editablelist = $_REQUEST[editablelist];
?>

<div class="div1">
<div class="contenido">
 
   <b>MODULO DE CAPACITADOS</b>
   
<? include("menu_capacitado.php"); ?><hr>
<table width="100%"><tr><td>
<div align="left"><b>Lista de capacitados:</b> <font color="red" size="3"><b><? echo $descipcioncapacitacion; ?></b></font> </div></td>
<td>
  <? if($editablelist=="1")
  { ?>
  <div align="right"><a href="asignando_capacitado.php?&idproyecto=<? echo $_REQUEST["idproyecto"]; ?>&idcapacitacion=<? echo $_REQUEST["idcapacitacion"]; ?>">[+]Asignar Capacitado</div>
  
  <? } ?>
</td></table>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Nombre</td>
 <td><font size='2' color='#ffffff'><b>Apellidos</td>
 <td><font size='2' color='#ffffff'><b>sexo</td>
 <!-- <td><font size='2' color='#ffffff'><b>Email</td>
-->
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select nombre, apellidos, sexo, email, idcapacitacionuser,  capacitados.idcapacitado as idcapacitado from capacitacionuser join capacitados on capacitacionuser.idcapacitado = capacitados.idcapacitado where capacitacionuser.idcapacitacion='$_REQUEST[idcapacitacion]'";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[0]</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 echo "<td><font face='arial' size='2'>";
	 $sexo= retorna_cadena($registro[2],"idsexo",1,"sexo");
	 echo $sexo;
	 
	 echo "</td>";
	//  echo "<td><font face='arial' size='2'>$registro[3]</td>";
	 echo "<td>";
         if($editablelist=="1")
         {
         $idcapacitado = $registro[5];
	 echo "<a href='capacitaciones_capacitados.del.php?idcapacitacion=$_REQUEST[idcapacitacion]&idproyecto=$_REQUEST[idproyecto]&idcapacitacionuser=$registro[4]'><img border='0' src='imagenes/eliminar.gif' height='15'><font face='2' face='arial'>[Eliminar]</font></a><a href='capacitado.php?editablelist=1&idproyecto=1&idcapacitacion=$_REQUEST[idcapacitacion]&idcapacitado=$idcapacitado&op=editar'>[Editar]</a>";
         echo "<a >";
         }
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
