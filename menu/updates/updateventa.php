<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Modificar Venta</title>
        
        <?php
            include ('menuscroll.php');
        ?>
    
        <div class="anchito3">
        
            <div class="formulario2">
            <form name="formaddven" action="updateall.php" method="POST">
                <fieldset>
                    <legend>Modificar Venta:</legend><br>
                        <?php
                            $idcli=$_GET['idcli'];
                            $idven=$_GET['idven'];
                            /*
                            echo "<input type='hidden' name='idven' value='".$idven."'/>";
                            echo "Cliente: <input class='formulario2' type='text' name='idcli' value='".$_GET['idcli']."' disabled/><br>";
                            */
                            $ventax=$conexion->query("SELECT * FROM test.venta WHERE '".$idven."'=idventa");   
                            foreach ($ventax as $showme)
                            {
                                $fecha=$showme['fecha'];
                                $articulos=$showme['articulos'];
                                $precio=$showme['precio'];
                                $usuid=$showme['usuarioid'];
                                $cliid=$showme['clienteid'];
                                $stat=$showme['stat'];
                            }
                            
                            $vercli=$conexion->query("SELECT nombre FROM cliente WHERE ci=".$cliid.";");
                            foreach ($vercli as $showcli)
                            {
                                $nomcli=$showcli['nombre'];
                            }
                            
                            if ($stat=1)
                                    $ask=".../addpago.php?verid=".$cliid."&vercli=".$nomcli;
                            else
                                $ask="#";
                            
                            //1=cliente, 2=usuario, 3=venta, 4=pago
                            $procedencia=3;
                            $precio=$precio/1;
                            //$precio=number_format($precio, 2, ",", ".");
                        ?>
                        Cliente: <input class="formulario2" type="text" name="clienteid" <?php echo "value='".$idcli."'" ?> disabled/>
                        &nbsp&nbsp&nbsp&nbsp&nbsp;
                        Monto: <input class="formulario2" type="text" name="precio" <?php echo "value='".$precio."'" ?> required/> Bs<br>
                        Articulos: <br><textarea class="formulario2" rows="10" cols="40" name="articulos" <?php echo "value='".$articulos."'" ?> placeholder="<?php echo $articulos ?>" ></textarea><br>
                        Fecha: <input class="formulario2" type="text" name="fecha" <?php echo "value='".$fecha."'" ?> disabled/>&nbsp&nbsp;
                        Usuario: <input class="formulario2" type="text" name="usuarioid" <?php echo "value='".$usuid."'" ?> disabled/><br><br>
                        <input type='hidden' name='clienteid' <?php echo "value='".$cliid."'" ?> />
                        <input type='hidden' name='id' <?php echo "value='".$idven."'" ?> />
                        <input type='hidden' name='stat' <?php echo "value='".$stat."'" ?> />
                        <input type='hidden' name='procedencia' <?php echo "value='".$procedencia."'"?> />
                        <button class="formulario2" type="submit" class="boton-2" name="delete">Eliminar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <input type="button" class="boton-2" value="Pagar" onClick="window.location.<?php echo "href='".$ask."'"?>">
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        <button class="formulario2" type="submit" class="boton-2" name="update">Guardar</button>
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