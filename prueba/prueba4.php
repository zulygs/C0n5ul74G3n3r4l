<?php
session_start();
session_unset();
session_destroy(); 
setcookie("id_extreme","x",time()-3600,"/");
header("Location: prueba1.php");
?>