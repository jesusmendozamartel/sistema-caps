<? include("cabecera.php"); 
   include("funciones.php");  
   $nombres = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
   $apellidos = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
   $iduser = $_REQUEST['iduser'];
   if($_POST['grabar'])
   {
      $conexion = conectar_base(); 
      mysql_select_db ("sistemaatencion",$conexion);
    //  $cadena = "select * from usuarioafectacion where iduser='$_REQUEST[iduser]'";	  
      $cadena = "select * from tipoafeccion";	  
      $tabla = mysql_query($cadena, $conexion);   
      $numero = mysql_num_rows($tabla);
      mysql_close($conexion);
      
	  if($numero>0)
	  {
	    
            for($i=1;$i<=$numero;$i++)
            {
               graba_opcion_afectacion($_POST["tex$i"], $_POST["op$i"], $_POST["indice$i"],$_REQUEST["iduser"]);   
              
            }

	  }
		 //echo $cadena;
		//   mysql_query($cadena,$conexion);
		 //  mysql_close($conexion);
		   
		   ?>
	<head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=datosusuarios.php?accion=editar&iduser=<? echo $_REQUEST["iduser"]?>">
        </head> 
	   <?
	 
   
   }
	
   
   
   
?>
<head>
<STYLE>

.contenido2
{ height: 1400px;
}
.div2
{
 height: 1400px;
}
</STYLE>
</head>
<div class="div2">
<div class="contenido2">
  <br>
   <b>AFECTACIONES DEL USUARIO: <?php echo $nombres." ".$apellidos; ?></b>
   <br><br>
   <?php
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
mysql_query("SET NAMES utf8");
    $cadena ="select * from tipoafeccion order by orden asc";
    $tabla = mysql_query($cadena, $conexion);
    $i=1;
	echo "<form name='grabar' method='post' action='afectacion.php?iduser=$_REQUEST[iduser]'>";
	echo "<table border='1' align='center'>";
	echo "<tr bgcolor='#e00000'><td><font color='#fffff'>Id</td><td><font color='#fffff'>Opt</td><td><font color='#fffff'>Especificar</td><td><font color='#fffff'>Descripci&oacute;n</td></tr>";
    while ($registro = mysql_fetch_array($tabla))
    {   
	
           $cadenita ="";
         
          $idrespuesraafectacion= busco_siexiste($registro[0],$iduser); 
     //      echo $registro[0]." ".$iduser."  $idrespuesraafectacion <br>";
          $valocillo =  retorna_cadena($idrespuesraafectacion,"idrespuesta",2,"respuesraafectacion");
          $textillo =  retorna_cadena($idrespuesraafectacion,"idrespuesta",1,"respuesraafectacion");
	    if($valocillo<>"" && $valocillo<>0) 
               echo "<tr bgcolor='YELLOW'>";
            else
               echo "<tr>";
             
	    echo "<td>";
            echo "<font face='2' face='arial'>".$registro[2]."</td>";
		if($valocillo=="")
		   $cadenita1= "selected";
		if($valocillo=="0")
		   $cadenita1= "selected";
		if($valocillo=="1")
		   $cadenita2= "selected";
		 if($valocillo=="2")
		   $cadenita3= "selected";
		   if($valocillo=="3")
		   $cadenita4= "selected";
		   
		//echo "<td><input type='checkbox' name='op$i' value='1' $cadenita ></td>";
		echo "<td><select name='op$i'><option value='0' $cadenita1 >Ninguno</option><option value='1' $cadenita2 >Directo</option><option value='2' $cadenita3>Indirecto </option><option value='3' $cadenita4 >Ambos</option></select></td>";
		echo "<input type='hidden' name='indice$i' value='$registro[0]'>";		
		echo "<td><input  name='tex$i' value='$textillo'></td>";
		echo "<td <font face='2' face='arial'>".$registro[1]."</td>";		
		echo "</tr>";
		
		 $i=$i+1;
		 $cadenita1="";
		 $cadenita2="";
		 $cadenita3="";
		 $cadenita4="";
	 }
         if($valorcillo<>"")  
	   echo "<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>";
         else
           echo "<tr bgcolor='YELLOWac'><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>";
	 echo "</table>";
	 echo "</form>";
	?>
</div>
</div>

<? include("pie.php");

function graba_opcion_afectacion($texto, $valor, $indice,$idusuario)
{
   $existe= busco_siexiste($indice,$idusuario);
   if($existe=="0")
     $cadena = "insert into respuesraafectacion (idrespuesta,especificar,valor,idafectacion,iduser) values (NULL,'$texto','$valor','$indice','$idusuario')"; 
   else
     $cadena = "update respuesraafectacion set valor='$valor',especificar='$texto' where idafectacion='$indice' and iduser='$idusuario'";

 //  echo "$cadena <br>";

  $conexion = conectar_base(); 
  mysql_select_db ("sistemaatencion",$conexion);
  mysql_query($cadena, $conexion);  
   mysql_close($conexion);
}

function busco_siexiste($indice,$idusuario)
{
      $indicerespuesta = 0;
      $conexion = conectar_base(); 
      mysql_select_db ("sistemaatencion",$conexion);
      $cadena = "select * from respuesraafectacion where idafectacion='$indice' and iduser='$idusuario'";	
     
   //   $cadena = "select * from tipoafeccion";	  
      $tabla = mysql_query($cadena, $conexion);   
      $numero = mysql_num_rows($tabla);
      if($numero==1)
      {
          while ($registro = mysql_fetch_array($tabla))
         {
             $indicerespuesta = $registro[0];
          }

      }
      mysql_close($conexion);

      return $indicerespuesta;
}

 ?>
