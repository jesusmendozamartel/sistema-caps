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
<div class="div1">
<div class="contenido">
   <div align="right"><a href="datosusuarios.php?accion=editar&iduser=<? echo $_REQUEST[iduser]; ?>&pagina=<? echo $_REQUEST[pagina]; ?>"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <?php
         $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
	 $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
	 echo "<h2>Atenciones de: ".$nombre_usuario." - ".$apellido_usuario."</h2><hr>";
         
  ?>   
    <? 
      
      $cadena ="SELECT * FROM atencion where idusario = '$iduser'";


       $numerototal = calculorows($cadena);
   
       
   ?>

  <?php
    echo "<a href='atencion.php?iduser=$iduser&op=nuevo'><img border='0' src='imagenes/nota_paciente.png'></a>";
    dibuja_paginacion("atenciones.php","iduser=$iduser",$numerototal, $numeropagina,$pagina);
   echo "<div id='Layer1' style=' height:450px; overflow: scroll;'>";
    cabezera_atencion($iduser, $numeropagina,$pagina );
   echo "</div>";	
  ?>
</div>
</div>

<? include("pie.php");  ?>
