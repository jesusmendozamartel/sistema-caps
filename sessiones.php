<? include("cabecera.php"); 
    include("funciones.php");
?>

<div class="div1">
<div class="contenido">
  
 

  
  <br>
  <div align="right"><b>USUARIOS DEL SISTEMA</b></div>
  <br>
  <a href="usuarios.system.php?op=nuevo">[+] Agregar Usuario </a>
  <div id='Layer1' style=' height:450px; overflow: scroll;'>
  
  <table width="100%">
  <?php cabecera();
       cargar_sessiones($_POST["paciente"]); ?>
  </table>
  
   </div>
  
</div>
</div>

<? include("pie.php");

function cabecera()
{
   echo "<tr bgcolor='#440707'>";
   echo "<td width='30'><font color='#ffffff' size='2'><b>Id</td>";
   echo "<td><font color='#ffffff' size='2'><b>Usuario</td>";
   echo "<td><font color='#ffffff' size='2'><b>Nombre</td>";
   echo "<td><font color='#ffffff' size='2'><b>Nivel de Acceso</td>";
   echo "<td><font color='#ffffff' size='2'><b>Ver Proyectos</td>";
   echo "</tr>";
   
}

?>
