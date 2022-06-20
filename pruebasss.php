<?php
include 'conexion.php';


 $query="SELECT sol_id,dbo.alote(inm_id) as lote,sol_fecha,sol_Descripcion,dbo.devuelveNombreServicio(ser_id) as servicio, 
   dbo.recuperaNombreUsuario(ser_usuario) as usuario,ser_TelefonoOtroSolicitante,plo_id,dbo.recuperaNombrePlomero(plo_id) as nombreplo
   from agu_SolicitudesDeServicio where sol_Estado=2 and CAST(sol_fecha as date) ='2021-10-04'  
   order by sol_id asc";
   $result=sqlsrv_query($con,$query); 

  
while($row = sqlsrv_fetch_array($result)) {
print_r($row);}
/*SELECT distinct codAgencia,
                          case
                          when codAgencia  =1 and tra_Descripcion='Reconexion' then   
                          dbo.devuelveCodigoAgencia(codAgencia)
                          when codAgencia  =1 and tra_Descripcion='Reconexion WEB' then  
                          'Pagina Web'
                          when codAgencia  <> 1 then
                          dbo.devuelveCodigoAgencia(codAgencia)
                          end  AS AGENCIA
                          ,
                          COUNT(*) AS TOTAL ,tra_Codigo,tra_Descripcion from ecuenta where tra_Codigo='RE'
                          and CAST(dia_Fecha as date) ='2021-10-01'
                          GROUP BY codAgencia,tra_Codigo,tra_Descripcion
                          order by codAgencia*/
?>