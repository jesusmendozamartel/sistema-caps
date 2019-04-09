<? include("cabecera.php"); 
   include("funciones.php"); 
?>

<?

  if($_POST["proceder"])
  {  
     $sw=2;
     $valor=$_POST["accion"];
     if($_POST["idatencion"])
     { $capturaID= retorna_cadena($_POST["idatencion"],"idusuario",0,"usuario");
       $cadena="update atencion set bloqueado=$valor where idusario=$capturaID";
       $sw=1;

      }else {
         if($_POST["aniomes"])
          {
           $fechita = $_POST["aniomes"];
           $cadena="update atencion set bloqueado=$valor where fecha like '$fechita%'";
           $sw=1; 
           }
      }
 
    if($sw==1)
     {
         
         $conexion = conectar_base();
         mysql_select_db("sistemaatencion",$conexion);
         mysql_query($cadena,$conexion);
         mysql_close($conexion);
     } 
   }

?>

<div class="div1">
<div class="contenido">
  <br>
   <b>CONFIGURACIONES GENERALES</b>
   <br><br>
  <? include("menu_adm.php")?>
 <hr> 
 <table  width="450" border="1" height="200" align="center">
   <tr><td colspan="2" height="10">
    <font size="2"><strong> Bloqueando</strong></font>
   </td></tr> 
  
   <tr><td valign="top" height="10" >  
   <form name="deblo" action="bloqueando_adm.php" method="post">
    <font size="2">A&ntilde;o:</td><td> <input name="aniomes">
    </td></tr><tr><td height="10">
    <font size="2">Identicacion del atendido:</td><td> <input name="idatencion">
    </td></tr><tr><td height="10">
    <font size="2">Accion :</td><td> <select name="accion"><option value="1">Bloquear</option><option value="0">desbloquear</option></select>
    </td></tr><tr><td colspan="2">
    <input type="submit" name="proceder" value="proceder">
   </td></tr> 
   <tr>
   <td colspan="2" align="center"><font color="RED"><strong>
    <?
       if($sw==1) 
           $error ="Se realizo la operacion exitosamente";
       if($sw==2)    
          $error ="Algun criterio para poder proceder, solo llene uno de ellos";
  
          echo $error;
    ?>
  
     </td>

    </tr>
  
   </table>
	
	
</div>
</div>

<? include("pie.php") ?>
