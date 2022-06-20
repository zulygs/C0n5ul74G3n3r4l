<h3 class="titulo">Estado de Cuenta</h3>
        <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
        <table class="table table-hover table-sm table-striped table-responsive">
            <tr>
                <td>No.</td>
                <td>Fecha</td>
                <td>Transacción</td>
                <td>DEBE</td>
                <td>HABER</td>
                <td>SALDO</td>
                <td>No.Doc.</td>
                <td>USUARIO</td>
                <td>Dte</td>
                <td>Recibo</td>
                <td>Observaciones</td>                  
            </tr>
            <?php   
            $inm_id_b  = $idinm_;
            $fecha_actual = date("Y-m-d");
            $fecha_ = date("Y-m-d",strtotime($fecha_actual."- 12 MONTH"));
            /*$estadoc = "SELECT top 6 inm_id, cast(dia_Fecha as date) as dia_Fecha, tra_Descripcion, DEBE, HABER, mov_NoDocto, USUARIO, dte, rec_id as rec, (select observaciones from pdv_RecibosDeCaja as r where r.rec_id = e.rec_id)
            as observa, observaciones, dbo.ecuentasaldopormes('$inm_id_b','$fecha_') as saldo
            from ecuenta as e where inm_id = '$inm_id_b' and dia_Fecha > '$fecha_' order by dia_Fecha desc ";*/
       $estadocc ="SELECT top 6  REPLACE(convert(varchar(11),dia_Fecha,106), ' ','/') as fecha,tra_Codigo+'-'+tra_Descripcion,(case WHEN DEBE IS NULL THEN 0.0 ELSE DEBE END) AS DEBE,(case WHEN HABER IS NULL THEN 0.0 ELSE HABER END) as haber,  
(SELECT dbo.saldopordia(9508,id))  AS SALDO,
(case WHEN mov_NoDocto IS NULL THEN 0 ELSE mov_NoDocto END) AS DOCUMENTO,USUARIO,dte,observaciones,id 
from ecuenta where inm_id='$inm_id_b'
group by efecto,dia_fecha,tra_Codigo,tra_Descripcion,DEBE,HABER,mov_NoDocto,FHSistema,USUARIO,cae,dte,observaciones,id 
order by  id desc, dia_fecha";
            $ejecutaec = sqlsrv_query($con, $estadocc);
            $i = 0;
            $saldoo = 0;
            $efe = 1;
            while($fila = sqlsrv_fetch_array($ejecutaec)){
                $inm_id_ = $fila['inm_id'];
                $dia_Fecha_ = $fila['dia_Fecha'];
                $tra_Descripcion_ = $fila['tra_Descripcion'];
                $DEBE_ = $fila['DEBE'];
                $HABER_ = $fila{'HABER'};
                $mov_NoDocto_ = $fila['mov_NoDocto'];
                $USUARIO_ = $fila['USUARIO'];
                $dte_ = $fila['dte'];
                $rec_ = $fila{'rec'};
                $observa_1 = $fila{'observa'};
                $observa_2 = $fila{'observaciones'};
                $i++;
                $observa_ = $observa_1 ." " . $observa_2;
                if ($efe == 1 ){
                    $saldoQuery = "SELECT  (sum(DEBE)-sum(HABER)) as rsaldo from ecuenta where inm_id = '$inm_id_b'  and dia_fecha < '$fecha_'";
                    $ejecutasaldo = sqlsrv_query($con, $saldoQuery);
                    while($fila = sqlsrv_fetch_array($ejecutasaldo)){
                        $saldoo = $fila['rsaldo'];
                    }
                    $efe = 0;
                }
                $saldoo = $saldoo + $DEBE_ - $HABER_;
                $len = strlen("$dte_");
                if ( $len > 14 ) {
                    $str_dte0 = substr("$dte_", 0,4); 
                    $str_dte1 = substr("$dte_", -6);
                    $str_dte2 = substr("$dte_", 6,1);
                    $str_dte = $str_dte0 . '-' . $str_dte2 .'-'. $str_dte1;
                }       
                else {
                    $str_dte = substr("$dte_", -9);
                }
                $mesanio = date_format($dia_Fecha_, 'Y-m-d');
                $fechaEntera = strtotime("$mesanio");
                $anio = date("Y", $fechaEntera);
                $mes = date("m", $fechaEntera);
                $mes_fac = $mes . "-" . $anio;
                switch ($mes_fac) {
                    case "06-2018":
                        $mes_id_ = 119;
                        break;
                    case "07-2018":
                        $mes_id_ = 120;
                        break;
                    case "08-2018":
                        $mes_id_ = 121;
                        break;
                    case "09-2018":
                        $mes_id_ = 122;
                        break;
                    case "10-2018":
                        $mes_id_ = 123;
                        break;
                    case "11-2018":
                        $mes_id_ = 124;
                        break;
                    case "12-2018":
                        $mes_id_ = 125;
                        break;
                    case "01-2019":
                        $mes_id_ = 127;
                        break;
                    case "02-2019":
                        $mes_id_ = 128;
                        break;
                    case "03-2019":
                        $mes_id_ = 129;
                        break;
                    case "04-2019":
                        $mes_id_ = 130;
                        break;
                    case "05-2019":
                        $mes_id_ = 131;
                        break;
                    case "06-2019":
                        $mes_id_ = 132;
                        break;
                    case "07-2019":
                        $mes_id_ = 133;
                        break;
                    case "08-2019":
                        $mes_id_ = 134;
                        break;
                    case "09-2019":
                        $mes_id_ = 135;
                        break;          
                    case "10-2019":
                        $mes_id_ = 137;
                        break;              
                    case "11-2019":
                        $mes_id_ = 137;
                        break;  
                    case "12-2019":
                        $mes_id_ = 138;
                        break;  
                }
                ?>
                <tr  align="right">
                    <td><?php echo $i; ?></td>
                    <td><?php echo date_format ($dia_Fecha_, 'd/m/Y'); ?></td>
                    <TD NOWRAP><?php echo $tra_Descripcion_; ?></TD>
                    <td><?php echo number_format ($DEBE_, 2); ?></td>
                    <td><?php echo number_format ($HABER_, 2); ?></td> 
                    <td><?php echo number_format ($saldoo,2); ?></td> 
                    <td><?php echo $mov_NoDocto_; ?></td>
                    <td><?php echo $USUARIO_; ?></td>
                    <TD NOWRAP><a target= "_blank" href = "../Facturas/facturapdf.php?inm_id_b=<?php echo $inm_id_; ?>& mes_anio=<?php echo $mes_id_;?>"> <?php echo $str_dte; ?></font> </a></td>
                    <td><?php echo $rec_; ?></td>
                    <TD NOWRAP><?php echo $observa_; ?></td> 
                </tr>

                <?php
                }
                ?>
            </table>