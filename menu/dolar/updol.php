<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Dolar</title>
</head>
<body>
	<?php
        //esto es para extender el tiempo de ejecucion del codigo a 2 minutos
        ini_set('max_execution_time',240);
        
        //Constructores de la pagina
                session_start();
                $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$usuario=$_SESSION['usuario_conectado'];
                date_default_timezone_set("America/caracas");
        
        //Verificacion de que procede de la pagina de registro de dolar
	if(isset($_POST['registrar']))
	{
            $dolerror=false;
            
            //Verificacion para comprobar que la fecha fue introducida
            //(Actualmente no es necesario)
                        $precio=$_POST['precio'];
                        if (!empty($_POST['fecha']))
                        {
                            $fecha=$_POST['fecha'];
                        }
                        else
                        {
                            $fecha=$_POST['fechahoy'];
                        }
                        //echo $fecha;
        
            //variables para redirigir una vez se actualize todo
            $backto1=true;
            $backto2=true;
            $backto3=true;
            $backto4=true;
                        
            //Esto no deberia estar, sino lo que esta mas abajo
            /*
            $dolarito=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1';");
            foreach ($dolarito as $listupdol83)
            {
                $idup3=$listupdol83['precio'];
            }
            */
            //Esto es lo que deberia estar, sera comprobado mas adelante
            $idup3=$_SESSION['dolarcalc'];
            //Variables para comprobar que el valor del dolar no tenga un
            //cero (0) de mas o de menos
            $doble=$idup3*2;
            $medio=$idup3/2;
            
            //Si el monto es correcto procede
            if ( ($precio < $doble) && ($precio > $medio)) 
            {
                        
                        //Inhabilitando el precio de dolar que estaba activo
                        $dolar2=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1' AND fecha<='$fecha';");
                            foreach ($dolar2 as $listupdol2)
                            {
                                $idup=$listupdol2['iddolar'];
                                $sql2="UPDATE test.dolar SET stat='2' WHERE iddolar='".$idup."';";
                                $exito2=$conexion->exec($sql2);
                            }    
                        
                        //Insertando nuevo precio de dolar
                        if($exito2)
                        {
                            $sql="INSERT INTO test.dolar (precio, fecha, stat, usuario) VALUES ('$precio', '$fecha', '1', '$usuario');";
                            $exito=$conexion->exec($sql);
                        }
                        else
                        {                            
                            $exito=false;
                        }
                        //si el nuevo precio del dolar es insertado correctamente, entonces procede
                        if($exito)
			{
                            $preciodolar1=number_format($precio, 0, ",", ".");
                            $_SESSION['dolar']=$preciodolar1;
                            $_SESSION['dolarcalc']=$precio;
                            $dolar=$_SESSION['dolarcalc'];
                            
                            //Actualizador del precio de los articulos
                            $articulos=$conexion->query('SELECT art.idarticulo, art.precarticulo, art.precdol, art.anclabs, art.ancladol, art.stat FROM test.articulo as art WHERE art.stat=1;');
                            $bigdata1=array();
                            $bigdata2=array();
                            $actualizeichon1=false;
                            $bigdata11=array();
                            $bigdata21=array();
                            $actualizeichon11=false;
                            $theTick=false;
                            $plomo=false;
                            foreach ($articulos as $listart)
                            {           
                                $idarticulo=$listart['idarticulo'];
                                $precioartold=$listart['precarticulo'];
                                $precioartnew=bcmul($listart['precdol'],$dolar,4);
                                
                                //si el dolar sube
                                if($precioartold<$precioartnew)
                                {
                                    if($listart['precdol']>$listart['ancladol'])
                                    {
                                        $nivelando=bcdiv($precioartold,$dolar,15);
                                        if($nivelando<=$listart['ancladol'])
                                        {
                                            $precioartnew=bcmul($listart['ancladol'],$dolar,4);
                                            $plomo=true;
                                        }
                                        $theTick=true;
                                    }
                                    if($listart['precdol']<=$listart['ancladol'] || $plomo)
                                    {
                                        $bigdata1[]=("WHEN idarticulo='".$idarticulo."' THEN '".$precioartnew."'");
                                        $bigdata2[]=("'".$idarticulo."'");
                                        if(!$actualizeichon1)
                                        {
                                            $actualizeichon1=true;
                                        }
                                    }  
                                }
                                
                                //si el dolar baja
                                if($precioartold>$precioartnew || $theTick)
                                {
                                    $newdolart3=bcdiv($precioartold,$dolar,15);
                                    if($theTick && $plomo)
                                    {
                                        $newdolart3=$listart['ancladol'];
                                    }
                                    $bigdata11[]=("WHEN idarticulo='".$idarticulo."' THEN '".$newdolart3."'");
                                    $bigdata21[]=("'".$idarticulo."'");
                                    if(!$actualizeichon11)
                                    {
                                        $actualizeichon11=true;
                                    }
                                }
                                $theTick=false;
                                $plomo=false;
                            }
                            
                            //actualizando precio de los articulos
                            //$sql24="UPDATE test.articulo SET precarticulo=(CASE WHEN idarticulo='".$idarticulo."' THEN '".$precioart2."' END) WHERE idarticulo IN ('".$idarticulo."')";
                            if($actualizeichon1)
                            {
                                $data1=implode(" ",$bigdata1);
                                $data2=implode(", ",$bigdata2);
                                $sql24="UPDATE test.articulo SET precarticulo=(CASE ".$data1." END) WHERE idarticulo IN (".$data2.")";
                                $exito44=$conexion->exec($sql24);
                                $backto1=$exito44;
                            }
                            //$sql241="UPDATE test.articulo SET precdol=(CASE WHEN idarticulo='".$idarticulo."' THEN '".$precioart2."' END) WHERE idarticulo IN ('".$idarticulo."')";
                            if($actualizeichon11)
                            {
                                $data11=implode(" ",$bigdata11);
                                $data21=implode(", ",$bigdata21);
                                $sql241="UPDATE test.articulo SET precdol=(CASE ".$data11." END) WHERE idarticulo IN (".$data21.")";
                                $exito441=$conexion->exec($sql241);
                                $backto2=$exito441;
                            }
                        
                            //$dolar=$precio;
                            //en vez de utilizar la variable dolar, se podria usar directamente precio
                                
                            //Actualizando Monto de Deuda para las Ventas
                            $ventas=$conexion->query('SELECT ven.idventa, ven.precio, ven.preciodol, ven.montorel, ven.dolrel, ven.stat FROM test.venta as ven WHERE (ven.stat=1 OR ven.stat=3) AND ven.fecha>"2020-11-28";');
                            $bigdata3=array();
                            $bigdata4=array();
                            $actualizeichon2=false;
                            $bigdata31=array();
                            $bigdata41=array();
                            $actualizeichon21=false;
                            foreach ($ventas as $listven)
                            {   
                                //$badven=false;        
                                $idventa=$listven['idventa'];
                                $ancladol=$listven['preciodol'];
                                $dolrel=$listven['dolrel'];
                                $newmontorel=bcmul($listven['dolrel'],$dolar,0);
                                $montorel=$listven['montorel'];
                                    
                                //si el dolar sube
                                if(($montorel<$newmontorel) && ($montorel<>null))
                                {
                                    if($dolrel>$ancladol)
                                    {
                                        $nivelando=bcdiv($montorel,$dolar,15);
                                        if($nivelando<=$ancladol)
                                        {
                                            $newmontorel=bcmul($ancladol,$dolar,4);
                                            $plomo=true;
                                        }
                                        $theTick=true;
                                    }
                                    if($dolrel<=$ancladol || $plomo)
                                    {
                                        $bigdata3[]=("WHEN idventa='".$idventa."' THEN '".$newmontorel."'");
                                        $bigdata4[]=("'".$idventa."'");
                                        if(!$actualizeichon2)
                                        {
                                            $actualizeichon2=true;
                                        }
                                    }
                                }    
                                    
                                //si el dolar baja y yo no estoy ahi
                                if(($montorel>$newmontorel || $theTick) && ($montorel<>null))
                                {
                                    $newpreciodol=bcdiv($montorel,$dolar,15);
                                    if($theTick && $plomo)
                                    {
                                        $newpreciodol=$ancladol;
                                    }
                                    $bigdata31[]=("WHEN idventa='".$idventa."' THEN '".$newpreciodol."'");
                                    $bigdata41[]=("'".$idventa."'");
                                    if(!$actualizeichon21)
                                    {
                                        $actualizeichon21=true;
                                    }
                                } 
                                $theTick=false;
                                $plomo=false;                                                                       
                            }
                            //Actualizando los valores de las ventas
                            //$sql84="UPDATE test.venta SET montorel=(CASE WHEN idventa='".$idventa."' THEN '".$newpreciodol."' END) WHERE idventa IN ('".$idventa."')";
                            if($actualizeichon2)
                            {
                                $data3=implode(" ",$bigdata3);
                                $data4=implode(", ",$bigdata4);
                                $sql84="UPDATE test.venta SET montorel=(CASE ".$data3." END) WHERE idventa IN (".$data4.")";
                                $exito55=$conexion->exec($sql84);
                                $backto3=$exito55;
                            }
                            if($actualizeichon21)
                            {
                                $data31=implode(" ",$bigdata31);
                                $data41=implode(", ",$bigdata41);
                                $sql841="UPDATE test.venta SET dolrel=(CASE ".$data31." END) WHERE idventa IN (".$data41.")";
                                $exito551=$conexion->exec($sql841);
                                $backto4=$exito551;
                            }
                        }
                        if ($exito)
                        {
                            if($backto1 && $backto2 && $backto3 && $backto4)
                            {
                                header('location:backhome.html');
                            }
                            else
                            {
                                if (isset($exito44))
                                {
                                    if (!$exito44)
                                    {
                                        echo "<h2>Error Grave de Ejecucion</h2><br/>";
                                        echo "El dolar se actualizo, pero<br/>";
                                        echo "NO se actualizo correctamente el precio de los articulos<br/>";
                                        echo "Error Numero: 440";
                                    }
                                }
                                if (isset($exito441))
                                {
                                    if (!$exito441)
                                    {
                                        echo "<h2>Error Grave de Ejecucion</h2><br/>";
                                        echo "El dolar se actualizo, pero<br/>";
                                        echo "NO se actualizo correctamente el precio de los articulos<br/>";
                                        echo "Error Numero: 441";
                                    }
                                }
                                if (isset($exito55))
                                {
                                    if (!$exito55)
                                    {
                                        echo "<h2>Error Grave de Ejecucion</h2><br/>";
                                        echo "El dolar se actualizo, pero<br/>";
                                        echo "NO se actualizo correctamente el precio de las ventas<br/>";
                                        echo "Error Numero: 550";
                                    }
                                }
                                if (isset($exito551))
                                {
                                    if (!$exito551)
                                    {
                                        echo "<h2>Error Grave de Ejecucion</h2><br/>";
                                        echo "El dolar se actualizo, pero<br/>";
                                        echo "NO se actualizo correctamente el precio de las ventas<br/>";
                                        echo "Error Numero: 551";
                                    }
                                }
                            }
                        }
                        //si el nuevo precio de dolar no fue registrado correctamente
                        else
                        {
                            //si no hay dolar activo debe habilitarse el ultimo funcional
                            if($exito2)
                            {
                                $sqln2="UPDATE test.dolar SET stat='1' WHERE iddolar='".$idup."';";
                                $exiton2=$conexion->exec($sqln2);
                                if($exiton2)
                                {
                                    echo "NO se registro el precio del DOLAR correctamente<br/>";
                                    echo "o existe un problema con la conexion a la base de datos<br/>";
                                    echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                    echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                                }//en caso de que lo anterior fallare
                                else
                                {
                                    echo "<h2>Error Grave de Ejecucion</h2><br/>";
                                    echo "Coloque nuevamente el precio del dolar<br/>";
                                    echo "Si el problema persiste, llame al administrador<br/>";
                                    echo "Error Numero: 92347";
                                }
                            }//en caso de que el dolar que esta activo temporalmente
                            //no hubiera sido deshabilitado correctamente
                            else
                            {
                                echo "NO se registro el precio del DOLAR correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
                                echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                            }
                        }                        
            }
            else
            {
                if ($precio > $doble)
                {
                    $dimelo="mas";
                }
                elseif ($precio < $medio)
                {
                    $dimelo="menos";
                }
                echo "[ERROR] El monto introducido contiene un cero de ".$dimelo."<br/>";
                echo "El monto introducido fue ".$precio."<br/>";
                echo "Para ir a Inicio presione: <a href='backhome.html'>Inicio</a><br/>";
            }
	}
        /*
        elseif(isset($_POST['modol']))
	{
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
            }
        }
        elseif(isset($_POST['del']))
	{
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
            }
        }
        */
	else
        {
            header('location:switch.php');
        }
	?>
</body>
</html>
