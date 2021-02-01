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
                date_default_timezone_set("America/caracas");
                $dolar=$conexion->query('SELECT precio FROM test.dolar WHERE stat=1;');
                foreach ($dolar as $lisdol)
                {
                    $dolp=$lisdol['precio'];
                }
        
	if(isset($_POST['registrar']))
	{
            
                //Lo comentado esta asi, debido a que procede de otro proyecto.. :P
		/*if ($key1==$key2)
		{*/
                        $precio=$_POST['precio'];
                        $articulo=$_POST['articulo'];
                        $dolart=$precio/$dolp;
                        $dolart= number_format($dolart, 13);
                        $ancladol=$dolart;
                        $anclabs=$precio;
                
                        //INSERT INTO `test`.`usuarios` (`usuario`, `clave`, `estatus`) VALUES ('leo', '1204', '1');
			$sql="INSERT INTO test.articulo (nombarticulo, fecha, usuario, stat, precdol, precarticulo, anclabs, ancladol) VALUES ('$articulo', now(), '$usuario', '1', '$dolart', '$precio', '$anclabs', '$ancladol');";
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
                                header('location:seeart_1.php');
                            //}
			}
			else
                        {
                            	echo "NO se registraron los datos correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
                                /*
                                echo "Precio: ".$precio.", Articulo: ".$articulo.", Dolar: ".$dolp." Conversion: ".$dolart."<br/>";
				*/
                                echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                                echo "Error Numero: 78657<br/>";
                                 
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
                $bolivar=$_POST['precart'];
                $dolar=$_POST['dolar'];
                $precio=$bolivar/$dolar;
                $precio= number_format($precio, 13);
            }
            else
            {
                $precio=$_POST['precioaaa'];
                $dolar=$_POST['dolar'];
                $bolivar=$precio*$dolar;
            }
            
            
            if (!empty($_POST['nombart']))
            {
                $articulo=$_POST['nombart'];
            }
            else
            {
                $articulo=$_POST['nombreaaa'];
            }
            
            $anclabs=$bolivar;
            $ancladol=$precio;
            $usuario=$_SESSION['usuario_conectado'];
            //echo 'articulo='.$articulo.' ,precio='.$precio;
            $sql="UPDATE test.articulo SET nombarticulo='".$articulo."', precdol='".$precio."', precarticulo='".$bolivar."', fecha=now(), usuario='".$usuario."', anclabs='".$anclabs."', ancladol='".$ancladol."' WHERE idarticulo='".$id."';";
            $exito=$conexion->exec($sql);
            //echo $precio;
            if($exito)
            {
                header('location:seeart_1.php');
            }
            else
            {
                echo "Los datos no pudieron ser registrados<br/>";
                echo "Por favor, contacte con el administrador. Error: 487<br/>";
                echo "<a href='backhome.html'>Volver a Inicio</a>";
            }
        }
	else
        {
            header('location:backhome.html');
        }
	?>
</body>
</html>
