<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Venta-Pago</title>
        <script type='text/javascript'>
            function enviarForm()
            {
                document.nameForm.submit();
            }
        </script>
</head>
<body onLoad='javascript:enviarForm();'>
    <?php
        $cliente=$_GET['cliente'];
    ?>
    <form name='nameForm' action='insertarpago.php' method='POST'>
        <input type='hidden' name='registrar' value='true'/>
        <?php echo"<input type='hidden' name='cliente' value='".$cliente."'/>"?>
        <input type='hidden' name='monto' value='0'/> 
    </form>
</body>
