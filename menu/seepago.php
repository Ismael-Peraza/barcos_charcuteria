<?PHP
    header('location:ver/pagodiary.php');
?>
<!--
<html>
<head>
    <script>
        function mostrar(enla) {
          obj = document.getElementById('oculto');
          obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
          enla.innerHTML = (enla.innerHTML == '-') ? '+' : '-';
        }
        function mostrar(enla) {
          obj = document.getElementById('oculto2');
          obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
          enla.innerHTML = (enla.innerHTML == '-') ? '+' : '-';
        }
        
        function mostrar2(enla , etik) {
            obj = document.getElementById(etik);
            obj.style.visibility = (obj.style.visibility == 'hidden') ? 'visible' : 'hidden';
            enla.innerHTML = (enla.innerHTML == '[-]') ? '[+]' : '[-]';
        }
        
    </script>
    
</head>
<body> 
    <input type="button" value="Ver 1" 
        onClick="document.getElementById('oculto').style.visibility='visible'; document.getElementById('oculto2').style.visibility ='hidden'"> 
    <br>Este texto se ve siempre 
    <div id="oculto" style="visibility:visible"> 
        Este se verá al principio
    </div> 
    <div id="oculto2" style="visibility:hidden"> 
        Este texto se verá ocultando el primero
    </div> 
    <input type="button" value="Ver 2" 
        onClick="document.getElementById('oculto').style.visibility ='hidden'; document.getElementById('oculto2').style.visibility='visible'">

    <span id="oculto" style="width:500;"></span>
        <br><a href="Javascript:document.getElementById('oculto') .innerText='Y la luz se hizo';">¡Hágase la luz!</a>

        <br><br>
        
    <a href="#" onclick="mostrar(this); return false" />+</a>
    <div id="oculto" style="visibility:hidden">
        Este texto se verá cuando yo quiera 2
    </div>
    <br><br>
    
    <a href="#" onclick="mostrar2(this); return false" />+</a>
    <div id="oculto" style="visibility:hidden">
        Veamos que pasa
    </div><a href="#" onclick="mostrar2(this); return false" />+</a>
    <div id="oculto" style="visibility:hidden">
        Cosa mas grande muchacho
    </div>
    
</body>  
-->