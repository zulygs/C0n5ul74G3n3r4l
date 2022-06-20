<?php
$alert = '';
$valor = 0;
include "conexion.php";
session_start();
$Id_ = $_SESSION['idUser'];
$Nuser=$_SESSION['user'];
$sql_Servicios="SELECT ser_id,ser_Nombre from agu_Servicios";
$registros_Servicios = sqlsrv_query( $con,$sql_Servicios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta  charset="UTF-8"/>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0"&amp;gt;>
    <?php include "includes/scriptes.php";?>
    <title>Sistema Aguas</title>

</head>
<style type="text/css">
  #botoncito{
  border-radius: 5px;
  padding: 10px 7px;
  text-decoration: none;
  color: #fff;
  background-color: #333;
  margin: 5px;
}
</style>
<body>
  <div class="container container-form-lg border-left border-bottom border-right col ">
  <div class="form-row">
          <img src="gotita.png" width="100" height="100">

            <div class="form-group col-md-4" id=""  >
              <div> <label>Servicio: </label> <input type="checkbox" name="" id="checkServicio"></div>
              <br>
              <select name="servicio" id="servicio" class="form-control" style="display: none">
              <?php
              while($data_Servicios=sqlsrv_fetch_array($registros_Servicios)) {
              echo "<option value='".$data_Servicios['ser_id']."' >".$data_Servicios['ser_Nombre']."</option>";
              } 
      ?>
              </select>
            </div>
            <br>
            <div class="col  form-group col-md-2" id="" >
              <br>

             <input type="radio" name="Ejecutada" id="Ejecutada" value="1" checked > Ejecutadas <br>
             <input type="radio" name="Ejecutada" id="Ejecutada2" value="2" > No Ejecutadas
            </div>
            <div class="col  form-group col-md-4" id="" >
              <br>
              <font size="3"><label for="fecha">Fecha:</label></font>
              <input type="date" name="fecha" class="form-control" id="fecha" value="<?php echo date("Y-m-d"); ?>" >
              <input type="date" name="fecha2" class="form-control" id="fecha2" value="<?php echo date("Y-m-d"); ?>" >
            </div>
          </div>
         
  <div class="container">
    
 <center> <button type="" name="buscar" class="btn btn-primary " id="buscar" onclick="myFunction()" style="height: 40px">Buscar</button></center>
   <hr>  

<div style="display: none;" id="tabla2" class="">
<table id="tablax2" class="table table-striped table-bordered table-responsive table table-striped table-bordered" >
   
  <thead>
    
    <tr>
      <th data-dynatable-column="rank"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ID</a></th>
      <th data-dynatable-column="country" class="dynatable-head"><a class="dynatable-sort-header" href="#">INMUEBLE</a></th>
      <th data-dynatable-column="us-$"    class="dynatable-head"><a class="dynatable-sort-header" href="#">LOTE</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ID PLOMERO</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">PLOMERO</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ID SERVICIO</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">FECHA</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ESTADO</a></th>
      <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">RESUELTO</a></th>
    </tr>
  </thead>
  <tbody >
  </tbody>
</table>
</div>

</div>
<div>
  <center><button class="btn btn-warning btn-group-lg "  onclick="history.back()"> <font color="white">Regresar</font></button>
    <button class="btn btn-info btn-group-lg " > <a href="salir.php"><font color="white">Cerrar Sesión</font></a></button></center>
</div>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

   
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script> 

  <script type="text/javascript">
    

  
 function prueba() {
  
               // $('input:radio[name=Ejecutada]:checked').val();
 var tablaSector = document.getElementById('tabla2');
 var Select_servicio =$("#servicio").val(); 
 var radio_ejec =$('input:radio[name=Ejecutada]:checked').val(); 
 var input_date =$("#fecha").val(); 
  var input_date2 =$("#fecha2").val(); 
   window.location.href = 'ajax3.php?Select_servicio='+Select_servicio+'&radio_ejec='+radio_ejec+'&input_date='+input_date
 }

    

function myFunction() {
  //alert("gooo");
  
 var tablaSector = document.getElementById('tabla2');
 var Select_servicio =$("#servicio").val(); 
 var radio_ejec =$('input:radio[name=Ejecutada]:checked').val(); 
 var input_date =$("#fecha").val(); 
 var input_date2 =$("#fecha2").val(); 
 if ( $('#checkServicio').is(':checked') ) {
var checkSerivicios=2;
 }
 else{
  var checkSerivicios=1;
 }
//alert('checkServicio='+checkSerivicios+'&Select_servicio='+Select_servicio+'&radio_ejec='+radio_ejec+'&input_date='+input_date+'&input');

   //("#tablax2").dataTable().fnDestroy();
    $('#tablax2').DataTable({
      
      'serverMethod': 'post',
      'destroy': 'true',
      'ajax': {
        'url':'ajax3.php?checkServicio='+checkSerivicios+'&Select_servicio='+Select_servicio+'&radio_ejec='+radio_ejec+'&input_date='+input_date+'&input_date2='+input_date2
      }, language: {

                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "Agrupar de _MENU_ items",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
      'columns': [
      { data: 'sol_id' },
      { data: 'inm_id' },
      { data: 'lote' },
      { data: 'plo_id' },
      { data: 'nombre_plomero' },
      { data: 'ser_id' },
      { data: 'sol_fecha' },
      { data: 'estado' },
      { data: 'det_tipo'}
      
       
        
      ],
      //"columnDefs": [{"render": createManageBtn, data: 'sol_id', "targets": [0]}],

 
    });
  
  


tablaSector.style.display = 'block';
  
  

}
$(document).ready(function(){

            
            $('#checkServicio').on('change',function(){
                if (this.checked) {
                    $("#servicio").show();
                  
                  
                } else {
                    $("#servicio").hide();
                   
                }
            })
           
            });

 

</script>

<script src="js/funciones1.js"></script>


</body>
</html>