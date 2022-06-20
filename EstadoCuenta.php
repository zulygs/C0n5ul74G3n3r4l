<h3 class="titulo">Estado de Cuenta</h3>
        <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
        <table class="table table-hover table-sm table-striped table-responsive">
            <tr>
                <td>No.</td>
                <td>Fecha</td>
                <td>Descripcion</td>
                <td>DEBE</td>
                <td>HABER</td>
                <td>SALDO</td>
                <td>No.Doc</td>
                <td>USUARIO</td>
                <td>Dte</td>
                
                <td>Observaciones</td>                  
            </tr>
            <?php   
            $inm_id_b  = $idinm_;
            $fecha_actual = date("Y-m-d");
            $fecha_ = date("Y-m-d",strtotime($fecha_actual."- 12 MONTH"));
        
       $estadoccc ="SELECT top 6  REPLACE(convert(varchar(11),dia_Fecha,106), ' ','/') as fecha,tra_Codigo+'-'+tra_Descripcion as decripciop,(case WHEN DEBE IS NULL THEN 0.0 ELSE DEBE END) AS DEBE,(case WHEN HABER IS NULL THEN 0.0 ELSE HABER END) as haber,  
(SELECT dbo.saldopordia('$inm_id_b',id))  AS SALDO,
(case WHEN mov_NoDocto IS NULL THEN 0 ELSE mov_NoDocto END) AS DOCUMENTO,USUARIO,dte,observaciones,id 
from ecuenta where inm_id='$inm_id_b'
group by efecto,dia_fecha,tra_Codigo,tra_Descripcion,DEBE,HABER,mov_NoDocto,FHSistema,USUARIO,cae,dte,observaciones,id 
order by  id desc, dia_fecha";

            $ejecutaec = sqlsrv_query($con, $estadoccc);
            $i = 0;
            $saldoo = 0;
            $efe = 1;
            while($fila = sqlsrv_fetch_array($ejecutaec)){  
                $dia_Fecha_ = $fila['fecha'];
                $tra_Descripcion_ = $fila['decripciop'];
                $DEBE_ = $fila['DEBE'];
                $HABER_ = $fila{'haber'};
                $SALDO_ = $fila{'SALDO'};
                $mov_NoDocto_ = $fila['DOCUMENTO'];
                $USUARIO_ = $fila['USUARIO'];
                $dte_ = $fila['dte'];               
                $observa_2 = $fila{'observaciones'};
                $i++;
                ?>
                <tr  align="right">
                    <td><?php echo $i; ?></td>
                    <td><?php echo ($dia_Fecha_); ?></td>
                    <TD NOWRAP><?php echo $tra_Descripcion_; ?></TD>
                    <td><?php echo number_format ($DEBE_, 2); ?></td>
                    <td><?php echo number_format ($HABER_, 2); ?></td> 
                    <td><?php echo number_format ($SALDO_,2); ?></td> 
                    <td><?php echo $mov_NoDocto_; ?></td>
                    <td><?php echo $USUARIO_; ?></td>
                    <td><?php echo $dte_; ?></td>
                     <td><?php echo $observa_2; ?></td>   
                </tr>
                <?php
                }
                ?>
            </table>