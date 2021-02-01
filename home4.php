<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Inicio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/menu2.css">
        <link rel="stylesheet" href="css/slider.css">
        <?php
            session_start();
            $_SESSION['conectar']=true;
            //Lo que esta abajo segun creo no deberia estar ahi
            require ('sesion/conexion.php');
            require ('sesion/usuario_conectado.php');
            $preciodol=$_SESSION['dolar'];
        ?>
    </head>
    <body>
        <header>
            <div class="ancho">
                <div class="logo">
                    <p>Barcos Charcuteria y Algo Mas...</p>
                    <?php
                        echo "<p>Usuario: ".$_SESSION['usuario_conectado']."&nbsp&nbsp&nbsp&nbsp&nbsp $ = ".$preciodol."</p>";
                    ?>
                </div>
                <nav>
                    <ul class="navi">
                        <!--<li><a href="home.html">Inicio</a></li>-->
                        <?php
                        /*session_start();
                        $_SESSION['home']=true;*/
                        
                        if ($_SESSION['status']==1)//pregunto si es administrador
                        {echo "
                            <li><a>Inicio</a></li>
                            <li><a href='menu/articulos/seeart_1.php' target='_blank'>Articulos</a></li>
                            <li><a>Agregar</a>
                                <ul>
                                    <li><a href='menu/seecliente.php?destination=addventa'>Venta</a></li>
                                    <li><a href='menu/seecliente.php?destination=addpago'>Pago</a></li>                                
                                    <li><a href='menu/addcliente.php'>Cliente</a></li>
                                    <li><a href='menu/addusuario.php'>Usuario</a></li>
                                </ul>
                            </li>
                            <li><a>Ver</a>
                                <ul>                                
                                    <li><a href='menu/seeventa.php'>Ventas</a></li>
                                    <li><a href='menu/seepago.php'>Pagos</a></li>
                                    <li><a href='menu/seecliente.php?destination=ver/clientex'>Clientes</a></li>
                                    <li><a href=''>Usuario:</a>
                                        <ul>";                                
                                            
                                                //codigo php para listar usuarios
                                                $usuarios=$conexion->query('select * from test.usuario where estatus<>3 order by usuario asc');
                                                foreach ($usuarios as $listau)
                                                {
                                                    echo "<li><a href='menu/seeusuario.php?verusu=".$listau['usuario']."'>".$listau['usuario']."</a></li>";
                                                }
                                        echo    
                                        "</ul>
                                    </li>
                                </ul>
                            </li>
                        
                            <li><a>Modificar</a>
                                <ul>                                
                                    <li><a href='menu/ver/ventaall.php?destination=../updates/updateventa'>Venta</a></li>
                                    <li><a href='menu/ver/pagoall.php?destination=../updates/updatepago'>Pago</a></li>
                                    <li><a href='menu/seecliente.php?destination=updates/updatecliente'>Cliente</a></li>
                                    <li><a href=''>Usuario:</a>
                                    <ul>";                                
                                            
                                                //codigo php para listar usuarios
                                                $usuarios2=$conexion->query('select * from test.usuario where estatus<>3 order by usuario asc');
                                                foreach ($usuarios2 as $listau2)
                                                {
                                                    echo "<li><a href='menu/updates/updateusuario.php?verusu=".$listau2['usuario']."'>".$listau2['usuario']."</a></li>";
                                                }
                                    echo    
                                    "</ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href='menu/dolar/switch.php'>Dolar</a></li>";
                        }
                        elseif ($_SESSION['status']==2)//pregunto si es vendedor
                        {echo "
                            <li><a>Inicio</a></li>
                            <li><a href='menu/articulos/seeart_1.php' target='_blank'>Articulos</a></li>
                            <li><a href='menu/seecliente.php?destination=addventa'>Venta</a></li>
                            <li><a href='menu/seepago.php'>Pagos</a></li>
                            <li><a href='menu/seecliente.php?destination=ver/clientex'>Clientes</a></li>
                            ";
                        }
                        ?>
                        <li><a href='sesion/logout.html'>Salir</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>
    </body>
</html>
