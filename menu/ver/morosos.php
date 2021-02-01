<!DOCTYPE html>

<html>
    <head>
        <title>Ventas Pendientes de Pago</title>
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                
                <!--Botones-->
                &nbsp;
                <input type="button" value="Ventas Diarias" onClick="window.location.href = 'ventadiary.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Ventas Pendientes de Pago" onClick="window.location.href = 'ventaactive.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas las Ventas" onClick="window.location.href = 'ventaall.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Morosos" onClick="window.location.href = '#'">
                
                <?php
                
                    echo "<br><br><h1>Ventas Pendientes de Pago</h1>";

                        echo "<table id=t01>";

                        echo
                            "<tr>
                                <th>Cliente</th>
                                <th>Monto</th>
                            </tr>";
                        
                        //Para enlazar a otras paginas
                        if (isset($_GET['destination']))
                        {
                            $destino=$_GET['destination'];
                        }
                        else
                        {
                            $destino="clientex";
                        }
                        $destination='morosos'; 
                
                    //$destino=$_GET['destination'];
                    //$deuda=0;
                    //$sql11=$conexion->query("SELECT ven.idventa, ven.precio, ven.stat FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=".$verid." AND ven.clienteid=cli.ci;");
                    $morosos=$conexion->query("SELECT * FROM test.cliente WHERE stat=1 ORDER BY nombre;");
                    //$ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=cli.ci ORDER BY ven.clienteid DESC, ven.fecha;');
                    $deudores=array();
                    foreach ($morosos as $paguenme)
                    {   
                        $clienteid=$paguenme['ci'];
                        $clientenom=$paguenme['nombre'];
                        $deuda=0;
                        $ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid='.$clienteid.' AND ven.clienteid=cli.ci ORDER BY ven.clienteid DESC, ven.fecha;');
                        $mostrar=false;
                        
                        foreach ($ventas as $listava)
                        {
                            if ($listava['stat']==3 AND $listava['clienteid']==$clienteid)
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
                                    foreach ($sql31 as $asignar)
                                    {
                                         $deuda=$deuda+($listava['precio']-$asignar['monto']);
                                    }
                                }
                            }
                            elseif ($listava['stat']==1 AND $listava['clienteid']==$clienteid)
                            {
                                $deuda=$deuda+$listava['precio'];
                            }
                            
                            if (($listava['stat']=='1' OR $listava['stat']=='3') AND $listava['clienteid']==$clienteid)
                            {
                                $mostrar=true;
                                /*
                                if ($listava['stat']==1)
                                    $mensaje='Pendiente';
                                else
                                    $mensaje='Pago Parcial';
                                
                                echo "<tr><th><a href='".$destino.".php?idven=".$listava['idventa']."&idcli=".$listava['nombre']."&destination=".$destination."&verid".$clienteid."&vercli".$clientenom."'>".$clientenom."</a></th><td>".$listava['precio']."</td><td>".$listava['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</td><td>".$mensaje."</td></tr>";
                                */
                            }
                            else
                            {$mostrar=false;}
                            
                        }
                        //fin de calculo de deuda del cliente
                        if ($mostrar==true)
                        {
                            //$deuda=$deuda/100;
                            $deuda=number_format($deuda, 2, ",", ".");
                            echo "<tr><th><a href='".$destino.".php?destination=".$destination."&verid=".$clienteid."&vercli=".$clientenom."&morosos=si'>".$clientenom."</a></th><td>".$deuda."</td></tr>";
                        }
                    }
                    echo "</table>";
                ?>
                
                
                    <?php
                    
                    //Ventas Pendientes de Pago
                    
                        /*
                        echo "<br><br><h1>Ventas Pendientes de Pago</h1>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>";
                            
                            if (isset($_GET['destination']))
                            {
                                $destino=$_GET['destination'];
                            }
                            else
                            {
                                $destino="ventax";
                            }
                            $destination='ventaactive'; 
                            
                            foreach ($ventas as $listaven)
                            {  
                                if ($listaven['stat']=='1' OR $listaven['stat']=='3')
                                {
                                    if ($listaven['stat']==1)
                                        $mensaje='Pendiente';
                                    else
                                        $mensaje='Pago Parcial';
                                    echo "<tr><th><a href='".$destino.".php?idven=".$listaven['idventa']."&idcli=".$listaven['nombre']."&destination=".$destination."'>".$listaven['nombre']."</a></th><td>".$listaven['precio']."</td><td>".$listaven['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</td><td>".$mensaje."</td></tr>";
                                }
                            }
                            echo "</table>";
                        */
                    ?>
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
