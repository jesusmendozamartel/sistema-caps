<?

   include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');

?>

<head>
<style>
body{
   font-size: 13x;
   font-family: arial;
  }

select { 
  font-family: arial;
  font-size: 9px;
  color: #000;
  background-color:#f6f6f6;
}
.contenido
    {
        height: auto;  
      }
    .div1
    {
          height: auto;  
   }

</style>

</head>

 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>

<?

/* Para editar primera vez o no cargo */
 if($_REQUEST['op']=='editar')
 {
  $fecha = retorna_cadena($_REQUEST["idactividad"],"idactividad",1,"actividades");
  $cmbproyecto = retorna_cadena($_REQUEST["idactividad"],"idactividad",2,"actividades");
  $idarea= retorna_cadena($_REQUEST["idactividad"],"idactividad",3,"actividades");
  $nombreactividad= retorna_cadena($_REQUEST["idactividad"],"idactividad",13,"actividades");
  $idzonaintervencion= retorna_cadena($_REQUEST["idactividad"],"idactividad",12,"actividades");
  $lugar= retorna_cadena($_REQUEST["idactividad"],"idactividad",11,"actividades");
  $responsable1= retorna_cadena($_REQUEST["idactividad"],"idactividad",4,"actividades");
  $responsable2= retorna_cadena($_REQUEST["idactividad"],"idactividad",5,"actividades");
  $responsable3= retorna_cadena($_REQUEST["idactividad"],"idactividad",6,"actividades");
  $responsable4= retorna_cadena($_REQUEST["idactividad"],"idactividad",7,"actividades");
  $nroparticipantes= retorna_cadena($_REQUEST["idactividad"],"idactividad",8,"actividades");
  $nvarones= retorna_cadena($_REQUEST["idactividad"],"idactividad",9,"actividades");
  $nmujeres= retorna_cadena($_REQUEST["idactividad"],"idactividad",10,"actividades");
  $perfilparticipante= retorna_cadena($_REQUEST["idactividad"],"idactividad",14,"actividades");
  $breveresena= retorna_cadena($_REQUEST["idactividad"],"idactividad",15,"actividades");
  $objetivoactividad= retorna_cadena($_REQUEST["idactividad"],"idactividad",16,"actividades");
  $progespecifico= retorna_cadena($_REQUEST["idactividad"],"idactividad",17,"actividades");
  $desarrolloactividad= retorna_cadena($_REQUEST["idactividad"],"idactividad",18,"actividades");
  $resultadobalance= retorna_cadena($_REQUEST["idactividad"],"idactividad",19,"actividades");
  $resultadoprueba= retorna_cadena($_REQUEST["idactividad"],"idactividad",20,"actividades");
  $recomendaciones= retorna_cadena($_REQUEST["idactividad"],"idactividad",21,"actividades");
  $responsableelaboracion= retorna_cadena($_REQUEST["idactividad"],"idactividad",22,"actividades");
  $cmbactividadesproy = retorna_cadena($_REQUEST["idactividad"],"idactividad",23,"actividades");
  $idsession = retorna_cadena($_REQUEST["idactividad"],"idactividad",24,"actividades");

   }
  if($_REQUEST['op']=='nuevo')
  {
     $cmbproyecto = $_REQUEST["idproyecto"];

  }
  if($_POST["grabar"])
  {
    
       if($_REQUEST['op']=="editar")
         $idactividad = $_REQUEST['idactividad'];
     
       $fecha = $_POST["fecha"];
       $idproyecto= $_POST["cmbproyecto"];
       $idarea= $_POST["idarea"];
       $idresponsable1= $_POST["responsable1"];
       $idresponsable2= $_POST["responsable2"];
       $idresponsable3= $_POST["responsable3"];
       $idresponsable4= $_POST["responsable4"];
       $nroparticipantes= $_POST["nroparticipantes"];
       $nvarones= $_POST["nvarones"];
       $nmujeres= $_POST["nmujeres"];
       $lugar= $_POST["lugar"];
       $idzonaintervencion= $_POST["idzonaintervencion"];
       $nombreactividad= $_POST["nombreactividad"];
       $perfilparticipante= $_POST["perfilparticipante"];
       $breveresena= $_POST["breveresena"];
       $objetivoactividad= $_POST["objetivoactividad"];
       $progespecifico= $_POST["progespecifico"];
       $desarrolloactividad= $_POST["desarrolloactividad"];
       $resultadobalance= $_POST["resultadobalance"];
       $resultadoprueba= $_POST["resultadoprueba"];
       $recomendaciones= $_POST["recomendaciones"];
       $responsableelaboracion= $_POST["responsableelaboracion"];
       $idactividadproyecto= $_POST["cmbactividadesproy"];
       
       if($_REQUEST['op']=="nuevo")
       {
         $fechacreacion = date("d-m-Y H:i:s");
         $idsession = $_COOKIE["idsession"];
       }else
          {
            $idsession = $_POST["idsession"];
          }
       $fechaedicion  = date("d-m-Y H:i:s");
    
      if($_REQUEST['op']=="nuevo")
      {
        $variables = "idactividad, fecha,idproyecto,idarea,idresponsable1,idresponsable2,idresponsable3,idresponsable4,nroparticipantes,nvarones,nmujeres,lugar,idzonaintervencion,nombreactividad,perfilparticipante,breveresena,objetivoactividad,progespecifico,desarrolloactividad,resultadobalance,resultadoprueba,recomendaciones,responsableelaboracion,idactividadproyecto, idsession,fechacreacion, fechaedicion, bloqueado";
        $valores = "NULL, '$fecha','$idproyecto','$idarea','$idresponsable1','$idresponsable2','$idresponsable3','$idresponsable4','$nroparticipantes','$nvarones','$nmujeres','$lugar','$idzonaintervencion','$nombreactividad','$perfilparticipante','$breveresena','$objetivoactividad','$progespecifico','$desarrolloactividad','$resultadobalance','$resultadoprueba','$recomendaciones','$responsableelaboracion','$idactividadproyecto','$idsession','$fechacreacion','$fechaedicion','0'";
          $cadena = "insert into actividades  ($variables) values ($valores) ";     
          // echo $cadena;
 
      }else
       {
          $variables = "fecha='$fecha',idproyecto='$idproyecto',idarea='$idarea',idresponsable1='$idresponsable1',idresponsable2='$idresponsable2',idresponsable3='$idresponsable3',idresponsable4 = '$idresponsable4',nroparticipantes='$nroparticipantes',nvarones='$nvarones',nmujeres='$nmujeres',lugar='$lugar',idzonaintervencion='$idzonaintervencion',nombreactividad='$nombreactividad',perfilparticipante='$perfilparticipante',breveresena='$breveresena',objetivoactividad='$objetivoactividad',progespecifico='progespecifico',desarrolloactividad='$desarrolloactividad',resultadobalance='$resultadobalance',resultadoprueba='$resultadoprueba',recomendaciones='$recomendaciones',responsableelaboracion='$responsableelaboracion',idactividadproyecto='$idactividadproyecto',fechaedicion='$fechaedicion',idsession='$idsession'";
          $cadena="update actividades set $variables where idactividad='$idactividad'";
       }   

      if($cadena<>"")
      {
        echo $cadena;

        $conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);
         mysql_query("SET NAMES utf8");
        mysql_query($cadena,$conexion);
        
        mysql_close($conexion);
             ?>
 
                 <head>         
 		   <META HTTP-EQUIV="Refresh" CONTENT="0; URL=proyecto_actividades.php?&idproyecto=<? echo $_REQUEST[idproyecto] ?>">
                 </head> 
                <?    

      }



  }
    
?>

<div class="div1">
<div class="contenido">
  <br>
   

<!-- 


-->

   <br>
  <? include("menu_.php")?>

<? if($_REQUEST[op]=='nuevo') { ?>
<form name='datos' method='post' action='actividadproyecto_op.php?op=<? echo $_REQUEST[op]; ?>&idproyecto=<? echo $_REQUEST[idproyecto]; ?>'>

<? }else{ ?> 
    <form name='datos' method='post' action='actividadproyecto_op.php?op=<? echo $_REQUEST[op]; ?>&idproyecto=<? echo $_REQUEST[idproyecto]; ?>&idactividad=<? echo $_REQUEST[idactividad]; ?>'>
<? } ?>

<table CELLPADDING="1" and CELLSPACING='0' bgcolor='#000'><tr><td>
<table border='0' CELLPADDING="2" and CELLSPACING='0' bgcolor='#c8ff71'>
<tr><td colspan='3' bgcolor='#000'>
<?
   if($_REQUEST[op]=="nuevo")
   {
     echo "<font face='arial' size='2' color='#ffffff'>NUEVA ACTIVIDAD";

   }   
   else{
           echo "<font face='arial' size='2' color='#ffffff'>EDITANDO ACTIVIDAD";
       }
?>
<a href='proyecto_actividades.php?&idproyecto=<? echo $_REQUEST[idproyecto]; ?>'><img border='0' align="right" src='imagenes/cerrar.jpg'></a>
</td></tr>
<tr><td>

<font size='2'>Fecha<br>  <input id='fecha' name='fecha' value='<? echo $fecha; ?>'>
<a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>  <div id="calendario">
    <?php calendar_html() ?>
</div>

</td><td>
<font size='2'>Proyecto <br><?


 $nombre_proyecto = retorna_cadena($cmbproyecto,"idproyecto",1,"proyecto");
 echo  "<b>".$nombre_proyecto;
 
?>
   <input type="hidden" name="cmbproyecto" value="<? echo $cmbproyecto; ?>">

</td>

<td><font size='2'> Area<br>
<select name='idarea'>
<?  cargar_area_actividades($idarea); ?>
</select>
</td> 
<tr>


<td colspan=3>
<font size='2'>Actividad 
<?php 
    
   if($_REQUEST['idproyecto'])
     $cmbproyecto = $_REQUEST['idproyecto'];

  echo "<select name='cmbactividadesproy' id='cmbactividadesproy' value='cmbactividadesproy'>";
 // if($_REQUEST['idproyecto'])
  carga_opcionesactiviades($cmbproyecto,$cmbactividadesproy);             
  echo "</select>" 

 ?>
</td>
</tr>
<tr>
<td>
<font size='2'>Nombre Actividad <br><input size='28' name="nombreactividad" value='<? echo $nombreactividad; ?>'>

</td>
<td>
<font size='2'>Zona de Intervencion  <br><select  name='idzonaintervencion' value='<? echo $idzonaintervencion; ?>'>
<?cargar_zonas($idzonaintervencion); ?>
</select>
</td>
</tr>
<tr>
<td colspan='3'>
    <font face='arial' size='2'>Lugar <input name='lugar' size='95' value='<?  echo $lugar; ?>'>

</td>
</tr>

<tr> <td colspan='3'>

<table width='100%'>
<tr>
<td><font size='2'>Responsable 1 
  <select name='responsable1'>
  <? cargar_responsable($responsable1); ?>
</select>
</td>
<td><font size='2'>Responsable 2
 <select name='responsable2'>
<? cargar_responsable($responsable2); ?>
</select>

</td>
<td><font size='2'>Responsable 3
 <select name='responsable3'>
<? cargar_responsable($responsable3); ?>
</select>


</td>
<td><font size='2'>Responsable 4
 <select name='responsable4'>
<? cargar_responsable($responsable4); ?>
</select>

</td></tr>
</table>


</td></tr>
<tr><td colspan='3'>
<table width='100%' ><tr><td colspan='2' width='200'>
<font size='2'>Numero de Participantes<br>
<input name='nroparticipantes' size='5' value='<? echo $nroparticipantes;?>'>
<br><br>
Nro Hombres
<br>
<input name='nvarones' size='5' value='<? echo $nvarones; ?>'>
<br><br>
Nro Mujeres<br>
<input name='nmujeres' size='5' value='<? echo $nmujeres; ?>'>

</td><td>
<font size='2'>Perfil de participantes<br>
<textarea cols='90' rows='5' name='perfilparticipante' value='<? echo $perfilparticipante; ?>'><? echo $perfilparticipante; ?>
</textarea>
</td></tr>
</table>
<tr>
<tr><td colspan='3'>
<font size='2'>
<b>Presentaci&oacute;n antecedentes de la actividad</b><br>
<font size='1'>
Breve rese&ntilde;a de la actividad, en qu&eacute; proceso se enmarca,  Señalar con quién/quiénes se ha coordinado, Actividades previas que han facilitado su realización, Resaltar algún dato importante sobre las instituciones o participantes, Otros datos de importancia)

<textarea cols='120' rows='5' name='breveresena' value='  <? echo $breveresena; ?>'><? echo $breveresena; ?>
</textarea>
</td>
</tr>


<tr><td colspan='3'>
<font size='2'><b>
Objetivos de la actividad
</b>
<textarea cols='120' rows='5' name='objetivoactividad' value='  <? echo $objetivoactividad; ?>'><? echo $objetivoactividad; ?>
</textarea>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Programa especifico
</b><br>
<font size='1'>
(Presentaci&oacute;n la gu&iacute;a de capacitaci&oacute;n programa o agenda prevista)

<textarea cols='120' rows='5' name='progespecifico' value='<? echo $progespecifico; ?>'><? echo $progespecifico; ?>
</textarea>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Desarrollo de la actividad
</b><br>
<font size='1'>
(Describir los pasos seguidos para el desarrollo, t&eacute;cnicas usadas, Detallar ideas clave, resultados de cada paso o fase, Comentarios relevantes)

</font>

<textarea cols='120' rows='5' name='desarrolloactividad' value='<? echo $desarrolloactividad; ?>'><? echo $desarrolloactividad; ?></textarea>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Resultado o balance de la actividad
</b><br>
<font size='1'>

(Describir  y valorar resultados en relaci&oacute;n  expectativas y/o objetivos, Comentar resultados de evaluaci&oacute;n participantes y autoevaluaci&oacute;n de equipo,  Acuerdos a los que se llegaron (teniendo presente a  que resultado se dirige).


<textarea cols='120' rows='5' name='resultadobalance' value='<? echo $resultadobalance; ?>'><? echo $resultadobalance; ?></textarea>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Resultado de prueba de entrada y salida: si la hubiera
</b>
<textarea cols='120' rows='5' name='resultadoprueba' value='<? echo $resultadoprueba; ?>'><? echo $resultadoprueba; ?></textarea>
</td>
</tr>
<tr><td colspan='3'>
<font size='2'><b>
Dificultades, retos y recomendaciones
</b>
<textarea cols='120' rows='5' name='recomendaciones' value='<? echo $recomendaciones; ?>'><? echo $recomendaciones; ?></textarea>
</td>
</tr>

<tr><td colspan='2'>
<font size='2'><b>
Responsable de la elaboraci&oacute;n
</b>
 <select name='responsableelaboracion'>
<? cargar_responsable($responsableelaboracion); ?>
</select>
</td>
<td>
<? if($nivel==1){ ?>
<b> Sessi&oacute;n:  </b>
  <select name='idsession'>
  <? cargar_session($idsession); ?>
</select>

<? }else
      {
        echo "<input name='idsession' type='hidden' value='$idsession'>";
  
       }

?>
</td>
</tr>
<tr><td colspan="2">
<td><input name='grabar' type="submit"  value='Grabar' src='imagenes/grabar_x.png'> </td>
</tr>

</table>
</td></tr></table>
</form>
</div></div>

<?

function cargar_session($idsession)
{
   $conexion = conectar_base();
   mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES utf8");
   $cadena ="SELECT * FROM usersession";
   $tabla = mysql_query($cadena, $conexion);
   while ($registro = mysql_fetch_array($tabla)){

        if($registro[0]==$idsession)
         echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
        else
         echo "<option value='$registro[0]'>$registro[1]</option>";

  }
    mysql_free_result($tabla);
        mysql_close($conexion);


}

function carga_opcionesactiviades($cmbproyecto,$idactividad)
{

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   mysql_query("SET NAMES utf8");
   $idprovincia = $_POST["elegido"];
   $cadena ="SELECT * FROM actividadproyecto where idproyecto='$cmbproyecto' ";
   echo "<option value='0'>Seleccionar</option>";
   $tabla = mysql_query($cadena, $conexion);   
   while ($registro = mysql_fetch_array($tabla)){

        if($registro[0]==$idactividad)
	 echo "<option value='$registro[0]' SELECTED>$registro[1]</option>";
        else
	 echo "<option value='$registro[0]'>$registro[1]</option>";
     
  }
    mysql_free_result($tabla);
	mysql_close($conexion);


}

?>
