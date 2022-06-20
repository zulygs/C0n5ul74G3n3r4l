<meta charset='utf-8'>
<?php
$alert = '';
include 'conexion.php';

$mostrar=0;
date_default_timezone_set('UTC');
$fechanow=date("Y-m-d");



 






?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include 'includes/head.php';?>
  <?php //include 'Querys.php';?>
  <title>Servicios</title>
</head>
<body>
  <div class="container">
    <center>
      <h2>
       Vania De Leon
        <img src="gotita.png" width="100px">
      </h2>
    </center>
    <div>
      <center>
        <h5>
      </h5>
    </center>
  </div>
  <div class="col row  col-md-6" style="width:600px">
    <div class="">
     <input type="date" name="fechas" id="fechas" class="form-control" value="<?php echo($fechanow) ?>">
    </div>
    <div class="">
    </div>
    &nbsp;&nbsp;
    <br>
    <div class="col form-group col-md-3"> 
      <center> 
    <button type=""  class="btn btn-primary" onclick="myFunction()"  style="height: 40px">Buscar</button>

  </center>

</div>

<br> 
<br> 
</div>
<br>
<br>
<div  id="tabla"  style="display: none">
   <button type=""  class="btn btn-primary" onclick="CargFunc()"  style="height: 40px">Enviar correo</button>
  <table id="tablax" class="table table-striped table-bordered table-responsive table table-striped table-bordered" style="width:100%" >
    <title>tabla principal</title>
    <thead>
      <tr>
        <th data-dynatable-column="rank"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ID Solicitud</a></th>
        <th data-dynatable-column="country" class="dynatable-head"><a class="dynatable-sort-header" href="#">FECHA</a></th>
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">SERVICIO</a></th>
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">LOTE</a></th>
        <th data-dynatable-column="us-$"    class="dynatable-head"><a class="dynatable-sort-header" href="#">DESCRIPCION</a></th>
        
        
        
        
        
        
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">USUARIO</a></th>
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">Tel. Solicitante</a></th>
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">ID Plomero</a></th>
        <th data-dynatable-column="year"    class="dynatable-head"><a class="dynatable-sort-header" href="#">Plomero Asignado</a></th>
        
        
      </tr>
    </thead>
    <tbody>
  
    </tbody>
  </table>
</div>
<!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
     <script>
     
    
 function myFunction() {
  var fechab = document.getElementById("fechas").value;
   var tabla1 = document.getElementById('tabla');
   var fechasol1 = document.getElementById('fechasol');
$("#tablax").dataTable().fnDestroy();
    $('#tablax').DataTable({
      'serverMethod': 'post',
      'ajax': {
        'url':'cc.php?fechas='+fechab
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
      { data: 'sol_fecha'},
      { data: 'servicio'},
      { data: 'lote' },
      { data: 'sol_Descripcion'},      
      { data: 'usuario'},
      { data: 'ser_TelefonoOtroSolicitante'},
      { data: 'plo_id'},
      { data: 'nombreplo'}
      
       
        
      ],
     

 
    });
    tabla1.style.display = 'block';
  }
 

   function CargFunc() {
    var fechab = document.getElementById("fechas").value;
          //alert("hola");
         $.ajax({
            type:'POST', //aqui puede ser igual get
            url: 'ajaxCorreo.php?fechas='+fechab,//aqui va tu direccion donde esta tu funcion php
        
            success:function(data){
                alert('Correo Enviado Exitosamente!');
           },
           error:function(){
           // alert('AJAX call was Error!');
           }
         });
       }

    </script>

</body>
</html>