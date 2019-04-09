<? include("cabecera.php"); 
   include("funciones.php");
   
   $proyecto = retorna_cadena($_REQUEST["idproyecto"],"idproyecto",1,"proyecto");
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES PROYECTOS</b>
   <br>
  <? include("menu_proyectos.php")?>
<div align="right"><b>CAPACITACIONES DEL PROYECTOS: <font size="3" color="RED"><?php echo $proyecto; ?></font></b></div>

<font face="arial" size="2">[+] <a href="proycapacitacion_op.php?&op=nuevo&idproyecto=<?php echo $_REQUEST["idproyecto"]; ?>">Agregar Capacitaci&oacute;n</a></font><br>
 <div class="scroll2">
 <table width='100%'>
 <tr bgcolor='#766508'>
 <td width='30'><font size='2' color='#ffffff'><b>Id</td>
 <td><font size='2' color='#ffffff'><b>Descripci&oacute;n</td>
 
 <td><font size='2' color='#ffffff'><b>Fecha</td>
 <td><font size='2' color='#ffffff'><b>Lugar de Atenci&oacute;n</td>
 <td><font size='2' color='#ffffff'><b>Operaciones</td>
 </tr>
 <?
    $idsession = $_COOKIE["idsession"];

    $nivel = $_COOKIE["nivel"];
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
   
   if($nivel==1)
      $cadena ="select * from capacitacion where idproyecto = $_REQUEST[idproyecto] order by idcapacitacion asc";
   else
     $cadena ="select * from capacitacion where idproyecto = $_REQUEST[idproyecto] and idsession='$idsession' order by idcapacitacion asc";

  

    $tabla = mysql_query($cadena, $conexion);
    $i=1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'>";
	 echo "<td align='center'><font face='arial' size='2'>$i</td>";
	 echo "<td><font face='arial' size='2'>$registro[1]</td>";
         echo "<td><font face='arial' size='2'>$registro[2]</td>";
         $cadenilla = retorna_cadena($registro[5],"idlugar",2,"lugaratencion");
	 echo "<td><font face='arial' size='2'>$cadenilla</td>";
	 echo "<td width='430'><font size='2'>";

   $editablelist="0";  
   if($nivel=="1" || $idsession == $registro[12] )
     {
         if($nivel=="1")
         {  
             $editablelist="1";  
        echo "<a href='proycapacitacion_op.php?&op=editar&idcapacitacion=$registro[0]&idproyecto=$registro[6]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>"; 
        echo "<a href='proycapacitacion_opdel.php?&op=editar&idcapacitacion=$registro[0]&idproyecto=$registro[6]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[ELiminar]</font></a>"; 
          }else
              {
                  if($registro[13]=="0" || $registro[13]=="")
                  {
                     
           echo "<a href='proycapacitacion_op.php?&op=editar&idcapacitacion=$registro[0]&idproyecto=$registro[6]'><img border='0' src='imagenes/editar.gif' height='15'><font face='2' face='arial'>[Editar]</font></a>";                  
              echo "<a href='proycapacitacion_opdel.php?&op=editar&idcapacitacion=$registro[0]&idproyecto=$registro[6]'><img border='0' src='imagenes/eliminar.gif' height='15'><font face='2' face='arial'>[Eliminar]</font></a>";

           $editablelist="1";  
                   }

                }

      }
     echo "<a href='capacitaciones_capacitados.php?editablelist=$editablelist&idcapacitacion=$registro[0]&idproyecto=$registro[6]'><img border='0' src='imagenes/icono-proponer-actividad.gif' height='15'><font face='2' face='arial'>[Lista Capacitados]</font></a>";

       
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
