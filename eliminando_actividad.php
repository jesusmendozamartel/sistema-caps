<? include("cabecera.php"); 
   include("funciones.php");
   
   $actividad = retorna_cadena($_REQUEST["idactividad"],"idactividad",13,"actividades");
   $idproyecto = retorna_cadena($_REQUEST["idactividad"],"idactividad",2,"actividades");
   if($_REQUEST[afirmacion]=="yesterday")
   {
     $idactividad = $_REQUEST["idactividad"];
     $cadena = "DELETE FROM actividades WHERE idactividad = $idactividad";
       $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
        mysql_query($cadena,$conexion);
        mysql_close($conexion);
        echo $cadena;
             ?>
        
 
                 <head>         
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_actividades.php?&idproyecto=<? echo $_REQUEST[idproyecto] ?>">
                 </head> 

              <?    
  
   }

?>
<div class="div1">
<div class="contenido">

  <br>
   <b>MODULO PROYECTOS - ACTIVIDADES</b>
   <hr>
<div align="right"><a href="javascript:history.back()"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <? include("menu_proyectos.php")?>

<form name='eliminar'>
<table>
<tr>
<td><b>Esta seguro de Eliminar esta actividad?: <? echo $actividad; ?> </b></td>
</tr>
<tr><td><a href="eliminando_actividad.php?afirmacion=yesterday&idactividad=<? echo $_REQUEST["idactividad"]; ?>&idproyecto=<? echo $_REQUEST['idproyecto']; ?>">[SI]</a>  <a href="javascript:history.back()">[NO]</a></td></tr>
</table>

</form>

</div>
</div>
