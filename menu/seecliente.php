<!DOCTYPE html>

<html>
    <head>
        <title>Clientes</title>
        
        <?php
            include ("menuscroll.php");
        ?>
        
        <div class="anchito2">
        
            <div class="lista1">
                <?php
                    $clientes=$conexion->query('SELECT * FROM test.cliente WHERE stat=1 ORDER BY nombre;');
                    $destino=$_GET['destination'];
                    echo "<h1>Lista de Clientes</h1>";

                    echo "<table id=t01>";

                    echo
			"<tr>
                            <th>Nombre</th>
                            <th>Cedula</th>
                        </tr>";
                    
                    foreach ($clientes as $listacli)
                    {
                        echo "<tr><th><a href='".$destino.".php?verid=".$listacli['ci']."&vercli=".$listacli['nombre']."'>".$listacli['nombre']."</a></th><td>".$listacli['ci']."</td></tr>";
                        
                    }

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

