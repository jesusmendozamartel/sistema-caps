<?php
  include("funciones.php");

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $subarea = $_COOKIE["subarea"];
   $idprovincia = $_POST["elegido"];
   $cadena ="SELECT * FROM subarea where idarea='$idprovincia' order by descripcion asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($subarea == $registro[0])
	     echo "<option value='$registro[0]' selected>$registro[1]</option>";
	 else	 
	     echo "<option value='$registro[0]'>$registro[1]</option>";
     
  }
    mysql_free_result($tabla);
	mysql_close($conexion);


?>