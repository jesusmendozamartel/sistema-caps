<? 
   include("cabecera.php"); 
   include("funciones.php");
   $parte = $_REQUEST["parte"];
   $iduser = $_REQUEST['iduser'];
   $idatencion = $_REQUEST['idatencion'];
   $idproyecto = retornaproyecto($idatencion);
   if($_POST["grabar"])
   {
     $parte = $_POST["parte"]; 
     if($parte=='1')
     {
       $inicio = 1;
       $fin = 18;
     }else
      {
        $inicio = 19;
        $fin = 28; 

      }
     $idproyecto=$_POST["idproyecto"];
     $idatencion = $_REQUEST["idatencion"];
      for($i = $inicio; $i <= $fin; $i++)
      {
	    $valor = $_POST["respuesta$i"];	
            $existe = existe_valor($idatencion,$i);
            if($existe==0)
	    { 
              $cadena = "insert into escalabienestaratencion (idrespuesta,idatencion,idusuario,idescalabienestar,respuesta,idproyecto,parte) values ('','$idatencion','$iduser','$i','$valor','$idproyecto','$parte')";      
            }else
                 {
                   $cadena = "update escalabienestaratencion set respuesta='$valor',idproyecto='$idproyecto' where idatencion='$idatencion' and idescalabienestar='$i'";   
		} 
            $conexion = conectar_base();
            mysql_select_db ("sistemaatencion",$conexion);
	    mysql_query($cadena,$conexion);
            mysql_close($conexion);
	    
           }	   
	   ?>
	   
    
	     <head>
  		   <META HTTP-EQUIV="Refresh" CONTENT="3; URL=manager_encuesta.php?idatencion=<? echo $idatencion; ?>&iduser=<? echo $iduser; ?>">
		</head> 
	      
	   <?
	   
   
   }
?>
<style>
  .div2{ height:700px; } 
  .contenido{ height:700px; }
</style>
<head>
<div class="div2">
<div class="contenido">
   
  <?php
     $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
	 $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
      echo "<font face='arial' size='2'><b>Atenciones de:</b> ".$nombre_usuario." - ".$apellido_usuario."</font><hr>";
  ?>   

  
  <form name="encuestabienestar" method="post" action='encuesta_bienestar.php?idatencion=<? echo $_REQUEST['idatencion']; ?>&iduser=<? echo  $_REQUEST['iduser']; ?>'>
 
 <table  align="center" bgcolor="#000000">
  <tr><td colspan="3" > <font size="3"><b>ESCALA DE BIENESTAR</b> <a href='javascript:history.back()'><img align='right' src='imagenes/cerrar.jpg'></a</font></td></tr>
  <tr><td colspan="3"><b><font color='#ffffff'>Proyecto:</b> <? lista_proyectos($idproyecto); ?> </b></td></tr>
  <? muestra_opciones($parte, $_REQUEST['idatencion']); ?>
  <input name='parte' type='hidden' value='<? echo $parte ?>'>
  <tr><td colspan="3"><input type="submit" name="grabar" value="grabar"></td></tr>
  </table>

  </form>
  
</div>
</div>

<? include("pie.php");  ?>

<?
function lista_proyectos($idproyecto)
{
   echo "<select name='idproyecto'>";
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM proyecto";
   $tabla = mysql_query($cadena, $conexion);
   while ($registro = mysql_fetch_array($tabla))
   {
       if($registro[0]==$idproyecto)
          echo "<option value='$registro[0]' SELECTED>".$registro[1]."</option>";
       else
          echo "<option value='$registro[0]'>".$registro[1]."</option>";
   
   }   
   echo "</select>";
}

function muestra_opciones($parte,$idatencion)
{
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestar ";
    mysql_query("SET NAMES utf8");
   $tabla = mysql_query($cadena, $conexion);
   if($parte=='1')
   {
     $inicio = 1;
     $fin = 18;
   }else
    {
      $inicio = 19;
      $fin = 28; 

   }
   $contador = 1;
   while ($registro = mysql_fetch_array($tabla))
   {
     if($contador >= $inicio && $contador <= $fin)
     {
      $valor = devuelve_valor($idatencion,$contador);
      echo "<tr bgcolor='#ffffff'>";
      echo "<td ><font size='2'>".$registro[0]."</td>";
	  echo "<td><font size='2'> ".$registro[1]." </td>";
	  echo "<td>";
	  ?>
	    <select name="respuesta<? echo $registro[0]; ?>">
		<option value='2' <? if($valor=='2'){ echo "SELECTED"; } ?>> <font size='2'>SIN CONTESTAR</option>
		<option value='1' <? if($valor=='1'){ echo "SELECTED"; } ?>> <font size='2'>SI</option>
		<option value='0' <? if($valor=='0'){ echo "SELECTED"; } ?>> <font size='2'>NO</option>
		</select>
	  <?
	  echo "</td>";
	  echo "</tr>";

     } 
  

    $contador = $contador + 1;
   
	} 
}

function devuelve_valor($idatencion,$contador)
{
   $valor = 2;
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestaratencion where idescalabienestar='$contador' and idatencion='$idatencion'";
   $tabla = mysql_query($cadena, $conexion);  
   while ($registro = mysql_fetch_array($tabla))
   {
      $valor = $registro[4];
   }
   $numero = mysql_num_rows($tabla);
   mysql_free_result($tabla);
   mysql_close($conexion);
   return  $valor;

}

function retornaproyecto($idatencion)
{

   $conexion = conectar_base();
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestaratencion where idatencion='$idatencion'";
   $tabla = mysql_query($cadena, $conexion);
   
   while ($registro = mysql_fetch_array($tabla))
   {
      $valor = $registro[5];
   }
   mysql_free_result($tabla);
   mysql_close($conexion);
  return  $valor;


}

function existe_valor($idatencion,$contador)
{
   $valor = 2;
   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT * FROM escalabienestaratencion where idescalabienestar='$contador' and idatencion='$idatencion'";
   $tabla = mysql_query($cadena, $conexion);
   $contador = 0;  
   while ($registro = mysql_fetch_array($tabla))
   {
     $contador = $contador + 1;
   }
   $numero = mysql_num_rows($tabla);
   mysql_free_result($tabla);
   mysql_close($conexion);
   return  $contador;

}
?>


