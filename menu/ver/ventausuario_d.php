<!DOCTYPE html>

<html>
    <head>
        <title>Ver Usuario</title>
        <meta charset="UTF-8">
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    if (isset($_GET['verusu']))
                        $verusu=$_GET['verusu'];
                    else
                        $verusu=$_SESSION['verusu'];
                    $hoy=date('d-m-Y');
                    $lista=$conexion->query('SELECT ven.idventa, ven.precio, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.stat, cli.nombre, cli.ci FROM test.venta AS ven, test.cliente AS cli, test.usuario AS usu WHERE ven.clienteid=cli.ci  AND ven.usuarioid=usu.usuario AND usu.usuario="'.$verusu.'" AND (ven.stat=1 OR ven.stat=3) ORDER BY ven.fecha, ven.clienteid DESC;');
                    //$destino=$_GET['destination'];
                ?>
                
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas las Ventas" onClick="window.location.href = 'ventausuario.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Pagos Diarios" onClick="window.location.href = 'pagousuario_d.php'">
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" value="Todas los Pagos" onClick="window.location.href = 'pagousuario.php'">
                 
                    <?php
                    
                        //Ventas Diarias
                        //echo "<div id='oculto' style='visibility:visible'>";
                        
                        echo "<br><br><h1>Ventas Diarias de ".$verusu."</h1><br>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Monto</th>
                                    <th>Cliente</th>
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
                            $destination='ventausuario';
                            
                            /*
                            $hoy=date('Y-m-d');
                            echo $verusu."<br>";
                            
                            var_dump($lista);
                            */
                            foreach ($lista as $lista2)
                            {
                                //debo convertir fecha super completa en fecha completa
                                //para que funcione
                                
                               
                                    
                                    if ($lista2['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($lista2['stat']==2)
                                        $mensaje='Pagado';                                        
                                    elseif ($lista2['stat']==3)
                                        $mensaje='Pago Parcial';
                                    elseif ($lista2['stat']==0)
                                        $mensaje='Eliminada';
                                    
                                    if ($lista2['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']==$hoy)
                                    {
                                    //$lista2['precio']=$lista2['precio']/100;
                                    $lista2['precio']=number_format($lista2['precio'], 2, ",", ".");
                                        
                                    echo "<tr>"
                                            . "<th>"
                                                . "<a href='".$destino.".php?idven=".$lista2['idventa']."&idcli=".$lista2['nombre']."&destination=".$destination."&verusu=".$verusu."'>".$lista2['precio']."</a>"
                                            . "</th>"
                                            . "<td>".$lista2['nombre']."</td>"
                                            . "<td>".$mensaje."</td>"
                                        . "</tr>";
                                    }
                                
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
