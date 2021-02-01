<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Error de Acceso</title>
</head>
<body>
<?php
	//session_start();
	if ($_SESSION['conexion']==false OR isset($_SESSION['conexion']))
	{
		echo "Ocurrio el siguiente error de conexion: ".$_SESSION['error']."<br/>";
		echo "<a href='index.html'>Volver al Inicio</a>";
	}
	elseif ($_SESSION['busqueda']==false)
	{
		echo "<H2>Usuario NO Encontrado y/o Contraseña Invalida</H2>";
		echo "Ingrese <a href='index.html'>Usuario y Contraseña</a> Nuevamente<br/>";
		//echo "O Registre un <a href='registrar.html'>Usuario Nuevo</a>";
	}
        else
            header("location:index.html");
?>
</body>
</html>