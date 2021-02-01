<?php
    //Para insertar la fecha actual en la venta (con la columna en formato datetime)
    //$db->query("INSERT INTO nombre_tabla (nombre_columna) VALUES (now())");
?>
<!DOCTYPE>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Registro de Venta</title>
        <!--
        <script language="JavaScript1.2" type="text/javascript">
        function eliminar()
            var statusconfirm = confirm ("Realmente desea eliminar las notas seleccionadas")
            if(statusconfirm==true)
            {
                alert("Eliminar")
            }
            else
            {
                window.history.go( -1);
            }
        </script>
        -->
</head>
<body>
	<!--<h2>Registro de Comentarios</h2>-->
	<?php
	if(isset($_POST['registrar']))
	{
            session_start();
            $_SESSION['conectar']=true;
		include ("../../sesion/conexion.php");
		$cliente=$_POST['id'];
		$comentario=$_POST['comentn'];
                $nombrecli=$_POST['cli'];
                $usuario=$_SESSION['usuario_conectado'];
                
                        date_default_timezone_set("America/caracas");
                            if(isset($_POST['borrar']))
                            {
                                for($i=0;$i<count($_POST['borrar']);$i++)
                                {
                                    $idnota=$_POST['borrar'][$i];
                                    $sql=$conexion->query('DELETE FROM test.notas WHERE id='.$idnota.';');
                                }
                            }
                            if ($comentario=="")
                            {
                                $exito1=true;
                            }
                            else
                            {
                                //$sql=$conexion->query('SELECT * FROM test.notas WHERE clienteid='.$cliente.';');
                                //if($sql->rowCount()==0)
                                //{  
                                    $sql1="INSERT INTO test.notas (clienteid, usuarioid, comentario, fecha, stat) VALUES ('$cliente', '$usuario', '$comentario', now(), '1');";
                                /*}
                                else
                                {   
                                    $fecha=date("Y-m-d");
                                    $sql1="UPDATE test.notas SET comentario='".$comentario."', usuarioid='".$usuario."', fecha='".$fecha."' WHERE clienteid=".$cliente.";";
                                }*/
                                $exito1=$conexion->exec($sql1);
                            }
                            if($exito1)
                            {
                                    header("location:../ver/ventacliente.php?verid=$cliente&vercli=$nombrecli");
                            }
                            else
                            {
                                    echo "NO se registraron los datos correctamente<br/>";
                                    echo "o existe un problema con la conexion a la base de datos<br/>";
                                    echo "Para intentar nuevamente, debe regresar con la flecha que se encuentra arriba a la izquierda</a><br/>";
                                    echo "o puede ir a <a href='backhome.html'>Inicio</a><br/>";
                            }
                        
	}
	else
        {
            echo "Su comentario no pudo ser registrado<br/>";
            echo "Por favor, contacte con el administrador. Error: 4042<br/>";
            echo "<a href='backhome.html'>Volver a Inicio</a>";
        }
	?>
    
    
</body>
</html>
