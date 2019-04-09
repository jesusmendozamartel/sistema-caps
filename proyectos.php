<? include("cabecera.php"); 
   include("funciones.php");
   $idencuesta = $_REQUEST["idencuesta"];
?>

<div class="div1">
<div class="contenido">
<div align="right"><a href="javascript:history.back()"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <br>
   <b>MODULO PROYECTOS</b>
   <br>
  <? include("menu_proyectos.php")?>
<div align="right"><b>CONFIGURACION DE PROYECTOS</b></div><hr>
<? if($_COOKIE["nivel"]=='1')
    {
?>
<font face="arial" size="2"><a href="proyecto_op.php?op=nuevo"><img src='imagenes/nuevo_proyecto.png'></a></font><br>
<? }?>
 <table width='100%'>
 <tr bgcolor='#000000'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td ><font size='2' color='#ffffff'><b>Descripci&oacute;n</td>
 <!-- <td><font size='2' color='#ffffff'><b>C&oacute;digo Antiguo</td> -->
 <td width='460'><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="select * from proyecto order by idproyecto asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    $idusersession =  $_COOKIE["idsession"];

    while ($registro = mysql_fetch_array($tabla))
    {
	if($_COOKIE["nivel"]<>'1')
        {   $cadena = "select * from proyecto_usersession where idusersession = '$idusersession' and  idproyecto='$registro[0]'";
            $sw = cuenta_rows($cadena); 
            if($sw==1)
               $mostrando="1"; 
            else
               $mostrando="0";    
        } 
         else
          { $mostrando=1; 
           }
        if($mostrando=="1")
        {

         echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
	 //echo "<td><font face='arial' size='2'>$registro[2]</td>";
	 echo "<td> <font face='arial' size='1'>";
         if($_COOKIE["nivel"]=='1')
         {
	 echo "<a href='proyecto_op.php?&op=editar&idproyecto=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'>[Editar]</font></a> | ";
         echo "<a href='proyecto_actividadp.php?idproyecto=$registro[0]'><img border='0' src='imagenes/editar.gif' height='15'><font size='1'>[Actividad-CMB]</font></a> | ";
         }
	 echo "<a href='proyecto_actividades.php?&idproyecto=$registro[0]'><img border='0' src='imagenes/icono-proponer-actividad.gif' width='25'><font size='1' face='arial'>[Actividades]</font></a> | ";
	 echo "<a href='proyecto_capacitaciones.php?&idproyecto=$registro[0]'><img border='0' src='imagenes/icono-proponer-actividad.gif' width='25'><font size='1' face='arial'>[Capacitaciones]</font></a>";
	 
	 echo "</td>";	 
	 echo "</tr>";
	 
	 $i = $i +1;
         }
    }
 
 ?>
 </table>

</div>
</div>

<? include("pie.php") ?>
