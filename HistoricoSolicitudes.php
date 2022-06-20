<h3 class="titulo">Historial De Solicitudes</h3>
        <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
        <table class="table table-hover table-sm table-striped table-responsive">
           
            <tr>
                <center><td > No.</td></center>
                <td>Fecha</td>
                <td>Hora</td>
                <td>No.Solicitud</td>
                <td>Lote</td>
                <td>Descripcion</td>
                <td>Completada</td>
                <td>Servicio</td>
               
                <td>Otro Solicitante</td>
                           
            </tr> 
            <?php   
            $inm_id_b  = $idinm_;
           

            $estadoc = "SELECT top 6 a.sol_id ,b.inm_IdGenerado,convert( varchar(10), sol_fecha, 103) as fecha ,
stuff( right( convert( varchar(26), sol_fecha, 109 ), 15 ), 7, 7, ' ' ) as hora ,a.sol_Descripcion,
case a.sol_Estado when 1 then 'SI' when 2 then 'NO' when 3 then 'ANULADA' END AS COMPLETADA
,(SELECT SER_nOMBRE FROM agu_servicios where ser_id =a.ser_id) as servicio,a.ser_NombreOtroSolicitante
from agu_SolicitudesDeServicio a, tblInmuebles b
where a.inm_id=b.inm_id and b.inm_id='$inm_id_b' order by a.sol_id desc";
         
            $ejecutaec = sqlsrv_query($con, $estadoc);
            $i = 0;
           
            $efe = 1;
            while($fila = sqlsrv_fetch_array($ejecutaec)){
                $sol_id_ = $fila['sol_id'];
                $inm_IdGenerado_ = $fila['inm_IdGenerado'];
                $fecha__= $fila['fecha'];
                $hora_ = $fila['hora'];
                $sol_Descripcion_ = $fila{'sol_Descripcion'};
                $COMPLETADA_ = $fila['COMPLETADA'];
                $servicio_ = $fila['servicio'];
                $ser_NombreOtroSolicitante_ = $fila['ser_NombreOtroSolicitante'];
               
                $i++;
               
                
              
                    
               
               
                $fechaEntera = strtotime("$fecha__");
                $anio = date("Y", $fechaEntera);
                $mes = date("m", $fechaEntera);
                $mes_fac = $mes . "-" . $anio;
              
                ?>
                <tr  align="right">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $fecha__; ?></td>
                    <td><?php echo $hora_; ?></td>
                    <td><?php echo $sol_id_; ?></td>
                    <TD NOWRAP><?php echo $inm_IdGenerado_; ?></TD>
                    <td><?php echo $sol_Descripcion_; ?></td> 
                     
                    <td><?php echo $COMPLETADA_; ?></td>
                    <td><?php echo $servicio_; ?></td>
                    <td><?php echo $ser_NombreOtroSolicitante_; ?></td>
                    
                </tr>

                <?php
                }
                ?>
            </table>