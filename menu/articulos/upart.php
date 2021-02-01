<?php
    //Para insertar la fecha actual en la venta (con la columna en formato datetime)
    //$db->query("INSERT INTO nombre_tabla (nombre_columna) VALUES (now())");
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Articulos</title>
</head>
<body>
	<!--<h2>Registro de Articulos</h2>-->
	<?php
        
                session_start();
                $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$usuario=$_SESSION['usuario_conectado'];
        
	if(isset($_POST['registrar']))
	{
            
                //Lo comentado esta asi, debido a que procede de otro proyecto.. :P
		/*if ($key1==$key2)
		{*/
                        $precio=$_POST['precio'];
                        $articulo=$_POST['articulo'];
                
                        date_default_timezone_set("America/caracas");
                        //INSERT INTO `test`.`usuarios` (`usuario`, `clave`, `estatus`) VALUES ('leo', '1204', '1');
			$sql="INSERT INTO test.articulo (nombarticulo, precarticulo, fecha, usuario, stat) VALUES ('$articulo', '$precio', now(), '$usuario', '1');";
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
                                header('location:seeart.php');
                            //}
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
        elseif(isset($_POST['modart']))
	{
            $id=$_POST['idarticulo'];
            
            if (!empty($_POST['precart']))
            {
                $precio=$_POST['precart'];
            }
            else
            {
                $precio=$_POST['precioaaa'];
            }
            
            
            if (!empty($_POST['nombart']))
            {
                $articulo=$_POST['nombart'];
            }
            else
            {
                $articulo=$_POST['nombreaaa'];
            }
            
            $usuario=$_SESSION['usuario_conectado'];
            //echo 'articulo='.$articulo.' ,precio='.$precio;
            $sql="UPDATE test.articulo SET nombarticulo='".$articulo."', precarticulo='".$precio."', fecha=now(), usuario='".$usuario."' WHERE idarticulo='".$id."';";
            $exito=$conexion->exec($sql);
            header('location:seeart.php');
        }
	else
        {
            echo "Los datos no pudieron ser registrados<br/>";
            echo "Por favor, contacte con el administrador. Error: 487<br/>";
            echo "<a href='backhome.html'>Volver a Inicio</a>";
        }
	?>
</body>
</html>
