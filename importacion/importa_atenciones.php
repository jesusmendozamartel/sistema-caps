<?

 
 $conexion = conectar_base();
 mysql_select_db ("datacaps",$conexion);
 $cadena = "select var101,var301,var302,var303,var304,var305,var306,var307,var393,var394,var317  from atencion limit 20000, 2000";
 
 $tabla = mysql_query($cadena, $conexion);

 //  echo "Encontrados: ".$registros_encontrados."<br>";
echo "IMPIRTANDOP";
   while ($registro = mysql_fetch_array($tabla)){

    graba_basedestino($registro["var101"],$registro["var301"],$registro["var302"],$registro["var303"],$registro["var304"],$registro["var305"],$registro["var306"],$registro["var307"],$registro["var393"],$registro["var394"],$registro["var317"]);
     


  }

  echo "<b>TERMINO</b>";
    mysql_free_result($tabla);
    mysql_close($conexion);


function  graba_basedestino($var101,$var301,$var302,$var303,$var304,$var305,$var306,$var307,$var393,$var394,$var317)
{
 
     //$idatencion
     //$codatencion
     $fecha = $var301;
     $idlugar = (int)$var302;
     $idtipousuario = traertipo($var303);
     $idarea = (int)$var306;
     $idsubarea = recupera_subarea($var307);
     $idresponsable1 = (int)$var304;
     $idresponsable2 = (int)$var317;
     $idproyecto = $var319;
     $idactividad = "";
     $idescalarecuperacion = "0";
     $idencuesta = "";
     $idusario = recuperaid($var101);
     $fechacreacion = $var393;
     $fechamodificacion = $var394;
     $idsession = (int)$var302;
     $bloqueado = "0";

   //echo   " ".$idusario." ".$var101;
 
   // echo $iddepartamento;

     $variable =  "idatencion,codatencion,fecha,idlugar,idtipousuario,idarea,idsubarea,idresponsable1,idresponsable2,idproyecto,idactividad,idescalarecuperacion,idencuesta,idusario, fechacreacion,fechamodificacion,idsession,bloqueado";

    $valores ="'$idatencion','$codatencion','$fecha','$idlugar','$idtipousuario','$idarea','$idsubarea','$idresponsable1','$idresponsable2','$idproyecto','$idactividad','$idescalarecuperacion','$idencuesta','$idusario','$fechacreacion','$fechamodificacion','$idsession','$bloqueado'";

    $cadena = "insert into atencion  ($variable) values ($valores)";
    //echo $cadena;
   
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);

    mysql_query($cadena, $conexion);
    mysql_free_result($tabla);
    mysql_close($conexion);

   
}
function recupera_subarea($control)
{
  $control = (int)$control;
  
   $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);

  $cadena ="SELECT * from subarea where control='$control' ";

  $tabla = mysql_query($cadena, $conexion);
  
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[0];
   }
  
  
    mysql_free_result($tabla);
    mysql_close($conexion);
   return $cadena2;
 

}

function traertipo($control)
{
  $control = (int)$control;
  
   $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);

  $cadena ="SELECT * from tipousuario where control='$control' ";

  $tabla = mysql_query($cadena, $conexion);
  
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[0];
   }
  
  
    mysql_free_result($tabla);
    mysql_close($conexion);
   return $cadena2;
 

}
function recuperaid($hc)
{
   $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);

  $cadena ="SELECT * from usuario where hc='$hc' ";

  $tabla = mysql_query($cadena, $conexion);
  
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[0];
   }
  
  
    mysql_free_result($tabla);
    mysql_close($conexion);
   return $cadena2;


}
function recuperalugar2($iddepartamento,$idprovincia,$iddistrito)
{
  
  
 
  $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);

  $cadena ="SELECT departamento.iddepartamento, provincia.idprovincia, distrito.iddistrito, departamento.descripcion, provincia.descripcion, distrito.descripcion, distrito.DI98 FROM (departamento JOIN provincia ON departamento.iddepartamento = provincia.iddepartamento ) JOIN distrito ON provincia.idprovincia = distrito.idprovincia where departamento.iddepartamento=$iddepartamento and provincia.idprovincia=$idprovincia and distrito.DI98='$iddistrito'";

  $tabla = mysql_query($cadena, $conexion);
  
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[2];
   }
  
  
    mysql_free_result($tabla);
    mysql_close($conexion);
   return $cadena2;


}

function recuperalugar($indice,$iddepartamento,$idprovincia,$iddistrito)
{
  
  
  $iddepartamento = (int)$iddepartamento; 

  $iddistrito = (int)$iddistrito;
  $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);
 if($indice=="1")
 {  
    $cadena ="SELECT departamento.iddepartamento, provincia.idprovincia, provincia.PP98, departamento.descripcion, provincia.descripcion FROM (departamento JOIN provincia ON departamento.iddepartamento = provincia.iddepartamento )  where departamento.iddepartamento=$iddepartamento and provincia.PP98='$idprovincia' ";
  //  echo $cadena;

 }else
 { 
  $cadena ="SELECT departamento.iddepartamento, provincia.idprovincia, distrito.iddistrito, departamento.descripcion, provincia.descripcion, distrito.descripcion FROM (departamento JOIN provincia ON departamento.iddepartamento = provincia.iddepartamento ) JOIN distrito ON provincia.idprovincia = distrito.idprovincia where departamento.iddepartamento=$iddepartamento and provincia.idprovincia=$idprovincia and distrito.iddistrito=$iddistrito";
 }

  $tabla = mysql_query($cadena, $conexion);
  
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[$indice];
   }
  
  
    mysql_free_result($tabla);
    mysql_close($conexion);
   return $cadena2;


}

function conectar_base()
{
 $host="localhost";
 $user="root";
 $password="aniladi42";
 $link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
 return $link;
}

?>
