<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Pago</title>
</head>
<body>
	
    
    
	<?php
        session_start();
        $_SESSION['conectar']=true;
        include ("../../sesion/conexion.php");
        
        /*
        //esto es por si viene de insertarventa
        if(isset($_GET['fromvent']))
        {
            $_POST['registrar']=true;
            $_POST['cliente']=$_GET['idcli'];
            $_POST['monto']=0;
        }
        */
        $ups2=false;
	if(isset($_POST['registrar']))
	{
            /*
            $sql11=$conexion->query("SELECT precio FROM test.dolar WHERE stat=1;");
            foreach ($sql11 as $listdol)
            {
                $dolar=$listdol['precio'];
            }
            */
            $dolar=$_SESSION['dolarcalc'];
            
            $cliente=$_POST['cliente'];
            $monto=$_POST['monto'];
            $usuario=$_SESSION['usuario_conectado'];
            $montodol=$monto/$dolar;
            //variable para determinar errores
            $ups=false;
                
            $inin1="INSERT INTO test.pago (clienteid, usuarioid, monto, fecha, stat, montodol) VALUES ('$cliente', '$usuario', '$monto', now(), 1, '$montodol');";
            $exito=$conexion->exec($inin1);
                
                        
            //si registro de pago fue exitos, ingresa            
            if($exito)
            {
                
                
                //Verificando deuda total del cliente
                $deuda=0;
                $deudadol=0;
                //Extrayendo idventa, precio y stat de la tabla venta e ingresando si esta fue correcta
                //$sql1=$conexion->query("SELECT ven.idventa, ven.montorel, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                /*$comein1=FALSE;
                foreach ($sql1 as $listsql1)
                {
                    if ($listsql1['idventa']!="")
                        $comein1=TRUE;
                }
                if ($comein1)
                {*/
                    $sql11=$conexion->query("SELECT ven.idventa, ven.montorel, ven.dolrel, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                    foreach ($sql11 as $listava)
                    {
                        if ($listava['stat']==3)
                        {
                            //extrayendo datos de la tabla venta_pago
                            $idv3=$listava['idventa'];
                            $sql3=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                            $comein1=FALSE;
                            foreach ($sql3 as $listsql3)
                            {
                                if ($listsql3['ventaid']!="")
                                    $comein1=TRUE;
                            }           
                            //si se ejecuto correctamente la sentencia sql venta_pago, ingresa
                            if ($comein1)
                            {
                                $sql31=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                                $primeravez=false;
                                foreach ($sql31 as $asignar)
                                {
                                    if ($primeravez)
                                    {
                                        $deuda=$deuda-$asignar['monto'];
                                        $deudadol=$deudadol-$asignar['montodol'];
                                    }
                                    if (!$primeravez)
                                    {
                                        $primeravez=true;
                                        $deuda=$deuda+($listava['montorel']-$asignar['monto']);
                                        $deudadol=$deudadol+($listava['dolrel']-$asignar['montodol']);
                                    }
                                }
                            }
                        }
                        elseif ($listava['stat']==1)
                        {
                            $deuda=$deuda+$listava['montorel'];
                            $deudadol=$deudadol+$listava['dolrel'];
                        }
                    }
                    //fin de calculo de deuda del cliente
                    
                                
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
                        $sql21=$conexion->query("SELECT * FROM test.pago WHERE clienteid=".$cliente." AND stat=1;");
                        $sql12=$conexion->query("SELECT ven.idventa, ven.montorel, ven.dolrel, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                        $sql13=$conexion->query("SELECT ven.idventa, ven.montorel, ven.dolrel, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                        $sql14=$conexion->query("SELECT ven.idventa, ven.montorel, ven.dolrel, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                        foreach ($sql21 as $pagos)
                        {
                                $pagoid=$pagos['idpago'];
                                $difmin=false;
                                if ($deuda<$pagos['monto'])
                                {
                                    $minimo=$deuda-$pagos['monto'];
                                    if ($minimo<10000)
                                    {
                                        $difmin=true;
                                    }
                                    else
                                        $difmin=false;
                                }
                                        
                                if ($deuda==$pagos['monto'] OR ($difmin==true && $pagos>10000))
                                {
                                    
                                    foreach ($sql12 as $p_v)
                                    {
                                        $montopv=0;
                                        $montopv2=0;
                                        $idv3=$p_v['idventa'];
                                        $sql31=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                                        if ($p_v['stat']==3)
                                        {
                                            foreach ($sql31 as $asignar)
                                            {
                                                 $montopv=$montopv+($p_v['montorel']-$asignar['monto']);
                                                 $montopv2=$montopv2+($p_v['dolrel']-$asignar['montodol']);
                                            }
                                        }
                                        else if ($p_v['stat']==1)
                                        {
                                            $montopv=$p_v['montorel'];
                                            $montopv2=$p_v['dolrel'];
                                        }
                                        if ($p_v['stat']==3 OR $p_v['stat']==1)
                                        {
                                            $ventaid=$p_v['idventa'];                                              
                                            $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat, montodol) VALUES ('$pagoid', '$ventaid', '$montopv', '1', '$montopv2');";
                                            $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                            $exito4=$conexion->exec($sql4);
                                            $exito5=$conexion->exec($sql5);
                                            $deuda=$deuda-$montopv;
                                            $deudadol=$deudadol-$montopv2;
                                            $pagos['monto']=$pagos['monto']-$montopv;
                                            $pagosdol['montodol']=$pagosdol['montodol']-$montopv2;
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
                                        $ups=true;
                                    }   
                                    if (!$exito6)
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1702<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        $ups=true;
                                    }
                                    
                                }
                                elseif ($deuda>$pagos['monto'])
                                {
                                    
                                    foreach ($sql13 as $p_v)
                                    {
                                        $montopv=0;
                                        $montopv2=0;
                                        
                                        $idv3=$p_v['idventa'];
                                        $sql32=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';");
                                        if ($p_v['stat']==3)
                                        {
                                            $primeravez2=false;
                                            foreach ($sql32 as $asignar)
                                            {
                                                if ($primeravez2)
                                                {
                                                    $montopv=$montopv-$asignar['monto'];
                                                    $montopv2=$montopv2-$asignar['montodol'];
                                                }
                                                if (!$primeravez2)
                                                {
                                                    $primeravez2=true;
                                                    $montopv=$montopv+($p_v['montorel']-$asignar['monto']);
                                                    $montopv2=$montopv2+($p_v['dolrel']-$asignar['montodol']);
                                                }
                                                
                                            /*    if ($pagos['monto']>$montopv)
                                                    $montopv=$p_v['precio'];]*/
                                            }
                                        }
                                        else if ($p_v['stat']==1)
                                        {
                                            $montopv=$p_v['montorel'];
                                            $montopv2=$p_v['dolrel'];
                                        }
                                            
                                        
                                        $ventaid=$p_v['idventa'];
                                                
                                        if ($pagos['monto']>=$montopv AND ($p_v['stat']==3 OR $p_v['stat']==1))
                                        {
                                            $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat, montodol) VALUES ('$pagoid', '$ventaid', '$montopv', '1', '$montopv2');";
                                            $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                            $exito4=$conexion->exec($sql4);
                                            $exito5=$conexion->exec($sql5);
                                            $deuda=$deuda-$montopv;
                                            $deudadol=$deudadol-$montopv2;
                                            $pagos['monto']=$pagos['monto']-$montopv;
                                            $pagosdol['montodol']=$pagos['montodol']-$montopv2;
                                        }
                                        elseif ($pagos['monto']<$montopv AND $pagos['monto']>0 AND ($p_v['stat']==3 OR $p_v['stat']==1))
                                        {
                                            $montopv=$pagos['monto'];
                                            $montopv2=$pagos['montodol'];
                                            
                                            $sql4="INSERT INTO test.pago_venta (pagoid, ventaid, monto, stat, montodol) VALUES ('$pagoid', '$ventaid', '$montopv', '1', '$montopv2');";
                                            $sql15=$conexion->query("SELECT stat FROM test.venta WHERE idventa='$ventaid';");
                                            foreach ($sql15 as $uvent)
                                            if ($uvent['stat']=1)
                                                $sql5="UPDATE test.venta SET stat=3 WHERE idventa='$ventaid';";
                                            $exito4=$conexion->exec($sql4);
                                            $exito5=$conexion->exec($sql5);
                                            $deuda=$deuda-$montopv;
                                            $deudadol=$deudadol-$montopv2;
                                            $pagos['monto']=0;
                                            $pagosdol['montodol']=0;
                                        }
                                                
                                    }
                                    if ($exito4)
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
                                        $ups=true;
                                    }
                                    if (!$exito6)
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1704<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        $ups=true;
                                    }
                                    
                                }
                                elseif ($difmin==false)
                                {/*
                                    
                                    $sql111=$conexion->query("SELECT ven.idventa, ven.precio, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                                    $comein1=FALSE;
                                    foreach ($sql111 as $listsql111)
                                    {
                                        if ($listsql111['idventa']!="")
                                            $comein1=TRUE;
                                    }

                                    //ingresando si consulta de ventas fue correcta
                                    if ($comein1)
                                    {
                                        foreach ($sql14 as $p_v)
                                        {/*
                                            $idv3=$p_v['idventa'];
                                            $sql111=$conexion->query("SELECT ven.idventa, ven.precio, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$cliente." AND ven.clienteid=cli.ci;");
                                            $comein1=FALSE;
                                            foreach ($sql111 as $listsql111)
                                            {
                                                if ($listsql111['idventa']!="")
                                                    $comein1=TRUE;
                                            }
                                        
                                         */
                                         /*
                                                $idv3=$p_v['idventa'];
                                                
                                                if ($p_v['stat']==3)
                                                {
                                                    $sql33=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid='$idv3';");
                                                    foreach ($sql33 as $asignar)
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
                                                    $exito4=$conexion->exec($sql4);
                                                    if (!$exito4)
                                                        $ups=true;
                                                    $sql5="UPDATE test.venta SET stat=2 WHERE idventa='$ventaid';";
                                                    $exito5=$conexion->exec($sql5);
                                                    if (!$exito5)
                                                        $ups=true;
                                                    $deuda=$deuda-$montopv;
                                                    $pagos['monto']=$pagos['monto']-$montopv;
                                                
                                            }
                                        }
                                    }
                                    else
                                        $montopv=$pagos['monto'];

                                        
                                    echo "Deuda: ".$deuda.", Pagos[monto]: ".$pagos['monto'];
                                    if ($deuda==0 AND $pagos['monto']>0)
                                    {
                                                //aqui lo que realmente deberia hacer es un update de ese pago especifico a stat=3
                                                //y preguntar por pagos stat=3 los cuales tendrian formula asi
                                                //[id]pago(monto)-foreach{[id]pagoventa(monto)}=monto_de_pago_por_adelantado
                                                $monto1=$pagos['monto'];
                                                $sql28=$conexion->query("SELECT * FROM test.pago WHERE clienteid=".$cliente." AND stat=1;");
                                                foreach ($sql28 as $reasignp)
                                                {
                                                    $monto2=$reasignp['monto']-$monto1;
                                                }
                                                $sql6="UPDATE test.pago SET stat=2, monto='$monto2' WHERE idpago='$pagoid';";
                                                $exito6=$conexion->exec($sql6);
                                                $sql7="INSERT INTO test.pago (clienteid, usuarioid, monto, fecha, stat) VALUES ('$cliente', '$usuario', '$monto1', now(), '1');";
                                                //Ejecutando sentencia sql7
                                                $exito7=$conexion->exec($sql7);
                                                
                                    }
                                    else
                                    {
                                        echo "<h2>Error Grave de Ejecucion</h2>";
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1705<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        $ups=true;
                                    }
                                    if (!$exito6)
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1706<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        $ups=true;
                                    }
                                    if (!$exito7)
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1707<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                        $ups=true;
                                    }*/
                                    $ups=true;
                                    $ups2=true;
                                    $sql66="UPDATE test.pago SET stat=0 WHERE idpago='$pagoid';";
                                    $sql77="UPDATE test.pago_venta SET stat=0 WHERE idpago='$pagoid';";
                                    $exito66=$conexion->exec($sql66);
                                    $exito77=$conexion->exec($sql77);
                                    echo "<h2>Error de Introduccion de Datos</h2>";
                                    echo "El monto de pago es superior al monto de la deuda<br/>";
                                    echo "El monto introducido por usted fue de: ".$_POST['monto']."<br>";
                                    echo "El monto de la deuda para este cliente es: &nbsp".$deuda."<br>";
                                    echo "Error N°: 4507<br/>";
                                    echo "<a href='backhome.html'>Volver a Inicio<br/></a>";
                                }
                                else
                                {
                                    echo "<h2>Error Grave de Ejecucion</h2>";
                                    echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                    echo "Por favor, contacte con el administrador. Error: 1718<br/>";
                                    echo "<a href='backhome.html'>Volver a Inicio</a>";
                                    $ups=true;
                                }
                                    
                                    /*if ($exito4 and $exito5 and $exito6)
                                    {
                                        echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                                        echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                                    }*/
                                    /*
                                    }
                                    else
                                    {
                                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                                        echo "Por favor, contacte con el administrador. Error: 1708<br/>";
                                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                                    }*/
                        }
                        if(!$ups)
                        {
                            //echo "<script type='text/javascript'>alert('Registro Exitoso');</script>";
                            //echo "<script type='text/javascript'>window.location.href='backhome.html';</script>";
                            header('location:backhome.html');
                        }
                    }
                    else
                    {
                        echo "Los datos se registraron parcialmente, pero con errores<br/>";
                        echo "Por favor, contacte con el administrador. Error: 1709<br/>";
                        echo "<a href='backhome.html'>Volver a Inicio</a>";
                    }
                /*}
		else
		{
                    echo "NO se registraron los datos correctamente<br/>";
                    echo "o existe un problema con la conexion a la base de datos<br/>";
                    echo "<a href='backhome.html'>Volver a Inicio</a>";
		}*/
                
            }
            else
            {
                echo "Los datos no pudieron ser registrados<br/>";
                echo "Por favor, contacte con el administrador. Error: 1710<br/>";
                echo "<a href='backhome.html'>Volver a Inicio</a>";
            }
            if ($ups)
            {
                if($ups2==false)
                {
                    echo "Los datos se registraron parcialmente, pero con errores<br/>";
                    echo "Por favor, contacte con el administrador. Error: 1711<br/>";
                    echo "<a href='backhome.html'>Volver a Inicio</a>";
                }
            }
		
	}
	else
            {
                header('location:backhome.html');
                /*
                echo "Los datos no pudieron ser registrados<br/>";
                echo "Por favor, contacte con el administrador. Error: 4042<br/>";
                echo "<a href='backhome.html'>Volver a Inicio</a>";
                 * 
                 */
            }
        
        /*
        SELECT ven.idventa, ven.monto FROM test.venta AS ven, test.cliente AS cli WHERE ven.stat=1 AND cli.stat=1 AND ven.clienteid=cli.ci;
        */
        /*
        
         */
	?>
</body>
</html>