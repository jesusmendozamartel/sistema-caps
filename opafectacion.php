<? 
  include("funciones.php");
include("cabecera.php"); ?>

<?

  $idafectacion = $_REQUEST["idafectacion"];

  if($_REQUEST["op"]<>"nuevo")
  {


    $descripcion = retorna_cadena($_REQUEST["idafectacion"],"idafeccion",1,"tipoafeccion");  

    $orden = retorna_cadena($_REQUEST["idafectacion"],"idafeccion",2," tipoafeccion");  
    $tortura = retorna_cadena($_REQUEST["idafectacion"],"idafeccion",3," tipoafeccion");  
  }
  if($_POST["eliminar"])
  {
    
    $cadena_grabar="delete from tipoafeccion where idafeccion='$idafectacion'";
  }
  if($_POST["grabar"])
  {
     if($_POST["descripcion"]<>"" && $_POST["orden"]<>"")
     {
           $descripcion = $_POST["descripcion"];
           $orden = $_POST["orden"];
	   $tortura = $_POST["tortura"];
 
            if($_REQUEST["op"]=="nuevo") 
            {  
               $cadena_grabar="insert into tipoafeccion (idafeccion,descripcion,orden,tortura) values ('','$descripcion','$orden','$tortura')";
             }else
                {
                  $cadena_grabar="update tipoafeccion set descripcion='$descripcion',orden='$orden',tortura='$tortura' where idafeccion = $idafectacion; ";

                 }
     }

  }
  if($cadena_grabar<>"")
  {

       $conexion = conectar_base(); 
        mysql_select_db ("sistemaatencion",$conexion);  
        mysql_query($cadena_grabar, $conexion); 
       echo $cadena_grabar;
    ?>
 

<?

 


 
   }


?>

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
       height: 100%;  
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
  
  <table  width="980" height="490" >
   <tr><td valign='top'>
   <table width="400" align='center' CELLPADDING=1 CELLSPACING=0 bgcolor='#000000'>
   <tr><td><font color='#fff'>Estado de afectaci&oacute;n </td><td><div align='right'><a href='eafectacion.php'><img align='right' src='imagenes/cerrar.jpg'></a></div></td></tr>
   <tr><td colspan='2'>
  <? if($_REQUEST["op"]=="nuevo"){ ?>
    <form name="gabis" method='post' action='opafectacion.php?op=nuevo'>
  <? }else{ ?>
         <form name="gabis" method='post' action='opafectacion.php?op=<? echo $_REQUEST["op"]; ?>&idafectacion=<? echo $_REQUEST["idafectacion"]; ?>'>

  <? } ?>
    <table  width="400" CELLPADDING=0 CELLSPACING=1 border='0' bgcolor='#fffff'>

    <tr><td>Descripcion:</td><td>
          <? if($_REQUEST["op"]<>"eliminar"){ ?>
             <input name='descripcion' value="<? echo $descripcion; ?>" >
          <? }else{ ?>
                <? echo $descripcion; ?>
         <? } ?>
       </td></tr>
    <tr><td>Orden:</td><td>
         <? if($_REQUEST[op]<>"eliminar"){ ?>
           <input name='orden' value='<? echo $orden; ?>' ><br><font size='1'>Debe ingresar un valor para que corresponsta al orden del formulario de afectaci&oacuten para el usuario</font>
         <? }else{ ?>
                <? echo $orden; ?>
               
         <? } ?>
       
</td></tr>
    <tr><td>Tortura:</td><td>
 <? if($_REQUEST[op]<>"eliminar"){ ?>
<input name='tortura' value='<? echo $tortura; ?>'>  <br><font size='1'>Coloque solo 1 si representa caso de tortura, de lo contrario dejelo en blanco
<? }else{ ?>
                <? echo $tortura; ?>
         <? } ?>

</td></tr>
    <tr><td colspan='2' align='center'>
      <?
            if($_REQUEST["op"]=="eliminar")
            {
                echo "<input type='submit' name='eliminar' value='eliminar'>";
             }else
               {
                echo "<input type='submit' name='grabar' value='grabar'>";

                }
       

      ?>
        
    </td></tr>
   </table> 
</form>
   </td></tr></table>

    </td>
   </tr> 
  </table>
  
	
	
</div>
</div>

<? include("pie.php");

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
