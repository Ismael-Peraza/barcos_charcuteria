<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Modificar Usuario</title>
        <?php
            include ('menuscroll.php');
        ?>
        
        <!--
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
        -->
        
         <?php
        
        $id=$_GET['verusu'];
        
        //1=cliente, 2=usuario, 3=venta, 4=pago
        $procedencia=2;        
        
        $usuariox=$conexion->query("SELECT * FROM test.usuario WHERE '".$id."'=usuario");   
        foreach ($usuariox as $showme)
        {
            $clave=$showme['clave'];
            $usuario=$showme['usuario'];
            $stat=$showme['estatus'];
            if ($showme['estatus']=='1')
            {
                $statmsg='Activo';
                $statmsg2='Administrador';
                $button='Eliminar';
            }
            elseif ($showme['estatus']=='2')
            {
                $statmsg='Activo';
                $statmsg2='Vendedor';
                $button='Eliminar';
            }
            elseif ($showme['estatus']=='0')
            {
                $statmsg='Eliminado';
                $statmsg2='Usuario Inhabilitado'.$showme['stat'];
                $button='Habilitar';
            }
        }
        
        echo "
            <div class='anchito2'>

                <div class='formulario2'>
                <form name='formaddcl' action='updateall.php' method='POST'>
                    <fieldset>
                        <legend>Modificar Datos del Usuario:</legend><br>
                            <input type='hidden' name='id' value='".$id."'/>
                            <input type='hidden' name='stat' value='".$stat."'/>
                            <input type='hidden' name='procedencia' value='".$procedencia."'/>
                            Usuario: <input class='formulario2' type='text' name='usuario' value=".$usuario." required><br>
                            Contraseña: <input class='formulario2' type='text' name='clave' value='".$clave."' required><br>
                            Este Usuario es: <input class='formulario2' type='text' name='statmsg2' value='".$statmsg2."' disabled><br>
                            Cambiar Tipo de Usuario:
                            <select name='tipo'>
                                <option value='".$stat."'>".$statmsg2."<option>;
                                <option value='1'>Administrador<option>
                                <option value='2'>Vendedor<option>
                            </select><br>
                            Este Usuario está: <input class='formulario2' type='text' name='statmsg' value='".$statmsg."' disabled><br><br>
                            <button class='formulario2' type='submit' class='boton-2' name='endis'>".$button."</button>
                            &nbsp&nbsp&nbsp&nbsp&nbsp;
                            <button class='formulario2' type='submit' class='boton-2' name='update'>Modificar Usuario</button>
                    </fieldset>
                </form>
                </div>
            </div>";
        ?>
        
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>