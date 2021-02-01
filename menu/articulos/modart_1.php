<!DOCTYPE html>

<html>
    <head>
        <title>Modificar Articulos</title>
        
        <?php
            include ("menuscroll.php");
            $precioart=0
                                
        ?>
        
        <div class="anchito4">
        
            <div class="lista1">
                <?php
                    $idart=$_GET['art'];
                    $articulos=$conexion->query('SELECT art.idarticulo, art.nombarticulo, art.precdol, art.fecha, art.stat, dol.precio FROM test.articulo as art, test.dolar as dol WHERE art.idarticulo='.$idart.' AND dol.stat=1 ORDER BY nombarticulo;');
                                            
                    echo '<form name="formaddcom" action="upart_1.php" method="POST">';
                    
                    echo "<h1>Articulos</h1>";

                    echo "<table id=t01>";

                    echo
                        "<tr>
                            <th>Articulo</th>
                            <th>Dolar</th>
                            <th>Bolivar</th>
                            <th>Modificado</th>
                        </tr>";
                    
                    foreach ($articulos as $listart)
                    {
                                $nombart=$listart['nombarticulo'];
                                
                                    $precioart=$listart['precdol'];
                                    $dolar=$listart['precio'];
                                    //$precioart=number_format($precioart, 3, ",", ".");
                                    $bolivar=$listart['precdol']*$listart['precio'];
                                    $bolivar=number_format($bolivar, 0, ",", ".");
                                
                                echo
                                    "<tr>".
                                    "<th>".'<textarea class="formulario2" rows="1" cols="45" name="nombart" placeholder="'.$nombart.'"></textarea>'."</th>";
                                    //$precioart=$listart['precarticulo'];
                                    $precioart=number_format($precioart, 2, ",", ".");
                                echo
                                    "<td>".'<textarea class="formulario2" rows="1" cols="12" name="precno" placeholder="'.$precioart.'" disabled></textarea>'."</td>"
                                    ."<td>".'<textarea class="formulario2" rows="1" cols="12" name="precart" placeholder="'.$bolivar.'"></textarea>'."</td>"
                                    . "<td>".$listart['fecha']."</td>"
                                    //. "<td>".$listart['usuarioid']."</td>"
                                ;
                                $idarticulo=$listart['idarticulo'];
                                echo
                                    "<input type='hidden' name='idarticulo' value='".$idarticulo."'/>".
                                    "<input type='hidden' name='nombreaaa' value='".$nombart."'/>".
                                    "<input type='hidden' name='precioaaa' value='".$precioart."'/>".
                                    "<input type='hidden' name='dolar' value='".$dolar."'/>";
                        
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

