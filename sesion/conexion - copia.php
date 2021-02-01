<html>
<head>
	<meta charset="UTF-8"/>
	<title>Conexion a Base de Datos</title>
</head>

<?php
date_default_timezone_set("America/caracas");
	//renombrar este archivo como conexion.php

	//session_start();
	if($_SESSION['conectar']==true)
	{
		try
		{
			//configurar host, usuario de MySql BD y contraseña para poder conectarse
			$host;
			$user;
			$password;

            $dsn= "mysql:host=".$host."; dbname=test";
            $conexion= new PDO($dsn, $user, $password);
			$_SESSION['conexion']=true;
		}
		catch (Exception $e)
		{
			$_SESSION['conexion']=false;
			$_SESSION['error']=$e->getMessage();
		}
                $_SESSION['conectar']=false;
	}
	else
            {header('location:logout.html');}
?>