<?php
include('config.php');
if($_SESSION["logeado"] != "SI"){
header ("Location: prueba1.php");
exit;
}
?>

USTED ESTA LOGEADO !!!