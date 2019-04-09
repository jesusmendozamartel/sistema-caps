<? include("cabecera.php"); 
   include("funciones.php");
   $iduser = $_REQUEST['iduser'];
    $status = "";
	
	
?>

<style>
 .contenido{
 
 height: 900px;
 }
 .div1
 {
   height: 900px;
 
 }
</style>

<?
    if ($_POST["action"] == "upload") {
        // obtenemos los datos del archivo
        $tamano = $_FILES["archivo"]['size'];
        $tipo = $_FILES["archivo"]['type'];
        $archivo = $_FILES["archivo"]['name'];
        $prefijo = substr(md5(uniqid(rand())),0,6);
       
        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino =  "documentos/".$prefijo."_".$archivo;
            if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                $status = "Archivo subido: <b>".$archivo."</b>";
				
				$nombre = $_FILES['archivo']['name'];
				$nombreunico = $prefijo."_".$archivo;
				
				graba_adjunto($_REQUEST["idatencion"],$nombre,$nombreunico);
				
				
            } else {
                $status = "Error al subir el archivo";
            }
        } else {
            $status = "Error al subir archivo";
        }
    }
   
   
?>

<div class="div1">
<div class="contenido">
   
  <?php
     $nombre_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",1,"usuario");
     $apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
     $natencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",1,"atencion");
   
     echo "<h2>Atenciones de: ".$nombre_usuario." - ".$apellido_usuario."</h2><hr>";
     echo "<br>";	
   echo "<b><h2>Modulo Adjuntos</b> - Atenci&oacute;n :   $natencion </h2>";
  ?>
  <br>
   <table bgcolor='#000000' align="center"><tr><td>
   <table align="center" bgcolor='#ffffff' width='350'><tr>
	  <form action="adjuntos.php?idatencion=<? echo $_REQUEST["idatencion"] ?>&iduser=<? echo $_REQUEST["iduser"] ?>" method="post" enctype="multipart/form-data">
       
      <td><input name="archivo" type="file" size="35" /></td></tr><tr>
      <td><input name="enviar" type="submit" value="Upload File" />
      <input name="action" type="hidden" value="upload" />     </td>
    </form>
  </td><tr>
  </table></td></tr></table>

<br>

    <?php muestra_adjuntos($_REQUEST["idatencion"],$_REQUEST["iduser"]); ?>
</div>
</div>

<? include("pie.php");  ?>
