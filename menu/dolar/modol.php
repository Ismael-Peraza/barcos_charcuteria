<!DOCTYPE html>

<html>
    <head>
        <title>Modificar Dolar</title>
        
        <?php
            include ("menuscroll.php");
            $precio=0
                                
        ?>
        
        <div class="anchito2">
        
            
                <?php
                    $dolarget=$_GET['dolar'];
                    
                    $dolar2=$conexion->query("SELECT iddolar, precio, fecha, stat FROM test.dolar WHERE stat='1' AND iddolar='$dolarget';");
                    foreach ($dolar2 as $listupdol2)
                    {
                        $precio=$listupdol2['precio'];
                        $fecha=$listupdol2['fecha'];
                    }
                    
                    //$fecha=date("Y-m-d");
                    /*
                    if(isset($_POST['nuevo']))
                    {*/
                    
                    echo
                    '<div class="formulario2">
                    <form name="modol" action="updol.php" method="POST">
                        <br><br>
                        <fieldset>
                            <legend>Ingresar Nuevo Precio de Dolar:</legend><br>
                                Fecha: <textarea class="formulario3" rows="1" cols="12" name="fecha" placeholder='.$fecha.' ></textarea><br>
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                                Precio: <input class="formulario2" type="text" name="precio" placeholder='.$precio.' /> Bs<br>
                                <input type=hidden name=fechadefault value='.$fecha.'>
                                <input type=hidden name=preciodefault value='.$precio.'>
                                <input type=hidden name=iddolar value='.$dolarget.'>
                                <button class="formulario2" type="submit" class="boton-2" name="modol">Modificar</button>';
                                if ($_SESSION['status']==1)
                                {
                                    echo
                                    '<button class="formulario2" type="submit" class="boton-2" name="del">Eliminar</button>';
                                }
                    echo
                    '
                        </fieldset>
                    </form>
                    </div>';
                    //}
                ?>
        </div>
        
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>

