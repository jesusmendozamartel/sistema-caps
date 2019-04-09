<?

 include("funciones.php");
 
 $nombre = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
 $apellido = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
 $tipodoc = retorna_cadena($_REQUEST["iduser"],"idusuario",3,"usuario");
 $nrodocumento = retorna_cadena($_REQUEST["iduser"],"idusuario",4,"usuario");
 $fecha = retorna_cadena($_REQUEST["idatencion"],"idatencion",2,"atencion");
 $idlugar = retorna_cadena($_REQUEST["idatencion"],"idatencion",3,"atencion");
 $textlugar = retorna_cadena($idlugar,"idlugar",2,"lugaratencion");
 $idtipouser = retorna_cadena($_REQUEST["idatencion"],"idatencion",4,"atencion");
 $texttipo = retorna_cadena($idtipouser,"idtipousuario",1,"tipousuario");
 $idarea = retorna_cadena($_REQUEST["idatencion"],"idatencion",5,"atencion");
 $textarea = retorna_cadena($idarea,"idarea",1,"area");
 $idsubarea = retorna_cadena($_REQUEST["idatencion"],"idatencion",6,"atencion");
 $texsubtarea = retorna_cadena($idsubarea,"idsubarea",1,"subarea");
 $idresponsable1 = retorna_cadena($_REQUEST["idatencion"],"idatencion",7,"atencion");
 $textresponsable1 = retorna_cadena($idresponsable1,"idresponsable",1,"responsable").' '.retorna_cadena($idresponsable1,"idresponsable",2,"responsable");
 $idresponsable2 = retorna_cadena($_REQUEST["idatencion"],"idatencion",7,"atencion");
 $textresponsable2 = retorna_cadena($idresponsable1,"idresponsable",1,"responsable").' '.retorna_cadena($idresponsable1,"idresponsable",2,"responsable");
 $proyecto = retorna_cadena($_REQUEST["idatencion"],"idatencion",9,"atencion");
 $textproyecto = retorna_cadena($proyecto,"idproyecto",1,"proyecto");
 $actividad = retorna_cadena($_REQUEST["idatencion"],"idatencion",10,"atencion");
 $textactividad = retorna_cadena($actividad,"idactividad",1,"actividadproyecto");
 
 
 echo "<table width='100%'>";
 echo "<tr><td colspan='3'><font face='arial' size='2' ><b>ID usuario:</b> $_REQUEST[iduser]</td></tr>";
 echo "<tr>";
 echo "<td><font face='arial' size='2' ><b>Usuario :</b> ".$apellido."/".$nombre."</td><td width='100'></td><td>";
 echo "<font face='arial' size='2' ><b>Documento :</b> ".$nrodocumento;
 echo "</td></tr>";
 echo "<tr bgcolor='#720000'><td colspan='3' align='center'><hr><font face='arial' size='2' color='#ffffff'><b>DETALLE DE LA ATENCI&Oacute;N<hr></td></tr>";
 echo "</table>";
 echo "<table width='100%'>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Fecha</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$fecha</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Lugar de Atencion</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textlugar</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Tipo de Usuario</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$texttipo</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Area</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textarea</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Sub Area</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$texsubtarea</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Responsable 1</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textresponsable1</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Responsable 2</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textresponsable2</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Proyecto Monitoreo</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textproyecto</td></tr>";
 echo "<tr><td width='49%' align='right'><font size='2' face='arial'><b>Actividad Monitoreo</td>";
 echo "<td>:</td><td><font size='2' face='arial'>$textactividad</td></tr>";
 echo "<tr><td colspan='3'><hr></td></tr>";
 echo "<tr><td colspan='2'>";
 ?>
 <input TYPE="image" SRC="imagenes/icon-impresora.gif" onclick="window.print();"></td><td align='right'><font face='arial' size='1'>Sistema de Consultas del CAPS</td></tr>
 <?
 echo "</table>";
?>
