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
         $idatencion = $_REQUEST["idatencion"];
         $iduser = $_REQUEST["iduser"];
         $cadena = "update atencion set bloqueado='1' where idatencion ='$idatencion'";
         mysql_query($cadena,$conexion);
         mysql_close($conexion);   
         echo $cadena;
         ?>
          <head>         
 		  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=atenciones.php?iduser=<? echo $iduser; ?>">
           </head> 
         <?

   }

?>


<div class="div1">
<div class="contenido">
   <div align="right"><a href="javascript:window.history.back()"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <?php
         $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
	 $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
	 echo "<h2>Atenciones de: ".$nombre_usuario." - ".$apellido_usuario."</h2><hr>";
  ?>   
  
  <?php
    echo "<a href='atencion.php?iduser=$iduser&op=nuevo'><img border='0' src='imagenes/nota_paciente.png'></a>";
    echo "<hr>";  
    
   //dibuja_paginacion("atenciones.php","iduser=$iduser",$numerototal, $numeropagina,$pagina);
   // cabezera_atencion($iduser, $numeropagina,$pagina );
  ?>
 <table width="100%">
  <tr><td>
  <? $codatencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",1,"atencion"); 

    ?>
  <tr><h2>Estas suguro de bloquear a la atenci&oacute;n</h2><h1><font color='red'><? echo $codatencion; ?></font></h1> 

 <br>
  <font size="3">
 

  <a href="?iduser=<? echo $_REQUEST[iduser]; ?>&idatencion=<? echo $_REQUEST[idatencion];  ?>&cicatriz=1"> [SI]</A> | <A HREF="javascript:window.history.back() "> [NO] </a>
</font>
  <br><br>
    <b>Una vez bloqueado solo el administrador podra editar</b>
  </td></tr> 
   </table

</div>
</div>

<? include("pie.php");  ?>
