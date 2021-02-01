<!DOCTYPE html>

<html>
    <head>
        <title>Todas Las Ventas</title>
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.clienteid=cli.ci AND (ven.stat=1 or ven.stat=3 or ven.stat=4 or ven.stat=5)) ORDER BY ven.fecha, ven.clienteid DESC;');
                    //$destino=$_GET['destination'];
                ?>
                
                &nbsp;
                <input type="button" value="Ventas Diarias" onClick="window.location.href = 'ventadiary.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Ventas Pendientes de Pago" onClick="window.location.href = 'ventaactive.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas las Ventas" onClick="window.location.href = '#'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Morosos" onClick="window.location.href = 'morosos.php'">
                    <?php
                        //Ventas Diarias
                        //echo "<div id='oculto' style='visibility:visible'>";
                        
                        echo "<br><br><h1>Todas las Ventas</h1>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Cliente</th>
                                    <th>Precio</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>";

                            //aqui deberia usar un between para que solo me muestre
                            //resultados del ultimmo mes
                            $fechaahora=date('d-m-Y');
                            
                            if (isset($_GET['destination']))
                            {
                                $destino=$_GET['destination'];
                            }
                            else
                            {
                                $destino="ventax";
                            }
                            $destination='ventaall';
                            
                            foreach ($ventas as $listaven)
                            {
                                    if ($listaven['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($listaven['stat']==2)
                                        $mensaje='Pagado';                                        
                                    elseif ($listaven['stat']==3)
                                        $mensaje='Pago Parcial';                                          
                                    elseif ($listaven['stat']==4)
                                        $mensaje='Vieja - Pendiente';                                         
                                    elseif ($listaven['stat']==5)
                                        $mensaje='Vieja - Pago Parcial'; 
                                    
                                    //$listaven['precio']=$listaven['precio']/100;
                                    $listaven['precio']=number_format($listaven['precio'], 2, ",", ".");
                                    echo "<tr><th><a href='".$destino.".php?idven=".$listaven['idventa']."&idcli=".$listaven['nombre']."&destination=".$destination."'>".$listaven['nombre']."</a></th><td>".$listaven['precio']."</td><td>".$listaven['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</td><td>".$mensaje."</td></tr>";
                            }
                            echo "</table>";
                        //echo "</div>";
                        
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