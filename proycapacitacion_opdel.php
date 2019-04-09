<? include("cabecera.php"); 
   include("funciones.php");
   
   $capacitacion = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",1,"capacitacion");
   $idproyecto = retorna_cadena($_REQUEST["idactividad"],"idactividad",2,"actividades");
   if($_REQUEST[afirmacion]=="yesterday")
   {
     $idcapacitacion = $_REQUEST["idcapacitacion"];
     $cadena = "DELETE FROM capacitacion WHERE idcapacitacion = $idcapacitacion";
       $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
        mysql_query($cadena,$conexion);
        mysql_close($conexion);
        echo $cadena;
             ?>
        
 
                 <head>         
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_capacitaciones.php?&idproyecto=<? echo $_REQUEST[idproyecto] ?>">
                 </head>  

              <?    
  
   }

?>
<div class="div1">
<div class="contenido">

  <br>
   <b>MODULO PROYECTOS - CAPACITACION</b>
   <hr>
<div align="right"><a href="javascript:history.back()"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <? include("menu_proyectos.php")?>

<form name='eliminar'>
<table>
<tr>
<td><b>Esta seguro de Eliminar esta capacitacion?: <? echo $capacitacion; ?> </b></td>
</tr>
<tr><td><a href="proycapacitacion_opdel.php?afirmacion=yesterday&idcapacitacion=<? echo $_REQUEST["idcapacitacion"]; ?>&idproyecto=<? echo $_REQUEST['idproyecto']; ?>">[SI]</a>  <a href="javascript:history.back()">[NO]</a></td></tr>
</table>

</form>

</div>
</div>
