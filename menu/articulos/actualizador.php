<?php
/*
    include ("menuscroll.php");
    $articulos=$conexion->query('SELECT art.idarticulo, art.nombarticulo, art.precarticulo, art.precdol, dol.precio FROM test.articulo as art, test.dolar as dol WHERE dol.stat="1";');
*/
    include ("menuscroll.php");
    $articulos=$conexion->query('SELECT art.idarticulo, art.nombarticulo, art.precarticulo, art.precdol FROM test.articulo as art;');
    ini_set('max_execution_time',300);
?>  

    <div class="anchito2">
    <div class="lista1">
<?php
//Este crea valores en dolares para los articulos
/*
    echo "<table id=t01>";
    echo "<tr><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>";
    foreach ($articulos as $artic)
    {
        $valor=$artic['precarticulo']/$artic['precio'];
        $id=$artic['idarticulo'];
        //$valor=number_format($valor, 15, ".", ",");
        $newval=$valor*$artic['precio'];
        //$valor=number_format($valor, 2, ",", ".");
        
        $sql3="UPDATE test.articulo SET precdol='".$valor."' WHERE idarticulo='".$id."';";
        $exito3=$conexion->exec($sql3);
            
        if($exito3)
        {
            echo "<tr><td>".$artic['nombarticulo']."</td>"
            . "<td>".$artic['precarticulo']."</td>"
            . "<td>".$artic['precio']."</td>"
            . "<td>".$valor."</td>"
            . "<td>".$newval."</td>";
            echo "</tr>";
        }
        else
        {
            echo "NO se registraron los datos correctamente en: ".$artic['idarticulo']."<br/>";
            echo "o existe un problema con la conexion a la base de datos<br/>";
            echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
            echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
        }
    }
    echo "</table id=t01>";
    
*/    

//Este crea anclas para dolar y bolivares en la tabla de articulos
/*
    $altereichon="ALTER TABLE `test`.`articulo` 
    ADD COLUMN `anclabs` DECIMAL(14,4) NULL DEFAULT NULL COMMENT '' AFTER `precdol`,
    ADD COLUMN `ancladol` DECIMAL(18,15) NULL DEFAULT NULL COMMENT '' AFTER `anclabs`;
    ";
    $exitazo=$conexion->query($altereichon);
    
    if($exitazo)
    {        
        $bigdata11=array();
        $bigdata21=array();
        
        echo "<table id=t01>";
        echo "<tr><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th></tr>";
        foreach ($articulos as $artic)
        {
            $anclabs=$artic['precarticulo'];
            $ancladol=$artic['precdol'];
            $idarticulo=$artic['idarticulo'];

            $bigdata11[]=("WHEN idarticulo='".$idarticulo."' THEN '".$ancladol."'");
            $bigdata21[]=("WHEN idarticulo='".$idarticulo."' THEN '".$anclabs."'");
            $bigdata31[]=("'".$idarticulo."'");
        }
        //$sql241="UPDATE test.articulo SET ancladol=(CASE WHEN idarticulo='".$idarticulo."' THEN '".$ancladol."' END), anclabs=(CASE WHEN idarticulo='".$idarticulo."' THEN '".$anclabs."' END) WHERE idarticulo IN ('".$idarticulo."')";
        $data11=implode(" ",$bigdata11);
        $data21=implode(" ",$bigdata21);
        $data31=implode(", ",$bigdata31);
        $sql241="UPDATE test.articulo SET ancladol=(CASE ".$data11." END), anclabs=(CASE ".$data21." END) WHERE idarticulo IN (".$data31.")";
        $exito441=$conexion->exec($sql241);


        $error=false;
        $articulos2=$conexion->query('SELECT art.idarticulo, art.nombarticulo, art.precarticulo, art.anclabs, art.precdol, art.ancladol FROM test.articulo as art;');
        foreach ($articulos2 as $artic2)
        {
            if($exito441)
            {
                echo "<tr><td>".$artic2['nombarticulo']."</td>"
                . "<td>".$artic2['precarticulo']."</td>"
                . "<td>".$artic2['anclabs']."</td>"
                . "<td>".$artic2['precdol']."</td>"
                . "<td>".$artic2['ancladol']."</td>";
                echo "</tr>";
            }
            else
                $error=true;
        }
        if($error)
            {
                echo "NO se registraron los datos correctamente en: ".$artic['idarticulo']."<br/>";
                echo "o existe un problema con la conexion a la base de datos<br/>";
                echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
            }
        else
            echo "</table id=t01>";
        
    }
    else {
       echo "Mierda 1"; 
    }

*/
//Este crea un monto relativo para el dolar y convierte al dolar relativo anterior,
//en el dolar ancla para ventas

/*
$altereichon2="ALTER TABLE `test`.`venta` 
ADD COLUMN `dolrel` DECIMAL(20,15) NULL DEFAULT NULL AFTER `montorel`,
CHANGE COLUMN `precio` `precio` INT(12) NOT NULL ,
CHANGE COLUMN `montorel` `montorel` INT(12) NULL DEFAULT NULL ;
";
$exitazo2=$conexion->query($altereichon2);
if($exitazo2)
{
    $buscando="SELECT idventa, fecha, precio FROM test.venta WHERE stat=1 ORDER BY idventa;";
    $q1=$conexion->query($buscando);
    $dolarizando="SELECT precio, fecha FROM test.dolar ORDER BY fecha;";
    $q2=$conexion->query($dolarizando);
    $fechaVenta="2020-01-01";
    $dolarActual=$_SESSION['dolarcalc'];
    $dolarCalc=$dolarActual*2;
    $fechaActual="2020-01-01";
    $bigdata1=$bigdata2=$bigdata3=$bigdata4=array();
    foreach ($q1 as $q11)
    {
        $fechaVenta=$q11['fecha'];
        foreach ($q2 as $q21)
        {
            if($fechaVenta<$q21['fecha'])
            {
                break;
            }
            elseif($fechaVenta>=$q21['fecha'])
            {
                if($fechaActual==$q21['fecha'] && $dolarCalc<=$q21['precio'])
                {
                    break;
                }
                else
                {
                    $fechaActual=$q21['fecha'];
                    $dolarCalc=$q21['precio'];
                }
            }
        }
                    
        $montorel=$q11['precio'];
        $preciodol=$montorel/$dolarCalc;
        $dolrel=$preciodol;
        $idventa=$q11['idventa'];

        $bigdata1[]=("WHEN idventa='".$idventa."' THEN '".$preciodol."'");
        $bigdata2[]=("WHEN idventa='".$idventa."' THEN '".$montorel."'");
        $bigdata3[]=("WHEN idventa='".$idventa."' THEN '".$dolrel."'");
        $bigdata4[]=("'".$idventa."'");
    }
    
    //$sql241="UPDATE test.venta SET preciodol=(CASE WHEN idventa='".$idventa."' THEN '".$preciodol."' END), montorel=(CASE WHEN idventa='".$idventa."' THEN '".$montorel."' END), dolrel=(CASE WHEN idventa='".$idventa."' THEN '".$dolrel."' END) WHERE idventa IN ('".$idventa."')";
    $data1=implode(" ",$bigdata1);
    $data2=implode(" ",$bigdata2);
    $data3=implode(" ",$bigdata3);
    $data4=implode(", ",$bigdata4);
    $sql2="UPDATE test.venta SET preciodol=(CASE ".$data1." END), montorel=(CASE ".$data2." END), dolrel=(CASE ".$data3." END) WHERE idventa IN (".$data4.")";
    $exito=$conexion->exec($sql2);
    /*if ($exito)
    {
        $altereichon49="ALTER TABLE `test`.`pago` 
        CHANGE COLUMN `monto` `monto` INT(12) NOT NULL ;";
        $exitazo33=$conexion->query($altereichon49);
        if($exitazo33)
        {        
            header('location:backhome.html');
        }
        else
        {
            echo "Mierda 2";
        }
    }
    else
    {
        echo "Mierda 3";
    }*/ /*
}
else
{
    echo "Mierda 4";
}
*/
 