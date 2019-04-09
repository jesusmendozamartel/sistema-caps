<? 
  include("funciones.php");
include("cabecera.php"); ?>

<head>
  <style>
   td.estilo
    {
       
       background-color:#e8c6c6; 
       width:20px;
       border: 1px solid black;
       text-align: center;
       text-decoration:underline;
       

    }
   td.estiloseleccionado
    {
       color: #ffffff;
       width:20px;
       background-color:#770a0a;
       border: 1px solid black;
       text-align: center;
       
     }
   .div1 .contenido2
    {
       height: 1100px;
	   
     }
	   
</style>
</head>


<div class="div1">
<div class="contenido2">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br><br>
  <? include("menu_adm.php")?>
  <hr>
  <h2>Estados de afectaci&oacute;n</h2>
  <a href='opafectacion.php?op=nuevo'>[+]Nuevo estado</a>
  <table  width="980" height="490" >
   <tr><td valign='top'>
   <table width="890"  CELLPADDING=1 CELLSPACING=0 bgcolor='#000000'><tr><td	>
    <table  width="890" CELLPADDING=0 CELLSPACING=1 border='0' ><tr bgcolor='#000'>
    <td ><font size='2' color='#fff'>Codigo Sistema</td>
    <td><font size='2' color='#fff'>Descripci&oacute;n</td> 
    <td><font size='2' color='#fff'>orden</td> 
    <td><font size='2' color='#fff'>Tortura</td> 
    <td><font size='2' color='#fff'>Opciones</td> 
    </tr>
    <? muestra_afectaciones(); ?>
   </table> 
   </td></tr></table>

    </td>
   </tr> 
  </table>
  
	
	
</div>
</div>

<? 

function muestra_afectaciones()
{

     $conexion = conectar_base(); 
      mysql_select_db ("sistemaatencion",$conexion);
       mysql_query("SET NAMES utf8");
     $cadena = "select * from  tipoafeccion  tipoafeccion order by orden";  

         $tabla = mysql_query($cadena, $conexion); 


   
    $tabla = mysql_query($cadena, $conexion);

   while ($registro = mysql_fetch_array($tabla)){
    
    echo "<tr  bgcolor='#ffffff'>";
    echo "<td><font face='arial' size='2'>$registro[0]</td>";
   echo "<td><font face='arial' size='2'>$registro[1]</td>";
   echo "<td><font face='arial' size='2'>$registro[2]</td>";
   echo "<td><font face='arial' size='2'>$registro[3]</td>";
   echo "<td><font face='arial' size='2'><a href='opafectacion.php?op=editar&idafectacion=$registro[0]'><img src='imagenes/editar.gif'>Editar</a> <a href='opafectacion.php?op=eliminar&idafectacion=$registro[0]'><img src='imagenes/eliminar.gif'>Elimina</a></td>";
    echo "<tr>";

    }
   
     mysql_close($conexion);
}


?>
