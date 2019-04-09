<?php

require "conexion.php";



 function mostrar_paises()
{	
   $conexion = conectar_base();
 
 mysql_select_db ("sistemaatencion",$conexion);
 $cadena ="SELECT * FROM departamento order by descripcion";
 $tabla = mysql_query($cadena, $conexion);
 $registros_encontrados = mysql_num_rows($tabla);
 //  echo "Encontrados: ".$registros_encontrados."<br>";
  echo "[+] <a href='region.php?op=nuevo'>Region/Departamento</a><br><br>";
  echo "<table width='800'><tr><td bgcolor='#8c0b0b' colspan='5'>";
  echo "<span class='titulodato'>Departamento</span>";
  echo "</td></tr>";
  
   while ($registro = mysql_fetch_array($tabla)){
    echo "<tr>";
	echo "<td width='20'><a href='provincias.php?id=$registro[0]'><img src='imagenes/txt_listar.jpg' border='0'></a></td>";
	echo "<td width='20'><a href='region.php?op=editar&id=$registro[0]'><img src='imagenes/editar.gif' border='0'></td>";
	echo "<td width='20'><a href='eliminar.php?objeto=1&id=$registro[0]'><img src='imagenes/eliminar.gif' border='0'></a></td>";
	echo "<td><span class='dato'>".$registro[1]."</span></td></tr>";
  }
  echo "</table>";
  
    mysql_free_result($tabla);
	mysql_close($conexion);
} 
function cuenta_rows($consultasql)
{

   $conexion = conectar_base();
 
   mysql_select_db ("sistemaatencion",$conexion);
   $tabla = mysql_query($consultasql, $conexion);
   $conteo = mysql_num_rows($tabla);
   mysql_close($conexion);
   return $conteo;
 
}



function mostrar_provincias($id)
{	
  
 $nombre = retorna_cadena($id,"iddepartamento",1,"departamento");
 $conexion = conectar_base(); 
 mysql_select_db ("sistemaatencion",$conexion);
 $cadena ="SELECT * FROM provincia where iddepartamento='$id'  order by descripcion";
 $tabla = mysql_query($cadena, $conexion);
 $registros_encontrados = mysql_num_rows($tabla);
 //  echo "Encontrados: ".$registros_encontrados."<br>";
  echo "<h1>".$nombre."</h1>";
  echo " [+] <a href='provincia.php?id=$id&op=nuevo'>Provincia</a><br><br>";
  echo "<table width='800'><tr><td bgcolor='#8c0b0b' colspan='5'>";
  echo "<span class='titulodato'>Provincias</span>";
  echo "</td></tr>";
  
   while ($registro = mysql_fetch_array($tabla)){
    echo "<tr>";
	echo "<td width='20'><a href='distritos.php?id=$id&idprov=$registro[0]'><img src='imagenes/txt_listar.jpg' border='0'></a></td>";
	echo "<td width='20'><a href='provincia.php?id=$id&op=editar&idprov=$registro[0]'><img src='imagenes/editar.gif' border='0'></td>";
	echo "<td width='20'><a href='eliminar.php?objeto=2&id=$registro[0]'><img src='imagenes/eliminar.gif' border='0'></a></td>";
	echo "<td><span class='dato'>".$registro[1]."</span></td></tr>";
  }
  echo "</table>";
  
    mysql_free_result($tabla);
	mysql_close($conexion);
} 

function mostrar_distritos($id,$idprov)
{	
  
 $depa = retorna_cadena($id,"iddepartamento",1,"departamento");
 $prov = retorna_cadena($idprov,"idprovincia",1,"provincia");
 
 $conexion = conectar_base(); 
 mysql_select_db ("sistemaatencion",$conexion);
 $cadena ="SELECT * FROM distrito where idprovincia='$idprov' order by descripcion";
 $tabla = mysql_query($cadena, $conexion);
 $registros_encontrados = mysql_num_rows($tabla);
 //  echo "Encontrados: ".$registros_encontrados."<br>";
  echo "<h1>".$depa." >>".$prov."</h1>";
  echo " [+] <a href='distrito.php?id=$id&idprov=$idprov&op=nuevo'>Distrito/Centro Poblado</a><br><br>";
  echo "<table width='800'><tr><td bgcolor='#8c0b0b' colspan='4'>";
  echo "<span class='titulodato'>Distrito/Centro Poblado</span>";
  echo "</td></tr>";
  
   while ($registro = mysql_fetch_array($tabla)){
    echo "<tr>";
	echo "<td width='20'><a href='distrito.php?id=$id&op=editar&idprov=$registro[2]&iddist=$registro[0]'><img src='imagenes/editar.gif' border='0'></td>";
	echo "<td width='20'><a href='eliminar.php?objeto=2&id=$registro[0]'><img src='imagenes/eliminar.gif' border='0'></a></td>";
	echo "<td><span class='dato'>".$registro[1]."</span></td></tr>";
  }
  echo "</table>";
  
    mysql_free_result($tabla);
	mysql_close($conexion);
} 



function retorna_cadena($id,$campo,$fila,$tabla)
{
  $conexion = conectar_base(); 
 mysql_select_db ("sistemaatencion",$conexion);
  mysql_query("SET NAMES utf8");
 $cadena ="SELECT * FROM $tabla where $campo = '$id'";
 $tabla = mysql_query($cadena, $conexion);

 $registros_encontrados = mysql_num_rows($tabla);
  $cadena2="";
   while ($registro = mysql_fetch_array($tabla)){
    $cadena2 = $registro[$fila];
  }
  

    mysql_free_result($tabla);
   mysql_close($conexion);
   return $cadena2;
}

function grabando_nueva_region($descripcion)
{
    $conexion = conectar_base();
    mysql_select_db ("sistemaatencion",$conexion);
	$cadena ="SELECT * FROM departamento where descripcion='$descripcion'";
	echo $cadena;
	$tabla = mysql_query($cadena, $conexion);
	$registros_encontrados = mysql_num_rows($tabla);
	
	if($registros_encontrados==0)
	{
	  if($descripcion<>"")
	  {
	       $cadena = "insert into departamento(iddepartamento,descripcion) values (NULL,'$descripcion')";
	       mysql_query($cadena,$conexion);
	       $sw = 1;
	  }else
	      {
		     $sw=11; //Campo debe estar lleno
		  }
	}else
	    {
		   $sw=10;  //Descripcion ya existente
		}
    mysql_free_result($tabla);
	mysql_close($conexion);
	return  $sw;
}

function CalculaEdad($fecha) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

function grabando_nueva_provincia($id, $descripcion)
{
    $conexion = conectar_base();
    mysql_select_db ("sistemaatencion",$conexion);
	$cadena ="SELECT * FROM provincia where descripcion='$descripcion' and iddepartamento='$id' ";
	echo $cadena;
	$tabla = mysql_query($cadena, $conexion);
	$registros_encontrados = mysql_num_rows($tabla);
	
	if($registros_encontrados==0)
	{
	  if($descripcion<>"")
	  {
	       $cadena = "insert into provincia(idprovincia,descripcion,iddepartamento) values (NULL,'$descripcion','$id')";
	       mysql_query($cadena,$conexion);
	       $sw = 1;
	  }else
	      {
		     $sw=11; //Campo debe estar lleno
		  }
	}else
	    {
		   $sw=10;  //Descripcion ya existente
		}
    mysql_free_result($tabla);
	mysql_close($conexion);
	return  $sw;
}
function grabando_nueva_distrito($id, $descripcion)
{
    $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
	$cadena ="SELECT * FROM distrito where descripcion='$descripcion' and idprovincia='$id' ";
	echo $cadena;
	$tabla = mysql_query($cadena, $conexion);
	$registros_encontrados = mysql_num_rows($tabla);
	
	if($registros_encontrados==0)
	{
	  if($descripcion<>"")
	  {
	       $cadena = "insert into distrito(iddistrito,descripcion,idprovincia) values (NULL,'$descripcion','$id')";
			mysql_query($cadena,$conexion);
	       $sw = 1;
	  }else
	      {
		     $sw=11; //Campo debe estar lleno
		  }
	}else
	    {
		   $sw=10;  //Descripcion ya existente
		}
    mysql_free_result($tabla);
	mysql_close($conexion);
	return  $sw;
}

function verifica_tortura($iduser)
{
        $cadena = "select sum(respuesraafectacion.valor) as suma from  tipoafeccion join respuesraafectacion on tipoafeccion.idafeccion = respuesraafectacion.idafectacion where respuesraafectacion.iduser ='$iduser' and tipoafeccion.tortura='1' and respuesraafectacion.valor>0";


    $conexion = conectar_base();
    mysql_select_db ("sistemaatencion",$conexion);
  
    $tabla = mysql_query($cadena, $conexion);

   while ($registro = mysql_fetch_array($tabla)){
     $cadena2 = $registro[0];
  }
   //   echo $cadena2;
  return $cadena2;
  
  mysql_close($conexion); 


/*        $suma = 0;
        for ($i = 18; $i <= 30; $i++) {
		  $suma = $suma + retorna_cadena($iduser,"iduser",$i,"usuarioafectacion");
		
	}
	return $suma;*/

}
function grabando_edicion_region($id,$descripcion)
{

   if($descripcion<>"")
   {
     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
     $cadena = "update departamento set descripcion='$descripcion' where iddepartamento='$id'";
	 mysql_query($cadena,$conexion);
	 $sw=1;
     mysql_close($conexion);
   }else
      {
	     $sw=11;
	  }
  //  mysql_free_result($tabla);
	
	return  $sw;
}
function grabando_edicion_provincia($id,$descripcion,$idprov)
{

   if($descripcion<>"")
   {
     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
     $cadena = "update provincia set descripcion='$descripcion' where iddepartamento='$id' and idprovincia='$idprov'";
	 mysql_query($cadena,$conexion);
	 $sw=1;
     mysql_close($conexion);
   }else
      {
	     $sw=11;
	  }
  //  mysql_free_result($tabla);
	
	return  $sw;

}

function grabando_edicion_distrito($idprovincia,$descripcion,$iddistrito)
{

   if($descripcion<>"")
   {
     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
     $cadena = "update distrito set descripcion='$descripcion' where iddistrito='$iddistrito' and idprovincia='$idprovincia'";
	 echo $cadena; 
	 mysql_query($cadena,$conexion);
	 $sw=1;
     mysql_close($conexion);
   }else
      {
	     $sw=11;
	  }
  //  mysql_free_result($tabla);
	
	return  $sw;

}

function graba_usuario($codatencion,$fecha,$idlugar,$idtipousuario,$idarea,$idsubarea,$idresponsable1,$idresponsable2,$idsession,$idactividad,$idescalarecuperacion,$idusario,$proyecto1,$proyecto2,$proyecto3,$proyecto4)
{

  echo "despuesde: ".$idactividad;
  if($idactividad=='')
    $idactividad =NULL;
   if($fecha<>"")
   {
     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
	 $fechacreacion = date("d-m-Y H:i:s");
     $cadena = "insert into atencion (idatencion,codatencion,fecha,idlugar,idtipousuario,idarea,idsubarea,idresponsable1,idresponsable2,idproyecto,idactividad,idescalarecuperacion,idencuesta,idusario,fechacreacion,fechamodificacion,idsession,bloqueado,proyecto1,proyecto2,proyecto3,proyecto4) values (NULL,'$codatencion','$fecha','$idlugar','$idtipousuario','$idarea','$idsubarea','$idresponsable1','$idresponsable2','$proyecto1',NULL,NULL,NULL,'$idusario','$fechacreacion','',$idsession,'0','$proyecto1','$proyecto2','$proyecto3','$proyecto4')";
         echo $cadena;

         //     `idatencion``codatencion``fecha``idlugar``idtipousuario``idarea``idsubarea``idresponsable1``idresponsable2``idproyecto``idactividad``idescalarecuperacion``idencuesta``idusario``fechacreacion``fechamodificacion``idsession``bloqueado``proyecto1``proyecto2``proyecto3``proyecto4`
	
	 mysql_query($cadena,$conexion);
	 $sw=1;
      mysql_close($conexion);
   }else
      {
	     $sw=11;
	  }
     mysql_free_result($tabla);
	
	return  $sw;

}

function edita_atencion($codatencion,$fecha,$idlugar,$idtipousuario,$idarea,$idsubarea,$idresponsable1,$idresponsable2,$idproyecto,$idactividad,$idescalarecuperacion,$idatencion,$proyecto1,$proyecto2,$proyecto3,$proyecto4)
{
 
  if($fecha<>"")
   {
     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
	 $fechaedicion = date("d-m-Y H:i:s");
	 if($idsubarea=="")
	    $idsubarea=$_COOKIE["idsubarea"];
	 if($idactividad=="")	
	   $idactividad=$_COOKIE["idactividad"];
	
     $cadena = "update atencion set codatencion='$codatencion',fecha='$fecha',idlugar='$idlugar',idtipousuario='$idtipousuario',idarea='$idarea',idsubarea='$idsubarea',idresponsable1='$idresponsable1',idresponsable2='$idresponsable2',idproyecto='$idproyecto',idactividad='$idactividad',fechamodificacion='$fechaedicion',proyecto1='$proyecto1',proyecto2='$proyecto2',proyecto3='$proyecto3',proyecto4='$proyecto4' where idatencion = '$idatencion'";
	
	 mysql_query($cadena,$conexion);
	 $sw=1;

    
   }else
      {
	     $sw=11;
	  }
  
   
	mysql_close($conexion);
	return  $sw;

}
function graba_adjunto($idatencion,$nombre,$nombreunico)
{

     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
     $cadena = "insert into adjuntos	(idadjunto,nombre,nombreunico,idatencion) values (NULL,'$nombre','$nombreunico','$idatencion')";
	// echo $cadena; 
	 mysql_query($cadena,$conexion);
     mysql_close($conexion);
   
}

function graba_adjuntoactividad($idactividad,$nombre,$nombreunico)
{

     $conexion = conectar_base();
     mysql_select_db ("sistemaatencion",$conexion);
     $cadena = "insert into adjuntoactividad	(idadjunto,nombre,nombreunico,idactividad) values (NULL,'$nombre','$nombreunico','$idactividad')";
	// echo $cadena; 
	 mysql_query($cadena,$conexion);
     mysql_close($conexion);
   
}

function cargar_departamento($iddepartamento)
{

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM departamento order by descripcion asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($registro[0]==$iddepartamento)
     {
	   echo "<option value='$registro[0]' selected>$registro[1]</option>";
	  }else{
	 
	  echo "<option value='$registro[0]'>$registro[1]</option>";
	 }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);
  
}
function generandohc()
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   //$cadena ="SELECT * FROM indices";
   $cadena ="select 1 idindice,MAX(hc)+1 idhc from usuario";
   $tabla = mysql_query($cadena, $conexion);
   $registro = mysql_fetch_array($tabla);
   $valor = $registro[1];
   mysql_free_result($tabla);
   mysql_close($conexion);
   return $valor; 
    
   
   
}
function muestra_adjuntos($idatencion,$iduser)
{

     $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM adjuntos join atencion on adjuntos.idatencion = atencion.idatencion where atencion.idusario='$iduser'";
	
   $tabla = mysql_query($cadena, $conexion);   
   echo "<div style='background:#fff;height:500px;display:block; overflow: scroll;'><table align='center' border='1'>";
   echo "<tr bgcolor='#961515'>";
   echo "<td></td><td ><font color='#ffffff'>Archivos Adjunto</td>";
   echo "<td ><a href='atenciones.php?iduser=$iduser'><font color='#ffffff'><img src='imagenes/cerrar.jpg'></td>";
   echo "</tr>";
   while ($registro = mysql_fetch_array($tabla)){
	 echo "<tr><td><a target='_blank' href='documentos/$registro[2]'><img src='imagenes/documento.jpg'></a>";
	 echo "</td>";
	 echo "<td colspan='2'><font size='2'>$registro[1]</td></tr>";
     
  }
  echo "</table></div>";
  
    mysql_free_result($tabla);
	mysql_close($conexion);
   
}

function muestra_adjuntos_actividad($idactividad,$idproyecto)
{

   $nivel = $_COCKIE[""];
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM  adjuntoactividad where idactividad='$idactividad'";
   //echo $cadena;
	
   $tabla = mysql_query($cadena, $conexion);   
   echo "<table align='center' border='1'>";
   echo "<tr bgcolor='#961515'>";
   echo "<td></td><td ><font color='#ffffff'>Archivos Adjunto</td>";

   
   echo "<td ><a href='proyecto_actividades.php?idproyecto=$idproyecto'><font color='#ffffff'><img src='imagenes/cerrar.jpg'></td>";
   echo "</tr>";
   while ($registro = mysql_fetch_array($tabla)){
	 echo "<tr><td><a target='_blank' href='documentos/$registro[2]'><img src='imagenes/documento.jpg'></a>";
         $ruta = "documentos/".$registro[2];
	 echo "</td>";
	 echo "<td colspan='2'><font size='2'>$registro[1]</td>";
         if($_COOKIE["nivel"]=='1'){   
              echo "<td><font size='2'><a href='borrarfichero.php?idadjunto=$registro[0]&idactividad=$_REQUEST[idactividad]&idproyecto=$_REQUEST[idproyecto]&op=edit&ruta=$ruta'>[Eliminar]</a></td>";
         }

        echo "</tr>";
     
  }
  echo "</table>";
  
    mysql_free_result($tabla);
	mysql_close($conexion);
   
}

function cargar_sexo($sexo)
{

  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM sexo order by descripcion asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($sexo==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
              }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}

function cargar_estadocivil($estadocivil)
{

  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM estadocivil";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($estadocivil==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);


}
function cargar_estudios($estudios)
{

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM estudios order by codigoanterior";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($estudios==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}

function cargar_lugar_atencion($lugaratencion,$laten)
{

  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM lugaratencion ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($lugaratencion==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[2]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[2]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_tipo_usuario($tipousuario)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM tipousuario ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($tipousuario==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}

function cargar_area_actividades($area)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM areaeventos ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($area==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}

function cargar_area($area)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM area ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($area==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_responsable($responsable)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM responsable order by apellido,nombre asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($responsable==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[2] $registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[2] $registro[1]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_zonas($idzonaintervencion)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM lugaratencion order by descripcion asc";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($idzonaintervencion==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[2]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[2]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_proyecto($proyecto)
{
  $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM proyecto ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($proyecto==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1] $registro[2]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_mejoria($mejoria)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalarecuperacion ";
   //echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){
     if($mejoria==$registro[0])
	 {
	   echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
	   }else
	      {
		    echo "<option value='$registro[0]'>$registro[1] $registro[2]</option>";
		  }
     
  }
  
    mysql_free_result($tabla);
	mysql_close($conexion);

}
function cargar_sessiones($criterio)
{
   
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM usersession";
 
   $tabla = mysql_query($cadena, $conexion);   
 //  echo $cadena;
   while ($registro = mysql_fetch_array($tabla)){
     
	  echo "<tr bgcolor='#ffffff'>";
      echo "<td><font color='#000000' size='2'><b>$registro[0]</td>";

	  
      echo "<td><a href='usuarios.system.php?op=editar&iduser=$registro[0]'><font color='#000000' size='2'><b>$registro[1]</a></td>";
         echo "<td><font color='#000000' size='2'><b>$registro[5]</td>";	 
	  echo "<td>";
      switch($registro[4])
      {
	     
		 case 2: echo "Operador";break;
		 case 1: echo "Administrador";break;
	  
	  }   	  
	  echo "</td>";
      echo "<td><font size='2'><a href='session_proyectos.php?idusersession=$registro[0]'>Ver Proyectos</a></font></td>";
      echo "</tr>";
	 
	   
	 }     
    mysql_free_result($tabla);
	
}
function buscasesionuser($usuario)
{

    $mayusculas = strtoupper($usuario);
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="SELECT * FROM usersession where usuario = '$mayusculas'";
	$tabla = mysql_query($cadena,$conexion);
    $i=0;
	while ($registro = mysql_fetch_array($tabla)){
	   $id = $registro[0];
	   $i= $i + 1;
	}
    mysql_free_result($tabla);
	mysql_close($conexion);
	if($i>0)
	  return  $id;
	else
	  return 0;
 
}
function cargar_usuarios($criterio,$pagina,$numeropagina)
{
   if($pagina=="")
      $pagina ="1";

   $inicio = ($pagina - 1) * $numeropagina;
   $nivel = $_COOKIE["nivel"];
   $idsession =  $_COOKIE["idsession"];

   $idregion = retorna_cadena($idsession,"id",6,"usersession");

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES utf8");

  
    if($nivel=="1" or $nivel=="3")
    {    $cadena ="SELECT * FROM usuario where eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%') order by hc DESC limit $inicio, $numeropagina";
    

      }else
          {
          //  $idregion = retorna_cadena($idsession,"id",6,"usersession");
            
            //$cadena ="SELECT * FROM usuario where idsession ='$idsession' and  eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%') order by idusuario desc limit $inicio, $numeropagina";

      if($idregion==31)
      {
         $cadena ="SELECT * FROM usuario where eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%') order by hc DESC limit $inicio, $numeropagina";

     }else{

      $cadena ="SELECT * FROM usuario join usersession on usuario.idsession = usersession.id where  usersession.idregion='$idregion' and  usuario.eliminado = '0' and (usuario.nombre like '$criterio%' or usuario.apellidos like '$criterio%' or usuario.nrodocumento like '$criterio%' or usuario.hc like '$criterio%') order by usuario.HC desc limit $inicio, $numeropagina";
            //$cadena ="SELECT * FROM usuario join usersession on usuario.idsession = usersession.id where usuario.idsession =  $idsession and usuario.hc < 9999 or usuario.hc > 99999  and usuario.eliminado = '0' and (usuario.nombre like '$criterio%' or usuario.apellidos like '$criterio%' or usuario.nrodocumento like '$criterio%' or usuario.hc like '$criterio%') order by usuario.HC desc limit $inicio, $numeropagina";
           
       }
 
 }
      
  

   $tabla = mysql_query($cadena, $conexion);   
   
 $numero = mysql_num_rows($tabla);


 //  echo $cadena;
   while ($registro = mysql_fetch_array($tabla)){

	  echo "<tr bgcolor='#ffffff'>";
      echo "<td><font color='#000000' size='2'><b>$registro[0]</td>";
	  echo "<td><font color='#000000' size='2'><b>$registro[23]</td>";

      if($nivel =="1" || $idsession==$registro[26])	  
      {  
               echo "<td><a href='datosusuarios.php?accion=editar&iduser=$registro[0]&pagina=$_REQUEST[pagina]'><font color='#000000' size='2'><b><img src='imagenes/editar.gif' border='0'>$registro[1]/$registro[2]</a></td>";	  


       }else
            {
                echo "<td><font size='2'><a  href='datosusuarios.php?accion=view&iduser=$registro[0]' ><img src='imagenes/lupa.gif' border='0'>$registro[1]/$registro[2]</b></td>";	  
             }
         



	  $departamento = retorna_cadena($registro[17],"iddepartamento",1,"departamento");
	  $provincia = retorna_cadena($registro[18],"idprovincia",1,"provincia");
	  $distrito = retorna_cadena($registro[19],"iddistrito",1,"distrito");
	  
      echo "<td><font color='#000000' size='1'>$departamento - $provincia - $distrito</td>";
        $nsession =  retorna_cadena($registro[26],"id",1,"usersession");
      echo "<td><font color='#000000' size='1'>$nsession</td>";
      echo "<td><font color='#000000' size='1'>$registro[25]</td>";
   
      echo "<td align='center'>";
	  echo "<a href='atenciones.php?iduser=$registro[0]'><font size='1'><img border='0' src='imagenes/atenciones.jpg' border='0' width='30' alt='atenciones del usuario'></a>";
	  echo "<a href='elimina_usuario.php?iduser=$registro[0]'><img src='imagenes/eliminar.png' border='0' alt='Elimina del usuario'></a>";
	  echo "</td>";
	  
	  if($nivel =="1")
	  { echo "<td>";
	    $listaproyectos = generalistaproyecto($registro[0]);
	    echo "$listaproyectos</td>";
	  }
	  
      echo "</tr>";
	 
	   
	 }     
    mysql_free_result($tabla);
	
}

function generalistaproyecto($idusuario)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES utf8");
   

   $cadena = "select * from atencion where idusario =  '$idusuario'";
   
   $tabla = mysql_query($cadena, $conexion);   
   
   $contador =0;
   
   while ($registro = mysql_fetch_array($tabla))
   {
      if($contador==0)
	  { 
         if($registro[18]<>"" and $registro[18]<>"0")
		    $valor = "<a target='_blank' href='usuario.proyecto.php?proyecto=$registro[18]' >".$registro[18]."</a>";
				 
		if($registro[19]<>"" and $registro[19]<>"0")
		    $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[19]' >".$registro[19]."</a>";
		 
		if($registro[20]<>"" and $registro[20]<>"0")
		    $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[20]' >".$registro[20]."</a>";
		
		if($registro[21]<>"" and $registro[21]<>"0")
	      $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[21]' >".$registro[21]."</a>";
		
	   }
	 else
	   {
	      
		  
		  $resultado = strpos($valor, $registro[18]);
		  if($resultado == FALSE && $registro[18]<>"0"){
		      $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[18]' >".$registro[18]."</a>";
		  }
		  
		  $resultado = strpos($valor, $registro[19]);
		  if($resultado == FALSE && $registro[19]<>"0"){
		      $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[19]' >".$registro[19]."</a>";			
		  }
		  
		  $resultado = strpos($valor, $registro[20]);
		  if($resultado == FALSE && $registro[20]<>"0"){
		      $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[20]' >".$registro[20]."</a>";			
		  }
		  $resultado = strpos($valor, $registro[21]);
		  
		  if($resultado == FALSE && $registro[21]<>"0"){
		      $valor = $valor." <a target='_blank' href='usuario.proyecto.php?proyecto=$registro[21]' >".$registro[21]."</a>";			
		  }
		  
		  
        }
		$contador = $contador +1;  
   }
   
   return $valor;

}

function cargar_preguntas($idatencion,$iduser,$idencuesta,$idusuario)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
mysql_query("SET NAMES utf8");
   $cadena ="select * from encuesta join pregunta on encuesta.idencuesta = pregunta.idencuesta where encuesta.idencuesta = $idencuesta";


   echo "<table align='center' bgcolor='#00000'>";
   echo "<tr bgcolor='#000000'><td colspan='3'><font color='#ffffff'><b>Encuesta</b></font><<a href='javascript:history.back()'><img align='right' src='imagenes/cerrar.jpg' border='0'></a></td></tr>";
   echo "<tr>";
   $tabla = mysql_query($cadena, $conexion);   
   
   $numero = mysql_num_rows($tabla);
   echo "<form name='encuesta' action='encuestas.php?idatencion=$idatencion&iduser=$iduser' method='post'>"; 
   echo "<tr bgcolor='#0d6fa2'>";
   echo "<td width='50' align='center'><font color='#fffff' size='2'><b>Indice</td>";
   echo "<td width='450'><font color='#fffff' size='2'><b>Pregunta</td>";
   if($idusuario=="1")
   {
     echo "<td width='160'><font color='#fffff' size='2'>Respuesta de Entrada</td>";
	 }else 
	 {
     echo "<td width='60'><font color='#fffff' size='2'>Respuesta</td>";
   }	 
   echo "</tr>";
   for ( $i = 0 ; $i < $numero ; $i ++)
   {
      $registro=mysql_fetch_row($tabla);
      echo "<tr bgcolor='#ffffff'>";
      $indice=$i +1;
      echo "<td align='center'><font color='#000000' size='2'><b>$indice</td>";
      echo "<td><font color='#000000' size='2'>$registro[4]</td>";

         echo "<td bgcolor='#d2bc00' align='center' valign='top'><font color='#000000' size='2'>";
	 echo "<input name='indice$i' type='hidden' value='$registro[3]'>";

         $valor = recuperavalor($idatencion,$registro[3]);

         
	  ?>
	  
	  <select name="entrada<?php echo $i;?>">
			  <option value='1' <? if($valor=='1'){ echo "SELECTED"; }?>>A</option>
			  <option value='2' <? if($valor=='2'){ echo "SELECTED"; }?>>B</option>
			  <option value='3' <? if($valor==3){ echo "SELECTED";} ?>>C</option>
			  <option value='4' <? if($valor=='4'){ echo "SELECTED"; } ?>>D</option>
			  <option value='5' <? if($valor=='5'){ echo "SELECTED"; }?>>E</option>			  
			</select>
	  <?		
	  echo "</td>";
	  
	  echo "</td>";
	  echo "</td>";
      echo "</tr>";
	 
   }    
    
    echo "<tr><td colspan='4' bgcolor='#0d6fa2'></td></tr>";
	echo "</table>";
	echo "<br><center><input type='submit' value='Grabar' name='grabar'>";
	echo "</form>";
    mysql_free_result($tabla);


}

function recuperavalor($idatencion,$idpregunta)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $tabla2 = mysql_query($cadena, $conexion);   
   $numero = mysql_num_rows($tabla2);
   $cadena ="select * from respuestaencuesta where idatencion = '$idatencion' and idpregunta='$idpregunta'";
//   echo $cadena;
   $tabla = mysql_query($cadena, $conexion);  
   while ($registro = mysql_fetch_array($tabla))
   {
      $valor =  $registro[1]; 

   }
  
   return $valor;

}

function cabezera_atencion($iduser,$mostarpag,$pagina)
{ 
   if($pagina=="")
      $pagina ="1";

  $inicio = ($pagina - 1) * $mostarpag ;
  
  echo "<table width='100%'>";
  echo "<tr bgcolor='#a00000'>";
  echo "<td ><font size='2' color='#ffffff'><b>ACCION</font></td>";
  echo "<td ><font size='2' color='#ffffff'><b>OP</font></td>";
//  echo "<td ><font size='2' color='#ffffff'><b>O-Sys</font></td>";
  echo "<td ><font size='2' color='#ffffff'><b>Fecha Atenci&oacute;n</font></td>";
  echo "<td><font size='2' color='#ffffff'><b>Lugar de Atenci&oacute;n</td>";
  echo "<td><font size='2' color='#ffffff'><b>Tipo Usuario</td>";
  echo "<td><font size='2' color='#ffffff'><b>Responsable 1</td>";
  echo "<td><font size='2' color='#ffffff'><b>Responsable 2</td>";
  echo "<td><font size='2' color='#ffffff'><b>Area</td>";
  echo "<td><font size='2' color='#ffffff'><b>Sub-Area</td>";
  echo "</tr>";
  
   $conexion2 = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion2);
   $cadena ="SELECT * FROM atencion where idusario='$iduser' order by idatencion desc limit $inicio, $mostarpag";


   $nivel=$_COOKIE["nivel"];
   $idsession = $_COOKIE["idsession"];
   

   $contador=0;
   $tabla = mysql_query($cadena, $conexion2);   
   while ($registro = mysql_fetch_array($tabla)){
     $contador=$contador +1;
	  echo "<tr bgcolor='#ffffff'>";
	  echo "<td width='70'>";
	  echo "<a href='adjuntos.php?idatencion=$registro[0]&iduser=$iduser'><img border='0' src='imagenes/adjuntos.gif'></a>";	  
	  echo "<a href='manager_encuesta.php?idatencion=$registro[0]&iduser=$iduser'><img height='30' src='imagenes/encuesta.gif' border='0'></a>"; 
	  /*
	  if($registro[15]=="1")
	  {  
	    $lupaweb2 = "viewencuestas.php?idatencion=$registro[0]&iduser=$iduser&tipousuario=$registro[3]";
	     ?>
		 <a href="javascript:Abrir_ventana('<? echo $lupaweb2; ?>')">
		 <?
		 echo "<img height='30' src='imagenes/encuesta.gif' border='0'></a>"; 
   	     echo "<img height='25' src='imagenes/ico_candadoc.jpg' width='20'>";
	  }
	  else
	  {  
	     echo "<a href='encuestas.php?idatencion=$registro[0]&iduser=$iduser&tipousuario=$registro[3]'>";
		 echo "<img border='0' height='30' src='imagenes/encuesta1.jpg'></a>";
		 echo "<img border='0' height='25' src='imagenes/ico_candado.jpg' >"; 
		 
		 }
	  */
	  echo "</td>";
//          $nivel =1;
          if($nivel == "1" )
          {
             if($registro[17]!="1")
             { 
             echo "<td><a href='atencion.php?iduser=$iduser&idatencion=$registro[0]&op=edit'><img src='imagenes/editar.gif' border='0'><font color='#000000' size='2'></a><a href='bloquea_atencion.php?iduser=$_REQUEST[iduser]&idatencion=$registro[0]'><img src='imagenes/ico_candado.jpg'></a><a href='elimina_atencion.php?iduser=$_REQUEST[iduser]&idatencion=$registro[0]'><img src='imagenes/eliminar.png'></a></td>";
              }else
                   {
             echo "<td><a href='atencion.php?iduser=$iduser&idatencion=$registro[0]&op=edit'><img src='imagenes/editar.gif' border='0'><font color='#000000' size='2'></a><a href='desbloquea_atencion.php?iduser=$_REQUEST[iduser]&idatencion=$registro[0]'><img src='imagenes/ico_candadoc.jpg'></a<a href='elimina_atencion.php?iduser=$_REQUEST[iduser]&idatencion=$registro[0]'><img src='imagenes/eliminar.png'></a></td>";
                   }

          }else
              {
                  if($registro[17]!="1")
                  {
                    
                         
   echo "<td><a href='atencion.php?iduser=$iduser&idatencion=$registro[0]&op=edit'><img src='imagenes/editar.gif' border='0'><font color='#000000' size='2'></a><a href='elimina_atencion.php?iduser=$_REQUEST[iduser]&idatencion=$registro[0]'><img src='imagenes/eliminar.png'></a></td>";

                     
                  }else
                      {

 $lupaweb = "muestra_atencion.php?iduser=$iduser&idatencion=$registro[0]";
	      echo "<td>";
	     ?> <a href="javascript:Abrir_ventana('<? echo $lupaweb;?>')">
	      <?
		 
	    
       	echo "<img src='imagenes/lupa.gif' border='0'><font color='#000000' size='2'></a></td>"; 


                      }
               }
          




	
  //   echo "<td align='center'><font color='#000000' size='2'><b>$registro[1]</td>";


	  echo "<td><font color='#000000' size='2'><b>$registro[2]</td>";
	  $lugar = retorna_cadena($registro[3],"idlugar",2,"lugaratencion");
      echo "<td><font color='#000000' size='2'>$lugar</td>";
	  $tipouser = retorna_cadena($registro[4],"idtipousuario",1,"tipousuario");
      echo "<td><font color='#000000' size='2'>$tipouser</td>";
	 
	  $responsable = retorna_cadena($registro[7],"idresponsable",1,"responsable");
	  $responsableap = retorna_cadena($registro[7],"idresponsable",2,"responsable");
      echo "<td><font color='#000000' size='2'>$responsable $responsableap</td>";
	  
	  $responsable = retorna_cadena($registro[8],"idresponsable",1,"responsable");
	  $responsableap = retorna_cadena($registro[8],"idresponsable",2,"responsable");
      echo "<td><font color='#000000' size='2'>$responsable $responsableap</td>";
	  
	  $area = retorna_cadena($registro[5],"idarea",1,"area");
	 
      echo "<td><font color='#000000' size='2'>$area</td>";

      $subarea = retorna_cadena($registro[6],"idsubarea",1,"subarea");
	 
      echo "<td><font color='#000000' size='2'>$subarea</td>";

      echo "</tr>";
	 
	   
	 }     
  
    mysql_free_result($tabla);
  
  echo "</table>";

}
function escribe_respuesta($rpta)
{
  switch($rpta)
  {
    case 1: echo "A";break;
	case 2: echo "B";break;
	case 3: echo "C";break;
	case 4: echo "D";break;
	case 5: echo "E";break;
  
  }
 

}
function quitar($mensaje)
{
$mensaje = str_replace("<","<",$mensaje);
$mensaje = str_replace(">",">",$mensaje);
$mensaje = str_replace("\'","'",$mensaje);
return $mensaje;
}

function cargar_actividad_proyecto($idactividad,$idproyecto) 
{
   
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM actividadproyecto where idproyecto='$idproyecto' order by idactividad desc";
   
   $contador=0;
  mysql_query("SET NAMES utf8");
   $tabla = mysql_query($cadena, $conexion);   
  
   echo "<select name='idactividad'>"; 
  if($idactividad=="" || $idactividad==0)
   {
    echo "<option name='-1' Selected >No Selecionado</option>";
   }
  while ($registro = mysql_fetch_array($tabla)){
      

      if($idactividad==$registro[0])
        {
           echo "<option value='$registro[0]' SELECTED>$registro[0] $registro[1]</option>";
        }else
           {
            echo "<option value='$registro[0]' >$registro[0] $registro[1]</option>";

            }
    }

   echo "</select>";
   mysql_free_result($tabla);

}
function calculorows($cadena)
{
  
	$conexion = conectar_base(); 
  	mysql_select_db ("sistemaatencion",$conexion);
	$result = mysql_query($cadena);
	$numero = mysql_num_rows($result);
        mysql_free_result($tabla);
        return $numero;
}

function dibuja_paginacion($phpagina, $consulta, $numerototal, $numeropagina,$pagina)
{

   if($pagina=="" || $pagina=="0")  
      $pagina=1;
   
   $total_paginas = ceil($numerototal / $numeropagina); 
  
   
   if($total_paginas<=20)
   {
       $inicio=1;
       $fin= $total_paginas;
       $tipo=1;
   }else
       {
          if($pagina>17) 
          {
               if($pagina>$total_paginas-18)
                {
                   $inicio = $total_paginas-18;
                   $fin = $total_paginas;
                   $tipo = 3;
 
                 }else
                   {
                      $inicio = $pagina - 9;
                      $fin = $pagina + 9;
                      $tipo = 2;

                   }
              
          }else
               {
                 $inicio = 1;
                 $fin = 18;
                 $tipo = 4; 
  
               }
           
       }
   

   echo "<table ><tr>";
   echo "<td><a href='$phpagina&$consulta&pagina=1'><img  border='0' src='imagenes/flecha_atras.gif'></a></td>";
   if($tipo=="2" || $tipo=="3")
   {
         if($pagina=="1")
             echo "<td class='estiloseleccionado'>1</td><td>...</td>";              
         else
           echo "<td class='estilo'><a href='$phpagina?$consulta&pagina=1'>1</a></td><td>...</td>";                             

   } 
   for ($i = $inicio; $i <= $fin; $i++)
   {
      if($i==$pagina)
         echo "<td class='estiloseleccionado'>$i</td>";             
      else
         echo "<td class='estilo'><a href='$phpagina?$consulta&pagina=$i'>$i</a></td>";             

   }
   if($tipo=="4" || $tipo=="2")
   {
         if($pagina==$total_paginas)
             echo "<td>...</td><td class='estiloseleccionado'>$total_paginas</td>";              
         else
           echo "<td>...</td><td class='estilo'><a href='$phpagina?$consulta&pagina=$total_paginas'>$total_paginas</a></td>";                             

   }
  
 echo "<td><a href='$phpagina?$consulta&pagina=$total_paginas'><img  border='0' src='imagenes/flecha_delante.gif'></a></td>";  
 echo "</tr></table>";  
}

function dibuja_paginacion_actividades($phpagina, $consulta, $numerototal, $numeropagina,$pagina)
{

   if($pagina=="" || $pagina=="0")  
      $pagina=1;
   
   $total_paginas = ceil($numerototal / $numeropagina); 
  
   
   if($total_paginas<=20)
   {
       $inicio=1;
       $fin= $total_paginas;
       $tipo=1;
   }else
       {
          if($pagina>17) 
          {
               if($pagina>$total_paginas-18)
                {
                   $inicio = $total_paginas-18;
                   $fin = $total_paginas;
                   $tipo = 3;
 
                 }else
                   {
                      $inicio = $pagina - 9;
                      $fin = $pagina + 9;
                      $tipo = 2;

                   }
              
          }else
               {
                 $inicio = 1;
                 $fin = 18;
                 $tipo = 4; 
  
               }
           
       }
   

   echo "<table ><tr>";
   echo "<td><a href='$phpagina&$consulta&pagina=1'><img  border='0' src='imagenes/flecha_atras.gif'></a></td>";
   if($tipo=="2" || $tipo=="3")
   {
         if($pagina=="1")
             echo "<td class='estiloseleccionado'>1</td><td>...</td>";              
         else
           echo "<td class='estilo'><a href='$phpagina?$consulta&pagina=1'>1</a></td><td>...</td>";                             

   } 
   for ($i = $inicio; $i <= $fin; $i++)
   {
      if($i==$pagina)
         echo "<td class='estiloseleccionado'>$i</td>";             
      else
         echo "<td class='estilo'><a href='$phpagina?$consulta&pagina=$i'>$i</a></td>";             

   }
   if($tipo=="4" || $tipo=="2")
   {
         if($pagina==$total_paginas)
             echo "<td>...</td><td class='estiloseleccionado'>$total_paginas</td>";              
         else
           echo "<td>...</td><td class='estilo'><a href='$phpagina?$consulta&pagina=$total_paginas'>$total_paginas</a></td>";                             

   }
  
 echo "<td><a href='$phpagina?$consulta&pagina=$total_paginas'><img  border='0' src='imagenes/flecha_delante.gif'></a></td>";  
 echo "</tr></table>";  
}


function muestra_actividades($pagina,$numeropagina,$idproyecto,$fecha,$idsession,$nivel,$filtro)
{

 if($pagina=="")
      $pagina ="1";
  $inicio = ($pagina - 1) * $numeropagina;
  if($filtro) 
     $idactividad = retorna_actividad($filtro,$idproyecto);

  echo "<table width='100%' border='1' height='500'>";
  echo "<tr bgcolor='#000000' height='15'>";
  echo "<td width='30'><font size='1' color='#ffffff'>Id</td>";
  echo "<td><font size='1' face='arial' color='#ffffff'>Fecha</td>";
  echo "<td width='250'><font size='1' color='#ffffff'>Actividad</td>";
  if($nivel==1)
    echo "<td><font size='1' color='#ffffff'>Zona de Intervencion</td>";  
  echo "<td><font size='1' color='#ffffff'>USUARIO</td>";
  echo "<td><font size='1' color='#ffffff'>Nro beneficiario</td> ";
  echo "<td><font size='1' color='#ffffff'>Mujeres</td> ";
  echo "<td><font size='1' color='#ffffff'>Hombres</td> ";
  echo "<td><font size='1' color='#ffffff'>Responsable1</td>";
  echo "<td><font size='1' color='#ffffff'>Responsable2</td>";
  echo "<td width='100'><font size='1' color='#ffffff'>Operaciones</td>";
  echo "<td><font size='1' color='#ffffff'>Archivos</td>";
  echo " </tr>";

    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    mysql_query("SET NAMES utf8");
    if($nivel<>"1")
    {
    if($filtro<>"")
     {  
      if($idactividad>0)
      {
           $cadena ="select * from actividades where (idproyecto = '$idproyecto'  and idsession=$idsession and idactividadproyecto='$idactividad' ) order by idactividad desc limit $inicio,$numeropagina ";
      }else{
      $cadena ="select * from actividades where (idproyecto = '$idproyecto'  and idsession=$idsession) or (fecha like '%$filtro%' or idarea = $filtro or idresponsable1 = $filtro or idresponsable2 = $filtro) order by idactividad desc limit $inicio,$numeropagina ";
      }
     }else
          {
            $cadena ="select * from actividades where (idproyecto = '$idproyecto'  and idsession=$idsession) order by idactividad desc limit $inicio,$numeropagina ";

             }
    }
    else
      {

    if($filtro<>"")
        {
          if($idactividad>0)
          {
                   $cadena ="select * from actividades where (idproyecto = '$idproyecto' and idactividadproyecto='$idactividad')  order by idactividad desc limit $inicio,$numeropagina ";
             }else
                 {
      $cadena ="select * from actividades where (idproyecto = '$idproyecto') and (fecha like '%$filtro%' or idarea = $filtro or idresponsable1 = '$filtro' or idresponsable2 = '$filtro')  order by idactividad desc limit $inicio,$numeropagina ";
                    }

         }else
            {
      $cadena ="select * from actividades where (idproyecto = '$idproyecto')  order by idactividad desc limit $inicio,$numeropagina ";


          }
     }

    
 $tabla = mysql_query($cadena, $conexion);
    $i=$inicio + 1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff'  height='15'>";
	 echo "<td align='center'><font face='arial' size='1'>$i</td>";
	 echo "<td><font face='arial' size='1'>$registro[1]</td>";
         


	 $actividad = retorna_cadena($registro[23],"idactividad",1,"actividadproyecto");
	 echo "<td><font face='arial' size='1'> $actividad</td>"; 


         if($nivel==1)
         {
           
	 $lugar = retorna_cadena($registro[12],"idlugar",2,"lugaratencion");
	
	 echo "<td><font face='arial' size='1'>$lugar</td>";

         }

	 $session = retorna_cadena($registro[24],"id",1,"usersession");
	 
	 echo "<td><font face='arial' size='1'>$session</td>";
	// echo $registro[14];
	 echo "<td><font face='arial' size='1'>$registro[8]</td>";
	echo "<td><font face='arial' size='1'>$registro[10]</td>";
	echo "<td><font face='arial' size='1'>$registro[9]</td>";
	 $nom1 = retorna_cadena($registro[4],"idresponsable",1,"responsable");
	 $apelli1 = retorna_cadena($registro[4],"idresponsable",2,"responsable");
	 echo "<td><font face='arial' size='1'>($registro[4]) $nom1 $apelli1 </td>"; //Responable
	 
	 $nom2 = retorna_cadena($registro[5],"idresponsable",1,"responsable");
	 $apelli2 = retorna_cadena($registro[5],"idresponsable",2,"responsable");
	 echo "<td><font face='arial' size='1'>($registro[5]) $nom2 $apelli2 </td>"; //Responable


	 
	 $idproyecto = $_REQUEST['idproyecto'];
	 $ruta = "proyecto_actividades.php?idproyecto=$idproyecto";
	 echo "<td >";

         if($nivel=="1" ||  $registro[24]==$idsession)  
         {
           if($nivel=="1")
           {   
	 echo "<a href='actividadproyecto_op.php?op=editar&idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/editar.gif' height='15'><font size='1' face='arial'>[Editar]</font></a><br>";
         echo "<a href='eliminando_actividad.php?idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/eliminar.gif' height='15'><font size='1' face='arial'>[Eliminar]</font></a>";
         echo "</td><td><a href='archivo.actividad.php?idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]&op=edit'>Dir Archivos</a></td>";
            }else
               {
                   if($registro[27]=="0" || $registro[27]=="")
                   {
	 echo "<a href='actividadproyecto_op.php?op=editar&idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/editar.gif' height='15'><font size='1' face='arial'>[Editar]</font></a><br>";
         echo "<a href='eliminando_actividad.php?idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/eliminar.gif' height='15'><font size='1' face='arial'>[Eliminar]</font></a>";
         echo "</td><td><a href='archivo.actividad.php?idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]&op=edit'>Dir Archivos</a></td>";


                    }else
                      {

                   $lupaweb = "consultar_actividad.php?idactividad=$registro[0]";
                 ?>
                    <a href="javascript:Abrir_ventana2('<? echo $lupaweb;?>')"><img src='imagenes/lupa.gif'>[Consultar]</a>

                 <? 

         echo "</td><td><a href='archivo.actividad.php?idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]&op=view'>Brow</td>";

 
                      }

                }
 
         }else
            {
                   $lupaweb = "consultar_actividad.php?idactividad=$registro[0]";
                 ?>
                    <a href="javascript:Abrir_ventana2('<? echo $lupaweb;?>')"><img src='imagenes/lupa.gif'>[Consultar]</a>

                 <?    
            }

	 echo "</td>";	 
	 echo "</tr>";
	 
	 $i = $i +1;
    }
 


 echo "<tr><td></td></tr>";
  echo "</table>";


}

function retorna_actividad($filtro,$idproyecto)
{
    $conexion = conectar_base();
    mysql_select_db ("sistemaatencion",$conexion);
    mysql_query("SET NAMES utf8");
    $cadena ="select * from actividadproyecto where idproyecto='$idproyecto' and descripcion like '$filtro%'";
    $tabla = mysql_query($cadena, $conexion); 
    while ($registro = mysql_fetch_array($tabla))
    {
       $codigo = $registro[0]; 
    }
    mysql_close($conexion);
    return $codigo;

}

function muestra_actividades_op($idproyecto)
{



  echo "<table width='880' height='500'>";
  echo "<tr bgcolor='#000000' height='15'>";
  echo "<td width='30'><font size='1' color='#ffffff'>Id</td>";
  echo "<td><font size='1' color='#ffffff'>Nombre Actividad - CMB</td>";
  echo "<td><font size='1' color='#ffffff'>Operaciones</td>";
  echo " </tr>";
 
    
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
     mysql_query("SET NAMES utf8");
    $cadena ="select * from actividadproyecto where idproyecto = $idproyecto";
  
    $tabla = mysql_query($cadena, $conexion);
    $i=$inicio + 1;
    while ($registro = mysql_fetch_array($tabla))
    {
	 echo "<tr bgcolor='#ffffff' height='15'>";
	 echo "<td align='center'><font face='arial' size='1'>$i</td>";
	 echo "<td><font face='arial' size='1'>$registro[1]</td>";
	// $actividad = retorna_cadena($registro[14],"idactividad",1,"actividadproyecto");
	
	 $idproyecto = $_REQUEST['idproyecto'];
	 $ruta = "proyecto_actividades.php?idproyecto=$idproyecto";
	 echo "<td width='230'>";
    
        
	 echo "<a href='actividadproyecto2_op.php?op=editar&idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/editar.gif' height='15'><font size='1' face='arial'>[Editar]</font></a>";
         echo "<a href='actividadproyecto2_op.php?op=eliminar&idactividad=$registro[0]&idproyecto=$_REQUEST[idproyecto]'><img border='0' src='imagenes/eliminar.gif' height='15'><font size='1' face='arial'>[Eliminar]</font></a>";

	 echo "</td>";	 
	 echo "</tr>";
	 
	 $i = $i +1;
    }
 


 echo "<tr><td></td></tr>";
  echo "</table>";



}
function escala_bienestar($iduser,$idatencion, $valor)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestaratencion where idusuario='$iduser' and idatencion='$idatencion' and parte='$valor'";
   $tabla = mysql_query($cadena, $conexion);  
   $suma = 0;
   $conteo=1;
   while ($registro = mysql_fetch_array($tabla))
   {

    
       if($registro[4]=="1" )
	     $suma = $suma +1;  
     
            

     $conteo =$conteo +1;
   } 
   
   mysql_free_result($tabla);
   mysql_close($conexion);
   return  $suma;
}


function conteo_encuesta($idatencion,$iduser)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena = "select * from respuestaencuesta join pregunta on respuestaencuesta.idpregunta=pregunta.idpregunta where respuestaencuesta.idatencion ='$idatencion'";
  $tabla = mysql_query($cadena, $conexion);  
   $suma = 0;
   $valorcito=0;
   while ($registro = mysql_fetch_array($tabla))
   {
     
      switch($registro[1])
      {
         case "1": $valorcito = $registro[10];break;
	 case "2": $valorcito = $registro[11];break;
         case "3": $valorcito = $registro[12];break;
         case "4": $valorcito = $registro[13];break; 
      }

      $suma = $suma + $valorcito;
    
    $valorcito=0;
     }

   mysql_free_result($tabla);
   mysql_close($conexion);
   return $suma;
}


?>
