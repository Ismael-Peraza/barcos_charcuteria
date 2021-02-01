<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Modificaciones</title>
</head>
<body>
	<?php
	if(isset($_POST['update']) OR isset($_POST['endis']) OR isset($_POST['delete']))
	{
            session_start();
            $_SESSION['conectar']=true;
            include ("../../sesion/conexion.php");
            
            //deben colocarse en formulario update
            $procedencia=$_POST['procedencia'];
            $id=$_POST['id'];
            $stat=$_POST['stat'];
            $dolarquery=$conexion->query("SELECT precio FROM test.dolar WHERE stat=1");   
            foreach ($dolarquery as $showme1)
            {                
                $dolar=$showme1['precio'];
            }
            
            if(isset($_POST['update']))
            {
                switch ($procedencia)
                {
                    case 1:
                    {   
                        $cedula=$_POST['ci'];
                        $nombre=$_POST['nombre'];
                        $sql="UPDATE test.cliente SET ci='".$cedula."', nombre='".$nombre."' WHERE ci=".$id.";";
                        break;
                    }
                    case 2:
                    {   
                        $usuario=$_POST['usuario'];
                        $clave=$_POST['clave'];
                        $tipo=$_POST['tipo'];
                        $sql="UPDATE test.usuario SET usuario='".$usuario."', clave='".$clave."', estatus=".$tipo." WHERE usuario='".$id."';";
                        break;
                    }
                    case 3:
                    {   
                        $precio=$_POST['precio'];
                        $articulos=$_POST['articulos'];
                        $relat=$precio;
                        $dolarito=$precio/$dolar;
                        $sql="UPDATE test.venta SET precio=".$precio.", articulos='".$articulos."', montorel=".$relat.", preciodol=".$dolarito." WHERE idventa=".$id.";";
                        break;
                    }
                    /*
                    case 4:
                    {   
                        $cedula=$_POST['ci'];
                        $nombre=$_POST['nombre'];
                        $sql="UPDATE test.cliente SET ci='".$cedula."', nombre='".$nombre."' WHERE ci=".$id.";";
                        break;
                    }
                    */
                }
            }
            if (isset($_POST['endis']) OR isset($_POST['delete']))
            {
                
                
                if ($procedencia==1)
                {
                    $endis='cliente';
                    $idmsg='ci';
                    $statmsg='stat';
                }
                elseif ($procedencia==2)
                {
                    $endis='usuario';
                    $idmsg='usuario';
                    $statmsg='estatus';
                    if ($stat==3)
                        $sql="UPDATE test.".$endis." SET ".$statmsg."=2 WHERE ".$idmsg."='".$id."';";
                    else
                        $sql="UPDATE test.".$endis." SET ".$statmsg."=3 WHERE ".$idmsg."='".$id."';";
                }
                elseif ($procedencia==3)
                {
                    $endis='venta';
                    $idmsg='idventa';
                    $statmsg='stat';
                }
                elseif ($procedencia==4)
                {
                    $endis='pago';
                    $idmsg='idpago';
                    $statmsg='stat';
                }
                if (($stat==1 OR $stat==4 OR $stat==5) AND ($procedencia==1 OR $procedencia==3))
                {
                    if (isset($_POST['delete']) AND $procedencia==3)
                    {
                        $sql="UPDATE test.".$endis." SET ".$statmsg."=0 WHERE ".$idmsg."=".$id.";";
                    }
                    else
                    {
                        $sql="UPDATE test.".$endis." SET ".$statmsg."=2 WHERE ".$idmsg."='".$id."';";
                    }
                }
                elseif ($stat==2 AND ($procedencia==1 OR $procedencia==3))
                {
                    $sql="UPDATE test.".$endis." SET ".$statmsg."=1 WHERE ".$idmsg."='".$id."';";
                }
                
            } 
            
            $exito=$conexion->exec($sql);
            
            if($exito)
                {
                    //echo "<script type='text/javascript'>alert('Actualizacion Exitosa');</script>";
                    //echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                    header('location:backhome.html');
                }
            else
		{
                    echo "NO se registraron los datos correctamente<br/>";
                    echo "o existe un problema con la conexion a la base de datos<br/>";
                    //echo "Tipo de Error: ".$errorsql."<br/>";
                    //echo $sql." ".$precio." ".$dolar." ". $dolarito;
                    echo "<a href='backhome.html'>Intentar Nuevamente</a>";
		}
	}/*
        elseif(isset($_POST['elmul']))
        {
                $endis='venta';
                $idmsg='idventa';
                $statmsg='stat';
                for($i=0;$i<count($_POST['masivo']);$i++)
                {
                    $idelmul=$_POST['masivo'][$i];
                    $sql2=("UPDATE test.".$endis." SET ".$statmsg."=0 WHERE ".$idmsg."='".$idelmul."';");                
                    $exito2=$conexion->exec($sql2);
                }
        }*/
	else
            {
                /*    
                    echo "NO se registraron los datos correctamente<br/>";
                    echo "o existe un problema con la conexion a la base de datos<br/>";
                    echo "<a href='backhome.html'>Intentar Nuevamente</a>";
                 * 
                 */header('location:backhome.html');
            }
	?>
</body>
</html>

