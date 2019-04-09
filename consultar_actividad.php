<?

//   include("cabecera.php"); 
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
?>


<table CELLPADDING="1" and CELLSPACING='0' width='800' bgcolor='#000'><tr><td>
<table border='0' CELLPADDING="2" and CELLSPACING='0' bgcolor='#ffffff'>

<tr><td>

<font size='2'><b>Fecha:</b>  <? echo $fecha; ?>


</td><td>
<font size='2'><b>Proyecto</b>:
<?
   
  if($cmproyecto=='0' || $cmproyecto=='')
      $cmproyecto = 1;
  $textoproyecto =  retorna_cadena($cmproyecto,"idproyecto",1,"proyecto");
  echo $textoproyecto;

?></td>

<td><font size='2'><b>Area: </b>

<? 
   if($idarea=="" || $idarea=="0")
      $nombrearea="SIN DATO";
  else
     $nombrearea= retorna_cadena($idarea,"idarea",1,"areaeventos");
  echo $nombrearea;
 ?>

</td> 
<tr>


<td>
<font size='2'><b>Actividad</b> : 
<? 

   if($cmbactividadesproy=="" || $cmbactividadesproy=="0")
    $nombre_actividad = "SIN DATO";
   else
     $nombre_actividad =   retorna_cadena($cmbactividadesproy,"idactividad",1,"actividadproyecto");
  echo $nombre_actividad;

 ?>

<td>
<font size='2'><b>Nombre Actividad</b>:<? echo $nombreactividad; ?>

</td>
<td>
<font size='2'><b>Zona de Intervencion</b>:
<?
        
    if($idzonaintervencion=="0")
      $zona ="SIN DATO";
    else
       $zona = retorna_cadena($idzonaintervencion,"idlugar",2,"lugaratencion");
    echo $zona;
?>

</td>
</tr>
<tr>
<td colspan='3'>
    <font face='arial' size='2'><b>Lugar</b>: <?  echo $lugar; ?>

</td>
</tr>

<tr> <td colspan='3'>

<table width='100%'>
<tr>
<td><font size='2'><b>Responsable 1:</b>
<?
   $nombre =  retorna_cadena($responsable1,"idresponsable",1,"responsable");
   $apellido =  retorna_cadena($responsable1,"idresponsable",2,"responsable");
   echo $nombre." ".$apellido;   
?> 

</td>
<td><font size='2'><b>Responsable 2: </b>
<?
   $nombre =  retorna_cadena($responsable2,"idresponsable",1,"responsable");
   $apellido =  retorna_cadena($responsable2,"idresponsable",2,"responsable");
   echo $nombre." ".$apellido;   

?>


</td>
<td><font size='2'><b>Responsable 3: </b>
<?
   $nombre =  retorna_cadena($responsable3,"idresponsable",1,"responsable");
   $apellido =  retorna_cadena($responsable3,"idresponsable",2,"responsable");
   echo $nombre." ".$apellido;   

?>


</td>
<td><font size='2'><b>Responsable 4:</b>
<?
   $nombre =  retorna_cadena($responsable4,"idresponsable",1,"responsable");
   $apellido =  retorna_cadena($responsable4,"idresponsable",2,"responsable");
   echo $nombre." ".$apellido;   

?>

</td></tr>
</table>


</td></tr>
<tr><td colspan='3'>
<table width='100%' ><tr><td colspan='2' width='200'>
<font size='2'><b>Numero de Participantes</b><br>
 <? echo $nroparticipantes;?>
<br><br>
<b>Nro Hombres</b>
<br>
<? echo $nvarones; ?>
<br><br>
<b>Nro Mujeres</b><br>
<? echo $nmujeres; ?>
<br>
</td><td align='left' valign='top'>
<font size='2'><b>Perfil de participantes</b><br>

  <? echo $perfilparticipante; ?>

</td></tr>
</table>
<tr>
<tr><td colspan='3'>
<font size='2'><b>
Breve reseña de la actividad, en qué proceso se enmarca,  Señalar con quién/quiénes se ha coordinado, Actividades previas que han facilitado su realización, Resaltar algún dato importante sobre las instituciones o participantes, Otros datos de importancia):<br>
</b>
<? echo $breveresena; ?>

</td>
</tr>


<tr><td colspan='3'>
<font size='2'><b>
Objetivo de la actividad<br>
</b>
<? echo $objetivoactividad; ?>

</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Programa especifico<br>
</b>
<? echo $progespecifico; ?>

</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Desarrollo de la actividad<br>
</b>
<? echo $desarrolloactividad; ?>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Resultado o balance de la actividas<br>
</b>
<? echo $resultadobalance; ?>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Resultado de prueba de entrada y salida: si la hubiera<br>
</b>
<? echo $resultadoprueba; ?>
</td>
</tr>
<tr><td colspan='3'>
<font size='2'><b>
Dificultades y recomendaciones
</b><br>
<? echo $recomendaciones; ?>
</td>
</tr>

<tr><td colspan='3'>
<font size='2'><b>
Responsable de la elaboraci&oacute;n: 
</b>
 
<? $nombre =  retorna_cadena($responsableelaboracion,"idresponsable",1,"responsable");
   $apellido =  retorna_cadena($responsableelaboracion,"idresponsable",2,"responsable");
   echo $nombre." ".$apellido;  
?>


</td>

</tr>

</table>
</td></tr></table>
<center><input TYPE="image" SRC="imagenes/icon-impresora.gif" onclick="window.print();"></td><td align='right'></center>
<center><font size='1'><b>Sistema de Atenci&oacute;n del CAPS</b></center>

