<? include("cabecera.php"); 
   include("funciones.php");

   if($_POST["generar"])
   {
   $anio = $_POST["anio"];
   $parte = $_POST["parte"]; 
   
    fwrite($fp,"<td>hc</td>");        
    fwrite($fp,"<td>Documento</td>");
    fwrite($fp,"<td>nombre/apellido</td>");
    fwrite($fp,"<td>edad</td>");
    fwrite($fp,"<td>estadocivil</td>");
    fwrite($fp,"<td>sexo</td>");
    fwrite($fp,"<td>grado</td>");

   $cadena = "select usuario.hc, usuario.nrodocumento, usuario.nombre, usuario.apellidos, usuario.fechanacimiento, usuario.idestadocivil, usuario.idsexo, usuario.idestudios,  respuesraafectacion.idafectacion ,respuesraafectacion.especificar, respuesraafectacion.valor from usuario join respuesraafectacion on usuario.idusuario = respuesraafectacion.iduser ";   
  
   
     $archivogenerado = genera_archivo_atenciones($cadena);

   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b><a href="reportesexel.php">Listado de Reportes</a> > Reporte de Afectacion </b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'> 
   <br><br>   
  <form name='consultex' method='post' action='reportesafectacion.php'>
 <table>
   <tr><td colspan='2' align='center'><input name='generar' type='submit' value="Generar Archivo"></td></tr>
   <? 
      if($archivogenerado==1){
    ?>  
      <tr><td><a href="reporte/reporteafectacion.xls" target='_blank'>Descargue Archivo</a></td></tr>
      <? }else{ ?>
        <tr><td colspan='2' align="center"><font size='1'>Esta operaci&oacute;n puede demorar... no cierre esta ventana..</a></td></tr>
      <? } ?>
    
</table> 
  
  </form>

</td>
</tr>
</table>
</div>
</div>

<? include("pie.php");


function genera_archivo_atenciones($cadena)
{
    //echo $cadena;
    $conexion = conectar_base(); 
    mysql_select_db ("sistemaatencion",$conexion);
    mysql_query("SET NAMES utf8");
    
    $scarpeta="reporte"; //carpeta donde guardar el archivo.
    //debe tener permisos 775 por lo menos
    $sfile=$scarpeta."/reporteafectacion.xls"; //ruta del archivo a generar
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml);
  
    $tabla = mysql_query($cadena, $conexion);


    fwrite($fp,"<table>");
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>hc</td>"); 
    fwrite($fp,"<td>Documento</td>");
    fwrite($fp,"<td>nombre/apellido</td>");
    fwrite($fp,"<td>edad</td>");
    fwrite($fp,"<td>estadocivil</td>");
    fwrite($fp,"<td>sexo</td>");
    fwrite($fp,"<td>grado</td>");
    
    for ($i = 1; $i<=36; $i++) {
      fwrite($fp,"<td>$i</td><td>Especificar</td>");
     
    }
  


    fwrite($fp,"</tr>");
    
    $i=0;
    while ($registro = mysql_fetch_array($tabla))
    {
    if($i==0)
    {
    fwrite($fp,"<tr>");
    
    fwrite($fp,"<td>$registro[0]</td>");
    fwrite($fp,"<td>$registro[1]</td>");
    fwrite($fp,"<td>$registro[2] $registro[3]</td>");
   
    $edad = CalculaEdad($registro[4]); 

    fwrite($fp,"<td>$edad</td>");
    $estado = retorna_cadena($registro[5],"idestadocivil",1,"estadocivil"); 
    
      fwrite($fp,"<td>$estado</td>");

   $sexo = retorna_cadena($registro[6],"idsexo",1,"sexo"); 

      fwrite($fp,"<td>$sexo</td>");

    $grado = retorna_cadena($registro[7],"idestudios",1,"estudios"); 

    fwrite($fp,"<td>$grado</td>");

     

    }
     if($registro[10]>=1 and $registro[10]<=3 )
     {
      switch($registro[10])
      {

        case 1:fwrite($fp,"<td>Directo</td>");break;
        case 2:fwrite($fp,"<td>Indirecto</td>");break;
        case 3:fwrite($fp,"<td>Ambos</td>");break;
      }
     }else
          fwrite($fp,"<td>No especifico</td>");
    
      fwrite($fp,"<td>$registro[9]</td>");
   
       $i=$i + 1;   
       if($i=="36")
        {
           fwrite($fp,"</tr>"); 
           $i = 0;
        }


    }
   fwrite($fp,"</table>");
   mysql_close($conexion);
   fclose($fp);
   
    return 1;
  

}



 ?>
