<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Acceso de Usuario</title>
</head>
<body>
<?php
	session_start();
	if(isset($_POST['log']))
	{
                $_SESSION['conectar']=true;
                do{
		require ('conexion.php');
		if ($_SESSION['conexion']==true)
		{
			$user=$_POST['user'];
			$key=$_POST['key'];
			$resultado=$conexion->query("select * from test.usuario where usuario='$user' and clave='$key';");
			if($resultado->rowCount()==0)
			{
				$_SESSION['busqueda']=false;
                                $_SESSION['conexion']==false;
				header("location:error.php");
			}
			else
			{
				$usuario=$resultado->fetch();
				$_SESSION['usuario_conectado']=$usuario['usuario'];
                                $_SESSION['status']=$usuario['estatus'];
				$_SESSION['conectado']=true;
                                $_SESSION['inicio_sesion'] = date("Y-n-j H:i:s");
                                $_SESSION['ultimo_mov'] = date("Y-n-j H:i:s");
                                //include ("usuario_conectado.php");
                                //y lo envio a home
                                echo "<script type='text/javascript'>window.location.href='../home4.php';</script>";
                                //header("location:../home.php");
                                $dolar=$conexion->query('SELECT precio, stat FROM test.dolar WHERE stat=1;');
                                foreach ($dolar as $listd)
                                {
                                    $preciodol=$listd['precio'];
                                }
                                $_SESSION['dolarcalc'] = $preciodol;
                                $preciodol=number_format($preciodol, 0, ",", ".");
                                $_SESSION['dolar'] = $preciodol;
                        }
		}
		else
                {
                    $_SESSION['conexion']==false;
                    header("location:error.php");
                }
                $que=false;
                }while ($que);
	}
	else
            echo 
                header("location:../index.html");
	?>
</body>
</html>
