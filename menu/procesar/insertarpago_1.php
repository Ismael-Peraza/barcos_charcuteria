<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Pago</title>
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
		$monto=$_POST['monto'];
                $usuario=$_SESSION['usuario_conectado'];
                
                        //Extrayendo idventa y precio de la tabla venta
			$sql="SELECT ven.idventa, ven.precio, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND (ven.clienteid=".$cliente."  AND ven.clienteid=cli.ci) AND cli.stat=1;";
			//Ejecutando sentencia "sql"
                        $exito=$conexion->exec($sql);
                        var_dump($exito);
                        //Si la sentencia "sql" se ejecuto correctamete, entra
                        $empezemos=$conexion->query('SELECT ven.idventa, ven.precio, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid='.$cliente.' AND cli.ci='.$cliente.' AND ven.clienteid=cli.ci AND cli.stat=1;');
                        
                        print_r($cliente);                        print_r($monto);
                        print_r($exito);                        print_r($empezemos);
			if($exito)
			{
                            //Ingresando datos en la tabla venta
                            $sql2="INSERT INTO test.pago (clienteid, usuarioid, monto, fecha, stat) VALUES ('$cliente', '$usuario', '$monto', now(), '1');";
                            //Ejecutando sentencia sql2
                            $exito2=$conexion->exec($sql2);
                            //Si la sentencia sql2 se ejecuto correctamete, entra
                            if ($exito2)
                            {
                                //Verificando deuda total del cliente
                                $deuda=0;
                                //$stat3=array();
                                foreach ($sql as $listava)
                                {
                                    if ($listava['stat']==3)
                                    {
                                        $idv3=$listava['idventa'];
                                        $pvs3="SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';";
                                        $exitoidv3=$conexion->exec($pvs3);
                                        foreach ($pvs3 as $asignar)
                                        {
                                            $deuda=$deuda+($listava['precio']-$asignar['monto']);
                                        }
                                            //$stat3[]=$listava['idventa'];
                                    }
                                    elseif ($listava['stat']==1)
                                    {
                                        $deuda=$deuda+$listava['precio'];
                                    }
                                }
                                
                                //Extrayendo datos de la tabla pago
                                $sql3="SELECT * FROM test.pago where clienteid='$cliente' and stat=1;";
                                $exito3=$conexion->exec($sql3);
                                
                                //Verificando pago global del cliente
                                
                                //$apagar=0;
                                foreach ($sql3 as $pagos)
                                {
                                    //Si la sentencia sql3 se ejecuto correctamete, entra
                                    if ($exito3)
                                    {
                                        $pagoid=$pagos['idpago'];
                                    //contador en 0 y limite maximo de vueltas
                                    /*
                                    $cont=$limit=0;
                                    $limit=$sql->rowCount();
                                     * 
                                     */
                                    
                                    
                                        //$sql="SELECT ven.idventa, ven.precio FROM test.venta AS ven, test.cliente AS cli WHERE ven.stat=1 AND cli.stat=1 AND ven.clienteid=cli.ci;";
                                        if ($deuda==$pagos['monto'])
                                        {
                                            
                                            foreach ($sql as $p_v)
                                            {
                                                $idv3=$p_v['idventa'];
                                                $pvs3="SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';";
                                                $exitoidv3=$conexion->exec($pvs3);
                                                if ($p_v['stat']==3)
                                                {
                                                    foreach ($pvs3 as $asignar)
                                                    {
                                                        $montopv=$p_v['precio']-$asignar['monto'];
                                                    }
                                                }
                                                else if ($p_v['stat']==1)
                                                    {$montopv=$p_v['precio'];}  
                                                if ($p_v['stat']==3 OR $p_v['stat']==1)
                                                {
                                                    $ventaid=$p_v['idventa'];                                              
                                                    $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat) VALUES ('$pagoid', '$ventaid', '$montopv', '1');";
                                                    $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                                    $exito4=$conexion->exec($sql4);
                                                    $exito5=$conexion->exec($sql5);
                                                    $deuda=$deuda-$montopv;
                                                    $pagos['monto']=$pagos['monto']-$montopv;
                                                }
                                            }
                                            if ($exito4 AND $exito5)
                                            {
                                                $sql6="UPDATE test.pago SET stat=2 WHERE idpago='$pagoid';";
                                                $exito6=$conexion->exec($sql6);
                                            }
                                            else
                                            {
                                                echo "<h2>Error Grave de Ejecucion</h2>";
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1701<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }   
                                            if (!$exito6)
                                            {
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1702<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }
                                        }
                                        elseif ($deuda>$pagos['monto'])
                                        {
                                            
                                            foreach ($sql as $p_v)
                                            {
                                                $idv3=$p_v['idventa'];
                                                $pvs3="SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';";
                                                $exitoidv3=$conexion->exec($pvs3);
                                                if ($p_v['stat']==3)
                                                {
                                                    foreach ($pvs3 as $asignar)
                                                    {
                                                        $montopv=$p_v['precio']-$asignar['monto'];
                                                    }
                                                }
                                                else if ($p_v['stat']==1)
                                                    {$montopv=$p_v['precio'];}
                                                $ventaid=$p_v['idventa'];
                                                
                                                if ($pagos['monto']>=$montopv AND ($p_v['stat']==3 OR $p_v['stat']==1))
                                                {
                                                    $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat) VALUES ('$pagoid', '$ventaid', '$montopv', '1');";
                                                    $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                                    $exito4=$conexion->exec($sql4);
                                                    $exito5=$conexion->exec($sql5);
                                                    $deuda=$deuda-$montopv;
                                                    $pagos['monto']=$pagos['monto']-$montopv;
                                                }elseif ($pagos['monto']<$montopv AND $pagos['monto']>0 AND ($p_v['stat']==3 OR $p_v['stat']==1))
                                                {
                                                    $montopv=$pagos['monto'];
                                                    $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat) VALUES ('$pagoid', '$ventaid', '$montopv', '1');";
                                                    $sql5="UPDATE test.venta SET stat=3 WHERE idventa='$ventaid';";
                                                    $exito4=$conexion->exec($sql4);
                                                    $exito5=$conexion->exec($sql5);
                                                    $deuda=$deuda-$montopv;
                                                    $pagos['monto']=0;
                                                }
                                                
                                            }
                                            if ($exito4 AND $exito5)
                                            {
                                                $sql6="UPDATE test.pago SET stat=2 WHERE idpago='$pagoid';";
                                                $exito6=$conexion->exec($sql6);
                                            }
                                            else
                                            {
                                                echo "<h2>Error Grave de Ejecucion</h2>";
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1703<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }
                                            if (!$exito6)
                                            {
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1704<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }
                                        }
                                        elseif ($deuda<$pagos['monto'])
                                        {
                                            foreach ($sql as $p_v)
                                            {
                                                $idv3=$p_v['idventa'];
                                                $pvs3="SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';";
                                                $exitoidv3=$conexion->exec($pvs3);
                                                if ($p_v['stat']==3)
                                                {
                                                    foreach ($pvs3 as $asignar)
                                                    {
                                                        $montopv=$p_v['precio']-$asignar['monto'];
                                                    }
                                                }
                                                else if ($p_v['stat']==1)
                                                    {$montopv=$p_v['precio'];}
                                                $ventaid=$p_v['idventa'];
                                                
                                                if ($p_v['stat']==3 OR $p_v['stat']==1)
                                                {
                                                    $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat) VALUES ('$pagoid', '$ventaid', '$montopv', '1');";
                                                    $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                                    $exito4=$conexion->exec($sql4);
                                                    $exito5=$conexion->exec($sql5);
                                                    $deuda=$deuda-$montopv;
                                                    $pagos['monto']=$pagos['monto']-$montopv;
                                                }
                                                
                                            }
                                            if ($exito4 AND $exito5)
                                            {
                                                //aqui lo que realmente deberia hacer es un update de ese pago especifico a stat=3
                                                //y preguntar por pagos stat=3 los cuales tendrian formula asi
                                                //[id]pago(monto)-foreach{[id]pagoventa(monto)}=monto_de_pago_por_adelantado
                                                $sql6="UPDATE test.pago SET stat=2 WHERE idpago='$pagoid';";
                                                $exito6=$conexion->exec($sql6);
                                                $monto=$pagos['monto'];
                                                $sql7="INSERT INTO test.pago (clienteid, usuarioid, monto, fecha, stat) VALUES ('$cliente', '$usuario', '$monto', now(), '1');";
                                                //Ejecutando sentencia sql7
                                                $exito7=$conexion->exec($sql7);
                                            }
                                            else
                                            {
                                                echo "<h2>Error Grave de Ejecucion</h2>";
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1705<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }
                                            if (!$exito6 OR !$exito7)
                                            {
                                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                                echo "Por favor, contacte con el administrador. Error: 1706<br/>";
                                                echo "<a href='backhome.html'>Volver a Inicio</a>";
                                            }
                                            else
                                            {
                                                echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                                                echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<h2>Error Grave de Ejecucion</h2>";
                                            echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                            echo "Por favor, contacte con el administrador. Error: 1707<br/>";
                                            echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        }
                                    
                                    /*if ($exito4 and $exito5 and $exito6)
                                    {
                                        echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                                        echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                                    }*/
                                    
                                    }
                                    else
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1708<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                    }
                                }
                            }
                            else
                            {
                                echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                echo "Por favor, contacte con el administrador. Error: 1708<br/>";
				echo "<a href='backhome.html'>Volver a Inicio</a>";
                            }
			}
			else
			{
				echo "NO se registraron los datos correctamente<br/>";
                                echo "o existe un problema con la conexion a la base de datos<br/>";
				echo "<a href='backhome.html'>Volver a Inicio</a>";
			}
		/*}
		else
		{
			echo "Las contraseñas deben ser identicas<br/>";
			echo "<a href='registrar.html'>Intentar de Nuevo</a>";
		}*/
	}
	else
            {header('location:backhome.html');}
        
        /*
        SELECT ven.idventa, ven.monto FROM test.venta AS ven, test.cliente AS cli WHERE ven.stat=1 AND cli.stat=1 AND ven.clienteid=cli.ci;
        */
        /*
        
         */
	?>
</body>
</html>