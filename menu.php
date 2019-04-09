<? $nivel=$_COOKIE["nivel"];
   $idsession = $_COOKIE["idsession"];
?>
<div id="menuh">

        <ul>

                <li><a href="index.php" id="primero">Inicio</a></li>

                <li><a href="usuarios.php">Atenci&oacute;n Usuarios</a></li>
				<!-- <li><a href="capacitaciones.php">Capacitaciones</a></li> -->

                              
                                <li><a href="proyectos.php">Proyectos</a></li> 
				<? if($_COOKIE["nivel"]=='1'){   ?>				
				
				<!-- <li><a href="eventos.php">eventos Haidey</a></li> -->
				<li><a href="reportesexel.php">Reportes OnDemand</a></li>
				<li><a href="sessiones.php">Sessiones</a></li>
			        <li><a href="configuracion.php">Configuraci&oacute;n</a></li>
				<? } ?>
				
<!--
                <li><a href="reportes.php">Reportes</a></li>
				 <li><a href="configuracion.php">configuraci&oacute;n</a></li>

                <li><a href="#menuh">Acerca de nosotros</a></li>
-->
        </ul>

</div>
<div id="menuh2">
<?
  echo "Usuario: ".$_COOKIE["usuario"]." | ";
  echo "<a href='logon.php'><font color='#fff000'>Cerrar Sessi&oacute;n [X]</font></a>";
  ?>
</div>
