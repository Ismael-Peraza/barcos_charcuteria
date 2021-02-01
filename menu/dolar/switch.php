<!DOCTYPE html>

<html>
    <head>
        <title>Dolar</title>
        
        <?php
            include ("menuscroll.php");
            $precio=0
        ?>
        
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    
                    $dolar=$conexion->query('SELECT iddolar, precio, DATE_FORMAT(fecha, "%d-%m-%Y"), stat, usuario FROM test.dolar ORDER BY fecha DESC, stat, iddolar Desc;');
                    //$destino=$_GET['destination'];
                    
                    echo
                    '<form name="formnew" action="newdol.php" method="POST">'
                    .'<button class="formulario2" type="submit" class="boton-2" name="nuevo">Nuevo Precio de Dolar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'
                    ;
                                                        
                    echo "<h1>Dolar</h1>";

                    echo "<table id=t01>";

                    echo
			"<tr>
                            <th>Precio</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Estatus</th>
                        </tr>";
                    
                    foreach ($dolar as $listd)
                    {           
                                
                                switch ($listd['stat'])
                                {
                                    case 1:
                                        $tipo="Actual";
                                        break;
                                    case 2:
                                        $tipo="Anterior";
                                        break;
                                    case 3:
                                        $tipo="Eliminado";
                                        break;
                                };
                                    $precio=$listd['precio'];
                                    $precio=number_format($precio, 2, ",", ".");
                                    
                                echo
                                    "<tr>"
                                    . "<td>".'<textarea class="formulario3" rows="1" cols="12" name="comentn" placeholder="'.$precio.'" readonly/></textarea>'."</td>"
                                    . "<td>".$listd['DATE_FORMAT(fecha, "%d-%m-%Y")']."</td>"
                                    . "<td>".$listd['usuario']."</td>"
                                    . "<td>".$tipo."</td>";
                                    $iddolar=$listd['iddolar'];
                                echo
                                    "<input type='hidden' name='iddolar' value='".$iddolar."'/>";
                               /* 
                                if (($_SESSION['status']==1))
                                {
                                    echo
                                    '<td><a href=modol.php?dolar='.$iddolar.'>Modificar</a></td>'
                                    . '</tr>';
                                }
                                */
                    }
                    echo "</table>";
                                        
                    echo '<br>'
                    .'<button class="formulario2" type="submit" class="boton-2" name="nuevo">Nuevo Precio de Dolar</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;'
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

