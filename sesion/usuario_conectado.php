<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Usuario Conectado</title>
</head>
<body>
<?PHP
        date_default_timezone_set("America/caracas");
	//session_start();
        
        //verificamos si el usuario esta conectado
	if($_SESSION['conectado']==true)
        {    
            $fechaGuardada1 = $_SESSION["ultimo_mov"];
            $fechaGuardada2 = $_SESSION["inicio_sesion"]; 
            $ahora = date("Y-n-j H:i:s"); 
            $tiempo_transcurrido1 = (strtotime($ahora)-strtotime($fechaGuardada1));
            $tiempo_transcurrido2 = (strtotime($ahora)-strtotime($fechaGuardada2));

            //comparamos el tiempo transcurrido 
            //si pasaron 45 minutos desde su ultimo movimiento o si inicio sesion hace mas de 2 horas 
            if($tiempo_transcurrido1 >= 27000 or $tiempo_transcurrido2 >= 72000) 
            { 
                //if ($_SESSION['home']===true)
                //{
                    $_SESSION['conectado']=false;
                    session_destroy(); // destruyo la sesión}
                    header("location:logout.html"); //envío al usuario a la pag. de autenticación
                //}
                //else
                //{
                    //session_destroy(); // destruyo la sesión
                    //header("Location:../index.html"); //envío al usuario a la pag. de autenticación 
                //}
                //echo $tiempo_transcurrido1." = ".$ahora." - ".$fechaGuardada1. " o ".$fechaGuardada2; */
            }
            /*
            elseif($tiempo_transcurrido2 >= 7200)
            {
                //si inicio sesion hace mas de 2 horas
                session_destroy(); // destruyo la sesión                
                header("Location:../index.html"); //envío al usuario a la pag. de autenticación 
                //echo "2";                
            }*/
            else
                //sino, actualizo la fecha de la sesión 
            {
                $_SESSION["ultimo_mov"] = $ahora;                           
                //echo "4";
            }
        }
        /*{
		echo "<H2>Usuario Conectado: ".$_SESSION['usuario_conectado']."</H2>";
		echo "<form action='fin_sesion.php' method='post' value='Cerrar Sesión'>
			<input type='submit' name='c_sesion' value='Cerrar Sesión'></form>";
	}*/
	else
                //en caso de que el usuario no este conectado lo enviamos al index
		header("location:logout.html");
                //echo "Error 404";
?>
</body>
</html>