<?php  
// Configura los datos de tu cuenta
include('../conexion1.php');


 $query = "SELECT * from usuario ";
    $eje_query = mysqli_query($con, $query);
    $result    = mysqli_num_rows($eje_query);
    while ($fila=mysql_fetch_array($eje_query)) {
    	print_r($fila);
    }
    echo "string";
?> 