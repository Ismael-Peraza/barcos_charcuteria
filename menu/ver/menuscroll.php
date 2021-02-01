<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/menu2.css">
        <link rel="stylesheet" href="../../css/slider.css">
        <!--<link rel="stylesheet" href="css/bar.css">-->
        <link rel="stylesheet" href="../../css/login.css">
        <link rel="stylesheet" href="../../css/tabla.css">
    </head>
    <body>

        <?PHP
            session_start();
            $_SESSION['conectar']=true;
            require ('../../sesion/conexion.php');
            require ('../../sesion/usuario_conectado.php');
            $preciodol=$_SESSION['dolar'];
        ?>
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
                        if ($_SESSION['status']==1)//pregunto si es administrador
                        {echo "
                            <li><a href='../../home4.php'>Inicio</a></li>
                            <li><a href='../articulos/seeart_1.php' target='_blank'>Articulos</a></li>
                            <li><a>Agregar</a>
                                <ul>
                                    <li><a href='../seecliente.php?destination=addventa'>Venta</a></li>
                                    <li><a href='../seecliente.php?destination=addpago'>Pago</a></li>
                                    <li><a href='../addcliente.php'>Cliente</a></li>
                                    <li><a href='../addusuario.php'>Usuario</a></li>
                                </ul>
                            </li>
                            <li><a>Ver</a>
                                <ul>                                
                                    <li><a href='../seeventa.php'>Ventas</a></li>
                                    <li><a href='../seepago.php'>Pagos</a></li>
                                    <li><a href='../seecliente.php?destination=ver/clientex'>Cliente</a></li>
                                    <li><a href=''>Usuario:</a>
                                        <ul>";                                
                                            
                                                //codigo php para listar usuarios
                                                $usuarios=$conexion->query('select * from test.usuario where estatus<>3 order by usuario asc');
                                                foreach ($usuarios as $listau)
                                                {
                                                    echo "<li><a href='../seeusuario.php?verusu=".$listau['usuario']."'>".$listau['usuario']."</a></li>";
                                                }
                                        echo    
                                        "</ul>
                                    </li>
                                </ul>
                            </li>
                        
                            <li><a>Modificar</a>
                                <ul>                                
                                    <li><a href='ventaall.php?destination=../updates/updateventa'>Venta</a></li>
                                    <li><a href='pagoall.php?destination=../updates/updatepago'>Pago</a></li>
                                    <li><a href='../seecliente.php?destination=updates/updatecliente'>Cliente</a></li>
                                    <li><a href=''>Usuario:</a>
                                    <ul>";                                
                                            
                                                //codigo php para listar usuarios
                                                $usuarios2=$conexion->query('select * from test.usuario where estatus<>3 order by usuario asc');
                                                foreach ($usuarios2 as $listau2)
                                                {
                                                    echo "<li><a href='../updates/updateusuario.php?verusu=".$listau2['usuario']."'>".$listau2['usuario']."</a></li>";
                                                }
                                    echo    
                                    "</ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href='../dolar/switch.php'>Dolar</a></li>";
                        }
                        elseif ($_SESSION['status']==2)//pregunto si es vendedor
                        {echo "
                            <li><a href='../../home4.php'>Inicio</a></li>
                            <li><a href='../articulos/seeart_1.php' target='_blank'>Articulos</a></li>
                            <li><a href='../seecliente.php?destination=addventa'>Venta</a></li>
                            <li><a href='../seepago.php'>Pagos</a></li>
                            <li><a href='../seecliente.php?destination=ver/clientex'>Clientes</a></li>
                            ";
                        }
                         ?>
                        <li><a href="../../sesion/logout.php">Salir</a></li>
                    </ul>
                </nav>
            </div>
        </header>
