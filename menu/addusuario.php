<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Agregar Usuario</title>
        
        <?php
            include ("menuscroll.php");
        ?>
        
        <div class="anchito">
        
            <div class="formulario2">
            <form name="formaddusu" action="procesar/insertarusuario.php" method="POST">
                <fieldset>
                    <legend>Ingresar Nuevo Usuario:</legend><br>
                        <input class="formulario2" type="text" name="usuario" placeholder="Usuario" required><br>
                        <input class="formulario2" type="text" name="clave" placeholder="Clave" required><br>
                        Tipo de Usuario:
                        <select name="tipo">
                            <option value="1">Administrador<option>
                            <option value="2">Vendedor<option>
                        </select>
                                <br><br>
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