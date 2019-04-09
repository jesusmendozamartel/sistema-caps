<? include("cabecera.php"); 
    include("funciones.php");
    $numeropagina = 50;
    $pagina = $_REQUEST["pagina"];
    if($pagina=="")
       $pagina = 1;    
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
  <table ><tr><td>
  <a href="datosusuarios.php?accion=nuevo"><img border='0' src='imagenes/add_paciente.png' width="80"></a> </td><td width="20"></td>
  <td><form name="busquedapaciente" action='usuarios.php' method="post"><font size='2'>Buscar :</font>  <input name="paciente" value="<? echo $_POST["paciente"]; ?>"> <input name="buscar" value="buscar" type="submit"></form>
   </td><td>
   <table border='1'>

<?
   $nivel = $_COOKIE["nivel"];
   $idsession =  $_COOKIE["idsession"];
   $fechita = date("Y-m");      
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

    <tr bgcolor='BLUE'><td align='center'><font size="1" color='#ffffff'><b>Total de usuarios</td><td align='center'><font size="1" color='#ffffff'><b>Total atenciones</td><td align='center'><font size="1" color='#ffffff'><b>Usuarios del Mes</td><td align='center'><font size="1" color='#ffffff'><b>Atenciones del Mes</td><td></td></tr>
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
<td>
   <a href='reportesusuarios.php'><font size='1'>[+] Mas Reportes</a>
</td>
</tr>
   </table>

  </td></tr>  
  </table>
  </div>
  
  <hr>    
 
  <? 

    $criterio = $_POST["paciente"]; 

  

    if($nivel=="1")
    {    $cadena ="SELECT * FROM usuario where eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%')" ;
    }else
          {
             

   $idregion = retorna_cadena($idsession,"id",6,"usersession");

// $cadena ="SELECT * FROM usuario join usersession on usuario.idsession = usersession.id where usuario.idsession =  $idsession and usuario.hc < 9999 or usuario.hc > 99999  and usuario.eliminado = '0' and (usuario.nombre like '$criterio%' or usuario.apellidos like '$criterio%' or usuario.nrodocumento like '$criterio%' or usuario.hc like '$criterio%')";


  if($idregion==31)
  {
      $cadena ="SELECT * FROM usuario where eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%')" ;


    }else{   $cadena ="SELECT * FROM usuario join usersession on usuario.idsession = usersession.id where  usersession.idregion='$idregion' and usuario.idsession = $idsession   and  usuario.eliminado = '0' and (usuario.nombre like '$criterio%' or usuario.apellidos like '$criterio%' or usuario.nrodocumento or usuario.hc < 9999 or usuario.hc > 99999  like '$criterio%' or usuario.hc like '$criterio%')";
  
  }


            // $cadena ="SELECT * FROM usuario where idsession ='$idsession' and  eliminado = '0' and (nombre like '$criterio%' or apellidos like '$criterio%' or nrodocumento like '$criterio%' or hc like '$criterio%') ";

            }

       $numerototal = calculorows($cadena);   

       dibuja_paginacion("usuarios.php","paciente=".$_POST["paciente"], $numerototal, $numeropagina,$pagina);
  
  // echo "<div id='Layer1' style=' height:450px; overflow: scroll;'>"; 
   ?>

  <table width="100%">
  <?php cabecera($nivel);
        
       cargar_usuarios($_POST["paciente"],$pagina,$numeropagina);
     
  
      ?>
       
   </table>
  <!-- </div>  -->
 
</div>
</div>

<? include("pie.php");




function cabecera($nivel)
{
   echo "<tr bgcolor='#440707'>";
   echo "<td><font color='#ffffff' size='2'><b>Id</td>";
   echo "<td><font color='#ffffff' size='2'><b>NIdem</td>";
   echo "<td><font color='#ffffff' size='2'><b>Nombre/Apellidos</td>";
   echo "<td><font color='#ffffff' size='2'><b>Reside Actualmente</td>";
   echo "<td><font color='#ffffff' size='2'><b>Session</td>";
   echo "<td><font color='#ffffff' size='2'><b>Modificado</td>";
   echo "<td><font color='#ffffff' size='2'><b>Opciones</td>";
   if($nivel=="1")
   {
     echo "<td><font color='#ffffff' size='2'><b>Proyectos</td>";
   }
   echo "</tr>";
   
}

?>
