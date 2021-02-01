<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Agregar Cliente</title>
        
        <?php
            include ("menuscroll.php");
        ?>
        
        <div class="anchito">
        
            <div class="formulario2">
            <form name="formaddcli" action="procesar/insertarcliente.php" method="POST">
                <fieldset>
                    <legend>Ingresar Nuevo Cliente:</legend><br>
                        <input class="formulario2" type="text" name="ci" placeholder="Cedula"><br>
                        <input class="formulario2" type="text" name="nombre" placeholder="Nombre" required><br><br>
                        <button class="formulario2" type="submit" class="boton-2" name="registrar">Agregar</button>
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
