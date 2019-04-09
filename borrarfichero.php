<? include("cabecera.php"); 
   include("funciones.php");
   $iduser = $_REQUEST['iduser'];
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
a:link {text-decoration:underline}
a:visited {text-decoration:underline}
a:hover{text-decoration:underline}
a:active{text-decoration:underline}
  </style> 
</head>

<?
 
   if($_REQUEST["cicatriz"]=='1')
   {
         $conexion = conectar_base();
         mysql_select_db ("sistemaatencion",$conexion);	
         $idadjunto = $_REQUEST["idadjunto"];

         $cadena = "delete from adjuntoactividad where idadjunto ='$idadjunto'";
         mysql_query($cadena,$conexion);
         unlink($_REQUEST["ruta"]);
         mysql_close($conexion);   
         echo $cadena;
         ?>
          <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=archivo.actividad.php?idactividad=<? echo $_REQUEST[idactividad] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>&op=edit">
           </head> 
         <?

   }

?>


<div class="div1">
<div class="contenido">
   <div align="right"><a href="javascript:window.history.back()"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
 
  
  
 <table width="100%">
  <tr><td>
  <? $codatencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",1,"atencion"); 

    ?>
  <tr><h2>Estas seguro de eliminar el fichero</h2><h1><font color='red'><? echo $_REQUEST[ruta]; ?></font></h1> 

 <br>
  <font size="3">
 

  <a href="borrarfichero.php?idadjunto=<? echo $_REQUEST[idadjunto] ?>&idactividad=<? echo $_REQUEST[idactividad] ?>&idproyecto=<? echo $_REQUEST[idproyecto] ?>&op=<? echo $_REQUEST[op] ?>&ruta=<? echo $_REQUEST[ruta] ?>&cicatriz=1"> [SI]</A> | <A HREF="javascript:window.history.back() "> [NO] </a>
</font>
  <br><br>
    <b>Esta eliminaci&oacute;n no se podra recuperar</b>
  </td></tr> 
   </table

</div>
</div>

<? include("pie.php");  ?>
