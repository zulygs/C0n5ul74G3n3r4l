<?php
include('prueba2.php');
if($_SESSION["logeado"] == "SI"){ 
header ("Location: prueba3.php");
}
?>		<form name="form1" method="post" action="prueba5.php"><br>
<span style="color:#000; font-size:12px;">Usuario</span><br>
   <input name="username" type="text" id="username"><br><br>
<span style="color:#000; font-size:12px;">Contrasenia</span><br>
    <input name="password" type="password" id="password"><br><br>
    <input type="checkbox" name="recordar" id="recordar">
<span style="color:#000; font-size:12px;">Recordar</span>
    <br><br>
     <input type="submit" name="Submit" value="Entrar"></form>