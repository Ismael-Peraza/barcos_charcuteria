<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>Nuevo Articulo</title>
        
    <?php
        include ("menuscroll.php");
            
        if(isset($_POST['modart']))
        {
                header("modart.php");
        }
        elseif(isset($_POST['newart']))
        {
                header("newart.php");
        }              
    ?>
                                
        <!--<div>TODO write content</div>-->
        <div id="particles-js"></div>
        <script src="js/particles.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/alto.js"></script>

    </body>
</html>