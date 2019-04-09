<?php
  include("funciones.php");

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $iddepartamento = $_POST["elegido"];
   $cadena ="SELECT * FROM provincia where iddepartamento='$iddepartamento' order by descripcion asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
	 echo "<option value='$registro[0]'>$registro[1]</option>";
     
  }
    mysql_free_result($tabla);
	mysql_close($conexion);


?>