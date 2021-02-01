<!DOCTYPE html>

<html>
    <head>
        <title>Ver Cliente</title>
        <?php
            include ('menuscroll.php');
        ?>
            <div class="anchito">
        
                
        
                    <?php
                    $verid=$_GET['verid'];
                    $vercli=$_GET['vercli'];
                    
                    //Para enlazar a otras paginas
                        if (isset($_GET['destination']))
                        {
                            $destino=$_GET['destination'];
                            $destination='clientex';
                            if (isset($_GET['morosos']))
                            {
                                $morosos='si';
                            }
                        }
                        else
                        {
                            $destino="../seecliente";
                            $destination='ver/clientex';
                            $morosos='no';
                        }
                        
                    
                    $deuda=0;
                    $deudadol=0;
                    $deudon=0;
                    $deudabol=0;
                    $sql11=$conexion->query("SELECT ven.idventa, ven.precio, ven.stat, ven.dolrel, ven.fecha, ven.montorel FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3 OR ven.stat=4 OR ven.stat=5) AND ven.clienteid=".$verid." AND ven.clienteid=cli.ci;");
                    foreach ($sql11 as $listava)
                    {
                        if ($listava['stat']==3 OR $listava['stat']==5)
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
                            
                            //para que no haga doble suma de deuda
                            $one=true;
                            if ($comein1)
                            {
                                $sql31=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                                foreach ($sql31 as $asignar)
                                {
                                    if ($one)
                                    {
                                        if ($listava['fecha']>='2020-11-29')
                                        {
                                            $deudadol=$deudadol+($listava['dolrel']-$asignar['montodol']);
                                            $deudon=$deudon+($listava['montorel']-$asignar['monto']);
                                            $deudabol=$deudabol+($listava['precio']-$asignar['monto']);
                                        }
                                        if ($listava['fecha']<'2020-11-29')
                                        {
                                            $deuda=$deuda+($listava['precio']-$asignar['monto']);
                                        }
                                    }
                                    else
                                    {
                                        if ($listava['fecha']>='2020-11-29')
                                        {                                            
                                            $deudadol=$deudadol-$asignar['montodol'];
                                            $deudon=$deudon-$asignar['monto'];
                                        }
                                        if ($listava['fecha']<'2020-11-29')
                                        {
                                            $deuda=$deuda-$asignar['monto'];
                                        }
                                    }
                                    $one=false;
                                }
                            }
                        }
                        elseif ($listava['stat']==1 OR $listava['stat']==4)
                        {
                            if ($listava['fecha']>='2020-11-29')
                            {
                                $deudadol=$deudadol+$listava['dolrel'];
                                $deudon=$deudon+$listava['montorel'];
                                $deudabol=$deudabol+$listava['precio'];
                            }
                            if ($listava['fecha']<'2020-11-29')
                            {
                               $deuda=$deuda+$listava['precio'];
                            }
                        }
                    }
                    //$deuda=$deuda/100;
                    $deudadol=number_format($deudadol, 2, ",", ".");
                    $deudon=number_format($deudon, 0, ",", ".");
                    $deuda=number_format($deuda, 0, ",", ".");
                    $deudabol=number_format($deudabol, 0, ",", ".");
                    //fin de calculo de deuda del cliente
                    
                    /*
                        if ($ventax['stat']==1)
                            $estatus='No Pagada';
                        elseif ($ventax['stat']==2)
                            $estatus='Pagada';
                        elseif($ventax['stat']==3)
                            $estatus='Pagada Parcialmente';
                         */
                    
                    
                    ?>
                    <!--hasta aqui-->
                <div class="formulario2">
                    <form name="formaddusu">
                    <fieldset>
                        <legend>Deuda del Cliente:</legend><br>
                            <?php
                                //1=cliente, 2=usuario, 3=venta, 4=pago
                                $procedencia='clientex';
                                
                                echo "Cliente: <input class='formulario2' type='text' name='id' value='".$vercli."' disabled/><br>&nbsp;";
                                echo "Deuda Vieja: <input class='formulario2' type='text' name='precio' value='".$deuda."' disabled/><br>";
                                //echo "Comprado: <input class='formulario2' type='text' name='precio' value='".$deudabol."' disabled/><br>";
                                echo "Deuda Dolar: <input class='formulario2' type='text' name='precio' value='".$deudadol."' disabled/><br>";
                                echo "Monto a Pagar: <input class='formulario2' type='text' name='precio' value='".$deudon."' disabled/><br>";
                                echo "<input type='hidden' name='idcli' value='".$verid."'/><br>";
                            ?>
                                <input type="button" class="boton-2" value="Compras" onClick="window.location.<?php echo "href='ventacliente.php?verid=".$verid."&vercli=".$vercli."&morosos=".$morosos."'"?>">
                                <input type="button" class="boton-2" value="Pagos" onClick="window.location.<?php echo "href='pagocliente.php?verid=".$verid."&vercli=".$vercli."&morosos=".$morosos."'"?>">
                                <?php
                                if ($_SESSION['status']==1)
                                    echo "<input type='button' class='boton-2' value='Modificar' onClick='window.location.'href='../updates/updatecliente.php?verid=".$verid."&vercli=".$vercli."'>"?>
                                <input type="button" class="boton-2" value="Regresar" onClick="window.location.<?php echo "href='".$destino.".php?destination=".$destination."'"?>">
                                
                    </fieldset>
                    </form>
                    
                    
                    
                                                                                      
                </div>
               
            </div>
        
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>
