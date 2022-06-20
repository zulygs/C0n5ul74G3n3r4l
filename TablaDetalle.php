<?php 
include "conexion.php";
$e=2;
 $sql_preg="exec ImprimirServicioPorRango1 @tipo=$e,@servicio=8,@rangoI='2021-04-01',@rangoF='2021-04-08',@estad=2";
 
 
            $registros = sqlsrv_query( $con,$sql_preg);
    

while($row = sqlsrv_fetch_array($registros)) {
  print_r($row);
}
 ?>
