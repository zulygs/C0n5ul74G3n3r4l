<?php
include "conexion.php";


    $checkServicio_=$_REQUEST["checkServicio"];  
    $servicio=$_REQUEST["Select_servicio"];
    $ejecutada=$_REQUEST["radio_ejec"];
    $fecha=$_REQUEST["input_date"];
    $fecha2=$_REQUEST["input_date2"];
    //echo "$servicio";
     $sql_preg="exec ImprimirServicioPorRango1 @tipo=$checkServicio_,@servicio=$servicio,@rangoI='$fecha',@rangoF='$fecha2',@estad=$ejecutada";
 
 
            $registros = sqlsrv_query($con,$sql_preg);
    
$data = array();   
while($row = sqlsrv_fetch_array($registros)) {
   $data[] = array(
    "sol_id"            => $row["sol_id"],
    "inm_id"            => $row["inm_id"],
    "lote"            => $row["lote"],
    "plo_id"            => $row["plo_id"],
    "nombre_plomero"    => $row["nombre_plomero"],
    "ser_id"            => $row["ser_id"],
    
    "sol_fecha"         => date_format($row["sol_fecha"],"Y-m-d H:i:s"),
    "estado"            => $row["estado"],
    "det_tipo"            => $row["det_tipo"]
    
      

   );
   
}

header("Content-type: application/json");
echo json_encode(array("data" => $data));

?>