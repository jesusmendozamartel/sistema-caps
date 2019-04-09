<? include("cabecera.php"); 
    include("funciones.php");
  
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
   a:link {text-decoration:underline}
a:visited {text-decoration:underline}
a:hover{text-decoration:underline}
a:active{text-decoration:underline}
  </style> 
</head>

<?
   $iduser=$_REQUEST[iduser];
   $nombres = retorna_cadena($_REQUEST[iduser],"idusuario",1,"usuario");
   $apellidos = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
   $hc = retorna_cadena($_REQUEST["iduser"],"idusuario",23,"usuario");

   if($_REQUEST["cicatriz"]=='1')
   {
         $conexion = conectar_base();
         mysql_select_db ("sistemaatencion",$conexion);	
         $cadena = "update usuario set eliminado='1' where idusuario='$iduser'";
         mysql_query($cadena,$conexion);
         mysql_close($conexion);   
         ?>
           <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuarios.php">
           </head>
         <?

   }

?>
<div class="div1">
<div class="contenido">
  
 <div align="right"><b>M&oacute;dulo de Usuarios</b></div>
 <hr>
  <div align="left">
  <table ><tr><td>
  <a href="datosusuarios.php?accion=nuevo"><img border='0' src='imagenes/add_paciente.png' width="80"></a> </td><td width="20"></td>
  <td><form name="busquedapaciente" action='usuarios.php' method="post"><font size='2'>Buscar :</font>  <input name="paciente" value="<? echo $_POST["paciente"]; ?>"> <input name="buscar" value="buscar" type="submit"></form>
   </td></tr>  
  </table>
  </div>
  
  <hr>    
 
  
  <table width="100%">
  <tr><td>
  <tr>Estas seguro de eliminar a <h1><? echo $nombres." ".$apellidos; ?></h1> 
   Numero de identificaci&oacute;n: <? echo $hc; ?><br>
 <br>
  <font size="3">
  

  <a href="?iduser=<? echo $iduser; ?>&cicatriz=1"> [SI]</A> | <A HREF="javascript:window.history.back() "> [NO] </a>
</font>
  <br><br>
    Solo sera recuperado por el administrador
  </td></tr> 
   </table>
  
 
</div>
</div>

<? include("pie.php");


?>
