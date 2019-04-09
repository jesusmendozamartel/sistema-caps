<?

 include("funciones.php");
 
 $idatencion=$_REQUEST["idatencion"];
 $iduser = $_REQUEST["iduser"];
 
 $nombre = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
 $apellido = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
 $nrodocumento = retorna_cadena($_REQUEST["iduser"],"idusuario",4,"usuario");
 $idencuesta = retorna_cadena($idatencion,"idatencion",11,"atencion");
 $txtnombreencuesta = retorna_cadena($idencuesta,"idencuesta",1,"encuesta");
 echo "<table width='100%'>";
 echo "<tr><td colspan='3'><font face='arial' size='2' ><b>ID usuario:</b> $_REQUEST[iduser]</td></tr>";
 echo "<tr>";
 echo "<td><font face='arial' size='2' ><b>Usuario :</b> ".$apellido."/".$nombre."</td><td width='100'></td><td>";
 echo "<font face='arial' size='2' ><b>Documento :</b> ".$nrodocumento;
 echo "</td></tr>";
 echo "<tr bgcolor='#720000'><td colspan='3' align='center'><hr><font face='arial' size='2' color='#ffffff'><b>DETALLE DE LA ENCUESTA<hr></td></tr>";
 echo "</table>";
 echo "<table width='100%'><tr><td>";
 echo "<font face='arial' size='2'><b>Atencion:</b> $idatencion <b>Nro-Enc:</b> ENC-$idencuesta  </td><td><font face='arial' size='2'><b> Nombre Encuesta: </b>$txtnombreencuesta";
 ?>
 </td><td><input TYPE="image" SRC="imagenes/icon-impresora.gif" onclick="window.print();"></td>
 <?
 echo "<table width='100%' border='1'>";
 echo "<tr bgcolor='#eac705'>";
 echo "<td colspan='2'><b>Pregunta</b></td>";
 echo "<td width='40'><b>Ant</td>";
 echo "<td width='40'><b>Desp</td>";
 echo "</tr>";
 $conexion = conectar_base(); 

 mysql_select_db ("sistemaatencion",$conexion);
 $cadena ="select * from respuestaencuesta where idatencion = '$idatencion' order by idopcion ASC";
 
 $tabla = mysql_query($cadena, $conexion);
 $i=1;
 while ($registro = mysql_fetch_array($tabla))
 {
   $txtpregunta = retorna_cadena($registro[4],"idpregunta",1,"pregunta");
   echo "<tr>"; 
   echo "<td width='10'><font size='2'>$i</td>";
   echo "<td><font size='2'>$txtpregunta</td>";
   echo "<td>";
   escribe_respuesta($registro[1]);
   echo "</td>";
   echo "<td>";
   escribe_respuesta($registro[2]);
   echo "</td>";
   echo "</tr>";
   $i=$i+1;
 
 }
 
 
 
 echo "</table>";
 
?> 