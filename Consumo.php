<h3 class="titulo">Consumos</h3>
        <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
        <table class="table table-hover table-sm table-striped table-responsive">
           
            <tr>
                <center><td > No.</td></center>
                <td>Fecha</td>
                
                <td>Lectura Anterior</td>
                <td>Lectura Actual </td>
                <td>Lectura Consumo </td>
                <td>Derechos Mts</td>
                <td>Exceso Mts3</td>
                <td>Valor Consumo</td>
                <td>Valor Exceso</td>
                <td>Valor Total</td>
                <td>Concepto</td>
                
              
                           
            </tr> 
            <?php   
            $inm_id_b  = $idinm_;
           $estadoc = "SELECT top 6 REPLACE(convert(varchar(11),LEC.lec_FechaOperacion,106),'','/') as fecha,
                LEC.lec_Anterior, LEC.lec_Actual, LEC.lec_Consumo, LEC.lec_DerechoMts,
               LEC.lec_ExcesoMts3,LEC.lec_ValorConsumo,LEC.lec_ValorExceso,LEC.lec_ValorTotal,
               CLEC.cl_Nombre AS Concepto
               FROM dbo.agu_Lecturas AS LEC INNER JOIN
                dbo.pdv_CiclosMeses AS CM ON LEC.mes_Id = CM.mes_id INNER JOIN
               dbo.pdv_CiclosContables AS CC ON CM.cic_id = CC.cic_id LEFT OUTER JOIN
                dbo.agu_ConceptosLecturas AS CLEC ON LEC.cl_id = CLEC.cl_id
                WHERE (LEC.inm_Id = '$inm_id_b' )
                ORDER BY CC.cic_Nombre DESC, CM.mes_Numero DESC";

          /*  $estadoc = " SELECT top 6 CC.cic_Nombre,CM.mes_Nombre, REPLACE(convert(varchar(11),LEC.lec_FechaOperacion,106),'','/') as fecha,
                LEC.lec_Anterior, LEC.lec_Actual, LEC.lec_Consumo, LEC.lec_DerechoMts,
               LEC.lec_ExcesoMts3,LEC.lec_ValorConsumo,LEC.lec_ValorExceso,LEC.lec_ValorTotal,
               CLEC.cl_Nombre AS Concepto
               FROM dbo.agu_Lecturas AS LEC INNER JOIN
                dbo.pdv_CiclosMeses AS CM ON LEC.mes_Id = CM.mes_id INNER JOIN
               dbo.pdv_CiclosContables AS CC ON CM.cic_id = CC.cic_id LEFT OUTER JOIN
                dbo.agu_ConceptosLecturas AS CLEC ON LEC.cl_id = CLEC.cl_id
                WHERE (LEC.inm_Id = '$inm_id_b' )
                ORDER BY CC.cic_Nombre DESC, CM.mes_Numero DESC";*/
        
            $ejecutaec = sqlsrv_query($con, $estadoc);
            $i = 0;
           
            $efe = 1;
            while($fila = sqlsrv_fetch_array($ejecutaec)){
               
                $fecha__= $fila['fecha'];
                $lec_Anterior_ = $fila['lec_Anterior'];
                $lec_Actual_ = $fila{'lec_Actual'};
                $lec_Consumo_ = $fila['lec_Consumo'];
                $lec_DerechoMts_ = $fila['lec_DerechoMts'];
                $lec_ExcesoMts3_ = $fila['lec_ExcesoMts3'];
                $lec_ValorConsumo_ = $fila['lec_ValorConsumo'];
                $lec_ValorExceso_ = $fila['lec_ValorExceso'];
                $lec_ValorTotal_ = $fila['lec_ValorTotal'];
               $Concepto_ = $fila['Concepto'];
                $i++;
               
                
              
                    
               
           
              
                ?>
                <tr  align="right">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $fecha__; ?></td>
                   
                    <td><?php echo $lec_Anterior_; ?></td>
                    <td><?php echo $lec_Actual_; ?></td> 
                     
                    <td><?php echo $lec_Consumo_; ?></td>
                    <td><?php echo $lec_DerechoMts_; ?></td>
                    <td><?php echo $lec_ExcesoMts3_; ?></td>

                    <td><?php echo $lec_ValorConsumo_; ?></td>
                    <td><?php echo $lec_ValorExceso_; ?></td>
                    <td><?php echo $lec_ValorTotal_; ?></td>
                     <td><?php echo $Concepto_; ?></td>
                </tr>

                <?php
                }
                ?>
            </table>
            