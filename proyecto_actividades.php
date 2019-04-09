<?php include("cabecera.php"); 
   include("funciones.php");
   
   $proyecto = retorna_cadena($_REQUEST["idproyecto"],"idproyecto",1,"proyecto");
    $numeropagina = 50;
    $pagina = $_REQUEST["pagina"];
    if($pagina=="")
       $pagina = 1;

?>

<head>
<style>
  td
   {
      font-family: arial;
      font-size: 10px;
      text-transform: uppercase;
   }
</style>
</head>


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
        width: auto;
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
  <br>
   <b>MODULO PROYECTOS - ACTIVIDADES</b><br>
<div style="float: left;">
<form name='filtra' method="post" action="#"><b>Filtro</b>: <input name="filtro">
<input name='filtrar' type="submit" value="filtrar">
</form></div><br><br><br>
<div align="right"><a href="proyectos.php?idproyecto=<? echo $_REQUEST[idproyecto]; ?>"><img align="right" width="50" src='imagenes/volver.png' border="0"></a></div>
  <? include("menu_proyectos.php")?>
<br><b>ACTIVIDAD DEL PROYECTO: <font size="3" color="RED"><?php echo $proyecto; ?></font></b><br>

<font face="arial" size="2">[+] <a href="actividadproyecto_op.php?op=nuevo&idproyecto=<?php echo $_REQUEST["idproyecto"]; ?>">Agregar Actividad</a></font><br>
<?
   $idsession = $_COOKIE["idsession"];
   $nivel = $_COOKIE["nivel"];

      if($nivel==1)
       $cadena= "select * from actividades where idproyecto = $_REQUEST[idproyecto]";
      else
          $cadena= "select * from actividades where idproyecto = $_REQUEST[idproyecto] and  idsession=$idsession";       
      

       $numerototal = calculorows($cadena);   
      $web = "proyecto_actividades.php?&idproyecto=$_REQUEST[idproyecto]&";
    echo $cadena;
     dibuja_paginacion_actividades($web,"fecha=".$_POST["fecha"], $numerototal, $numeropagina,$_REQUEST['pagina']);
?>

 
  <?
   $idsession = $_COOKIE["idsession"];
   $nivel = $_COOKIE["nivel"];

    muestra_actividades($pagina,$numeropagina,$_REQUEST['idproyecto'],$fecha,$idsession,$nivel,$_POST["filtro"]);

   ?>
  


</div>
</div>

<? include("pie.php") 

?>
