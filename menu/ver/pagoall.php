<!DOCTYPE html>

<html>
    <head>
        <title>Todos los Pagos</title>
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $ventas=$conexion->query('SELECT pag.idpago, pag.fecha, pag.monto, pag.clienteid, pag.stat, cli.nombre, pag.usuarioid FROM test.pago AS pag, test.cliente AS cli, test.usuario AS usu WHERE pag.clienteid=cli.ci AND pag.usuarioid=usu.usuario ORDER BY pag.clienteid, pag.fecha;');
                    //$destino=$_GET['destination'];
                ?>
                
                &nbsp;
                <input type="button" value="Pagos del Dia" onClick="window.location.href = 'pagodiary.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas los Pagos" onClick="window.location.href = '#'">
                    <?php
                    $destino="clientex";
                        //Ventas Diarias
                        //echo "<div id='oculto' style='visibility:visible'>";
                        
                        echo "<br><br><h1>Todos los Pagos</h1>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                </tr>";

                            $fechaahora=date('Y-m-d');
                            
                            foreach ($ventas as $listapag)
                            {/*
                                    if ($listaven['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($listaven['stat']==2)
                                        $mensaje='Pagado';                                        
                                    elseif ($listaven['stat']==3)
                                        $mensaje='Pago Parcial';  
                               */   
                                    //$listapag['monto']=$listapag['monto']/100;
                                    $listapag['monto']=number_format($listapag['monto'], 2, ",", ".");
                                    echo "<tr>"
                                            . "<th>".$listapag['nombre']."</th>"
                                            . "<td>".$listapag['monto']."</td>"
                                            . "<td>".$listapag['fecha']."</td>"
                                            . "<td>".$listapag['usuarioid']."</td>"
                                        . "</tr>";
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