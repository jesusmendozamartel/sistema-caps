<?php
     include("funciones.php");
  
    $conexion = conectar_base(); 
    mysql_select_db ("backcaps",$conexion);
    $cadena ="select var401, var402, var403, var408, var409, var410, var411, var406, var407, var412, var413, varproy,varacti  from ws04 limit 2500, 500";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
	echo "<table border='1'>";
	echo "<tr>";
	echo "<td>Id</td>";
	echo "<td>var401</td>";
	echo "<td>var402</td>";
	echo "<td>var403</td>";
	echo "<td>var408</td>";
	echo "<td>var409</td>";
	echo "<td>var410</td>";
	echo "<td>var411</td>";
	echo "<td>var406</td>";
	echo "<td>var407</td>";
	echo "<td>var412</td>";
	echo "<td>var413</td>";
	echo "<td>varproy</td>";
	echo "<td>varacti</td>";
	echo "</tr>";
    while ($registro = mysql_fetch_array($tabla))
	{
	  echo "<tr>";
	  echo "<td>$i</td>";
	  echo "<td>$registro[0]</td>"; //fecha
	  echo "<td>$registro[1]</td>"; //area
	 $idactividad = retorna_cadena($registro[2],"codantiguo",0,"areaeventosactvidad");
	  echo "<td>$idactividad</td>"; //actvidad
	  echo "<td>$registro[3]</td>"; //respon1
	  echo "<td>$registro[4]</td>"; //respon2
	  echo "<td>$registro[5]</td>"; // respon3
	  echo "<td>$registro[6]</td>";  //respon3
	  echo "<td>$registro[7]</td>"; //nuemro Benificiado  OK 406
	  echo "<td>$registro[8]</td>";    //lugar 407
	  $idaux=$registro[9]*1;
	  $idzonaintervencion = retorna_cadena($idaux,"codigoviejo",0,"lugaratencion"); 
	  echo "<td>$idzonaintervencion</td>"; //zona de intervencion  412
	  echo "<td>$registro[10]</td>"; //observacion  413
	  $idproyecto = retorna_cadena($registro[11],"CPROY",0,"proyecto"); 
	  echo "<td>$idproyecto</td>"; //proyecto
	  $idactividadproyecto = retorna_cadena($registro[12],"CACTI",0,"actividadproyecto"); 
	  echo "<td>$idactividadproyecto</td>"; //actividad
	  echo "</tr>";
	  $i=$i+1;
	  inserta_basenueva($registro[0],$registro[1],$idactividad,$registro[3],$registro[4],$registro[5],$registro[6],$registro[7],$registro[8],$idzonaintervencion,$registro[10],$idproyecto,$idactividadproyecto);
	  
	}
	//mysql_close($conexion);
	
function inserta_basenueva($fecha,$idarea,$idactividad,$idresponsable1,$idresponsable2,$idresponsable3,$idresponsable4, $nbenificiario, $lugar, $idzonaintervencion,$observacion,$idproyecto,$idactividadproyecto)
{
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="insert into eventos (ideventos,fecha,idarea,idactividad,idresponsable1,idresponsable2,idresponsable3,idresponsable4,nbenificiario,lugar,idzonaintervencion,observacion,idproyecto,idactividadproyecto) value ('','$fecha','$idarea','$idactividad','$idresponsable1','$idresponsable2','$idresponsable3','$idresponsable4', '$nbenificiario','$lugar','$idzonaintervencion','$observacion','$idproyecto','$idactividadproyecto')";

    mysql_query($cadena, $conexion); 
    mysql_close($conexion);
}
 
 ?>