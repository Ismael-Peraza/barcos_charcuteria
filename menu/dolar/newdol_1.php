<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>Nuevo Precio de Dolar</title>
        
    <?php
        
        /*    
        if(isset($_POST['modart']))
        {
                $idarticulo=$_POST['idarticulo'];
                echo header('location:modart.php?idarticulo='.$idarticulo);
                /*para utilizar
                 * Para enlazar a otras paginas
                        if (isset($_GET['destination']))
                        {
                            $destino=$_GET['destination'];
                            $destination='clientex';
                            if (isset($_GET['morosos']))
                            {
                                $morosos='si';
                            }
                        }
                        else
                        {
                            $destino="../seecliente";
                            $destination='ver/clientex';
                            $morosos='no';
                        }
                        
                 
        }
        else
        */
     
        
        include ("menuscroll.php");
               $fecha=date("Y-m-d");
               $hora=date("H:i:s");
        echo
        '<div class="anchito2">
        
            <div class="formulario2">
            <form name="newdol" action="updol.php" method="POST">
                <br><br>
                <fieldset>
                    <legend>Ingresar Nuevo Precio de Dolar:</legend><br>
                        Fecha: <textarea class="formulario3" rows="1" cols="12" name="fecha" placeholder="'.$fecha.'"></textarea><br>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        Precio: <input class="formulario2" type="text" name="precio" placeholder="p.ej: 85000" required/> Bs<br>
                        <input type=hidden name=fechahoy value="'.$fecha.'">
                        <button class="formulario2" type="submit" class="boton-2" name="registrar">Guardar</button>
                </fieldset>
            </form>
            </div>
        </div>'
        ;
                            $dolar=$conexion->query('SELECT precio FROM test.dolar WHERE stat=1;');
                            foreach ($dolar as $listdol)
                            {
                                $dolar=$listdol['precio'];
                            }
                            $ventas=$conexion->query('SELECT ven.idventa, ven.precio, ven.preciodol, ven.montorel, ven.stat FROM test.venta as ven WHERE (ven.stat=1 OR ven.stat=3) AND ven.fecha>"2020-11-27";');
                            foreach ($ventas as $listven)
                            {           
                                $idventa=$listven['idventa'];
                                $precioventa=$listven['precio'];
                                $precioventa2=$listven['preciodol']*$dolar;
                                $precioventa3=$listven['montorel'];
                                echo "Dolar: ".$dolar."<br>";
                                echo "Precio1: ".$precioventa."<br>";
                                echo "Precio2: ".$precioventa2."<br>";
                                echo "Precio3: ".$precioventa3."<br>";
                                
                            }
        
                                
    ?>
                                
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>