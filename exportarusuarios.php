 <?
 
 //importar Lugares
   $host="localhost";
   $user="root";
   $password="";
   $link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
   //Vaciando la Tabla

   // Leyendo tabla Responsable
   mysql_select_db ("backcaps",$link);
   //$cadena = "select ws02.hc as hc, ws00.VAR102 as nombre, ws00.VAR103 as apellido from (ws02 INNER join ws00 on ws00.VAR101 = ws02.hc )";// inner join ws01 on ws01.rel_00 = ws02.REL_00"; // join ws01  on ws01.rel_00 =  ws02.REL_00 ";	 
   $cadena = "select  ws01.VAR224, ws01.VAR225, ws01.VAR226, ws00.VAR101, ws00.VAR102,ws00.VAR103,ws00.VAR104,ws01.VAR201,ws01.VAR202,ws01.VAR203,ws01.VAR204, ws01.VAR205, ws01.VAR207, ws01.VAR210, ws01.VAR211, ws00.VAR105,ws01.VAR213, ws01.VAR214, ws01.VAR215,  ws01.VAR216, ws01.VAR217, ws01.VAR218, ws01.VAR219, ws01.VAR220, ws01.VAR221, ws01.VAR223, ws01.VAR293, ws01.VAR294, ws01.VAR227,ws01.VAR228, ws01.VAR229, ws01.VAR230, ws01.VAR231, ws01.VAR201, ws01.VAR232, ws01.VAR233, ws01.VAR234, ws01.VAR235, ws01.VAR236   from (ws02 join ws00 on ws02.REL_00 = ws00.COD_MA) join ws01 on ws01.rel_00 = ws02.REL_00 limit 1";
//$cadena = "select VAR101 from ws00 order by hc"; // join ws01  on ws01.rel_00 =  ws02.REL_00";   
   $tabla = mysql_query($cadena, $link);   
   //$numero = mysql_num_rows($tabla);
   
  // if($numero>0)
   //{
    $i=0;
	 while ($registro = mysql_fetch_array($tabla))
	 { 
		inserta_dato_sistema($registro[0],$registro[1],$registro[2],$registro[3],$registro[4],$registro[5],$registro[6],$registro[7],$registro[8],$registro[9],$registro[10],$registro[11],$registro[12],$registro[13],$registro[14],$registro[15],$registro[16],$registro[17],$registro[18],$registro[19],$registro[20],$registro[21],$registro[22],$registro[23],$registro[24],$registro[25],$registro[26],$registro[27],$registro[28],$registro[29],$registro[30],$registro[31],$registro[32],$registro[33],$registro[34],$registro[35],$registro[36],$registro[37],$registro[38]);
		//echo $i."- $registro[0] $registro[1] $registro[2] $registro[3] $registro[4] $registro[5] $registro[6] $registro[7] $registro[8] $registro[9] $registro[10] $registro[11] $registro[12] $registro[13] $registro[14] $registro[15] $registro[16] $registro[17] $registro[18] $registro[19] $registro[20] $registro[21] $registro[22] $registro[23] $registro[24] $registro[25] $registro[26] $registro[27] $registro[28] $registro[29] $registro[30] $registro[31] $registro[32] $registro[33] $registro[34] $registro[35] $registro[36] $registro[37] $registro[38]<br>";
		$i=$i+1;
	 }
     //echo $numero;	  
	 
    
   mysql_free_result($tabla);

function inserta_dato_sistema($VAR224, $VAR225, $VAR226, $VAR101,$nombre,$apellidos1,$apellidos2,$VAR201,$VAR202,$VAR203,$VAR204, $VAR205, $VAR207, $VAR210, $VAR211, $VAR105,$VAR213, $VAR214, $VAR215, $VAR216, $VAR217, $VAR218, $VAR219, $VAR220, $VAR221, $VAR223, $VAR293, $VAR294, $VAR227, $VAR228, $VAR229, $VAR230, $origen, $VAR201, $VAR232, $VAR233, $VAR234, $VAR235, $VAR236)
{

 	/*
	tipodoc 	nrodocumento 	
	origen 	iddepartamento 	idprovincia 	iddistrito 	fechanacimiento 	edadactual 	edadingreso 	idsexo 	idestadocivil 	idestudios 	ocupacion 	direccion 	iddepartamentoact 	idprovinciaact 	iddistritoact 	telefono 	celular 	anioresidencia
	*/
	echo "$VAR224, $VAR225, $VAR226, $VAR101,$nombre,$apellidos1,$apellidos2,$VAR201,$VAR202,$VAR203,$VAR204, $VAR205, $VAR207, $VAR210, $VAR211, $VAR105,$VAR213, $VAR214, $VAR215, $VAR216, $VAR217, $VAR218, $VAR219, $VAR220, $VAR221, $VAR223, $VAR293, $VAR294, $VAR227, $VAR228, $VAR229, $VAR230, $origen, $VAR201, $VAR232, $VAR233, $VAR234, $VAR235, $VAR236 <br>";

	
	
	$apellidos="$apellidos1 $apellidos2";
	$tipodoc="";
	$nrodocumento=$VAR105;
	$origen=$origen;
	$iddepartamento=$VAR224;
	$idprovincia=$VAR225;
	$iddistrito=$VAR226;
	$fechanacimiento=$VAR216;
	$edadactual=$VAR201;
	$edadingreso=$VAR201;
	$idsexo=$VAR202;
	$idestadocivil=$VAR203;
	$idestudios=$VAR204;
	$ocupacion=$VAR233;
	$direccion=$VAR230;
	$iddepartamentoact=$VAR234;
	$idprovinciaact=$VAR235;
	$iddistritoact=$VAR236;
	$telefono=$VAR113;
	$celular=$VAR223;
	$anioresidencia=$VAR207;
	$hc=$VAR101;	
	
    $cadena ="insert into usuario  (idusuario,nombre,apellidos,tipodoc,nrodocumento,origen,iddepartamento,idprovincia,iddistrito,fechanacimiento,edadactual,edadingreso,idsexo,idestadocivil,idestudios,ocupacion,direccion,iddepartamentoact,idprovinciaact,iddistritoact,telefono,celular,anioresidencia,hc) values ('','$nombre','$apellidos','$tipodoc','$nrodocumento','$origen','$iddepartamento','$idprovincia','$iddistrito','$fechanacimiento','$edadactual','$edadingreso','$idsexo','$idestadocivil','$idestudios','$ocupacion','$direccion','$iddepartamentoact','$idprovinciaact','$iddistritoact','$telefono','$celular','$anioresidencia','$hc');";
	
	echo $cadena;
}
   
   
?>
