<?php
    //Para insertar la fecha actual en la venta (con la columna en formato datetime)
    //$db->query("INSERT INTO nombre_tabla (nombre_columna) VALUES (now())");
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Dolar</title>
</head>
<body>
	<!--<h2>Registro de Articulos</h2>-->
	<?php
        
                session_start();
                $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$usuario=$_SESSION['usuario_conectado'];
                date_default_timezone_set("America/caracas");
                
	if(isset($_POST['registrar']))
	{
            $dolerror=false;
                        $precio=$_POST['precio'];
                        if (!empty($_POST['fecha']))
                        {
                            $fecha=$_POST['fecha'];
                        }
                        else
                        {
                            $fecha=$_POST['fechahoy'];
                        }
                        echo $precio." ";
                        $preciodolar1=$_SESSION['dolar'];
                        echo $preciodolar1." ";
                        $dolarito=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1' AND fecha<='$fecha';");
                            foreach ($dolarito as $listupdol83)
                            {
                                $idup3=$listupdol83['precio'];
                            }
                        echo $idup3." ";
                        $doble=$idup3*2;
                        $medio=$idup3/2;
                        echo $doble." ";
                        echo $medio." ";
                        if ( ($precio > $doble) || ($precio < $medio)) 
                        {
                            echo " al fin ";
                        }
            
                        
                        /*$dolar2=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1' AND fecha<='$fecha';");
                            foreach ($dolar2 as $listupdol2)
                            {
                                $idup=$listupdol2['iddolar'];
                                $sql2="UPDATE test.dolar SET stat='2' WHERE iddolar='".$idup."';";
                                $exito2=$conexion->exec($sql2);
                            }    
                            
                        $sql="INSERT INTO test.dolar (precio, fecha, stat, usuario) VALUES ('$precio', '$fecha', '1', '$usuario');";
			$exito=$conexion->exec($sql);
                        if($exito)
			{
                            $_SESSION['dolar']=$precio;
                            $articulos=$conexion->query('SELECT art.idarticulo, art.precarticulo, art.precdol, art.stat, dol.precio FROM test.articulo as art, test.dolar as dol WHERE art.stat=1 AND dol.stat=1;');
                            foreach ($articulos as $listart)
                            {           
                                $idarticulo=$listart['idarticulo'];
                                $dolar=$listart['precio'];
                                $precioart1=$listart['precarticulo'];
                                $precioart2=$listart['precdol']*$dolar;
                                if($precioart1<$precioart2)
                                {
                                    $sql24="UPDATE test.articulo SET precarticulo='".$precioart2."' WHERE idarticulo='".$idarticulo."';";
                                    $exito44=$conexion->exec($sql24);
                                    if($exito44)
                                    {
                                        $badart=false;
                                    }
                                    else
                                    {
                                        $badart=true;
                                    }
                                }
                            }
                        }
                        if($exito)
			{   
                            $querydolar=$conexion->query('SELECT precio FROM test.dolar WHERE stat=1;');
                            foreach ($querydolar as $listdol)
                            {
                                $dolar=$listdol['precio'];
                                $goboy=true;
                            }
                            
                            if($goboy)
                            {
                                $ventas=$conexion->query('SELECT ven.idventa, ven.precio, ven.preciodol, ven.montorel, ven.stat FROM test.venta as ven WHERE (ven.stat=1 OR ven.stat=3) AND ven.fecha>"2020-11-28";');
                                foreach ($ventas as $listven)
                                {   
                                    $badven=false;        
                                    $idventa=$listven['idventa'];
                                    $precioventa=$listven['precio'];
                                    $precioventa2=$listven['preciodol']*$dolar;
                                    $precioventa3=$listven['montorel'];
                                
                                    if(($precioventa3<$precioventa2) && ($precioventa3<>null))
                                    {
                                        $sql84="UPDATE test.venta SET montorel='".$precioventa2."' WHERE idventa='".$idventa."';";
                                        $exito55=$conexion->exec($sql84);
                                        if($exito55)
                                        {
                                            //lo puse pa'q se viera bonito pero no hace falta :P
                                            $badven=false;
                                        }
                                        else
                                        {
                                            $badven=true;
                                        }
                                    }
                                    if($badven==false)
                                    {
                                        $ventaja=$conexion->query('SELECT ven.montorel FROM test.venta as ven WHERE (ven.stat=1 OR ven.stat=3) AND ven.fecha>"2020-11-28" AND ven.idventa="'.$idventa.'";');
                                        foreach ($ventaja as $vendol)
                                        {
                                            $relativo=$vendol['montorel'];
                                        }
                                        $dolarfluc=0;
                                        $dolarfluc=$relativo/$dolar;
                                        $sql94="UPDATE test.venta SET preciodol='".$dolarfluc."' WHERE idventa='".$idventa."';";
                                        $exito75=$conexion->exec($sql94);
                                        if($exito75)
                                        {
                                            $baddolrel=false;
                                        }
                                        else
                                        {
                                            $baddolrel=true;
                                        }
                                    }  
                                }
                            }
                            else
                            {
                               $dolerror=true;
                            }
                        }   
                        else
                        {
                            echo "NO se registro el precio del DOLAR correctamente<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                        if ($dolerror)
                        {
                            echo "Existe un problema con la conexion a la base de datos al ver el Dolar<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                            
                        if($badven)
                        {
                            echo "NO se registraron los datos correctamente en las Ventas<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                        
                        if($badart)
                        {
                            echo "NO se registraron los datos correctamente en los Articulos<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                        
                        if($baddolrel)
                        {
                            echo "NO se registraron los datos correctamente en los Precio Dolar Venta<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
            if ($dolerror==false AND $badven==false AND $badart==false AND $baddolrel==false)
                header('location:../../home4.php');        
	*/ echo "todo bien"	;	
	}
        elseif(isset($_POST['modol']))
	{/*
            if (!empty($_POST['fecha']))
            {
                $fecha=$_POST['fecha'];
            }
            else
            {
                $fecha=$_POST['fechadefault'];
            }
            if (!empty($_POST['precio']))
            {
                $precio=$_POST['precio'];
            }
            else
            {
                $precio=$_POST['preciodefault'];
            }
            $iddolar=$_POST['iddolar'];
            
            $sql3="UPDATE test.dolar SET fecha='".$fecha."', precio='".$precio."', usuario='".$usuario."' WHERE iddolar='".$iddolar."';";
            $exito3=$conexion->exec($sql3);
            
            if($exito3)
            {
                header('location:../../home4.php');
            }
            else
            {
                echo "NO se registraron los datos correctamente<br/>";
                echo "o existe un problema con la conexion a la base de datos<br/>";
                echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
            }*/ echo "por aqui no";
        }
        elseif(isset($_POST['del']))
	{/*
            $iddolar=$_POST['iddolar'];
            
            $sql4="UPDATE test.dolar SET stat='3', usuario='".$usuario."' WHERE iddolar='".$iddolar."';";
            $exito4=$conexion->exec($sql4);
            
            if($exito4)
            {
                header('location:../../home4.php');
            }
            else
            {
                echo "NO se eliminaron los datos correctamente<br/>";
                echo "o existe un problema con la conexion a la base de datos<br/>";
                echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
            }*/ echo "por aqui tampoco";
        }
	else
        {
            //header('location:switch.php');
            echo "el header";
        }
	?>
</body>
</html>
