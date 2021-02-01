<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>Nuevo Articulo</title>
        
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
        if(isset($_POST['nuevo']))
        {
        include ("menuscroll.php");
        echo
        '<div class="anchito2">
        
            <div class="formulario2">
            <form name="newart_1" action="upart_1.php" method="POST">
                <br><br>
                <fieldset>
                    <legend>Ingresar Nuevo Articulo:</legend><br>
                        Nombre: <input class="formulario2" type="text" name="articulo" placeholder="p.ej: Harina Pan" required/><br>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
                        Precio: <input class="formulario2" type="text" name="precio" placeholder="p.ej: 85000" required/> Bs<br>
                        <button class="formulario2" type="submit" class="boton-2" name="registrar">Guardar</button>
                </fieldset>
            </form>
            </div>
        </div>'
        ;
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