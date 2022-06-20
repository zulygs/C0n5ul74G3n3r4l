<?php
include("conexion.php");
session_start();
 $valor=0;
 $valorr=3;
  $fechaname_ = " ";
$userr=$_SESSION['user'];
/*if(!isset($_SESSION['active3'])){
  echo "<script>window.location='../index.html';</script>";
  	        header("Location: ConsultaRecone.php");

}*/date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d");  
if (isset($_POST['botonsubmit'])) {
    $fechaname_ = $_POST['fechaname'];
   
    
  
            $valor=1;
          }else{
             $valor=0;
        
          }
          
  
  

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'includes/head.php';?>
    <?php include "includes/scriptes.php";?>

  <?php //include 'Querys.php';?>
  <title>Servicios</title>
</head>
<body>

  <div class="panel-header panel-header-lg1" id="lateral">
    <div class="col form-row">
      <div class="container container-form-lg" style="width: 600px">
        <center>
          <div class="form-row" >
            <div class="col form-group" id="" >
              <div class="card" >
                <h2>Reconexiones Por Fecha</h2>
                <form class="needs-validation" novalidate method="POST" action="ConsultaRecone.php" >
                 <!--<center>
                  <h2>Resumen De Reconexiones <br><?php echo $fechaname_; ?></h2>
                  <div class="col form-group" >
                    <input type="date" name="fechaname" id="fechaname" value="<?php echo($hoy) ?>" required>
                    <button class="btn btn-primary btn-lg" name="botonsubmit" id="botonsubmit" type="submit">Buscar</button>
                  </div>
                </center>-->
             
              <div class="card-header row" >
                <div class="col form-group" >
                  <div class="table-responsive"  id="hhh" >
                    <table class="table">
                      <thead class=" text-primary2" align="" >
                        <th ><font color="white">No.</font></th>
                        <th ><font color="white">Fecha Reconexion</font></th>
                        <th ><font color="white">Total</font></th>
                        <th ><font color="white">Detalle</font></th>
                      </thead>
                      <tbody>
                        <?php
                        $busqueda2    = "SELECT   CONVERT (date, dia_Fecha, 103) as dia_Fecha,
                        COUNT(*) as  tot from ecuenta where   tra_codigo='RE' and CAST(dia_fecha as date) 
                        between CONVERT(VARCHAR(25),DATEADD(dd,-(DAY(GETDATE())-1),GETDATE()),101)
                        AND CONVERT(VARCHAR(25),DATEADD(dd,-(DAY(DATEADD(mm,1,GETDATE()))),DATEADD(mm,1,GETDATE())),101)
                        GROUP BY CONVERT (date, dia_Fecha, 103) 
                        order by dia_Fecha";
                        $buscar2 = sqlsrv_query($con, $busqueda2);
                        $total_  = 0;

                        $i=0;

                        while ($fila2 = sqlsrv_fetch_array($buscar2)) {
                          $dia_Fecha_ = $fila2['dia_Fecha']->format("d-m-Y");
                          $total = $fila2['tot'];
                          $total_+=$fila2['tot'];

                          $i++;
                          ?>
                          <tr class="" align="">
                            <td ><?php echo $i; ?></td>
                            <td width=""><?php echo $dia_Fecha_; ?></td>
                            <td><?php echo $total; ?></td>

                            <td><a id="bbbb" type="submit"  href="ConsultaRecone.php?feccha=<?php echo $fila2['dia_Fecha']->format("Y-m-d"); ?>&valor=3" >
                              <img src="https://img.icons8.com/color/36/000000/show-property.png"/>Detalle
                            </a></td>
                          </tr>
                        <?php }  ?>
                        <tr>
                          <td><?php echo "Total:"; ?></td>
                        <td></td>
                       
                        <td><?php echo number_format($total_); ?></td>
                        <td></td>
                        <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
               </form>
            </div>
          </div>
        </div>
      </center>
    </div>
    <?php

    if (isset($_REQUEST["valor"])==3){
                $fechab=$_REQUEST["feccha"];
               ?>
    <div class="container container-form-lg" style="width: 600px">
      <center>
        <div class="form-row" >
          <div class="col form-group" id="" >
            <div class="card" >
            
                <h2>Resumen De Reconexiones <br><?php echo $fechab; ?></h2>
                <div class="card-header row" >
                    
                    <div class="table-responsive" style="width: auto" id="hh" >
                      <table class="table">
                        <thead class=" text-primary2" align="center" >
                          <th ><font color="white">Codigo Agencia</font></th>
                          <th><font color="white">Agencia</font></th>
                          <th><font color="white">Total</font></th>
                          <th><font color="white">Codigo Transaccion</font></th>
                          <th><font color="white">Descripción</font></th>
                        </thead>
                        <tbody>
                          <?php
                          $busqueda    = "SELECT distinct codAgencia,
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
                          and CAST(dia_Fecha as date) ='$fechab'
                          GROUP BY codAgencia,tra_Codigo,tra_Descripcion
                          order by codAgencia";
                          $buscar = sqlsrv_query($con, $busqueda);
                          $total__  = 0;

                          while ($fila = sqlsrv_fetch_array($buscar)) {
                            $codAgencia_                     = $fila['codAgencia'];
                            $AGENCIA_                     = $fila['AGENCIA'];
                            $TOTAL_                     = $fila['TOTAL'];
                            $tra_Codigo_                     = $fila['tra_Codigo'];
                            $tra_Descripcion_                     = $fila['tra_Descripcion'];
                            $total__+=$fila['TOTAL'];
                            ?>
                            <tr class="" align="center">
                              <td><?php echo $codAgencia_; ?></td>
                              <td><?php echo $AGENCIA_; ?></td>
                              <td><?php echo $TOTAL_; ?></td>
                              <td><?php echo $tra_Codigo_; ?></td>
                              <td><?php echo $tra_Descripcion_; ?></td>
                            </tr>
                          <?php }  ?>
                          <tr class="" align="">
                            <td><?php echo "Total Reconexiones:"; ?></td>
                            <td></td>
                            <td><?php echo number_format($total__); ?></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
               
              </div>
            </div>
          </div>
        </center>
      </div>
       <?php }?>
      <!--********************************DETALLE*********************************-->
     <script type="text/javascript">

  function actualizar(){
    location.reload(true);
  }

 // setInterval("actualizar()",4000);
</script>
</div>

</div>



</body>
</html>

