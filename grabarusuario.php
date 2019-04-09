<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<center>
 
 <?php
    include("funciones.php");
  
     //$idusuario,
	 $nombre = $_POST['nombres'];
	 $apellidos= $_POST['apellidos'];
	 $tipodoc= $_POST['tipodocumento'];
	 $nrodocumento= $_POST['numerodocumento'];
	 $origen= $_POST['origen'];
	 $iddepartamento= $_POST['cmbdepartamento'];
	 $idprovincia= $_POST['cmbprovincia'];
	 $iddistrito= $_POST['cmbdistrito'];
	 $fechanacimiento= $_POST['fechanacimiento'];
	 $edadactual= $_POST['edad'];
	 $edadingreso= $_POST['fechaingreso'];
	 $idsexo= $_POST['sexo'];
	 $idestadocivil= $_POST['estadovivil'];
	 $idestudios= $_POST['estudios'];
	 $ocupacion= $_POST['ocupacion'];
	 $direccion= $_POST['direccion'];
	 $iddepartamentoact= $_POST['cmbdepartamentoresidencia'];
	 $idprovinciaact= $_POST['cmbprovinciaresidencia'];
	 $iddistritoact= $_POST['cmbdistritoresidencia'];
	 $telefono= $_POST['telefono'];
	 $celular= $_POST['celular'];
	 $anioresidencia= $_POST['aniosresidencia'];	 
	 $hc= $_POST['hc'];	 
         $fechacreacion = date("d-m-Y H:i:s");
         $fechamodificacion = date("d-m-Y H:i:s");
	 $idsession = $_COOKIE["idsession"];
         $seguro = $_POST['seguro'];
         $textoseguro = $_POST['textoseguro'];
	 
	 if($_REQUEST["accion"]=="nuevo")
	 {
	     $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);	
        mysql_query("SET NAMES utf8");
	  if($nombre<>"" and $apellidos<>"")
	  {
	       $cadena = "insert into usuario(idusuario,nombre,apellidos,tipodoc,nrodocumento,origen,iddepartamento,idprovincia,iddistrito,fechanacimiento,edadactual,edadingreso,idsexo,idestadocivil,idestudios,ocupacion,direccion,iddepartamentoact,idprovinciaact,iddistritoact,telefono,celular,anioresidencia,hc,fechacreacion,fechamodificacion,idsession,eliminado,seguro,textoseguro) values (NULL,'$nombre','$apellidos','$tipodoc','$nrodocumento','$origen','$iddepartamento','$idprovincia','$iddistrito','$fechanacimiento','$edadactual','$edadingreso','$idsexo','$idestadocivil','$idestudios','$ocupacion','$direccion','$iddepartamentoact','$idprovinciaact','$iddistritoact','$telefono','$celular','$anioresidencia','$hc','$fechacreacion','$fechamodificacion','$idsession','0','$seguro','$textoseguro')";
			mysql_query($cadena,$conexion);
	       $sw = 1;
	  }else
	      {
		     $sw=11; //Campo debe estar lleno
		  }
	
        
	    mysql_close($conexion);
	   
	 }else
	    {
		
		$conexion = conectar_base();
         
           mysql_select_db ("sistemaatencion",$conexion);	
	 mysql_query("SET NAMES utf8");  
         if($nombre<>"" and $apellidos<>"")
	  {
	       $fechamodificacion = date("d-m-Y H:i:s");
                $cadena = "update usuario set nombre='$nombre',apellidos='$apellidos',tipodoc='$tipodoc',nrodocumento='$nrodocumento',origen='$origen',iddepartamento='$iddepartamento',idprovincia='$idprovincia',iddistrito='$iddistrito',fechanacimiento='$fechanacimiento',edadingreso='$edadingreso',idsexo='$idsexo',idestadocivil='$idestadocivil',idestudios='$idestudios',ocupacion='$ocupacion',direccion='$direccion',iddepartamentoact='$iddepartamentoact',idprovinciaact='$idprovinciaact',iddistritoact='$iddistritoact',telefono='$telefono',celular='$celular',anioresidencia='$anioresidencia',fechamodificacion='$fechamodificacion',hc='$hc',seguro='$seguro',textoseguro='$textoseguro' where idusuario='$_REQUEST[iduser]'";
		   

                                                                                                                                                                                                                                                                                                                                                                                                        			mysql_query($cadena,$conexion);
	       $sw = 1;
	  }else
	      {
		     $sw=11; //Campo debe estar lleno
		  }
	
        
	    mysql_close($conexion);
	   
		
		
		
		
		}
	 if($sw==1)
	 {
	 ?><
	   <head>     
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=datosusuarios.php?accion=editar&iduser=<? echo $_REQUEST[iduser]; ?>&pagina=<? echo $_REQUEST[pagina]; ?>">
            </head> 
	 <? 
	 }
 ?>
 
</center>
