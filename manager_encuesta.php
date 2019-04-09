<? include("cabecera.php"); 
   include("funciones.php");
   $iduser = $_REQUEST['iduser'];
   $idatencion = $_REQUEST['idatencion'];
   $nivel = $_COOKIE["nivel"];
   $idsession = $_COOKIE["idsession"];
?>
<head>
<div class="div1">
<div class="contenido">
  <a href="atenciones.php?iduser=<? echo $iduser; ?>"><img  align='right' src='imagenes/volver.png' width='50'></a> 
  <?php
     $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
	 $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
	 echo "<h2>Atenciones de: ".$nombre_usuario." - ".$apellido_usuario."</h2><hr>";
  ?>   
  
  <?php
    //cabezera_atencion($iduser);
	
	$verifica_existencia = verificando_existencia($iduser,$_REQUEST['idatencion']); 
        $idcreador =  retorna_cadena($iduser,"idusuario",26,"usuario");
        

    echo "<table align='center' border='0' width='550' bgcolor='#ffffff'><tr bgcolor='#910909'><td align='center'><font color='#ffffff' face='arial' size='2'><b>Escala de Bienestar</b></td><td align='center' width='50%'><font face='arial' size='2' color='#ffffff'><b>Escala de Autopercepci&oacute;n de Secuelas Psicol&oacute;gicas por Violencia Política</td></tr><tr><td align='center'><img src='imagenes/encuesta1.jpg'>";
	
	if($nivel=="1" || $idsession==$idcreador)
	{
         $valor_escala = escala_bienestar($iduser,$_REQUEST['idatencion'],1);
         $valor_escala2 = escala_bienestar($iduser,$_REQUEST['idatencion'],2);
  ?>
   <br>  
   
   <a href="encuesta_bienestar.php?parte=1&idatencion=<? echo $_REQUEST["idatencion"]; ?>&iduser=<? echo $iduser; ?>"><font face='arial' size='2'>Rendir Escala Parte 1: </a><? echo "<b>".$valor_escala; ?></b> Puntos<br>
   <a href="encuesta_bienestar.php?parte=2&idatencion=<? echo $_REQUEST["idatencion"]; ?>&iduser=<? echo $iduser; ?>"><font face='arial' size='2'>Rendir Escala Parte 2: </a><? echo "<b>".$valor_escala2; ?></b> Puntos<br>
  <?
    } else 
	  {
	    $valor_escala = escala_bienestar($iduser,$_REQUEST['idatencion'],1);
            $valor_escala2 = escala_bienestar($iduser,$_REQUEST['idatencion'],2);
	    echo "<br><font face='arial' size='2'>Resultado 1 : $valor_escala Puntos</font>";
       	    echo "<br><font face='arial' size='2'>Resultado 2 : $valor_escala2 Puntos</font>";
	  }

      echo "</td>";
	  echo "<td align='center'>";
	  
	  //if($registro[15]=="1")
	  //{  
	    /*$lupaweb2 = "viewencuestas.php?idatencion=$registro[0]&iduser=$iduser&tipousuario=$registro[3]";
	     ?>
		 <a href="javascript:Abrir_ventana('<? echo $lupaweb2; ?>')">
		 <?
		 echo "<img height='30' src='imagenes/encuesta.gif' border='0'></a>"; 
   	    */
		 $valor_encuesta=conteo_encuesta($idatencion,$iduser);
                 
                 if($nivel=="1" || $idsession==$idcreador)
                 {
                 echo "<br><a href='encuestas.php?idatencion=$idatencion&iduser=$iduser'>";
		 echo "<img border='0' height='30' src='imagenes/encuesta.jpg'>";		 
		 echo "<br><font size='2' >Rendir Escala</a><br><br>";
                 echo "Resultado: $valor_encuesta";
                 }else
                      {
		 echo "<img height='30' src='imagenes/encuesta1.jpg' border='0'></a><BR>"; 
                           echo "<b>Resultado Encuesta:</b>  $valor_encuesta";
                      }
	  /*}
	  else
	  {  
	     echo "<a href='encuestas.php?idatencion=$registro[0]&iduser=$iduser&tipousuario=$registro[3]'>";
		 echo "<img border='0' height='30' src='imagenes/encuesta1.jpg'></a>";		 
		 }
	  */
	  
	  
	 echo "</td></tr></table>";
	  
  ?>
</div>
</div>

<? include("pie.php");  ?>

<?
function retorna_creador($idatencion)
{

   $conexion = conectar_base();
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena = "select * from atencion where idatencion ='$idatencion'";
  $tabla = mysql_query($cadena, $conexion);
  echo $cadena; 

  while ($registro = mysql_fetch_array($tabla))
   {
     $valor = $registro[16];
   }
  mysql_close($conexion);
}




function verificando_existencia($iduser,$idatencion)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestaratencion where idusuario='$iduser' and idatencion='$idatencion'";
   $tabla = mysql_query($cadena, $conexion);  
   $numero = mysql_num_rows($tabla);
   mysql_free_result($tabla);
   mysql_close($conexion);
   return  $numero;
}


?>
