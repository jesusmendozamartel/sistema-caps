<?


 //importar Lugares
   $host="localhost";
   $user="root";
   $password="";
   $link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
   //Vaciando la Tabla
   mysql_select_db ("sistemaatencion",$link);
   mysql_query("TRUNCATE TABLE departamento",$link);
   mysql_query("TRUNCATE TABLE provincia",$link);
   mysql_query("TRUNCATE TABLE distrito",$link);
   // Leyendo tabla Responsable
   mysql_select_db ("backcaps",$link);
   $cadena = "select * from wsdat25 order by DD98,PP98,DI98 ASC";	  
   $tabla = mysql_query($cadena, $link);   
   $numero = mysql_num_rows($tabla);
   
   if($numero>0)
   {
    
	 while ($registro = mysql_fetch_array($tabla))
	 { 
		 insertar_dato_lugar($registro);
		 
      }	 
	 
   } 
   mysql_free_result($tabla);

function insertar_dato_lugar($registro)
{

   $link2 = mysql_connect ("localhost","root", "") or die ("<center>No se puede conectar con la base de datos\n</center>\n");
   mysql_select_db ("sistemaatencion",$link2);
         

  if($registro[1]=="00" and $registro[2]=="00")
  { 
   $cadena = " insert into departamento(iddepartamento,descripcion) values ('','$registro[3]')";
  
    
  }else
     {
	    if($registro[2]=="00")
		{
		  
		  $cadena = " insert into provincia(idprovincia,descripcion,iddepartamento,PP98) values ('','$registro[3]','$registro[0]','$registro[1]')";
	      
		
		}else
		   {
		  $cadena = " insert into distrito(iddistrito,descripcion,idprovincia,DI98) values ('','$registro[3]','$registro[1]','$registro[2]')";
		   
		   }	 
	 }
  mysql_query($cadena,$link2);
  mysql_close($link2);
}   
   
function importar_responsable()
{
   //importar responsables
   $host="localhost";
   $user="root";
   $password="";
   $link = mysql_connect ($host, $user, $password) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
   //Vaciando la Tabla
   mysql_select_db ("sistemaatencion",$link);
   mysql_query("TRUNCATE TABLE responsable",$link);
   // Leyendo tabla Responsable
   mysql_select_db ("backcaps",$link);
   $cadena = "select * from wsdat05";	  
   $tabla = mysql_query($cadena, $link);   
   $numero = mysql_num_rows($tabla);
   
   if($numero>0)
   {
    
	 while ($registro = mysql_fetch_array($tabla))
	 { 
		 insertar_dato_responsable($registro);
		 
      }	 
	 
   } 
   mysql_free_result($tabla);

}
function insertar_dato_responsable($registro)
{

         
		 $link2 = mysql_connect ("localhost","root", "") or die ("<center>No se puede conectar con la base de datos\n</center>\n");
         mysql_select_db ("sistemaatencion",$link2);
         $cadena = "insert into responsable (idresponsable,nombre,apellido,dni,password,display,idlugaratencion) values ('','$registro[1]','$registro[1]','$registro[4]','$registro[2]','$registro[1]','$registro[5]')";	  
         //echo $cadena;
		 mysql_query($cadena,$link2);
         mysql_close($link2);
}		 
?>