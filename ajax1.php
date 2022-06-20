<?php
include "conexion.php";
session_start();

if (empty($_POST)){

} else {
    if($_POST['action'] == 'searchLot'){

        if($_POST['lote']){
            $id_g = $_POST['lote'];
            
            $fechoy = date('Y-m-d');
            $ejeqlote = sqlsrv_query($con, "SELECT dbo.recuperaEstadoInmueble(inm_id) as estado, dbo.recuperaNombreInmueble(inm_id) as nombre, 
            dbo.recuperaDireccionInmueble(inm_id) as direccion, dbo.recuperaNitInmueble(inm_id) as nit,
            dbo.ecuentasaldopormes(inm_id,'$fechoy') as saldo, dbo.devuelveEncargadoSector(inm_IdGenerado) as encargado,dbo.saldoConvenioCuotas(inm_id)as convenio, * 
            from tblInmuebles where 
            inm_IdGenerado like '$id_g' ");
            $fila = 0;
            while ($fila = sqlsrv_fetch_array($ejeqlote)){
                $id_generado = $fila['inm_IdGenerado'];
                
                echo json_encode($fila,JSON_UNESCAPED_UNICODE);
             
            }
      
           
        }
        
        exit;
    }else { 
        if($_POST['action'] == 'searchLot2'){

            if($_POST['idInmueble']){
            $id_m = $_POST['idInmueble'];
            $fechoy = date('Y-m-d');
            $ejeqlote = sqlsrv_query($con, "SELECT dbo.recuperaEstadoInmueble(inm_id) as estado, dbo.recuperaNombreInmueble(inm_id) as nombre, 
            dbo.recuperaDireccionInmueble(inm_id) as direccion, dbo.recuperaNitInmueble(inm_id) as nit,
            dbo.ecuentasaldopormes(inm_id,'$fechoy') as saldo, dbo.devuelveEncargadoSector(inm_IdGenerado) as encargado,dbo.saldoConvenioCuotas(inm_id)as convenio, * 
            from tblInmuebles where 
            inm_id like '$id_m'");
            $fila = 0;

            while ($fila = sqlsrv_fetch_array($ejeqlote)){
                $id_generado = $fila['inm_IdGenerado'];
                echo json_encode($fila,JSON_UNESCAPED_UNICODE);

            }
        

        
        exit;
        
   }    
}
   

 if($_POST['action'] == 'searchLot3'){

            if($_POST['idInmueble']){
            $id_m = $_POST['idInmueble'];
            $fechoy = date('Y-m-d');
            $ejeqlote = sqlsrv_query($con, "SELECT c.ARE_ID,dbo.devuelveNombreArea(c.ARE_ID) as area,  c.sect_Id,dbo.devuelveNombreSector(c.sect_Id) as sector, c.PLO_ID as idPlomero,dbo.recuperaNombrePlomero(c.PLO_ID) as nombre_Plomero,CONCAT(c.PLO_ID, '  ', dbo.recuperaNombrePlomero(c.PLO_ID)) as persona,colonia,horarios,a.inm_id,c.sect_Id,dbo.recuperaTelefonoPlomero(c.PLO_ID) as telefono_P
                from tblInmuebles a
                left join  tblDetalleUbicacionInmueble b
                on a.det_id = b.det_Id
                left join SEG_PLOMEROSPORSECTOR c
                on b.sect_id=c.SECT_ID and b.are_id = c.are_id
                where a.inm_id='$id_m'");
            $fila = 0;
                while ($fila = sqlsrv_fetch_array($ejeqlote)){
                $id_generado = $fila['inm_id'];
                echo json_encode($fila,JSON_UNESCAPED_UNICODE);
            }
        exit;
        
            } 
        }

     if($_POST['action'] == 'searchLot4'){

            if($_POST['lote']){
            $id_g = $_POST['lote'];
            $fechoy = date('Y-m-d');
            $ejeqlote = sqlsrv_query($con, "SELECT c.ARE_ID,dbo.devuelveNombreArea(c.ARE_ID) as area,  c.sect_Id,dbo.devuelveNombreSector(c.sect_Id) as sector, c.PLO_ID as idPlomero,dbo.recuperaNombrePlomero(c.PLO_ID) as nombre_Plomero,CONCAT(dbo.recuperaNombrePlomero(c.PLO_ID), ',', c.PLO_ID) as persona
                ,colonia,horarios,a.inm_id,a.inm_IdGenerado,c.sect_Id,dbo.recuperaTelefonoPlomero(c.PLO_ID) as telefono_P
                from tblInmuebles a
                left join  tblDetalleUbicacionInmueble b
                on a.det_id = b.det_Id
                left join SEG_PLOMEROSPORSECTOR c
                on b.sect_id=c.SECT_ID and b.are_id = c.are_id
                where a.inm_IdGenerado='$id_g'");
            $fila = 0;
                while ($fila = sqlsrv_fetch_array($ejeqlote)){
                $id_generado = $fila['inm_IdGenerado'];
                echo json_encode($fila,JSON_UNESCAPED_UNICODE);
            }
        exit;
        
    } }

}
    
    if($_POST['action'] == 'searchSec'){
        if($_POST['sector']){
            $sec = $_POST['sector'];
            $query1 = mysqli_query($con, "SELECT * FROM cliente WHERE sec_codigo = '$sec' order by codcli desc limit 1");
            mysqli_close($con);
            $result1 = mysqli_num_rows($query1);
            $data1 = '';
            if ($result1 > 0) {
                $data1 = mysqli_fetch_assoc($query1);
            } else {
                $data1 = 0;
            }
            echo json_encode($data1,JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
    if($_POST['action'] == 'searchsobre'){
        if($_POST['sobre']){
            $sec = $_POST['sobre'];

            $data1 = 0;

            if ($sec == 1 ) {
                $data1 = 1;
            } 
            if ($sec == 2) {
                $data1 = 2;
            }
            echo json_encode($data1,JSON_UNESCAPED_UNICODE);
            
        }
        exit;
    }
    exit;








}
exit;
?>