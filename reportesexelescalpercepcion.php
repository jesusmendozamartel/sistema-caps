<? include("cabecera.php"); 
   include("funciones.php");

   if($_POST["generar"])
   {
   $anio = $_POST["anio"]; 
   if($anio<>"" && $anio>1980)
   {
    $where = "where atencion.fecha like '$anio%' ";
   }
   $cadena = "select atencion.idusario, atencion.idatencion,  atencion.fecha, atencion.proyecto1, respuestaencuesta.idpregunta, respuestaencuesta.opentrada  from atencion join respuestaencuesta on atencion.idatencion = respuestaencuesta.idatencion $where ";   
  
   
     $archivogenerado = genera_archivo_atenciones($cadena);

   }
?>

<div class="div1">
<div class="contenido">
  <br>
   <b>Reportes OnDemand</b>
   <br><br><hr>
   <b><a href="reportesexel.php">Listado de Reportes</a> > Reporte de Escala de Percepcion </b><hr>
<table width='900' height='500' background='imagenes/estadistica.jpg'>
  <tr><td valign='top'> 
   <br><br>   
  <form name='consultex' method='post' action='reportesexelescalpercepcion.php'>
 <table>
 <tr><td align='right'>
  <font size='2'> 
   A&ntilde;o:</td><td> <input name='anio' value='<? echo $anio; ?>'> <font size='1'><br>Si no coloca ningun valor generara una consulta de toda la base</font></td></tr>
   <tr><td colspan='2' align='center'><input name='generar' type='submit' value="Generar Archivo"></td></tr>
   <? 
      if($archivogenerado==1){
    ?>  
      <tr><td><a href="reporte/reporte.escala.persepcion.xls" target='_blank'>Descargue Archivo</a></td></tr>
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
    $sfile=$scarpeta."/reporte.escala.persepcion.xls"; //ruta del archivo a generar
    $fp=fopen($sfile,"w");
    fwrite($fp,$shtml);
  
    $tabla = mysql_query($cadena, $conexion);



    fwrite($fp,"<table>");
    fwrite($fp,"<tr>");
    fwrite($fp,"<td>IdAtencion</td>"); 
    fwrite($fp,"<td>Identificacion</td>");
    fwrite($fp,"<td>Fecha Atencion</td>");
    fwrite($fp,"<td>Proyecto</td>");
    
    fwrite($fp,"<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td>32</td><td>33</td><td>34</td><td>35</td><td>36</td><td>37</td><td>38</td>");
    fwrite($fp,"<td>TOTAL</td>");
    fwrite($fp,"</tr>");
    
    $i = 0; 
    while ($registro = mysql_fetch_array($tabla))
    {
    if($i==0)
    {
    fwrite($fp,"<tr>");
    $HC =  retorna_cadena($registro[0],"idusuario",23,"usuario");
    fwrite($fp,"<td>$HC</td>");
    fwrite($fp,"<td>$registro[1]</td>");
    fwrite($fp,"<td>$registro[2]</td>");
    $proyecto = retorna_cadena($registro[3],"idproyecto",1,"proyecto");
    fwrite($fp,"<td>$proyecto</td>");
    
   } 

    fwrite($fp,"<td>$registro[5]</td>");
    $suma = $suma + $registro[5];
    $i = $i + 1;
    if($i ==  "38")
    {
     fwrite($fp,"<td>$suma</td></tr>");
     $suma = 0;
     $i = 0;
    }

     

    }
   fwrite($fp,"</table>");
   mysql_close($conexion);
   fclose($fp);
   
    return 1;
  

}



 ?>
