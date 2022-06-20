<?php 
include 'conexion.php';

$fechaa=$_REQUEST["fechas"];

 $query="SELECT sol_id,dbo.alote(inm_id) as lote,sol_fecha,sol_Descripcion,dbo.devuelveNombreServicio(ser_id) as servicio, 
   dbo.recuperaNombreUsuario(ser_usuario) as usuario,ser_TelefonoOtroSolicitante,plo_id,dbo.recuperaNombrePlomero(plo_id) as nombreplo
   from agu_SolicitudesDeServicio where sol_Estado=2 and CAST(sol_fecha as date) ='$fechaa'  
   order by sol_id asc";
   $result=sqlsrv_query($con,$query); 

   $data = array();   
while($row = sqlsrv_fetch_array($result)) {
   $data[] = array(
   	"sol_id" => $row["sol_id"],
   	"lote" => $row["lote"],
      "sol_fecha" => date_format($row["sol_fecha"],"Y-m-d H:i:s"),
      "sol_Descripcion" => $row["sol_Descripcion"],
      "servicio" => $row["servicio"],
      "usuario" => $row["usuario"],
      "ser_TelefonoOtroSolicitante" => $row["ser_TelefonoOtroSolicitante"],
      "plo_id" => $row["plo_id"],
      "nombreplo" => $row["nombreplo"]

      
    

   );
   
}

header("Content-type: application/json");
echo json_encode(array("data" => $data));

   ?>


