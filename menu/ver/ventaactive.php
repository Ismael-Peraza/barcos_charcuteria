<!DOCTYPE html>

<html>
    <head>
        <title>Ventas Pendientes de Pago</title>
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE ven.clienteid=cli.ci ORDER BY ven.clienteid DESC, ven.fecha;');
                    //$destino=$_GET['destination'];
                ?>
                
                &nbsp;
                <input type="button" value="Ventas Diarias" onClick="window.location.href = 'ventadiary.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Ventas Pendientes de Pago" onClick="window.location.href = '#'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas las Ventas" onClick="window.location.href = 'ventaall.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Morosos" onClick="window.location.href = 'morosos.php'">
                    <?php
                    
                    //Ventas Pendientes de Pago
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
                                    
                                    //$listaven['precio']=$listaven['precio']/100;
                                    $listaven['precio']=number_format($listaven['precio'], 2, ",", ".");
                                    echo "<tr><th><a href='".$destino.".php?idven=".$listaven['idventa']."&idcli=".$listaven['nombre']."&destination=".$destination."'>".$listaven['nombre']."</a></th><td>".$listaven['precio']."</td><td>".$listaven['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</td><td>".$mensaje."</td></tr>";
                                }
                            }
                            echo "</table>";
                        
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
