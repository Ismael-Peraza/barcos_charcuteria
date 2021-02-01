<!DOCTYPE html>

<html>
    <head>
        <title>Ventas del Dia</title>
        <meta charset="UTF-8">
        <?php
            include ('menuscroll.php');
        ?>
        <div class="anchito3">
        
            <div class="lista1">                
                <div class="nota">
                <?php
                    $verid=$_GET['verid'];
                    $vercli=$_GET['vercli'];
                    $ventaja=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.stat, ven.dolrel, ven.preciodol, usu.usuario, ven.montorel FROM test.venta AS ven, test.cliente AS cli, test.usuario AS usu WHERE ven.clienteid=cli.ci AND ven.usuarioid=usu.usuario AND cli.ci='.$verid.' AND (ven.stat=1 OR ven.stat=3 OR ven.stat=4 OR ven.stat=5)  ORDER BY ven.fecha, ven.clienteid;');
                    $ventafecha=$conexion->query('SELECT ven.idventa, ven.fecha, ven.stat FROM test.venta AS ven, test.cliente AS cli, test.usuario AS usu WHERE ven.clienteid=cli.ci AND ven.usuarioid=usu.usuario AND cli.ci='.$verid.' AND (ven.stat=1 OR ven.stat=3 OR ven.stat=4 OR ven.stat=5)  ORDER BY ven.fecha, ven.clienteid;');
                    //$ventas2=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.stat, usu.usuario FROM test.venta AS ven, test.cliente AS cli, test.usuario AS usu WHERE ven.clienteid=cli.ci AND ven.usuarioid=usu.usuario AND cli.ci='.$verid.' ORDER BY ven.fecha DESC, ven.clienteid;');
                    //$destino=$_GET['destination'];
                    
                    $nota=$conexion->query('SELECT comentario, usuarioid, DATE_FORMAT(fecha, "%d-%m-%Y") FROM test.notas WHERE clienteid='.$verid.';');
                    if($nota->rowCount()>0)
                    {
                        foreach ($nota as $listnota)
                        {
                            $coment=$listnota['comentario'];
                            $usunota=$listnota['usuarioid'];
                            $fechanota=$listnota['DATE_FORMAT(fecha, "%d-%m-%Y")'];
                        }
                    }
                    else
                    {
                        $coment="";
                        $usunota="";
                        $fechanota="";
                    }
                    
                ?>
                
                &nbsp;
                <input type="button" class="boton-2" value="Agregar Venta" onClick="window.location.<?php echo "href='../addventa.php?verid=".$verid."&vercli=".$vercli."&destination=ventacliente'"?>">
                &nbsp&nbsp;
                <?php
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
                if ($_SESSION['status']==1)
                    $ask='../addpago.php?verid='.$verid.'&vercli='.$vercli;
                else
                    $ask='#';
                ?>
                <input type="button" class="boton-2" value="Agregar Pago" onClick="window.location.<?php echo "href='".$ask."'"?>">
                &nbsp&nbsp;
                <input type="button" class="boton-2" value="Regresar" onClick="window.location.<?php echo "href='".$vamos."?verid=".$verid."&vercli=".$vercli."&morosos=".$_GET['morosos']."'"?>">
                <br>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                <input type="button" class="boton-2" value="Ventas Pendientes" onClick="window.location.<?php echo "href='#'"?>">
                &nbsp&nbsp;
                <input type="button" class="boton-2" value="Ventas Pagadas" onClick="window.location.<?php echo "href='ventacliente_1.php"."?verid=".$verid."&vercli=".$vercli."&morosos=".$_GET['morosos']."'"?>">
                
                <!Notas Reinaldo>
                <?php
                //Notas Reinaldo
                    
                    $nota=$conexion->query('SELECT comentario, usuarioid, DATE_FORMAT(fecha, "%d-%m-%Y"), id FROM test.notas WHERE clienteid='.$verid.' ORDER BY id;');
                        echo '<form name="formaddcom" action="../procesar/insertarcomentario.php" method="POST">';
                        echo "<br><br><h1>Notas</h1><br>";
                    if($nota->rowCount()>0)
                    {
                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Comentario</th>
                                    <th>Eliminar</th>
                                </tr>";
                        
                        foreach ($nota as $listnota)
                        {
                            $coment=$listnota['comentario'];
                            $usunota=$listnota['usuarioid'];
                            $fechanota=$listnota['DATE_FORMAT(fecha, "%d-%m-%Y")'];
                            $idnota=$listnota['id'];
                     
                            echo "<tr>"
                                . "<th>"
                                . $fechanota
                                . "</th>"
                                . "<td>".$usunota."</td>"
                                . "<td>".$coment."</td>"
                                . "<td><input type='checkbox' name='borrar[]' value='".$idnota."' id=checkbox></td>"
                                . "</tr>";
                            
                            
                        }
                        echo  '</table>';
                    }
                    else
                    {   $usunota="";
                        $fechanota="";
                        $idnota="";
                    }
                        $coment="";
                        echo  "<input type='hidden' name='id' value='".$verid."'/>";
                        echo  "<input type='hidden' name='cli' value='".$vercli."'/>";
                        echo  '<textarea class="formulario2" rows="5" cols="60" name="comentn" value='.$coment.'></textarea>';
                        echo  '<button class="formulario2" type="submit" class="boton-2" name="registrar">Guardar</button>
                              </form>';
                ?>
                </div>
                
                    <?php
                        //echo '<form name="formaddcom2" action="../updates/updateall.php" method="POST">';
                        //Ventas Diarias
                        //echo "<div id='oculto' style='visibility:visible'>";
                        
                        echo "<br><br><h1>Compras del Cliente</h1><br>";

                            echo "<table id=t01>";

                            echo
                                "<tr>
                                    <th>Fecha</th>
                                    <th>Bolivares</th>
                                    <th>Dolares</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
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
                            
                            foreach ($ventaja as $listaven4)
                            {
                                $idv3=$listaven4['idventa'];
                                //debo convertir fecha super completa en fecha completa
                                //para que funcione
                                foreach ($ventafecha as $fechada)
                                {
                                    if($fechada['idventa']==$listaven4['idventa'])
                                    {
                                        $fechacontrol=$fechada['fecha'];
                                    }
                                }
                                
                                if ($listaven4['stat']==3 OR $listaven4['stat']==5)
                                {
                                    
                                    //extrayendo datos de la tabla venta_pago
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
                                    $deuda=0;
                                    $deudon=0;
                                    if ($comein1)
                                    {
                                        $sql31=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                                        foreach ($sql31 as $asignar)
                                        {
                                            if ($one)
                                            {
                                                if($fechacontrol>"2020-11-28")
                                                    $deudon=$deudon+($listaven4['montorel']-$asignar['monto']);
                                                else
                                                    $deuda=$deuda+($listaven4['precio']-$asignar['monto']);
                                            }
                                            else
                                            {
                                                if($fechacontrol>"2020-11-28")
                                                    $deudon=$deudon-$asignar['monto'];
                                                else
                                                    $deuda=$deuda-$asignar['monto'];
                                            }
                                            $one=false;
                                        }
                                    }
                                }
                                
                                    if ($listaven4['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($listaven4['stat']==2)
                                        $mensaje='Pagado';
                                    elseif ($listaven4['stat']==3)
                                        $mensaje='Resta: '.$deudon;
                                        //$mensaje='Resta: '.$deudon;
                                    elseif ($listaven4['stat']==0)
                                        $mensaje='Eliminada';
                                    elseif ($listaven4['stat']==4)
                                        $mensaje='Vieja';
                                    elseif ($listaven4['stat']==5)
                                    {
                                        $show=$deuda;
                                        round($show, 0, PHP_ROUND_HALF_UP);
                                        $mensaje='Vieja y Resta: '.$show;
                                    }
                                    
                                    if (($listaven4['stat']==1 OR $listaven4['stat']==2 OR $listaven4['stat']==3 OR $listaven4['stat']==0))
                                    {
                                        //$listaven4['precio']=$listaven4['precio']/100;
                                        $listaven4['precio']=number_format($listaven4['precio'], 0, ",", ".");
                                        $listaven4['montorel']=number_format($listaven4['montorel'], 0, ",", ".");
                                        $listaven4['dolrel']=number_format($listaven4['dolrel'], 2, ",", ".");
                                        echo "<tr>"
                                                . "<th>"
                                                    . "<a href='".$destino.".php?idven=".$listaven4['idventa']."&idcli=".$vercli."&destination=".$destination."'>".$listaven4['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</a>"
                                                . "</th>"
                                                . "<td>".$listaven4['montorel']."</td>"
                                                . "<td>".$listaven4['dolrel']."</td>"
                                                . "<td>".$listaven4['usuario']."</td>"
                                                . "<td>".$mensaje."</td>"
                                            . "</tr>";
                                    }
                                    if (($listaven4['stat']==4 OR $listaven4['stat']==5))
                                    {
                                        //$listaven4['precio']=$listaven4['precio']/100;
                                        $listaven4['precio']=number_format($listaven4['precio'], 0, ",", ".");
                                        $listaven4['montorel']=number_format($listaven4['montorel'], 0, ",", ".");
                                        $listaven4['preciodol']=number_format($listaven4['preciodol'], 2, ",", ".");
                                        echo "<tr>"
                                                . "<th>"
                                                    . "<a href='".$destino.".php?idven=".$listaven4['idventa']."&idcli=".$vercli."&destination=".$destination."'>".$listaven4['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</a>"
                                                . "</th>"
                                                . "<td>".$listaven4['precio']."</td>"
                                                . "<td>".$listaven4['preciodol']."</td>"
                                                . "<td>".$listaven4['usuario']."</td>"
                                                . "<td>".$mensaje."</td>"
                                                //. "<td><input type='checkbox' name='masivo[]' value='".$idv3."' id=checkbox></td>"
                                            . "</tr>";
                                    }
                            }       
                            /*
                            foreach ($ventas2 as $listaven42)
                            {
                                //debo convertir fecha super completa en fecha completa
                                //para que funcione
                                
                               
                                
                                    if ($listaven42['stat']==1)
                                        $mensaje='Pendiente';
                                    elseif ($listaven42['stat']==2)
                                        $mensaje='Pagado';                                        
                                    elseif ($listaven42['stat']==3)
                                        $mensaje='Pago Parcial';
                                    elseif ($listaven42['stat']==0)
                                        $mensaje='Eliminada';
                                    
                                    if ($listaven42['stat']==2 OR $listaven42['stat']==0)
                                    {
                                        echo "<tr>"
                                                . "<th>"
                                                    . "<a href='".$destino.".php?idven=".$listaven42['idventa']."&idcli=".$vercli."&destination=".$destination."'>".$listaven42['DATE_FORMAT(ven.fecha, "%d-%m-%Y")']."</a>"
                                                . "</th>"
                                                . "<td>".$listaven42['precio']."</td>"
                                                . "<td>".$listaven42['usuario']."</td>"
                                                . "<td>".$mensaje."</td>"
                                            . "</tr>";
                                    }
                            }*/
                            echo "</table>";
                        //echo "</div>";
                    ?>  <!--
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;-->
                    <?php
                        /*echo  '<button class="formulario2" type="submit" class="boton-2" name="elmul">Eliminar</button>
                              </form>';*/
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