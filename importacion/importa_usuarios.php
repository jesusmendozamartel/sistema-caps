<?

 
 $conexion = conectar_base();
 mysql_select_db ("datacaps",$conexion);
 $cadena = "SELECT var224, var225, var226, var101, var102, var103, var104, var287, var202, var203, var204, var105, var213, var214, var215, var216, var221, var223, var293, var294, var278, var231, var201, var288, var289, var233, var234, var235, var236, var106 FROM paciente";
 
 $tabla = mysql_query($cadena, $conexion);
 $registros_encontrados = mysql_num_rows($tabla);
 //  echo "Encontrados: ".$registros_encontrados."<br>";
echo "IMPIRTANDOP";
   while ($registro = mysql_fetch_array($tabla)){

    graba_basedestino($registro["var224"],$registro["var225"],$registro["var226"],$registro["var101"],$registro["var102"],$registro["var103"],$registro["var104"],$registro["var287"],$registro["var202"],$registro["var203"],$registro["var204"],$registro["var105"],$registro["var213"],$registro["var214"],$registro["var215"],$registro["var216"],$registro["var221"], $registro["var223"], $registro["var293"], $registro["var294"], $registro["var278"], $registro["var231"], $registro["var201"], $registro["var288"], $registro["var289"], $registro["var233"], $registro["var234"], $registro["var235"], $registro["var236"], $registro["var106"]);
     


  }

  echo "<b>TERMINO</b>";
    mysql_free_result($tabla);
    mysql_close($conexion);


function  graba_basedestino($var224, $var225, $var226, $var101, $var102, $var103, $var104, $var287, $var202, $var203, $var204, $var105, $var213, $var214, $var215, $var216, $var221, $var223, $var293, $var294, $var278, $var231, $var201, $var288, $var289, $var233, $var234, $var235, $var236, $var106)
{
 
     $nombre = $var102;
     $apellidos = $var103." ".$var104;
     $tipodoc = 1;
     $nrodocumento = $var105;
     if($var231=="1")
        $origen = "URBANO";
     else  
       $origen = "RURAL";
     $iddepartamento = (int)$var224;
     $idprovincia = recuperalugar(1,$var224,$var225,$var226);
     //echo $idprovincia;
     $iddistrito =  recuperalugar2($iddepartamento,$idprovincia,$var226);
//     echo $iddistrito;
     $fechanacimiento = $var216;
     $edadactual = $var289;
     $edadingreso = $var201;
     $idsexo = $var202;   // 0  1 M , 2 F
     $idestadocivil = $var203; // 0 ND 1 Soltero 2 Casado 3 Divor/viudo/Separado 4 Madre soltera
     $idestudios = $var204;  // 0  Sin Dato 1 Ninguno 2 Primaria  3 Secundaria   4 Superior    
     $ocupacion = $var233;  
     $direccion = $var214;
     $iddepartamentoact = (int)$var234;
     $idprovinciaact= recuperalugar(1,$var234,$var235,$var236);// $var235;
     $iddistritoact = recuperalugar2($iddepartamentoact,$idprovinciaact,$var236); //$var236;
     $telefono = $var213;
     $celular = $var223;
     $anioresidencia = 0;
     $hc = $var101;
     $fechacreacion = $var293;
     $fechamodificacion = $var294;
     $idsession = (int)$var106; //"buscarID LUGAR REGISTRO"
     $eliminado = "0";
   

   
   // echo $iddepartamento;

    $variable =  "idusuario,nombre,apellidos,tipodoc,nrodocumento,origen,iddepartamento,idprovincia,iddistrito,fechanacimiento,edadactual,edadingreso,idsexo,idestadocivil,idestudios,ocupacion,direccion,iddepartamentoact, idprovinciaact,iddistritoact,telefono,celular, anioresidencia, hc,fechacreacion,fechamodificacion,idsession,eliminado";

    $valores ="'','$nombre','$apellidos','$tipodoc', '$nrodocumento','$origen','$iddepartamento','$idprovincia','$iddistrito','$fechanacimiento','$edadactual','$edadingreso','$idsexo','$idestadocivil', '$idestudios', '$ocupacion', '$direccion', '$iddepartamentoact', '$idprovinciaact', '$iddistritoact', '$telefono', '$celular', '$anioresidencia', '$hc', '$fechacreacion', '$fechamodificacion', '$idsession', '$eliminado'";

    $cadena = "insert into usuario  ($variable) values ($valores)";
  
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);

    mysql_query($cadena, $conexion);
    mysql_free_result($tabla);
    mysql_close($conexion);
   
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
