<?php
$alert = '';
include 'conexion.php';
//include 'conexion.php';
session_start();
$alert='';
$user1=$_SESSION['idUser'];
//echo "$user1";
$Nuser=$_SESSION['user'];
$inm_id = $_REQUEST['inm_id_'];
if (!isset($_SESSION['active'])) {
    echo "<script>alert('Inicie Sesion Para Continuar'); window.location='index.html';</script>";
} else {
    if (isset($_POST['guar'])) {
       date_default_timezone_set("America/Guatemala");

      $sol_fecha=date('Y-m-d H:i:s');
        $CSolicitud_=$_POST['CSolicitud'];
        $det_Descripcion_=$_POST['det_Descripcion'];
        $nombre_=$_POST['nombre'];
        $telefono_=$_POST['telefono'];
        $dpi_=$_POST['dpi'];
        //$sol_observaciones_="sol_observaciones";



    $sql = "INSERT INTO agu_solicitudesDeServicio (sol_fecha,
     sol_Descripcion,
     sol_Estado,
     sol_Resultado,
     inm_id
     ,ser_id
     ,ser_usuario
     ,ser_Solicitante
     ,ser_NombreOtroSolicitante
     ,ser_DpiOtroSolicitante 
     ,ser_TelefonoOtroSolicitante) VALUES ('$sol_fecha', '$det_Descripcion_',2,2,'$inm_id', '$CSolicitud_','$user1','$inm_id','$nombre_','$dpi_','$telefono_')";  
   // echo "$sql";
 sqlsrv_query($con, $sql);
 //sqlsrv_close($con);
 echo'<script type="text/javascript">
        alert("Solicitud Guardada");
        window.history.go(-2);
        </script>';
}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta  charset="UTF-8"/>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"&amp;gt;>
    <?php include "includes/scriptes.php";?>
    <title>Sistema Aguas</title>

</head>



<body>
  <div class="container container-form-lg2" style="background-color: white">
    <h3 class="titulo">Solicitud de Servicio
      <img src="gotita.png" width="100" height="100" srcset="gotita.png 17x"  class=""></h3>
    <form  method="POST" id="formulario" action="" enctype='multipart/form-data' >
      <div>
        <font class="letras">Solicitud : </font>
        <select class="select-css" name="CSolicitud"  id="CSolicitud" >         
          <?php
$Consulta = "SELECT ser_id,ser_nombre from agu_Servicios";
$R        = sqlsrv_query($con, $Consulta);
while ($Fila = sqlsrv_fetch_array($R)) {
    echo "<option value='".$Fila['ser_id']."'>" . $Fila['ser_nombre'] . "</option>";
}
sqlsrv_close($con);
?>
          </select>
        </div>
        <br>
      <div class="form-row">
        <div class="form-row">
          <div class="col form-group col-md-3" id="" >
            <label>Descripción:</label>
          </div>
          <div class="col form-group " id="" >
            <textarea class="textarea" name="det_Descripcion" id="det_Descripcion" rows="4" required></textarea>
          </div>
        </div>
      </div>
      <div class="border-left border-bottom border-right border-top">
        <br>
        <div class="col form-group">
          Nombre: <input type="text" name="nombre" class="form2"></div>
        <div class="col form-row col-md-500">
          <div class="col form-group col-md-500">DPI:<input type="text" name="dpi" class="form3 col-md-10">
          <label>Teléfono:<input type="text" name="telefono" class="form4 validanumericos"></label> 
          </div>
        </div>
        </div>

    </center>
    <br>
    <!--<div class="form-group">
        <div class="form-row">
          <div class="col form-group col-md-4" id="" >
            <label>Observaciones:</label>
          </div>
          <div class="col form-group " id="" >
            <textarea class="textarea" name="sol_observaciones" id="sol_observaciones" rows="4" ></textarea>
          </div>
        </div>
      </div>-->
    <div>
      <br>
      <center>
        <button class="btn btn-info btn-group-lg "  name="guar" id="guar" type="submite">
          <a><font color="white">Guardar</font></a>
        </button>
        <input onClick="javascript:window.history.back();" type="button" class="btn btn-success btn-group-lg" name="Submit" value="Cancelar" />
       
        <input onClick="javascript:window.history.back();" type="button" class="btn btn-info btn-group-lg " name="Submit" value="Regresar" />
      </center>
      </div>
      
</form>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
onload = function(){
  var ele = document.querySelectorAll('.validanumericos')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
    var ele = document.querySelectorAll('.validanumericos2')[0];
  ele.onkeypress = function(e) {
     if(isNaN(this.value+String.fromCharCode(e.charCode)))
        return false;
  }
  ele.onpaste = function(e){
     e.preventDefault();
  }
}</script>
</body>
</html>
