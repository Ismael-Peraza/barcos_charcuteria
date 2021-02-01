<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Nueva Venta</title>
        
        <?php
            include ("menuscroll.php");
        ?>
        
        <div class="anchito2">
        
            <div class="formulario2">
            <form name="formaddven" action="procesar/insertarventa.php" method="POST">
                <fieldset>
                    <legend>Ingresar Nueva Venta:</legend><br>
                    
                    <!--Esto no deberia ir aqui sino en modulo aparte al que se le haria require (el de clientex es igual-->
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
                    ?>
                    
                    
                    <!--Esto es lo unico que deberia estar aqui-->
                        <?php
                            echo "Deuda Vieja: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class='formulario2' type='text' name='precio' value='".$deuda."' disabled/><br>";
                            echo "Deuda Nueva: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input class='formulario2' type='text' name='precio' value='".$deudon."' disabled/><br>";
                            echo "Deuda Nueva en Dolar: &nbsp<input class='formulario2' type='text' name='precio' value='".$deudadol."' disabled/><br><br>";
                            echo "<input type='hidden' name='cliente' value='".$_GET['verid']."'/>";
                            echo "Cliente: <input class='formulario2' type='text' name='nombrecli' value='".$_GET['vercli']."' disabled/><br>";
                        ?>
                        &nbsp&nbsp&nbsp&nbsp&nbsp;
                        Monto: <input class="formulario2" type="text" name="precio" placeholder="p.ej: 5400" required/> Bs<br>
                        Articulos: <br><textarea class="formulario2" rows="10" cols="40" name="articulos" placeholder="p.ej: 1/2 Frijol, 3 Harinas, 1 Azucar, 850 Bs Jamon, Crema Baragueña, 2L Leche Merilac, etc." required></textarea><br><br>
                        <button class="formulario2" type="submit" class="boton-2" name="registrar">Procesar</button>
                </fieldset>
            </form>
            </div>
        </div>
        
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>