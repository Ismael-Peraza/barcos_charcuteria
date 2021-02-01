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
        //esto es para extender el tiempo de ejecucion del codigo a 2 minutos
        ini_set('max_execution_time',120);
        
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
            
            //Esto no deberia estar, sino lo que esta mas abajo
            $dolarito=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1';");
            foreach ($dolarito as $listupdol83)
            {
                $idup3=$listupdol83['precio'];
            }
            //Esto es lo que deberia estar, sera comprobado mas adelante
            $idup3=$_SESSION['dolarcalc'];
            //Comprobando que el valor del dolar no tenga un cero (0) de mas o de menos
            $doble=$idup3*2;
            $medio=$idup3/2;
            
            //Si el monto es correcto procede
            if ( ($precio < $doble) || ($precio > $medio)) 
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
                            
                            //Actualizando precio de los articulos
                            $articulos=$conexion->query('SELECT art.idarticulo, art.precarticulo, art.precdol, art.stat, dol.precio FROM test.articulo as art, test.dolar as dol WHERE art.stat=1 AND dol.stat=1;');
                            foreach ($articulos as $listart)
                            {           
                                $badart=false;
                                $idarticulo=$listart['idarticulo'];
                                $dolar=$listart['precio'];
                                $precioart1=$listart['precarticulo'];
                                $precioart2=bcmul($listart['precdol'],$dolar,4);
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
                        //si el nuevo precio del dolar es insertado correctamente, entonces procede
                        if($exito)
			{   
                            //NO deberia estar esto desde aqui:
                            $querydolar=$conexion->query('SELECT precio FROM test.dolar WHERE stat=1;');
                            foreach ($querydolar as $listdol)
                            {
                                $dolar=$listdol['precio'];
                                $goboy=true;
                            }
                            
                            if($goboy)
                            {
                                //                          ^
                                //hasta la linea de arriba--:
                                //Deberia estar lo que sigue:
                                //$dolar=precio
                                //o en vez de utilizar la variable dolar, usar directamente precio
                                
                                //Actualizando Monto de Deuda para las Ventas
                                $ventas=$conexion->query('SELECT ven.idventa, ven.precio, ven.preciodol, ven.montorel, ven.stat FROM test.venta as ven WHERE (ven.stat=1 OR ven.stat=3) AND ven.fecha>"2020-11-28";');
                                foreach ($ventas as $listven)
                                {   
                                    $badven=false;        
                                    $idventa=$listven['idventa'];
                                    $precioventa=$listven['precio'];
                                    $precioventa2=bcmul($listven['preciodol'],$dolar,4);
                                    $precioventa3=$listven['montorel'];
                                
                                    if(($precioventa3<$precioventa2) && ($precioventa3<>null))
                                    {
                                        $sql84="UPDATE test.venta SET montorel='".$precioventa2."' WHERE idventa='".$idventa."';";
                                        $exito55=$conexion->exec($sql84);
                                        echo "Actualizando Valores... por favor espere...<br>";
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
                                        round($relativo, 0, PHP_ROUND_HALF_UP);
                                        $dolarfluc=bcdiv($relativo,$dolar,15);
                                        //round($dolarfluc, 14, PHP_ROUND_HALF_UP);
                                        $sql94="UPDATE test.venta SET preciodol='".$dolarfluc."' WHERE idventa='".$idventa."';";
                                        $exito75=$conexion->exec($sql94);
                                        if($exito75)
                                        {
                                            $baddolrel=false;
                                        }
                                        else
                                        {
                                            $baddolrel=true;
                                            echo $sql94."<br/>";
                                        }
                                    }  
                                }
                            }
                            else
                            {
                               $dolerror=true;
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
                            echo "Y esto fue lo que paso: <br/>";
                            echo "Sql: <br/>".$sql84."<br/>";
                            echo "Precioventa1: <br/>".$precioventa."<br/>";
                            echo "Precioventa2: <br/>".$precioventa2."<br/>";
                            echo "Precioventa3: <br/>".$precioventa3."<br/>";
                            echo "Dolar: <br/>".$dolar."<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                        
                        if($badart)
                        {
                            echo "NO se registraron los datos correctamente en los Articulos<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "El sql en articulos es: ".$sql24."<br/>";
                            echo "El dolar en articulos es: ".$dolar."<br/>";
                            echo "El precioart1 en articulos es: ".$precioart1."<br/>";
                            echo "El precdol en articulos es: ".$listart['precdol']."<br/>";
                            echo "El precioart2 en articulos es: ".$precioart2."<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                        
                        if($baddolrel)
                        {
                            //Esto lo pondre aqui mientras arreglo el bug
                            header('location:../../home4.php');
                            //Lo que viene si va aqui:
                            echo "NO se registraron los datos correctamente en los Precio Dolar Venta<br/>";
                            echo "o existe un problema con la conexion a la base de datos<br/>";
                            echo "Y esto fue lo que paso: <br/>";
                            echo "Sql: <br/>".$sql94."<br/>";
                            echo "Dolarfluc: <br/>".$dolarfluc."<br/>";
                            echo "Relativo: <br/>".$relativo."<br/>";
                            echo "Dolar: <br/>".$dolar."<br/>";
                            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                        }
                if ($dolerror==false AND $badven==false AND $badart==false AND $baddolrel==false)
                {
                    header('location:../../home4.php');
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
	else
        {
            header('location:switch.php');
        }
	?>
</body>
</html>
