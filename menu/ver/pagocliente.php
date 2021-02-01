<!DOCTYPE html>

<html>
    <head>
        <title>Pagos Diarios</title>
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $verid=$_GET['verid'];
                    $vercli=$_GET['vercli'];
                    $pagos=$conexion->query('SELECT pag.idpago, DATE_FORMAT(pag.fecha, "%d-%m-%Y"), pag.monto, pag.stat, pag.usuarioid FROM test.pago AS pag, test.cliente AS cli, test.usuario AS usu WHERE pag.clienteid=cli.ci AND pag.usuarioid=usu.usuario AND cli.ci='.$verid.' AND pag.stat=2 ORDER BY pag.fecha, pag.clienteid;');
                    //$destino=$_GET['destination'];
                
                    if (isset($_GET['morosos']))
                    {
                        if ($_GET['morosos']=='si')
                            $vamos='morosos.php';
                        else
                            $vamos='clientex.php';
                    }
                    else
                    {
                        $vamos='clientex.php';
                    }
                    
                ?>
                
                &nbsp;
                <?php
                if ($_SESSION['status']==1)
                {
                    echo "<input type='button' class='boton-2' value='Agregar Pago' onClick='window.location.href='../addpago.php?verid=".$verid."&vercli=".$vercli."''>";
                }?>
                &nbsp&nbsp;
                <input type="button" class="boton-2" value="Agregar Venta" onClick="window.location.<?php echo "href='../addventa.php?verid=".$verid."&vercli=".$vercli."'"?>">
                &nbsp&nbsp;
                <input type="button" class="boton-2" value="Regresar" onClick="window.location.<?php echo "href='".$vamos."?verid=".$verid."&vercli=".$vercli."&morosos=".$_GET['morosos']."'"?>">
                
                    <?php
                    
                        //Ventas Diarias
                        //echo "<div id='oculto' style='visibility:visible'>";
                        
                        echo "<br><br><h1>Pagos del Cliente</h1><br>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Usuario</th>
                                </tr>";

                            $fechaahora=date('d-m-Y');
                            
                            if (isset($_GET['destination']))
                            {
                                $destino=$_GET['destination'];
                            }
                            else
                            {
                                $destino="ventax";
                            }
                            $destination='ventacliente';
                            
                            
                            foreach ($pagos as $listapag)
                            {
                                //debo convertir fecha super completa en fecha completa
                                //para que funcione
                                
                                $nuevafecha = strtotime ( '-7 day' , strtotime ( $fechaahora ) ) ;
                                /*
                                    if ($listapag['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($listapag['stat']==2)
                                        $mensaje='Pagado';                                        
                                    elseif ($listapag['stat']==3)
                                        $mensaje='Pago Parcial';  
                                    */
                                    //$listapag['monto']=$listapag['monto']/100;
                                    $listapag['monto']=number_format($listapag['monto'], 2, ",", ".");
                                    echo "<tr>"
                                            . "<th>".$listapag['DATE_FORMAT(pag.fecha, "%d-%m-%Y")']."</th>"
                                            . "<td>".$listapag['monto']."</td>"
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