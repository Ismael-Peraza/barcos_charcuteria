<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Modificar Cliente</title>
        
        <?php
        include ('menuscroll.php');
        
        $id=$_GET['verid'];
        $nomcli=$_GET['vercli'];
        
        //1=cliente, 2=usuario, 3=venta, 4=pago
        $procedencia=1;        
        
        $clientex=$conexion->query('SELECT * FROM test.cliente WHERE '.$id.'=ci');   
        foreach ($clientex as $showme)
        {
            $ci=$showme['ci'];
            $nombre=$showme['nombre'];
            $stat=$showme['stat'];
            if ($showme['stat']==1)
            {
                $statmsg='Activo';
                $button='Eliminar';
            }
            elseif ($showme['stat']==2)
            {
                $statmsg='Eliminado';
                $button='Habilitar';
            }
        }
        
        echo "
            <div class='anchito'>

                <div class='formulario2'>
                <form name='formaddcl' action='updateall.php' method='POST'>
                    <fieldset>
                        <legend>Modificar Datos del Cliente:</legend><br>
                            <input type='hidden' name='id' value='".$id."'/>
                            <input type='hidden' name='stat' value='".$stat."'/>
                            <input type='hidden' name='procedencia' value='".$procedencia."'/>&nbsp;
                            Cedula <input class='formulario2' type='text' name='ci' value=".$ci." required><br>
                            Nombre <input class='formulario2' type='text' name='nombre' value='".$nombre."' required><br>&nbsp;
                            Estatus <input class='formulario2' type='text' name='statmsg' value='".$statmsg."' disabled><br><br>
                            <button class='formulario2' type='submit' class='boton-2' name='endis'>".$button."</button>
                            &nbsp&nbsp&nbsp&nbsp&nbsp;
                            <button class='formulario2' type='submit' class='boton-2' name='update'>Modificar Cliente</button>
                    </fieldset>
                </form>
                </div>
            </div>

            <!--<div>TODO write content</div>-->
            <div id='particles-js'></div>
            <script src='js/particles.js'></script>
            <script src='js/app.js'></script>
            <script src='js/jquery-3.3.1.js'></script>
            <script src='js/alto.js'></script>";
       
            
        ?>
    </body>
</html>
