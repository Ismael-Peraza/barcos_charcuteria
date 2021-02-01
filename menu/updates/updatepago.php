<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Modificar Pago</title>
        
        <?php
            include ('menuscroll.php');
        ?>
    
        <div class="anchito">
        
            <div class="formulario2">
            <form name="formaddpago" action="procesar/insertarpago.php" method="POST">
                <fieldset>
                    <legend>Modificar Pago:</legend><br>
                        <?php
                            echo "<input type='hidden' name='cliente' value='".$_GET['verid']."'/>";
                            echo "Cliente: <input class='formulario2' type='text' name='nombrecli' value='".$_GET['vercli']."' disabled/><br>";
                        ?>
                        &nbsp&nbsp&nbsp&nbsp&nbsp;
                        Monto: <input class="formulario2" type="text" name="monto" placeholder="p.ej: 5400" required/> Bs<br>
                        <button class="formulario2" type="submit" class="boton-2" name="registrar">Modiicar</button>
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