<?
 error_reporting(E_ALL ^ E_NOTICE); 
setcookie("usuario","x",time()-3600);
setcookie("nivel","x",time()-3600);

?>

<SCRIPT LANGUAGE="javascript">location.href = "login.php";</SCRIPT>