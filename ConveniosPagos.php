<h3 class="titulo">Convenios De Pago</h3>
        <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
        <table class="table table-hover table-sm table-striped table-responsive">
           
            <tr>
                <center><td > No.</td></center>
                <td>Fecha</td>
                <td>Fecha Limite</td>
                <td>Trx</td>
                <td>Descripción</td>
                <td>Saldo</td>
                <td>Numero</td>
                <td>ID</td>
                <!--<td>Abono</td>-->
               
             
                           
            </tr> 
            <?php   
            $inm_id_b  = $idinm_;
           

            $estadocccc = "SELECT  REPLACE(convert(varchar(11),b.con_FechaCuota1,106), ' ','/') fecha_de_cuota,
                REPLACE(convert(varchar(11), a.cre_FechaLimite, 106), ' ', '/') as fecha_limite_de_pago,
                c.tra_Codigo, a.cre_Descripcion, a.cre_Saldo, b.con_Numero, b.con_id
                 from agu_ConveniosCuotas a
                 inner join agu_convenios b on a.con_id = b.con_id
                 inner join agu_TransaccionesCaja c on b.con_TipoTransaccion = c.tra_id
                 where b.inm_id = '$inm_id_b' and a.cre_Saldo > 0";
        
            $ejecutaec = sqlsrv_query($con, $estadocccc);
            $i = 0;
           
            $efe = 1;
            while($fila = sqlsrv_fetch_array($ejecutaec)){
                $fecha__= $fila['fecha_de_cuota'];
                $fecha_limite_de_pago_ = $fila['fecha_limite_de_pago'];
                $tra_Codigo_ = $fila{'tra_Codigo'};
                $cre_Descripcion_ = $fila['cre_Descripcion'];
                $cre_Saldo_ = $fila['cre_Saldo'];
                $con_Numero_ = $fila['con_Numero'];
                $con_id_ = $fila['con_id'];
                
               
                $i++;
               
                
              
                    
               
               
                $fechaEntera = strtotime("$fecha__");
                $anio = date("Y", $fechaEntera);
                $mes = date("m", $fechaEntera);
                $mes_fac = $mes . "-" . $anio;
              
                ?>
                <tr  align="right">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $fecha__; ?></td>
                    <td><?php echo $fecha_limite_de_pago_; ?></td>
                    <td><?php echo $tra_Codigo_; ?></td>
                    <td><?php echo $cre_Descripcion_; ?></td>
                    <td><?php echo $cre_Saldo_; ?></td> 
                     
                    <td><?php echo $con_Numero_; ?></td>
                    <td><?php echo $con_id_; ?></td>
                    

                </tr>

                <?php
                }
                ?>
            </table>