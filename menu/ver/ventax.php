<!DOCTYPE html>

<html>
    <head>
        <title>Registro de Venta</title>
        <?php
            include ('menuscroll.php');
        ?>
            <div class="anchito3">
        
                
        
                    <?php
                    $idven=$_GET['idven'];
                    $idcli=$_GET['idcli'];
                    $destination=$_GET['destination'].'.php';
                    $ventas=$conexion->query('SELECT clienteid, idventa, DATE_FORMAT(fecha, "%d-%m-%Y"), articulos, precio, usuarioid, montorel, dolrel, stat FROM test.venta WHERE '.$idven.'=idventa');
                    foreach ($ventas as $ventax)
                    {
                        $id=$ventax['idventa'];
                        $stat=$ventax['stat'];
                        $fecha=$ventax['DATE_FORMAT(fecha, "%d-%m-%Y")'];
                        $articulos=$ventax['articulos'];
                        $precio=$ventax['precio'];
                        $precio=number_format($precio, 2, ",", ".");
                        $montorel=$ventax['montorel'];
                        $montorel=number_format($montorel, 2, ",", ".");
                        $preciodol=$ventax['dolrel'];
                        $preciodol=number_format($preciodol, 2, ",", ".");
                        $usuario=$ventax['usuarioid'];
                        $realcli=$ventax['clienteid'];
                        if ($ventax['stat']==1)
                            $estatus='No Pagada';
                        elseif ($ventax['stat']==2)
                            $estatus='Pagada';
                        elseif($ventax['stat']==3)
                            $estatus='Pagada Parcialmente';
                        elseif($ventax['stat']==0)
                            $estatus='Venta Eliminada';
                        elseif($ventax['stat']==4)
                            $estatus='Vieja';
                        elseif($ventax['stat']==5)
                            $estatus='Vieja con Pago Parcial';
                    }
                    if ($_GET['destination']=='ventacliente')
                    {
                        $destination=$destination.'?verid='.$realcli.'&vercli='.$idcli;
                    }
                    if ($_GET['destination']=='ventausuario')
                    {
                        $destination=$destination.'?verusu='.$_GET['verusu'];
                    }
                    
                    ?>
                    
                <div class="formulario2">
                    <form name="formaddusu" action="../updates/updateall.php" method="POST">
                    <fieldset>
                        <legend>Registro de Venta:</legend><br>
                            <?php
                                //1=cliente, 2=usuario, 3=venta, 4=pago
                                $procedencia=3;
                                
                                echo "Cliente: <input class='formulario2' type='text' name='idcli' value='".$idcli."' disabled/>&nbsp&nbsp&nbsp&nbsp;";
                                echo "Precio de Venta: <input class='formulario2' type='text' name='precio' value='".$precio."' disabled/><br>";
                                echo "Fecha: <input class='formulario2' type='text' name='fecha' value='".$fecha."' disabled/>&nbsp&nbsp;";
                                echo "Deuda Dolarizada: <input class='formulario2' type='text' name='montorel' value='".$montorel."' disabled/><br>";
                                echo "Usuario: <input class='formulario2' type='text' name='usuario' value='".$usuario."' disabled/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
                                echo "Dolares: <input class='formulario2' type='text' name='precio' value='".$preciodol."' disabled/><br>";
                                echo "Estatus: <input class='formulario2' type='text' name='statmsg1' value='".$estatus."' disabled/><br>";
                                echo "<textarea class='formulario2' rows='10' cols='40' name='articulos' placeholder='".$articulos."' disabled/></textarea>";
                                echo "<input type='hidden' name='id' value='".$id."'/>";
                                echo "<input type='hidden' name='stat' value='".$stat."'/><br>";
                            ?>
                                <input type="button" class="boton-2" value="Pagar" onClick="window.location.<?php echo "href='".$ask."'"?>">
                            <?php
                                if ($_SESSION['status']==1)
                                {
                                    if ($stat==1 OR $stat==3)
                                        $ask='../addpago.php?verid='.$realcli.'&vercli='.$idcli;
                            ?>
                                    <input type="button" class="boton-2" value="Modificar" onClick="window.location.<?php echo "href='../updates/updateventa.php?idven=".$idven."&idcli=".$idcli."&destination=ventaall.php"."'"?>">
                            <?php   
                                    echo "<button class='formulario2' type='submit' class='boton-2' name='delete'>Eliminar</button>";
                                }
                            ?>
                                <input type="button" class="boton-2" value="Regresar" onClick="window.location.<?php echo "href='".$destination."'"?>">
                                <input type='hidden' name='procedencia' <?php echo "value='".$procedencia."'"?> />
                                
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
