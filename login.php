<?
   error_reporting(E_ALL ^ E_NOTICE); 
  // error_reporting(E_ALL);
  //  ini_set('display_errors', '1');


    include("funciones.php");
  
if($_POST['ingresar'])
{       
		if(trim($_POST["usuario"]) != "" && trim($_POST["clave"]) != "")
		{
			$usuario = quitar($_POST["usuario"]);
			$clave = quitar($_POST["clave"]);

		$conexion = conectar_base();
        mysql_select_db ("sistemaatencion",$conexion);	
			
		$result = mysql_query("SELECT id, clave, nivel FROM usersession WHERE usuario='$usuario'");
		if($row = mysql_fetch_array($result))
		{
		if($row["clave"] == $clave)
		{
			
			$idsession =  $row["id"];
                        $nivel = $row["nivel"];
			//90 dias dura la cookie
			setcookie("idsession",$idsession,time()+7776000);
			setcookie("usuario",$usuario,time()+7776000);
			setcookie("nivel",$nivel,time()+7776000);
			//setcookie("usPass",$passN,time()+7776000);
			$cadena_error ="<img src='imagenes/conectando.gif'>";
			?>
<script language="JavaScript" type="text/javascript">

var pagina="index.php"
function redireccionar() 
{
location.href=pagina
} 
setTimeout ("redireccionar()", 2000);

</script>

<?
			
		}
		else
			{
			$cadena_error = "Password incorrecto";
			}
		}
		  else
			{
				$cadena_error = "Usuario no existente en la base de datos";
			}
			mysql_free_result($result);
		}
		else
		{
			$cadena_error = "Debe especificar un nick y password";
		}
		mysql_close();
  
  
}  
  
  
  $usuario ="";
  $clave = "";
 
?>

<FORM ACTION="login.php" METHOD="post">
<table align="center" ><tr><td><img src="imagenes/login.jpg"></td>
<td>
<table align='center' >
<tr bgcolor="#2f9b0d"><td colspan="2" align="center"><font face='arial' size='3' color='#fffff'><b>INICIO DE SESSION</b></font></td></tr>
<tr><td colspan="2" align="center" height="20"></td></tr>
<tr><td><font face='arial' size='2'><b>Usuario</b></font></td><td>: <input name='usuario' value="<? echo $usuario; ?>" ></td></tr>
<tr><td><font face='arial' size='2'><b>Password</b></font></td><td>: <input type='password' name='clave' value='<? echo $clave; ?>' ></td></tr>
<tr><td colspan='2' align='center'><INPUT TYPE="submit" name="ingresar" VALUE="Ingresar"></td></tr>
<tr><td colspan='2' align="center" >
<?
    echo "<br><font face='arial' size='2' color='red'>".$cadena_error."</font>";
?>
</td></tr>
</table>
</td><td width="150"></td></tr></table>
</form>
