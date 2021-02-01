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
     
        if(isset($_POST['nuevo']))
        {
        include ("menuscroll.php");
               $fecha=date("Y-m-d");
               $hora=date("H:i:s");
        echo
        '<div class="anchito2">
        
            <div class="formulario2">
            <form name="newdol" action="updol.php" method="POST" onsubmit="return validacion()">
                
                
                
                <br><br>
                <fieldset>
                    <legend>Ingresar Nuevo Precio de Dolar:</legend><br/>
                        Fecha: <input class="formulario2" type="text" name="fecha" placeholder="'.$fecha.'" readonly/><br/>
                        &nbsp&nbsp&nbsp&nbsp;
                        Precio: <input class="formulario2" type="text" name="precio" id="precio" placeholder="p.ej: 85000" required/> Bs<br/>
                        <input type=hidden name=fechahoy value="'.$fecha.'"/>
                        <button onclick=validacion() class="formulario2" type="submit" class="boton-2" name="registrar">Guardar</button><br/><br/>
                </fieldset>
            </form>
            </div>
        </div>'
        ;
        }
        //Fecha: <textarea class="formulario3" rows="1" cols="12" name="fecha" placeholder="'.$fecha.'"></textarea><br>
        //&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;
        ?>
        <!--
        <script>
        document.addEventListener
        ("DOMContentLoaded", function() {
            document.getElementById("newdol").addEventListener('submit', validacion);
            
        });
        
        function validacion()
        { 
            var precio = document.getElementById('precio').value;
            var dolar = <?php //$_SESSION['dolarcalc'] ?>;
            var doble = dolar * 2;
            var medio = dolar / 2;
            
            if ( (precio > doble) || (precio < medio)) )
            {
                //Si no se cumple la condicion...
                alert("[ERROR] El campo debe tener un valor valido");
                return; 
            }
            //return true;
            this.submit();
        }
        </script>
        -->
                                
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>