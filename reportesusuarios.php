<? include("cabecera.php"); 
    include("funciones.php");
    $numeropagina = 50;
    $pagina = $_REQUEST["pagina"];
    if($pagina=="")
       $pagina = 1;    

  $nivel = $_COOKIE["nivel"];
   $idsession =  $_COOKIE["idsession"];
   $fechita = date("Y-m");   
   $idlugar = $_POST["idlugar"];
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

   .contenido
    {
        height: auto;  
      }
    .div1
    {
          height: auto;  
   }
    
   a:link {text-decoration:underline}
a:visited {text-decoration:underline}
a:hover{text-decoration:underline}
a:active{text-decoration:underline}
  </style> 
</head>
<div class="div1">
<div class="contenido">
  
 <div align="right"><b>M&oacute;dulo de Usuarios</b></div>
 <hr>
  <div align="left">
  <table height='500' border='0' width='100%'><tr>
  <td height='22'>
  <table border='0' height='22'><tr><td>
  <form name="busquedapaciente" action='reportesusuarios.php' method="post"><font size='2'>A&ntilde;o :</font>  <input name="anho" value="<? echo $_POST["anho"]; ?>"> 
  </td>
</tr>
<?
  if($nivel=="1")
  {  echo "<tr><td>";
     if($idlugar=="")
      $idlugar = 0;   
     carga_sessiones($idlugar);
     echo "</td></tr>";
   }
?>
<tr>
  <td colspan='2' align='center'>
  <input name="buscar" value="filtrar" type="submit">
  </td>
   </form>

  </table> 
   </td><td>
   <table border='1'>

<?
      
   if($nivel=="1")
   {
      $consultausuariototal =  "SELECT * FROM usuario where eliminado = '0'" ;
      $consultaatencionestotal =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0'";
  
     
     $consulusuariomes =  "SELECT DISTINCT usuario.hc from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0'  and atencion.fecha like '$fechita%' ";
     $consultaatencionesmes =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0'  and atencion.fecha like '$fechita%' ";

   }else
      {
       
       $consultausuariototal =  "SELECT * FROM usuario where eliminado = '0' and idsession = '$idsession'" ;
      $consultaatencionestotal =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0' and usuario.idsession = '$idsession'";


 $consulusuariomes =  "SELECT DISTINCT usuario.hc from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0' and usuario.idsession = '$idsession' and atencion.fecha like '$fechita%' ";
     $consultaatencionesmes =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0' and usuario.idsession = '$idsession' and atencion.fecha like '$fechita%' ";
      }
 
      

?>

    <tr bgcolor='BLUE'><td align='center'><font size="1" color='#ffffff'><b>Total de usuarios</td><td align='center'><font size="1" color='#ffffff'><b>Total atenciones</td><td align='center'><font size="1" color='#ffffff'><b>Usuarios del Mes</td><td align='center'><font size="1" color='#ffffff'><b>Atenciones del Mes</td></tr>
    <tr>
<td align='center'><font size="1">
<? 

  //echo $consultausuariototal;
  echo cuenta_rows($consultausuariototal); ?></td>

<td align='center'><font size="1"> 
<? 
   
    echo cuenta_rows($consultaatencionestotal);
    
    //total_atenciones($consultausuariototal); ?></td>

<td align='center'><font size="1">
 <? 
    echo cuenta_rows($consulusuariomes);

  ?>

</td>

<td align='center'><font size="1"><?
     echo cuenta_rows($consultaatencionesmes);
   // echo $consultaatencionesmes;
?>

</td>

</tr>
   </table>

  </td></tr> 

<tr>
<td colspan='2'>

<?
  
 if($_POST["anho"])  
   {
    $anito = $_POST["anho"];
  }else
    {
      $anito =  date("Y");
   }
   $acualanio = date("Y");
  if($acualanio == $anito )
    $iniciomes = (int)date("m");
  else
     $iniciomes = 12;

 echo "<table width='500' align='center' border='1'><tr bgcolor='#000000'><td ><font color='#ffffff'>Fecha</td><td><font color='#ffffff'>Beneficiados atendidos</td><td><font color='#ffffff'>Atenciones del Mes</td></tr>";
  for($i=$iniciomes;$i>=1;$i--)
   {
         if($i<10)
             $mes = "0".$i;
          else
             $mes = $i;

       $fechita = "$anito-$mes";


        
   if($nivel=="1")
   {
      if($idlugar=="0")
      {
     
     $consulusuariomes =  "SELECT DISTINCT usuario.hc from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0'  and atencion.fecha like '$fechita%' ";
     $consultaatencionesmes =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0'  and atencion.fecha like '$fechita%' ";


     }else
         {

              $consulusuariomes =  "SELECT DISTINCT usuario.hc from (usuario join atencion on usuario.idusuario = atencion.idusario) join usersession on usersession.id = usuario.idsession  where usuario.eliminado ='0'  and  usersession.idregion='$idlugar'  and atencion.fecha like '$fechita%' ";
              
      // echo     $consulusuariomes;   
       $consultaatencionesmes =  "SELECT * from (usuario join atencion on usuario.idusuario = atencion.idusario) join usersession on usersession.id = usuario.idsession where usuario.eliminado ='0'  and  usersession.idregion='$idlugar' and atencion.fecha like '$fechita%' ";


         }

   }else
      {
       
   
 $consulusuariomes =  "SELECT DISTINCT usuario.hc from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0' and usuario.idsession = '$idsession' and atencion.fecha like '$fechita%' ";
     $consultaatencionesmes =  "SELECT * from usuario join atencion on usuario.idusuario = atencion.idusario where usuario.eliminado ='0' and usuario.idsession = '$idsession' and atencion.fecha like '$fechita%' ";
      }


   ?>
     <tr>
     <td><? echo $fechita; ?></td>
     <td align='right'><? echo cuenta_rows($consulusuariomes); ?></td>
     <td align='right'><? echo cuenta_rows($consultaatencionesmes); ?></td>
    </tr>

   <?


       
  }
   echo "</table>";
?> 

</td>
</tr> 
  </table>
  </div>
  
  
 
</div>
</div>

<? include("pie.php");

function carga_sessiones($idlugar)
{

   $conexion = conectar_base(); 
   mysql_select_db ("sistemaatencion",$conexion);
   $cadena ="SELECT  DISTINCT departamento.iddepartamento, departamento.descripcion  FROM usersession join departamento on usersession.idregion = departamento.iddepartamento";
 
   $tabla = mysql_query($cadena, $conexion);  


  echo "<font size='2'>Region";
  echo "<select name='idlugar'>";
  if($idlugar=='0')
     echo "<option value='0' selected >todos</option>";
  else
    echo "<option value='0' >todos</option>"; 

  while ($registro = mysql_fetch_array($tabla))
  {
     $id = $registro[0];
     $nombre = $registro[1];

    if($idlugar==$id)
     echo "<option value='$id' SELECTED>$nombre</option>";
    else 
     echo "<option value='$id'>$nombre</option>";
  }
  

  echo "</select>";

  mysql_close($conexion);
}

?>
