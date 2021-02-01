<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Usuario</title>
</head>
<body>
	<!--<h2>Registro de Cliente Nuevo</h2>-->
	<?php
	if(isset($_POST['registrar']))
	{
            session_start();
            $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$user=$_POST['usuario'];
		$key=$_POST['clave'];
                $tipo=$_POST['tipo'];
                //Lo comentado esta asi, debido a que procede de otro proyecto.. :P
		/*if ($key1==$key2)
		{*/
                        //INSERT INTO `test`.`usuarios` (`usuario`, `clave`, `estatus`) VALUES ('leo', '1204', '1');
			$sql="INSERT INTO test.usuario (usuario, clave, estatus) VALUES ('$user', '$key', '$tipo');";
			$exito=$conexion->exec($sql);
			if($exito)
			{
				/*echo "Registro Exitoso<br/>";
				echo "<a href='inicio_sesion.html'>Iniciar Sesión</a>";*/
                                //echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                                //echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                                header('location:backhome.html');
                        }
			else
			{
				echo "NO se registraron los datos correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
				echo "<a href='backhome.html'>Intentar Nuevamente</a>";
			}
		/*}
		else
		{
			echo "Las contraseñas deben ser identicas<br/>";
			echo "<a href='registrar.html'>Intentar de Nuevo</a>";
		}*/
	}
	else
        {
            echo "El usuario no pudo ser registrado correctamente<br/>";
            echo "Por favor, contacte con el administrador. Error: 4042<br/>";
            echo "<a href='backhome.html'>Volver a Inicio</a>";
        }
        ?>
</body>
</html>