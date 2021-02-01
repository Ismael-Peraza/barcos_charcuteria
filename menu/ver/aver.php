<!DOCTYPE html>

<html>
    <head>
        <title>Ventas Pendientes de Pago</title>
        <?php
            include ('menuscroll.php');
        ?>
        
        <div class="anchito2">
        
        <div class="lista1">

        <?php
        $hola=$conexion->query("SELECT cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=cli.ci;");
        $morosos=$conexion->query("SELECT * FROM test.cliente;");
        //$ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid=cli.ci ORDER BY ven.clienteid DESC, ven.fecha;');
        
        foreach ($morosos as $paguenme)
        {
            $clienteid=$paguenme['ci'];
            $clientenom=$paguenme['nombre'];
            $deuda=0;
            $ventas=$conexion->query('SELECT ven.idventa, DATE_FORMAT(ven.fecha, "%d-%m-%Y"), ven.precio, ven.clienteid, ven.stat, cli.nombre FROM test.venta AS ven, test.cliente AS cli WHERE (ven.stat=1 OR ven.stat=3) AND ven.clienteid='.$clienteid.' AND ven.clienteid=cli.ci ORDER BY ven.clienteid DESC, ven.fecha;');
            foreach ($ventas as $listava)
            {
                
                if ($listava['stat']==3 AND $listava['clienteid']==$clienteid)
                {
                    //extrayendo datos de la tabla venta_pago
                    $idv3=$listava['idventa'];
                    $sql3=$conexion->query("SELECT * FROM test.pago_venta  WHERE stat=1 AND ventaid=".$idv3.";");
                }
                elseif ($listava['stat']==1 AND $listava['clienteid']==$clienteid)
                {
                    $deuda=$deuda+$listava['precio'];
                }
                if (($listava['stat']==1 OR $listava['stat']==3) AND $listava['clienteid']==$clienteid)
                {
                    
                }
            }
            echo $paguenme['nombre']." ".$deuda;
            echo "<br>";
        }
        
        ?>
</body>
</html>
