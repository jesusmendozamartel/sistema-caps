<?

function conectar_base()
{
 $host="localhost";
 $user="root";
 $password="";
 $link = mysql_connect($host, $user, $password);
 return $link;
}

?>
