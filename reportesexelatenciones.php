<? include("cabecera.php"); 
   include("funciones.php");

   if($_POST["generar"])
   {
   $anio = $_POST["anio"]; 
   $agrupado = $_POST["agrupado"];
   $tipousuario = $_POST["tipousuario"];
   //echo "$anio - $agrupado - $tipousuario"; 
   if($anio<>"" && $anio>1980)
   {
    $where = "where atencion.fecha like '$anio%' ";
   }
   if($tipousuario<>"0")
   { 
      if($where=="")
           $where = "where atencion.idtipousuario='$tipousuario' ";
      else
           $where = $where." and atencion.idtipousuario='$tipousuario' ";

    } 
   switch($agrupado)
   {
      case 0: break; 
      case 1: $agrupadoby="order by usuario.idusuario"; break;
      case 2: $agrupadoby="order by usuario.iddepartamentoact"; break;
      case 3: $agrupadoby="order by atencion.idlugar"; break;
   } 
   $cadena = "select * from atencion join usuario on atencion.idusario = usuario.idusuario $where  $agrupadoby";   
   //echo $cadena;
   
     $archivogenerado = genera_archivo_atenciones($cadena);

   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b><a href="reportesexel.php">Listado de Reportes</a> > Reporte de atenciones especializado </b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'> 
   <br><br>   
  <form name='consultex' method='post' action='reportesexelatenciones.php'>
 <table>
 <tr><td align='right'>
  <font size='2'> 
   A&ntilde;o:</td><td> <input name='anio' value='<? echo $anio; ?>'> <font size='1'><br>Si no coloca ningun valor generara una consulta de toda la base</font></td></tr>
  <tr><td align='right'>  <font size='2'>  Agrupado por:</td><td> <select name='agrupado'>
                 <option value='0' <? if($agrupado=='0'){ echo "selected";} ?>>Ningun Criterio</option>
                 <option value='1' <? if($agrupado=='1'){ echo "selected";} ?>>Beneciario</option>
                 <option value='2' <? if($agrupado=='2'){ echo "selected";} ?>>Regi&oacute;n </option> 
                 <option value='3' <? if($agrupado=='3'){ echo "selected";} ?>>Lugar de atenci&oacute;n</option> 
   		 </select> </td></tr>
  <tr><td>  <font size='2'>Estado de la Atenci&oacute;n</td><td>
   <select name='tipousuario' >";
   <?   cargar_tipo_usuario($tipousuario); ?>

   </select>
   </td></tr>
   <tr><td colspan='2' align='center'><input name='generar' type='submit' value="Generar Archivo"></td></tr>
   <? 
      if($archivogenerado==1){
    ?>  
      <tr><td><a href="reporte/xxxx.xls" target='_blank'>Descargue Archivo</a></td></tr>
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
    $sfile=$scarpeta."/xxxx.xls"; //ruta del archivo a generar
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml);
  
    $tabla = mysql_query($cadena, $conexion);

    fwrite($fp,"<table>");
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>Fecha</td>"); 
    fwrite($fp,"<td>Lugar Atencion</td>");
    fwrite($fp,"<td> Area</td>");
    fwrite($fp,"<td> Sub Area</td>");
    fwrite($fp,"<td> Responsable1</td>");
    fwrite($fp,"<td>Responsable2</td>");
    fwrite($fp,"<td>Proyecto 1</td>");
    fwrite($fp,"<td>Proyecto 2</td>");
    fwrite($fp,"<td>Tipousuario</td>");
    fwrite($fp,"<td>Bienestar Esc 1</td>");
    fwrite($fp,"<td>Bienestar Esc 2</td>");
    fwrite($fp,"<td>Escala Secueles</td>");
    fwrite($fp,"<td>NIdentificacion</td>");
    fwrite($fp,"<td>Nombre</td>");
    fwrite($fp,"<td>Apellido</td>");
    fwrite($fp,"<td>Tipo Doc</td>");
    fwrite($fp,"<td> Documento</td>");
    fwrite($fp,"<td> Origen</td>");
    fwrite($fp,"<td> Depatamento Nac</td>");
    fwrite($fp,"<td> Provicia Nac</td>");
    fwrite($fp,"<td> Distri Nac</td>");
    fwrite($fp,"<td> Fecha Nac</td>");
    fwrite($fp,"<td>Edad</td>");
    fwrite($fp,"<td>Edad Ingreso</td>");
    fwrite($fp,"<td>Sexo</td>");
    fwrite($fp,"<td>ECivil</td>");
    fwrite($fp,"<td>Estudios</td>");
    fwrite($fp,"<td>Ocupacion</td>");
    fwrite($fp,"<td>Direccion Actual");
    fwrite($fp,"</td><td>Departamento Resi</td>");
    fwrite($fp,"<td>Provincia Resi</td>");
    fwrite($fp,"<td>Dist Resi</td>");
    fwrite($fp,"<td>Telefono</td>");
    fwrite($fp,"<td>Celular</td>");
    fwrite($fp,"<td>Anios Lima</td>");
    fwrite($fp,"<td>Seguro</td>");
    fwrite($fp,"<td>Descripcion Seguro</td>");
    fwrite($fp,"</tr>");
    
   
    while ($registro = mysql_fetch_array($tabla))
    {
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>$registro[2]</td>"); 
    $nombrelugar = retorna_cadena($registro[3],"idlugar",2,"lugaratencion"); 
    fwrite($fp,"<td>$nombrelugar</td>");
   
    $nombrearea = retorna_cadena($registro[5],"idarea",1,"area"); 
    fwrite($fp,"<td>$nombrearea</td>");

    $nombresubarea = retorna_cadena($registro[6],"idsubarea",1,"subarea"); 
    fwrite($fp,"<td>$nombresubarea</td>");
    
    $nomresponsable1 = retorna_cadena($registro[7],"idresponsable",1,"responsable")." ".retorna_cadena($registro[7],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable1</td>");

    $nomresponsable2 = retorna_cadena($registro[8],"idresponsable",1,"responsable")." ".retorna_cadena($registro[8],"idresponsable",2,"responsable"); 
    fwrite($fp,"<td>$nomresponsable2</td>");

    $nombreproy = retorna_cadena($registro[18],"idproyecto",1,"proyecto"); 
    fwrite($fp,"<td>$nombreproy</td>");

    $nombreactividad = retorna_cadena($registro[19],"idproyecto",1,"proyecto"); 
    fwrite($fp,"<td>$nombreactividad </td>");

    $nomtipousuario = retorna_cadena($registro[4],"idtipousuario",1,"tipousuario"); 
    fwrite($fp,"<td>$nomtipousuario</td>");

    $valor_escala = escala_bienestar($registro[22],$registro[0],1);
    $valor_escala2 = escala_bienestar($registro[22],$registro[0],2);
    fwrite($fp,"<td>$valor_escala</td>");
    fwrite($fp,"<td>$valor_escala2</td>");

    $valor_encuesta=conteo_encuesta($registro[0],$registro[13]);

    fwrite($fp,"<td>$valor_encuesta</td>");

    fwrite($fp,"<td>$registro[45]</td>");

    fwrite($fp,"<td>$registro[23]</td>");
    fwrite($fp,"<td>$registro[24]</td>");
    fwrite($fp,"<td>$registro[25]</td>");
    fwrite($fp,"<td>$registro[26]</td>");
    fwrite($fp,"<td>$registro[27]</td>");

    $nombredepa= retorna_cadena($registro[28],"iddepartamento",1,"departamento");
    fwrite($fp,"<td>$nombredepa</td>");
    $nombreprov= retorna_cadena($registro[29],"idprovincia",1,"provincia");
    fwrite($fp,"<td>$nombreprov</td>");
    
    $nombredist= retorna_cadena($registro[30],"iddistrito",1,"distrito");
    fwrite($fp,"<td>$nombredist</td>");
    fwrite($fp,"<td>$registro[31]</td>");
    $edad = CalculaEdad($registro[31]);
    fwrite($fp,"<td>$edad</td>");

    fwrite($fp,"<td>$registro[33]</td>");
    if($registro[34]==1)
          $sexo ="HOMBRE";
    else 
          $sexo ="MUJER";  
    fwrite($fp,"<td>$sexo</td>");
   
    $civil = retorna_cadena($registro[35],"idestadocivil",1,"estadocivil");
    
    fwrite($fp,"<td>$civil</td>");

    $grado = retorna_cadena($registro[36],"idestudios",1,"estudios");
    
    
    fwrite($fp,"<td>$grado</td>");
    fwrite($fp,"<td>$registro[37]</td>");
    fwrite($fp,"<td>$registro[38]</td>");

    $nombredepa1= retorna_cadena($registro[39],"iddepartamento",1,"departamento");
    fwrite($fp,"<td>$nombredepa1</td>");

    $nombreprov1= retorna_cadena($registro[40],"idprovincia",1,"provincia");
    fwrite($fp,"<td>$nombreprov1</td>");

    $nombredist1= retorna_cadena($registro[41],"iddistrito",1,"distrito");
    fwrite($fp,"<td>$nombredist1</td>");
    fwrite($fp,"<td>$registro[42]</td>");
    fwrite($fp,"<td>$registro[43]</td>");
    fwrite($fp,"<td>$registro[44]</td>");
    
    if($registro[50]=="1")
    {   $seguro = "SI";

       $texto = $registro[51]; 
     }
    else
      {
         if($registro[50]=="0")
         {    $seguro="NO";
    
          }
         else
             $seguro="Aun no contesta";
       }
    fwrite($fp,"<td>$seguro</td>");
    fwrite($fp,"<td>$texto</td>");
    fwrite($fp,"</tr>");
    }
   fwrite($fp,"</table>");
   mysql_close($conexion);
   fclose($fp);
   
    return 1;
  

}



 ?>
