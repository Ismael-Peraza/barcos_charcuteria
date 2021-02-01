<html>
<head>
	<meta charset="UTF-8"/>
	<title>Cerrar Sesión</title>
</head>

<?php
//Esta hecho asi por un error con el manejo de las funciones de sesion
	/*if(isset($_POST['c_sesion']))
	{*/
    
        //Esto deberia ser un respaldo de cada ez que se cierra sesion
        //pero da error
        /*
        echo "<!Probando LogOut>
            <script type='text/javascript'>alert('Logout.php');</script>";
        
        
        include ('respaldo.php');

        $contenido = $_SESSION['respaldo'];
        $archivo = fopen('D:\Documents\MEGAsync\respaldo.txt','w+');
        fputs($archivo,$contenido);
        fclose($archivo);
        
        $auto = $_SESSION['respaldo'];
        $erchivo = fopen('D:\Documents\MEGAsync\respaldo.sql','w+');
        fputs($erchivo,$auto);
        fclose($erchivo);
        */

        //echo "<script type='text/javascript'>window.location.href='../login.html';</script>";
                session_start();
                $_SESSION['conectado']=false;
		session_destroy();
		//header("location:index.html");
                echo("
			<script language='javascript'>
				  var contador = 0;
				  var fin_contador = 5; 
				  var iniciado = false;
				  
				  function cuenta()
					  {       
					  if(contador >= fin_contador)
						{
						window.location.href = 'index.html';
						}
							else
							{
							document.getElementById('contador').innerHTML  =  fin_contador;
							fin_contador = fin_contador - 1;
							}   
					  }
					   
				  function ini()
					{
					cuenta();
					setInterval('cuenta()',1000);
					}
				  
			</script>   
                        
                        

                        ");

?>

<BR><BR>
			<BODY BGCOLOR='#FFFFCC' onload="ini()">
				<TABLE ALIGN='center' BORDER=2>
				<TR>
					<TD>
					<CENTER><FONT COLOR=#999999 size=+2><B>Cerrando Sesion... Espere...<div id="contador"></div></B></FONT></CENTER>
		 			</TD>
				</TR>
				</TABLE>
			</BODY>
                
<?php
                /*
 * }
 
    
	else
		header("location:index.html");
        */
        
?>