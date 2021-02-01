<!DOCTYPE html>

<html>
    <head>
        <title>Articulos</title>
        
        <?php
            include ("menuscroll.php");
            $precioart=0
        ?>
        
        <div class="anchito4">
        
            <div class="lista1">
                <?php
                    $articulos=$conexion->query('SELECT art.idarticulo, art.nombarticulo, art.precarticulo, art.precdol, art.fecha, art.usuario, art.stat, dol.precio FROM test.articulo as art, test.dolar as dol WHERE art.stat=1 AND dol.stat=1 ORDER BY art.nombarticulo;');
                    //$destino=$_GET['destination'];
                    
                    echo
                    '<form name="formnew" action="newart_1.php" method="POST">'
                    .'<button class="formulario2" type="submit" class="boton-2" name="nuevo">Nuevo Articulo</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'
                    ;
                                                        
                    echo "<h1>Articulos</h1>";

                    echo "<table id=t01>";

                    echo
			"<tr>
                            <th>Articulo</th>
                            <th>Dolar</th>
                            <th>Bolivar</th>
                            <th>Modificado</th>
                            <th>Usuario</th>
                        </tr>";
                    
                    foreach ($articulos as $listart)
                    {           
                                $idarticulo=$listart['idarticulo'];
                                echo
                                    "<tr>"
                                    . "<th>".$listart['nombarticulo']."</th>";
                                    $precioart=$listart['precdol'];//valor del articulo en dolares
                                    $precioart1=$listart['precarticulo'];//valor almacenado en bolivares
                                    $precioart2=$listart['precdol']*$listart['precio'];//valor calculado dado el precio del dolar
                                    $precioart=number_format($precioart, 2, ",", ".");
                                    if($precioart1<$precioart2)
                                        $bolivar=$precioart2;
                                    elseif($precioart1>=$precioart2)
                                        $bolivar=$precioart1;
                                    
                                    $bolivar=number_format($bolivar, 0, ",", ".");
                                        
                                    $modif=$listart['fecha'];/*
                                    $modif=DATE_FORMAT($modif, "%d-%m-%Y");*/
                                echo
                                    "<td>".'<textarea class="formulario3" rows="1" cols="12" name="comentn" placeholder="'.$precioart.'" disabled/></textarea>'."</td>"
                                    ."<td>".'<textarea class="formulario3" rows="1" cols="12" name="comentn" placeholder="'.$bolivar.'" disabled/></textarea>'."</td>"
                                    . "<td>".$modif."</td>"
                                    . "<td>".$listart['usuario']."</td>"
                                ;
                                echo
                                    "<input type='hidden' name='idarticulo' value='".$idarticulo."'/>";
                                echo
                                    '<td><a href=modart_1.php?art='.$idarticulo.'>Modificar</a></td>';
                        
                    }
                    echo "</table>";
                                        
                    echo '<br>'
                    .'<button class="formulario2" type="submit" class="boton-2" name="nuevo">Nuevo Articulo</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'
                    .'</form>'
                       
                    /*a utilizar
                     * echo "<tr><th><a href='".$destino.".php?verid=".$listacli['ci']."&vercli=".$listacli['nombre']."'>".$listacli['nombre']."</a></th><td>".$listacli['ci']."</td></tr>";
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

