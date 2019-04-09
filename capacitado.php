<? include("cabecera.php"); 
   include("funciones.php");
  
   if($_POST["grabar"])
   {
      //echo $_REQUEST["idproyecto"];
	  if($_POST["nombre"]<>"" and $_POST["apellidos"]<>"" and $_POST["documento"]<>"")
	   {
		 
		 
		if($_REQUEST["op"]=="nuevo")
		{
		$conexion = conectar_base();
                mysql_select_db ("sistemaatencion",$conexion);
		
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$tipodocumento = $_POST["tipodocumento"];
		$documento = $_POST["documento"];
		$edad = $_POST["edad"];
		$sexo = $_POST["sexo"];
		$cargo = $_POST["cargo"];
		$profesion = $_POST["profesion"];
		$direccion = $_POST["direccion"];
		$telefono = $_POST["telefono"];
		$fax = $_POST["fax"];
		$email = $_POST["email"];
		$organizacion = $_POST["organizacion"];
		$gradoinstruccion = $_POST["gradoinstruccion"];
		$cadena = "insert into capacitados (idcapacitado,nombre,apellidos,tipodocumento,documento,edad,sexo,cargo,profesion,direccion,telefono,fax,email,organizacion,gradoinstruccion) values (NULL,'$nombre','$apellidos','$tipodocumento','$documento','$edad','$sexo','$cargo','$profesion','$direccion','$telefono','$fax','$email','$organizacion','$gradoinstruccion')";		
		//echo $cadena;
		mysql_query($cadena,$conexion);
	  //    mysql_free_result($tabla);
	        mysql_close($conexion);

           
               $idcapacitado = ultimocapacitado();
        	$conexion = conectar_base();
                mysql_select_db ("sistemaatencion",$conexion);
	       
               
               $idcapacitacion = $_REQUEST["idcapacitacion"];
               $cadena = "insert into capacitacionuser (idcapacitacionuser,idcapacitacion,idcapacitado) values ('','$idcapacitacion','$idcapacitado')";
		 mysql_query($cadena, $conexion);   

                mysql_query("insert into ",$conexion);
                mysql_close($conexion);
  
		}else
		  {
		  
		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$tipodocumento = $_POST["tipodocumento"];
		$documento = $_POST["documento"];
		$edad = $_POST["edad"];
		$sexo = $_POST["sexo"];
		$cargo = $_POST["cargo"];
		$profesion = $_POST["profesion"];
		$direccion = $_POST["direccion"];
		$telefono = $_POST["telefono"];
		$fax = $_POST["fax"];
		$email = $_POST["email"];
		$organizacion = $_POST["organizacion"];
		$gradoinstruccion = $_POST["gradoinstruccion"];
		
		$idcapacitado = $_REQUEST["idcapacitado"];
		
		$cadena = "update capacitados set nombre='$nombre',apellidos='$apellidos',tipodocumento='$tipodocumento',documento='$documento',edad='$edad',sexo='$sexo',cargo='$cargo',profesion='$profesion',direccion='$direccion',telefono='$telefono',fax='$fax',email='$email',organizacion='$organizacion',gradoinstruccion='$gradoinstruccion'  where idcapacitado='$idcapacitado'";
		
           mysql_query($cadena,$conexion);
	   // mysql_free_result($tabla);
	    mysql_close($conexion);	  
		
		  }
		
		
         ?>
		
		  <head>        
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=capacitaciones_capacitados.php?editablelist=<? echo $_REQUEST[editablelist];?>&idcapacitacion=<? echo $_REQUEST[idcapacitacion] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>">  
          </head> 
		 
	  
		<?		
		}
		
   }
   if($_REQUEST["op"]==editar)
	 {
	 
	        $nombre = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",1,"capacitados");
		$apellidos = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",2,"capacitados");
		$tipodocumento =retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",3,"capacitados");
		$documento =retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",4,"capacitados");
		$edad = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",5,"capacitados");
		$sexo = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",6,"capacitados");
		$cargo = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",7,"capacitados");
		$profesion = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",8,"capacitados");
		$direccion = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",9,"capacitados");
		$telefono = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",10,"capacitados");
		$fax = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",11,"capacitados");
		$email = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",12,"capacitados");
		$organizacion = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",13,"capacitados");
		$gradoinstruccion = retorna_cadena($_REQUEST["idcapacitado"],"idcapacitado",14,"capacitados");
	 
		
	 }
   
?>

<div class="div1">
<div class="contenido">
    <br>
   <b>MODULO DE CAPACITADOS</b>
   <br>

<? include("menu_capacitado.php"); ?>  
   <hr>
<table><tr><td>
<? if($_REQUEST["op"]=="nuevo"){ ?>
<font face="arial" size="2"><b>Nuevo Capacitado</b></font></td><td>
<? }else{?>
  <font face="arial" size="2"><b>Editar Capacitado</b></font></td><td>
<? } ?>
</td></tr>
</table>
  
  
 <div class="scroll2">


 <table bgcolor="#ffffff" width='center' width='400' align='center' border='0'>
<tr bgcolor="#c1a404"><td colspan='3'><a href="capacitaciones_capacitados.php?editablelist=<? echo $_REQUEST[editablelist] ?>&idcapacitacion=<? echo $_REQUEST[idcapacitacion] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>"><img src="imagenes/cerrar.jpg" border="1"></a> </td></tr>
<? if($_REQUEST["op"]=="nuevo"){ ?>

<form name='nuevaopcion' method='post' action='capacitado.php?editablelist=<? echo $_REQUEST[editablelist] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>&idcapacitacion=<? echo $_REQUEST[idcapacitacion] ?>&op=<?php echo $_REQUEST["op"]; ?>'>
<? }else { ?>
    <?php echo $_REQUEST["opcion"]; ?>
   <form name='nuevaopcion' method='post' action='capacitado.php?editablelist=<? echo $_REQUEST[editablelist] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>&idcapacitacion=<? echo $_REQUEST[idcapacitacion] ?>&op=<?php echo $_REQUEST["op"]; ?>&idcapacitado=<?php echo $_REQUEST["idcapacitado"];?>'>
<? }?>
<tr><td><b>Nombre</b></td><td>:</td><td> <input name='nombre' size="35" value='<? echo $nombre; ?>' ></td></tr>
<tr><td><b>Apellidos</b></td><td>:</td><td> <input name='apellidos' size="35" value='<? echo $apellidos; ?>' ></td></tr>
<tr><td><b>Tipo Doc</b></td><td>:</td><td> <select  name='tipodocumento'>
<option value="DNI" <? if($tipodocumento=="DNI"){ echo "SELECTED"; } ?>>DNI</option>
<option value="CARNET EXTRANGERIA" <? if($tipodocumento=="CARNET EXTRANGERIA"){ echo "SELECTED"; } ?>>CARNET EXTRANGERIA</option>
<option value="PASAPORTE" <? if($tipodocumento=="PASAPORTE"){ echo "SELECTED"; } ?>>PASAPORTE</option>
<option value="SIN DOCUMENTO" <? if($tipodocumento=="SIN DOCUMENTO"){ echo "SELECTED"; } ?>>Sin Documento</option>
</select>
<tr><td><b>Documento</b></td><td>:</td><td> <input name='documento' value='<? echo $documento; ?>'>
<tr><td><b>Edad</b></td><td>:</td><td> <input name='edad' value='<? echo $edad; ?>'>
<tr><td><b>Sexo</b></td><td>:</td><td> <select  name='sexo' value='<? echo $sexo; ?>'>
<?cargar_sexo($sexo); ?>   
</select>	
</td></tr>
<tr><td><b>Grado de Instrucci&oacute;n</b></td><td>:</td><td> 
<select name="gradoinstruccion">
<?php cargar_estudios($gradoinstruccion); ?>

</select>
</td></tr>
<tr><td><b>Ocupaci&oacute;n/Profesi&oacute;n</b></td><td>:</td><td> <input name='profesion' value='<? echo $profesion; ?>'>
<tr><td><b>Cargo</b></td><td>:</td><td> <input name='cargo' value='<? echo $cargo; ?>'>
<tr><td><b>Organizaci&oacute;n/Instituci&oacute;n</b></td><td>:</td><td> <input name='organizacion' value='<? echo $organizacion; ?>'>
<tr><td><b>Direcci&oacute;n</b></td><td>:</td><td> <input name='direccion' value='<? echo $direccion; ?>'>
<tr><td><b>Telefono/celular</b></td><td>:</td><td> <input name='telefono' value='<? echo $telefono; ?>'>
<tr><td><b>Fax</b></td><td>:</td><td> <input name='fax' value='<? echo $fax; ?>'>
<tr><td><b>Email</b></td><td>:</td><td> <input name='email' value='<? echo $email; ?>'>



<tr><td colspan='3' align='center'><input type='submit' name='grabar' value='grabar'></td></tr>
</form> 
</table>
</div>
Este modulo agrega como nuevo al capacitado, pero no le asigna a ninguna capacitaci&oacute;n luego de esta operaci&oacute;n ya puede asignarlo ( [+] asignar capacitado) a la capacitaci&oacute;n que corresponde, este registro es utilizado para todas las capacitaciones.
</div>
</div>

<? include("pie.php"); 

function ultimocapacitado()
{
  $conexion = conectar_base(); 
 mysql_select_db ("sistemaatencion",$conexion);
  mysql_query("SET NAMES utf8");
 $cadena ="SELECT * FROM capacitados order by idcapacitado desc   limit 0,1";
 $tabla = mysql_query($cadena, $conexion);

 $registros_encontrados = mysql_num_rows($tabla);
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[0];
  }
  

    mysql_free_result($tabla);
   mysql_close($conexion);
   return $cadena2;

}
?>

