<? include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');
?>
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>
<?
   if($_REQUEST['accion']=='view')
   {
     $cadenon = "disabled";
   }

?>
<div class="div1">
<div class="contenido">
   
 <?php

 if($_POST["grabar"]=="grabar")
 {

         
	 $nombres = $_POST['nombres'];
	 $apellidos= $_POST['apellidos'];
	 $tipodoc= $_POST['tipodocumento'];
	 $nrodocumento= $_POST['numerodocumento'];
         $numerodocumento = $_POST['numerodocumento'];
	 $origen= $_POST['origen'];
	 $iddepartamento= $_POST['cmbdepartamento'];
         $cmbdepartamento = $_POST['cmbdepartamento'];
	 $idprovincia= $_POST['cmbprovincia'];
         $cmbprovincia= $_POST['cmbprovincia'];
	 $iddistrito= $_POST['cmbdistrito'];
         $cmbdistrito= $_POST['cmbdistrito'];
	 $fechanacimiento= $_POST['fechanacimiento'];
	 $edadactual= $_POST['edad'];
         
	 $edadingreso= $_POST['fechaingreso'];
	 $fechaingreso =  $_POST['fechaingreso'];

         $idsexo= $_POST['sexo'];
         $sexo = $_POST['sexo'];
	 $idestadocivil= $_POST['estadovivil'];
         $estadovivil = $_POST['estadovivil'];
	 $idestudios= $_POST['estudios'];
         $estudios = $_POST['estudios'];
	 $ocupacion= $_POST['ocupacion'];
	 $direccion= $_POST['direccion'];
	 $iddepartamentoact= $_POST['cmbdepartamentoresidencia'];
         $cmbdepartamentoresidencia = $_POST['cmbdepartamentoresidencia'];
	 $idprovinciaact = $_POST['cmbprovinciaresidencia'];
         $cmbprovinciaresidencia = $_POST['cmbprovinciaresidencia'];
	 $iddistritoact= $_POST['cmbdistritoresidencia'];
         $cmbdistritoresidencia = $_POST['cmbdistritoresidencia'];
	 $telefono= $_POST['telefono'];
	 $celular= $_POST['celular'];
	 $anioresidencia= $_POST['aniosresidencia'];	 
         $aniosresidencia = $_POST['aniosresidencia'];	 
	 $hc= $_POST['hc'];	 
         $fechacreacion = date("d-m-Y H:i:s");
         $fechamodificacion = date("d-m-Y H:i:s");
	 $idsession = $_COOKIE["idsession"];
         $seguro = $_POST['seguro'];
         $textoseguro = $_POST['textoseguro'];

         $h3 = $_POST['h3'];

         if($_REQUEST["accion"]=="nuevo")
         {

              $h3 =  busqueda_norepitente($hc);
              if($h3==-1)
                  $pasa=1; 
              else
                  $pasa= 6;
                 
    
         }else
             {

                 if($_REQUEST["accion"]=="editar")
                 {
                    $h4 =  busqueda_norepitente($hc);
                  if($h4 == $_REQUEST[iduser])
                        $pasa = 1;
                    else
                    {
                       if($h4==-1)
                          $pasa=1;
                       else 
                          $pasa = 6;
                          
                     }                 
                 }

             }	 
  
	 if($_REQUEST["accion"]=="nuevo")
	 {
	  
          if($nombres<>"" and $apellidos<>"" and $pasa==1)
	  {
	  

        $conexion = conectar_base();
          mysql_select_db ("sistemaatencion",$conexion);
          mysql_query("SET NAMES utf8");
 
	$cadena = "insert into usuario(idusuario,nombre,apellidos,tipodoc,nrodocumento,origen,iddepartamento,idprovincia,iddistrito,fechanacimiento,edadactual,edadingreso,idsexo,idestadocivil,idestudios,ocupacion,direccion,iddepartamentoact,idprovinciaact,iddistritoact,telefono,celular,anioresidencia,hc,fechacreacion,fechamodificacion,idsession,eliminado,seguro,textoseguro) values (NULL,'$nombres','$apellidos','$tipodoc','$nrodocumento','$origen','$iddepartamento','$idprovincia','$iddistrito','$fechanacimiento','$edadactual','$edadingreso','$idsexo','$idestadocivil','$idestudios','$ocupacion','$direccion','$iddepartamentoact','$idprovinciaact','$iddistritoact','$telefono','$celular','$anioresidencia','$hc','$fechacreacion','$fechamodificacion','$idsession','0','$seguro','$textoseguro')";

//echo $cadena;	    
          mysql_query($cadena,$conexion);
          //mysql_close($conexion);


          //$conexion = conectar_base();
          //mysql_select_db ("sistemaatencion",$conexion);
            $hc2=generandohc();
            //if($hc2==$hc)
           // {
	          $hc2= $hc2 + 1;
		  $cadena2 = "update indices set idhc='".$hc2."' where idindice ='1'";
        	  mysql_query($cadena,$conexion);
	     // }			
	    mysql_close($conexion);
	        $pasa = 1;
	  }else
	      {
		   if($pasa<>6)
                           $pasa=5; //Campo debe estar lleno
		  }
	
        
	   
	 }else
	    {
		
		$conexion = conectar_base();
         
         mysql_select_db ("sistemaatencion",$conexion);	
	 mysql_query("SET NAMES utf8");  
         if($nombres<>"" and $apellidos<>"" and $pasa==1)
	  {
	       $fechamodificacion = date("d-m-Y H:i:s");
                $cadena = "update usuario set nombre='$nombres',apellidos='$apellidos',tipodoc='$tipodoc',nrodocumento='$nrodocumento',origen='$origen',iddepartamento='$iddepartamento',idprovincia='$idprovincia',iddistrito='$iddistrito',fechanacimiento='$fechanacimiento',edadingreso='$edadingreso',idsexo='$idsexo',idestadocivil='$idestadocivil',idestudios='$idestudios',ocupacion='$ocupacion',direccion='$direccion',iddepartamentoact='$iddepartamentoact',idprovinciaact='$idprovinciaact',iddistritoact='$iddistritoact',telefono='$telefono',celular='$celular',anioresidencia='$anioresidencia',fechamodificacion='$fechamodificacion',hc='$hc',seguro='$seguro',textoseguro='$textoseguro' where idusuario='$_REQUEST[iduser]'";
		   

                                                                                                                                                                                                                                                                                                                                                                                                 		mysql_query($cadena,$conexion);
	       $pasa = 1;
	  }else
	      {
		   if($pasa<>6)
                         $pasa=5; //Campo debe estar lleno
		  }
	
        
	    mysql_close($conexion);
     /*	if($pasa==1)
	 {
	 ?><
	   <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuarios.php?pagina=<? echo $_REQUEST[pagina]; ?>">
            </head> 
	 <? 
	 }
     */
    }
 }else
{

 if($_REQUEST["accion"]=="nuevo")
 {  echo "<form name='nuevo' action='datosusuarios.php?accion=nuevo' method='post'>"; 
    echo "<div align='right'><b><h2>NUEVO USUARIO</b></div>";
    
 }
 else
   {

       if($_REQUEST["accion"]=="editar" || $_REQUEST["accion"]=="view" )
       {
         $nombres = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");

	 $apellidos = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
        
	 $tipodocumento = retorna_cadena($_REQUEST["iduser"],"idusuario",3,"usuario");
         $numerodocumento  = retorna_cadena($_REQUEST["iduser"],"idusuario",4,"usuario");
	 $origen = retorna_cadena($_REQUEST["iduser"],"idusuario",5,"usuario");
	 $iddepartamento = retorna_cadena($_REQUEST["iduser"],"idusuario",6,"usuario");
         
	 $textdepartamento = retorna_cadena($iddepartamento,"iddepartamento",1,"departamento");
	 
	 $idprovincia = retorna_cadena($_REQUEST["iduser"],"idusuario",7,"usuario");

	 $textprovincia = retorna_cadena($idprovincia,"idprovincia",1,"provincia");
	 
	 $iddistrito = retorna_cadena($_REQUEST["iduser"],"idusuario",8,"usuario");
   

	 $textdistrito = retorna_cadena($iddistrito,"iddistrito",1,"distrito");


	 $fechanacimiento = retorna_cadena($_REQUEST["iduser"],"idusuario",9,"usuario");
	 
	 $fechaingreso = retorna_cadena($_REQUEST["iduser"],"idusuario",11,"usuario");
	 $sexo = retorna_cadena($_REQUEST["iduser"],"idusuario",12,"usuario");
	 $estadocivil = retorna_cadena($_REQUEST["iduser"],"idusuario",13,"usuario");
	 $estudios =  retorna_cadena($_REQUEST["iduser"],"idusuario",14,"usuario");
	 $ocupacion  =  retorna_cadena($_REQUEST["iduser"],"idusuario",15,"usuario");
	 $direccion =  retorna_cadena($_REQUEST["iduser"],"idusuario",16,"usuario");
	 
	 $cmbdepartamentoresidencia = retorna_cadena($_REQUEST["iduser"],"idusuario",17,"usuario");
	 
	 $txtcmbdepartamentoresidencia = retorna_cadena($cmbdepartamentoresidencia,"iddepartamento",1,"departamento");
	 
          $cmbprovinciaresidencia = retorna_cadena($_REQUEST["iduser"],"idusuario",18,"usuario");
	 $txtcmbprovinciaresidencia = retorna_cadena($cmbprovinciaresidencia,"idprovincia",1,"provincia");
         $cmbdistritoresidencia = retorna_cadena($_REQUEST["iduser"],"idusuario",19,"usuario");
         $txtcmbdistritoresidencia = retorna_cadena($cmbdistritoresidencia,"iddistrito",1,"distrito");
	 $telefono = retorna_cadena($_REQUEST["iduser"],"idusuario",20,"usuario");
         $celular = retorna_cadena($_REQUEST["iduser"],"idusuario",21,"usuario");
         $aniosresidencia =  retorna_cadena($_REQUEST["iduser"],"idusuario",22,"usuario");
	 $hc =  retorna_cadena($_REQUEST["iduser"],"idusuario",23,"usuario");
        
        $seguro = retorna_cadena($_REQUEST["iduser"],"idusuario",28,"usuario"); 
        $textoseguro = retorna_cadena($_REQUEST["iduser"],"idusuario",29,"usuario");
       }
   }
 
}

if($_REQUEST["accion"]=="nuevo")
{
   echo "<form name='nuevo' action='datosusuarios.php?accion=nuevo' method='post'>"; 
    echo "<div align='right'><b><h2>NUEVO USUARIO</b></div>";
}else
{
          echo "<form name='nuevo' action='datosusuarios.php?accion=editar&iduser=$_REQUEST[iduser]&pagina=$_REQUEST[pagina]' method='post'>"; 
       
        echo "<div align='right'><b>EDITAR USUARIO</b></div>";

}
 
 ?>
<hr> 
<input type="submit"  width='45' name="grabar" value="grabar" >

<a href='usuarios.php?pagina=<? echo $_REQUEST[pagina]; ?>'><img border='0' src="imagenes/cancelar.jpg"></a>
<? echo "<a href='atenciones.php?iduser=$_REQUEST[iduser]'><img border='0' src='imagenes/atenciones.jpg'></a>"; ?>
<div align="left">
<? 
  echo $pasa;
  if($pasa>1) 
 { 
    if($pasa==5)
      $cadenaerror = "Faltan datos";
    if($pasa==6)
       $cadenaerror = "Nro de Identificación ya Usado Cambielo por uno Valido";
?>
  <center><font color="red" size='3'><? echo  $cadenaerror; ?></font></center>
<?
   }

?>
</div>
<table width="100%" height="100" border="0" bgcolor="#fdff7c"><tr><td width="50%">
<span class="label">Nombres :</span> <input <? echo $cadenon; ?> name="nombres" size="30" value="<?php echo $nombres; ?>" ><br>
<span class="label">Apellidos :</span>  <input <? echo $cadenon; ?> name="apellidos" size="30" value="<?php echo $apellidos; ?>">
</td><td>
<span class="label">Documento tipo</span> 
<select name="tipodocumento" <? echo $cadenon; ?> >
<option value="DNI" <?php if($tipodocumento=="DNI"){ echo "SELECTED"; } ?>>DNI</option>
<option value="PASAPORTE" <?php if($tipodocumento=="PASAPORTE"){ echo "SELECTED"; } ?>>PASAPORTE</option>
<option value="CE" <?php if($tipodocumento=="CE"){ echo "SELECTED"; } ?>>CARNET EXTRANJERIA</option>
<option value="SD" <?php if($tipodocumento=="SD"){ echo "SELECTED"; } ?>>SIN DOCUMENTO</option>
</select><br>
<span class="label">Nro Documento</span> <input  <? echo $cadenon; ?> name="numerodocumento" value='<? echo $numerodocumento ?>'>
</td>
</tr>
<tr><td colspan="2">
<?
   if($_REQUEST['accion']=='nuevo' and $hc=="")
   {
     $hc = generandohc();
   }

?>
<span class="label">Nro de identificaci&oacute;n:</span>
<input name="hc" <? echo $cadenon; ?> value='<? echo $hc;?>'>
<?
  if($accion=="editar")
  {

    ?>
     <input type='hidden' name="hc3" value="<? echo $hc; ?>">
   <?
  }

?>
</td></tr>
</table>
<br>
<table bgcolor="#fdff7c" width="100%">
<tr><td colspan="4"><center><font size="2"><b>Lugar de Nacimiento</b></font></center></td></tr>
<tr><td>
<span class="label2">Origen</span> 
   <select name='origen' <? echo $cadenon; ?>> 
       <option value="URBANO" <? if($origen=="URBANO"){ echo "selected"; }?> >URBANO</option>
       <option value="RURAL" <? if($origen=="RURAL"){ echo "selected"; }?>>RURAL</option>
   </select>
   <!-- <input name="origen" value='<? echo $origen ?>'> -->

   </td><td>
<span class="label2">Departamento</span> 
<select name="cmbdepartamento" <? echo $cadenon; ?> id="cmbdepartamento" value="<? echo $iddepartamento; ?>">
<?php cargar_departamento($iddepartamento); ?>
</select> 
</td><td>
<span class="label2">Provincia</span> 
<select name="cmbprovincia" <? echo $cadenon; ?> id="cmbprovincia" value="<? echo $idprovincia; ?>">	
<?php
  if($_REQUEST["accion"]=="editar")
  {
    echo "<option value='$idprovincia' default>$textprovincia</option>";
  }
?>


</select> 
</td><td>
<span class="label2">Distrito</span>

<select name="cmbdistrito"  <? echo $cadenon; ?> id="cmbdistrito" value="<? echo $iddistrito; ?>">
<?php
  if($_REQUEST["accion"]=="editar")
  {
    echo "<option value='$iddistrito' default>$textdistrito</option>";
  }
?>	
</select> 

</td>
</tr>
<tr><td colspan="4"><center><font size="2"><b>Generalidades</b></font></center></td></tr>
</table>
<table bgcolor="#fdff7c" width="90%" border="0" ><tr><td width="300">
<span class="label3">Fecha de Nacimiento</span> <input size="8" <? echo $cadenon; ?> id='fecha' name="fechanacimiento" value='<? echo $fechanacimiento; ?>'>

<a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>
    <div id="calendario">
    <?php calendar_html() ?>
	</div> 
	
	
    </td><td width="100">
<span class="label3">Edad Actual: </span> <input type='hidden' name="edad" size="5" value = <?php echo CalculaEdad($fechanacimiento); ?> > 
<b> <?  if($fechanacimiento<>"")
        { echo CalculaEdad($fechanacimiento); } ?>
</b></td>
<td width="250">
<span class="label3">Edad de Ingreso</span> <input name="fechaingreso" size='10' <? echo $cadenon; ?> value="<?php echo $fechaingreso; ?>" >
</td>
</tr>
<tr><td>
<span class="label3">Sexo</span> <select <? echo $cadenon; ?>  name="sexo">
<?php cargar_sexo($sexo); ?>
</select></td><td>
<span class="label3">Estado Civil</span> <select <? echo $cadenon; ?> name="estadovivil">
<?php cargar_estadocivil($estadocivil); ?>


</select></td><td>
<span class="label3">Estudios</span><select <? echo $cadenon; ?> name="estudios">
<?php cargar_estudios($estudios); ?>

</select></td></tr>
<tr><td colspan="3">
<span class="label3">Ocupaci&oacute;n</span>  <input <? echo $cadenon; ?> name="ocupacion" size="109" value="<?php echo $ocupacion; ?>">
</td>
</tr>
</table>
<br>
<table width="100%"  bgcolor="#fdff7c">
<tr><td colspan="3">
  <center><b><font size="2">Sobre la Residencia Actual
</td></tr>
<tr><td colspan="3">
<span class="label2">Direccion Actual <input name="direccion" <? echo $cadenon; ?> size="100" value="<?php echo $direccion; ?>"></td></tr><tr><td>
<span class="label2">Departamento</span>
<select name="cmbdepartamentoresidencia" <? echo $cadenon; ?> id="cmbdepartamentoresidencia" value="<?php echo $cmbdepartamentoresidencia; ?>">
<?php cargar_departamento($cmbdepartamentoresidencia); ?>
</select>

</td><td>

<span class="label2">Provincia</span><select name="cmbprovinciaresidencia" <? echo $cadenon; ?> id="cmbprovinciaresidencia" value="<?php echo $cmbprovinciaresidencia; ?>">	
<?php
  if($_REQUEST["accion"]=="editar")
  {
    echo "<option value='$cmbprovinciaresidencia' default>$txtcmbprovinciaresidencia</option>";
  }
?>	
</select>
</td><td>
<span class="label2">Distrito </span>
<select name="cmbdistritoresidencia" id="cmbdistritoresidencia" <? echo $cadenon; ?> value="<?php echo $cmbdistritoresidencia; ?>">	
<?php
  if($_REQUEST["accion"]=="editar")
  {
    echo "<option value='$cmbdistritoresidencia' default>$txtcmbdistritoresidencia</option>";
  }
?>


</select> 

 </span></td></tr>
<tr>
<td><span class="label2">Telefono <input <? echo $cadenon; ?> name="telefono" value="<?php echo $telefono; ?>"></td>
<td><span class="label2">Celular <input <? echo $cadenon; ?> name="celular" value="<?php echo $celular; ?>"></td>
<td><span class="label2">A&ntilde;os en Lima: <input <? echo $cadenon; ?> name="aniosresidencia" value="<?php echo $aniosresidencia; ?>"></td>
</tr>
<tr><td colspan='3'><hr><center><font size='2'><b>Informaci&oacute;n Sobre el Seguro</b></center></td></tr>
<tr>
<td><span class="label2">Posee seguro<select name='seguro'><option value='-1' <? if($seguro=="-1"){ echo "SELECTED"; } ?>>Seleccionar</option><option value='1' <? if($seguro=="1"){ echo "SELECTED"; } ?>>SI</option><option value='0' <? if($seguro=="0"){ echo "SELECTED"; } ?> >NO</option></select></td>
<td colspan='2'><span class="label2">Si contesto [si] indique cual: <input size="30" name='textoseguro' value="<? echo $textoseguro; ?>"></td>
</tr>
</table>
<div align="right"> 
<input type="submit"  width='45' name="grabar" value="grabar" >
</div>
</form>


 <?
    if($_REQUEST["accion"]=='editar')
	{
	   echo "<center><a href='afectacion.php?iduser=$_REQUEST[iduser]'><font size='3'>[Agregar Afectaci&oacute;n]</a>";
	   $sw = verifica_tortura($_REQUEST['iduser']);
	   
	   if($sw>=1)
	   {
	      echo " - <a href='encuestatortura.php?iduser=$_REQUEST[iduser]'><font size='3'>[Encuesta para personas que han sufrido tortura]</a>";
	   }
	}
 
 ?> 
</div>
</div>

<? include("pie.php");

function busqueda_norepitente($hc)
{
   $mayusculas = strtoupper($usuario);
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    $cadena ="SELECT * FROM usuario where hc = '$hc'";
	$tabla = mysql_query($cadena,$conexion);
    $id = -1;
    while ($registro = mysql_fetch_array($tabla)){
	   $id = $registro[0];
	   
	}
    mysql_free_result($tabla);
	mysql_close($conexion);

	  return  $id;


}



 ?>
