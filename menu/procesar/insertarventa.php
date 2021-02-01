<?php
    //Para insertar la fecha actual en la venta (con la columna en formato datetime)
    //$db->query("INSERT INTO nombre_tabla (nombre_columna) VALUES (now())");
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Venta</title>
</head>
<body>
	<!--<h2>Registro de Cliente Nuevo</h2>-->
	<?php
	if(isset($_POST['registrar']))
	{
            session_start();
            $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$cliente=$_POST['cliente'];
		$precio=$_POST['precio'];
                $articulos=$_POST['articulos'];
                $usuario=$_SESSION['usuario_conectado'];
                //Lo comentado esta asi, debido a que procede de otro proyecto.. :P
		/*if ($key1==$key2)
		{*/
                
                        date_default_timezone_set("America/caracas");
                        //INSERT INTO `test`.`usuarios` (`usuario`, `clave`, `estatus`) VALUES ('leo', '1204', '1');
			$sql2=$conexion->query('SELECT precio FROM dolar WHERE stat=1;');
                        $yeap=false;
                        foreach ($sql2 as $predol)
                        {           
                            $dolar=$predol['precio'];
                            $yeap=true;
                        }    
                        if ($yeap)
                        {
                            $preciodol=$precio/$dolar;
                            $sql="INSERT INTO test.venta (fecha, articulos, precio, usuarioid, clienteid, stat, preciodol, montorel, dolrel) VALUES (now(), '$articulos', '$precio', '$usuario', '$cliente', '1', '$preciodol', '$precio', '$preciodol');";
                            $exito=$conexion->exec($sql);
                            if($exito)
                            {
                            /*
                            //extrayendo datos de la tabla pago y verificando si consulta es correcta
                            $sql2=$conexion->query("SELECT * FROM test.pago WHERE clienteid=".$cliente." AND stat=1;");
                            $comein1=FALSE;
                            foreach ($sql2 as $listsql2)
                            {
                                if ($listsql2['idpago']!="")
                                    $comein1=TRUE;
                            }

                            //ingresando si consulta de pagos fue correcta
                            if ($comein1)
                            {
                                header('location:ventapago.php?cliente='.$cliente);
                            }
                             else 
                            {*/
                                //echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                                //echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                                header('location:backhome.html');
                            //}
                            }
                            else
                            {
                            	echo "NO se registraron los datos correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
				echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                            }
                        }
			else
                        {
                            	echo "NO se registraron los datos correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
				echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
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
