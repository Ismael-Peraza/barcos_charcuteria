<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Cliente</title>
</head>
<body>
	<!--<h2>Registro de Cliente Nuevo</h2>-->
	<?php
	if(isset($_POST['registrar']))
	{
            session_start();
            $_SESSION['conectar']=true;
            include ("../../sesion/conexion.php");
		$cedula=$_POST['ci'];
		$nombre=$_POST['nombre'];
                //Lo comentado esta asi, debido a que procede de otro proyecto.. :P
		/*if ($key1==$key2)
		{*/
                        //INSERT INTO `test`.`usuarios` (`usuario`, `clave`, `estatus`) VALUES ('leo', '1204', '1');
                        if ($cedula!='')
                            $sql="INSERT INTO test.cliente (ci, nombre, stat) VALUES ('$cedula', '$nombre', '1');";
                        else
                            //este codigo chulito no me sirve
                            /*$addcli=$conexion->query('SELECT ci FROM test.cliente');
                            $cimenor=999999999;
                            foreach ($addcli as $clinu)
                            {
                                if($clinu['ci']<=$cimenor)
                                    $cimenor=$clinu['ci'];                                    
                            }*/
                            $sql="INSERT INTO test.cliente (nombre, stat) VALUES ('$nombre', '1');";
                        
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
            echo "Los datos no pudieron ser registrados<br/>";
            echo "Por favor, contacte con el administrador. Error: 4042<br/>";
            echo "<a href='backhome.html'>Volver a Inicio</a>";
        }
	?>
</body>
</html>