<? include("cabecera.php"); 
   include("funciones.php");
    $descipcioncapacitacion = retorna_cadena($_REQUEST["idcapacitacion"],"idcapacitacion",1,"capacitacion");
    
   if($_REQUEST["yesterday"]=="1")
   {
      $conexion = conectar_base(); 
      mysql_select_db ("sistemaatencion",$conexion);
      $cadena ="delete from capacitacionuser where idcapacitacionuser='$_REQUEST[idcapacitacionuser]' ";
      mysql_query($cadena, $conexion);
      mysql_close($conexion);
  
     ?>
     <head>         
 	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=capacitaciones_capacitados.php?editablelist=1&idcapacitacion=<? echo  $_REQUEST[idcapacitacion]; ?>&idproyecto=<? echo  $_REQUEST[idproyecto] ?>">
     </head> 

    <?
    }


?>

<div class="div1">
<div class="contenido">
 
   <b>MODULO DE CAPACITADOS</b>
   
<? include("menu_capacitado.php"); ?><hr>

<h2>Esta a punto de eliminar este capacitado de la capacitacion, mas no elimina el registro ingresado en la base de datos</h2>

<h2><a href="capacitaciones_capacitados.del.php?idcapacitacion=<? echo $_REQUEST["idcapacitacion"]; ?>&idproyecto=<? echo $_REQUEST["idproyecto"] ?>&idcapacitacionuser=<? echo  $_REQUEST["idcapacitacionuser"] ?>&yesterday=1">[SI]</a>  <a href="javascript:history.go(-1);"> [NO] </a></h2>
 

</div>
</div>
</div>

<? include("pie.php") ?>
