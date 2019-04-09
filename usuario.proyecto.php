<?php
   include("funciones.php");


   $proyecto = $_REQUEST["proyecto"];
  
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES utf8");
   

   $cadena = "select DISTINCT nombre, apellidos, hc from usuario join atencion on usuario.idusuario = atencion.idusario where proyecto1='$proyecto' or proyecto2='$proyecto' or proyecto3='$proyecto' or proyecto4='$proyecto'";
   
   $tabla = mysql_query($cadena, $conexion);   
   
   $contador =0;
   echo "<table>";
   while ($registro = mysql_fetch_array($tabla))
   {
      echo "<tr>";
      echo "<td>";
	  echo $registro[2]." ".$registro[0]." ".$registro[1];
	  echo "</td>"; 
      echo "</tr>";
   }
   echo "</table>";
   mysql_free_result($tabla);
  
?>