<!DOCTYPE html>

<html>
    <head>
        <title>Modificar Articulos</title>
        
        <?php
            include ("menuscroll.php");
            $precioart=0
                                
        ?>
        
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $idart=$_GET['art'];
                    $articulos=$conexion->query('SELECT idarticulo, nombarticulo, precarticulo, DATE_FORMAT(fecha, "%d-%m-%Y"), stat FROM test.articulo WHERE idarticulo='.$idart.' ORDER BY nombarticulo;');
                                            
                    echo '<form name="formaddcom" action="upart.php" method="POST">';
                    
                    echo "<h1>Articulos</h1>";

                    echo "<table id=t01>";

                    echo
                        "<tr>
                            <th>Articulo</th>
                            <th>Precio</th>
                            <th>Modificado</th>
                        </tr>";
                    
                    foreach ($articulos as $listart)
                    {
                                $nombart=$listart['nombarticulo'];
                                echo
                                    "<tr>".
                                    "<th>".'<textarea class="formulario2" rows="1" cols="45" name="nombart" placeholder="'.$nombart.'"></textarea>'."</th>";
                                    $precioart=$listart['precarticulo'];
                                    $precioart=number_format($precioart, 2, ",", ".");
                                echo
                                    "<td>".'<textarea class="formulario2" rows="1" cols="12" name="precart" placeholder="'.$precioart.'"></textarea>'."</td>"
                                    . "<td>".$listart['DATE_FORMAT(fecha, "%d-%m-%Y")']."</td>"
                                    //. "<td>".$listart['usuarioid']."</td>"
                                ;
                                $idarticulo=$listart['idarticulo'];
                                echo
                                    "<input type='hidden' name='idarticulo' value='".$idarticulo."'/>".
                                    "<input type='hidden' name='nombreaaa' value='".$nombart."'/>".
                                    "<input type='hidden' name='precioaaa' value='".$precioart."'/>";
                        
                    }
                    echo "</table>";
                    echo '<button class="formulario2" type="submit" class="boton-2" name="modart">Modificar</button></form>';
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

