<? include("cabecera.php"); 
   include("funciones.php");
   $iduser = $_REQUEST['iduser'];
    $status = "";
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
				
				graba_adjuntoactividad($_REQUEST["idactividad"],$nombre,$nombreunico);
				
				
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

     $actividadesnom = retorna_cadena($_REQUEST["idactividad"],"idactividad",13,"actividades");
     
     //$apellido_usuario = retorna_cadena($_REQUEST["iduser"],"idusuario",2,"usuario");
     //$natencion = retorna_cadena($_REQUEST["idatencion"],"idatencion",1,"atencion");
   
     echo "<h2>Actividad de: ".$actividadesnom."</h2><hr>";
     echo "<br>";	
     echo "<b><h2>Modulo Adjuntos</b> Actividad </h2>";

  ?>
  <br>
   <table bgcolor='#000000' align="center"><tr><td>
   <table align="center" bgcolor='#ffffff' width='350'><tr>
   
	  <form action="archivo.actividad.php?idactividad=<? echo $_REQUEST["idactividad"] ?>&idproyecto=<? echo $_REQUEST["idproyecto"] ?>&op=edit" method="post" enctype="multipart/form-data">
       
      <td><input name="archivo" type="file" size="35" /></td></tr><tr>
      <td><input name="enviar" type="submit" value="Upload File" />
      <input name="action" type="hidden" value="upload" />     </td>
    </form>
  </td><tr>
  </table></td></tr></table>

<br>

    <?php muestra_adjuntos_actividad($_REQUEST["idactividad"],$_REQUEST["idproyecto"]); ?>
</div>
</div>

<? include("pie.php");  ?>
