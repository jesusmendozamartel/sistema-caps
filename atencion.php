<?php 
   include("cabecera.php"); 
   include("funciones.php");
   require('calendario.php');
   $iduser = $_REQUEST['iduser'];
   ?>
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.functions.js"></script>
</head>
   
   <?
   if($_POST["grabar"])
   {
        if($_REQUEST["op"]=="nuevo")
		{   echo 'proyecto1 antes de: '.$_REQUEST['proyecto1']; 
   		    $sw = graba_usuario($_POST['codatencion'],$_POST['fecha'], $_POST['lugaratencion'], $_POST['tipousuario'], $_POST['cmbarea'], $_POST['cmbsubarea'], $_POST['responsable1'], $_POST['responsable2'], $iduser, $_POST['cmbactividad'], $_POST['mejoria'],$iduser,$_REQUEST['proyecto1'],$_REQUEST['proyecto2'],$_REQUEST['proyecto3'],$_REQUEST['proyecto4']);
			//echo "grabausuario"; //graba_usuario();
			if($sw==1)
			{
			 ?>
			   <head>         
 		         <META HTTP-EQUIV="Refresh" CONTENT="0; URL=atenciones.php?iduser=<?php echo  $_REQUEST['iduser']; ?>">
                </head>
			  <?
			}   
		  
		}else
		  {
		 //  echo $_POST['cmbsubarea'];      
                   if($_POST["cmbsubarea"]=="")
                   {
                        $subarea = $_POST['subareax'];

                   }else
                        $subarea = $_POST['cmbsubarea'];
                  
                  echo $subarea;
	       	 $sw = edita_atencion($_POST['codatencion'],$_POST['fecha'], $_POST['lugaratencion'], $_POST['tipousuario'], $_POST['cmbarea'], $subarea, $_POST['responsable1'], $_POST['responsable2'], $_POST['cmbproyecto'], $_POST['cmbactividad'], $_POST['mejoria'],$_REQUEST['idatencion'],$_REQUEST['proyecto1'],$_REQUEST['proyecto2'],$_REQUEST['proyecto3'],$_REQUEST['proyecto4']);
			   
//$codatencion,$fecha,$idlugar,$idtipousuario,$idarea,$idsubarea,$idresponsable1,$idresponsable2,$idproyecto,$idactividad,$idescalarecuperacion,$idatencion

			//echo "grabausuario"; //graba_usuario();
			if($sw==1)
			{
			 ?>
			   <head>         
 		         <META HTTP-EQUIV="Refresh" CONTENT="0; URL=atenciones.php?iduser=<?php echo  $_REQUEST['iduser']; ?>">
                </head>  
			  <?
			}   
		  
		  
		  }
   
   }
if($sw!=1)
{   
?>

<div class="div1">
<div class="contenido">

<?php
     $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
	 $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
	 echo "<h2>Atenciones de: ".$nombre_usuario." - ".$apellido_usuario."</h2><hr>";
  ?>   
  <?php
   if($_REQUEST['op']=="nuevo")
    { 
	  echo "<form id='formulario' name='nuevaatencion' method='post' action='atencion.php?iduser=$iduser&op=$_REQUEST[op]'>";
	  echo "<table bgcolor='#c1c1c1' align='center' border='0' cellspacing='0'>";  
	  echo "<tr bgcolor='#961515'><td bgcolor='#961515'><b><font color='#ffffff'>Nueva Atenci&oacute;n</b></td> <td align='right'><a href='atenciones.php?iduser=";
	  echo $iduser;
	  echo "'><font color='#ffffff'><img src='imagenes/cerrar.jpg'></a></td></tr>";
	  
	 }else
	    {
		echo "<form id='formulario' name='nuevaatencion' method='post' action='atencion.php?iduser=$iduser&idatencion=$_REQUEST[idatencion]&op=$_REQUEST[op]' >";
	  echo "<table bgcolor='#c1c1c1' align='center' border='0' cellspacing='0'>";  
	  echo "<tr bgcolor='#961515'><td bgcolor='#961515'><b><font color='#ffffff'>Editar Atenci&oacute;n</b></td> <td align='right'><a href='atenciones.php?iduser=";
	  echo $iduser;
	  echo "'><font color='#ffffff'><img src='imagenes/cerrar.jpg'></a></td></tr>";
		
		}
	 prepara_formulario_atencion($iduser,$_REQUEST['op'],$_REQUEST['idatencion']);
  ?>
</div>
</div>

<? 
}
include("pie.php");  

function prepara_formulario_atencion($iduser,$op,$idatencion)
{
  
  if($op=='edit')
  {
           $codatencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",1,"atencion"); 
           $fecha = retorna_cadena($_REQUEST["idatencion"],"idatencion",2,"atencion");
           $lugaratencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",3,"atencion");
           $tipousuario = retorna_cadena($_REQUEST["idatencion"],"idatencion",4,"atencion");
	   $cmbarea = retorna_cadena($_REQUEST["idatencion"],"idatencion",5,"atencion");
	   $cmbsubarea = retorna_cadena($_REQUEST["idatencion"],"idatencion",6,"atencion");
	   setcookie("idsubarea", $cmbsubarea);
	   $textsubarea = retorna_cadena($cmbsubarea,"idsubarea",1,"subarea");
	   $responsable = retorna_cadena($_REQUEST["idatencion"],"idatencion",7,"atencion");
	   $responsable2 = retorna_cadena($_REQUEST["idatencion"],"idatencion",8,"atencion");
	   $cmproyecto = retorna_cadena($_REQUEST["idatencion"],"idatencion",9,"atencion");
	   $cmbactividad =retorna_cadena($_REQUEST["idatencion"],"idatencion",10,"atencion");
	   setcookie("idactividad", $cmbactividad);
	   $txtactividad  =retorna_cadena($cmbactividad,"idactividad",1,"actividadproyecto");
           $proyecto1 = retorna_cadena($_REQUEST["idatencion"],"idatencion",18,"atencion");
           $proyecto2 = retorna_cadena($_REQUEST["idatencion"],"idatencion",19,"atencion");
           $proyecto3 = retorna_cadena($_REQUEST["idatencion"],"idatencion",20,"atencion");
           $proyecto4 = retorna_cadena($_REQUEST["idatencion"],"idatencion",21,"atencion");
  }
  
 // echo "<tr><td align='right'><font size='2'>Codigo Atenci&oacute;n:</td>";  
//  echo "<td><input name='codatencion' value='$codatencion'></td></tr>";
  echo "<tr><td align='right'><font size='2'>Fecha</td>";

  echo "<td><input  id='fecha' name='fecha' value='$fecha'>";
  ?>
  
  <a onclick="show_calendar()" style="cursor: pointer;"><small><img src='imagenes/iconoCalendario.gif'></small></a>
    <div id="calendario">
    <?php calendar_html() ?>
    </div>
  
  <?
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Lugar de Atencion</td><td>";
   
  echo "<select name='lugaratencion'>";  
  cargar_lugar_atencion($lugaratencion);
  echo "</select>";
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Tipo de Usuario</td><td>";
  echo "<select name='tipousuario' >";
   cargar_tipo_usuario($tipousuario);
   echo "</select>";
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Area</td><td>";
  echo "<select name='cmbarea' id='cmbarea' >";
   cargar_area($cmbarea);
  echo "</select>";
  
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Sub Area</td><td>";
  echo "<select name='cmbsubarea' id='cmbsubarea' value='$cmbsubarea'>";
  echo "</select>".$textsubarea;
  if($_REQUEST["op"]=="edit")
  {
    echo "<input type='hidden' name='subareax' value='$cmbsubarea'>";
  } 
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Responsable 1:</td><td>";
  echo "<select name='responsable1' id='responsable1' >";
   cargar_responsable($responsable);
  echo "</select>";
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Responsable 2:</td><td>";
  echo "<select name='responsable2' id='responsable2' >";
   cargar_responsable($responsable2);
  echo "</select>";
  echo "</td></tr>";
  echo "<tr><td align='right'><font size='2'>Proyecto 1:</td><td>";
  echo "<select name='proyecto1' id='proyecto1' >";
   cargar_proyecto($proyecto1);
  echo "</select></td></tr>";  
  echo "<tr><td align='right'><font size='2'>Proyecto 2:</td><td>";
  echo "<select name='proyecto2' id='proyecto2' >";
   cargar_proyecto($proyecto2);
  echo "</select></td></tr>";  
  echo "<tr><td align='right'><font size='2'>Proyecto 3:</td><td>";
  echo "<select name='proyecto3' id='proyecto3' >";
   cargar_proyecto($proyecto3);
  echo "</select></td></tr>";     
  echo "<tr><td align='right'><font size='2'>Proyecto 4:</td><td>";
  echo "<select name='proyecto4' id='proyecto4' >";
   cargar_proyecto($proyecto3);
  echo "</select></td></tr>";
  
  /*
  echo "<tr><td align='right'><font size='2'>Actividad Monitoreo:</td><td>";
  echo "<select name='cmbactividad' id='cmbactividad' value='$cmbactividad'>";
  echo "</select>".$txtactividad;
  echo "</td></tr>";*/

/*  echo "<tr><td colspan='2' height='5' bgcolor='#ececec'></td></tr>";
  echo "<tr><td align='right'><font size='2'>Escala de Mejoria:</td><td>";
  echo "<select name='mejoria' id='mejoria' >";
   cargar_mejoria($mejoria);
  echo "</select>";  
  echo "</td></tr>";
  */
  echo "<tr><td colspan='2' align='center'><hr><input type='submit' name='grabar' value='grabar' ></td></tr>";
  echo "</table>";
  echo "</form>";
}
?>
