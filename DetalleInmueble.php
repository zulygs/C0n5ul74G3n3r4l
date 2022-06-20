<?php
$alert = '';
$valor = 0;
include "conexion.php";
session_start();
$Id_ = $_SESSION['idUser'];

if (empty($_SESSION['active'])) {
    echo "<script>alert('Inicie Sesion Para Continuar'); window.location='index.html';</script>";
} else {
    if (isset($_POST['activar_'])) {
        $idinm_ = $_POST['id_'];
        $idgen_ = $_POST['codlot'];
        $encar_ = $_POST['encar_'];
        $nom_   = $_POST['nom_'];
        $dir_   = $_POST['dir_'];
        $est_   = $_POST['est_'];
        $nit_   = $_POST['nit_'];
        $tel_   = $_POST['tel_'];
        $sal_   = $_POST['sal_'];
        $conv_  = $_POST['conv_'];

        include "conexion.php";
        //echo($idinm_);
        // $user = mysqli_real_escape_string($con,$_POST['idinmb_']);

        $query = "UPDATE  tblInmuebles set est_Id=1,tps_Id=1 where est_Id=2 and inm_id='$idinm_'";
        sqlsrv_query($con, $query);
        header("Location: DetalleInmueble.php");
        sqlsrv_close($con);
//echo($idinm_);

    } else {
        if (isset($_POST['enviar'])) {
            $idinm_ = $_POST['id_'];
            $idgen_ = $_POST['codlot'];
            $encar_ = $_POST['encar_'];
            $nom_   = $_POST['nom_'];
            $dir_   = $_POST['dir_'];
            $est_   = $_POST['est_'];
            $nit_   = $_POST['nit_'];
            $tel_   = $_POST['tel_'];
            $sal_   = $_POST['sal_'];
            $conv_  = $_POST['conv_'];
//        $sal_ = number_format($_POST['sal_'],2);
            $valor = 1;
        }

    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta  charset="UTF-8"/>
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <?php include "includes/scriptes.php";?>
    <title>Sistema Aguas</title>
</head>
<body>
<div class="container container-form-lg">
  <div class="col-md-12 " >
        <h3 class="titulo">Detalle Del Inmueble</h3>
        <form class="needs-validation" novalidate method="POST" action="DetalleInmueble.php" >
             <div class="form-row">
              <img src="gotita.png" width="100" height="100">
             <div class="col form-group col-md-4" id="" style="width: 10px">
                 <label for="encargado">Encargado De Grupo De Plomeros:</label>
                 <input type="text" name="encargado" class="form-control" id="encargado" placeholder="" value="<?php echo isset($encar_) ? $encar_ : ''; ?>" disabled>

                 </div>

             </div>

            <div class="form-row">
              <div class="col form-group col-md-4" id="" >
          <label for="id_">ID Inmueble:</label>
          <input type="text" name="id_" class="form-control" id="id_"  onclick="muestra_oculta('divid')" value="<?php echo isset($idinm_) ? $idinm_ : '';

?>" >


            <div class="invalid-feedback">
                    Debe ingresar Código del Inmueble
                    </div>
                </div>

                <div class="col form-group col-md-4" id="">
                    <label for="codlot">Código de Lote:</label>
                    <input type="text" name="codlot"  class="form-control" id="codlot" onclick="muestra_oculta('divid')" placeholder="" value="<?php echo isset($idgen_) ? $idgen_ : ''; ?>" >

                    <div class="invalid-feedback">
                    Debe ingresar Código del Lote
                    </div>


                </div>



                <input type="hidden" id="idgen" name="idgen" value= "" required>
                <input type="hidden" id="idinm" name="idinm" value= "" required>
                <input type="hidden" id="nom_" name="nom_" value= "" required>
                <input type="hidden" id="dir_" name="dir_" value= "" required>
                <input type="hidden" id="est_" name="est_" value= "" required>
                <input type="hidden" id="nit_" name="nit_" value= "" required>
                <input type="hidden" id="tel_" name="tel_" value= "" required>
                <input type="hidden" id="sal_" name="sal_" value= "" required>
                <input type="hidden" id="conv_" name="conv_" value= "" required>
                <input type="hidden" id="encar_" name="encar_" value= "" required>


            </div>

            <div class="form-row" >

            <div class="form-row" >
            <div class="col form-group" style="width: 310px" >
      <label for="nombre">Titular Propietario:</label>
      <input type="text" name="nombre" class="form-control" id="nombre"  value="<?php echo isset($nom_) ? $nom_ : ''; ?>" disabled>
            </div>
            </div>


            <div class="col form-group" >
      <label for="direccion">Dirección:</label>
      <input type="text" name="direccion" class="form-control" id="direccion"  value="<?php echo isset($dir_) ? $dir_ : ''; ?>" disabled>
             </div>

            </div>

            <div class="form-row">
            <div class="form-row">
            <div class="col form-group">
      <label for="estado">Estado Usuario:</label>
      <input type="text" name="estado" class="form-control" id="estado" value="<?php echo isset($est_) ? $est_ : '';

?>" onclick ="return validar()" readonly >



            </div>

            <div class="col form-group">
      <label for="nit">Nit:</label>
      <input type="text" name="nit" class="form-control" id="nit"  value="<?php echo isset($nit_) ? $nit_ : ''; ?>" disabled>
            </div></div>
            <div class="col form-group">
      <label for="tel">Telefono:</label>
            <input type="text" name="tel" class="form-control" id="tel" value="<?php echo isset($tel_) ? $tel_ : ''; ?>" disabled>
            </div>
          <div class="col form-group">
      <label for="conv_">Convenio:</label>
            <input type="text" name="convenio" class="form-control" id="convenio" value="<?php echo isset($conv_) ? $conv_ : ''; ?>" disabled>


            </div>
             <div class="col form-group">
      <label for="saldo">Saldo al día:</label>
            <input type="numbre" name="saldo" class="form-control" id="saldo" value="<?php echo isset($sal_) ? $sal_ : ''; ?>" disabled>
            </div>
</div>


            <div class="form-row centro">
        </form>



            <?php
if ($_SESSION['idUser'] == 8) {
    echo " <button class='btn btn-warning btn-lg' name='activar_' id='activar_' type='submite' style='display:none;' >Activar</button>";
}
?>

            <?php
if ($_SESSION['idUser'] == 8) {
    echo "<script type='text/javascript'>
            function validar() {
            //obteniendo el valor que se puso en el campo text del formulario
            var miCampoTexto = document.getElementById('estado').value;
            //la condición
            if (miCampoTexto ==  'Activo,Activo' ) {
            alert('El Lote esta activo!');
            $('#activar_').css('display','none');
            return false;
            }else{
            $('#activar_').css('display','inline');
            }
            //Validando el combo select
            return true;
            }
            </script>";
}
?>




             <div class="form-group margen">
            <button class="btn btn-warning btn-lg" type="submite" onclick="function()" name="enviar"><font color="">Informacion Del Servicio</font></button>
            </div>



           <div class="form-group margen">
            <button class="btn btn-primary btn-lg" type="reset">Limpiar</button>
            </div>
            <div class="form-group margen">
            <a href="salir.php" class="btn btn-info btn-lg">Salir</a>
      </div>
            </div>

    </div>
</div>

<?php
if ($valor == 1) {
    ?>
    <div class="container container-form-lg-g" id="divid" >
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
</head>
<body>
  <script type="text/javascript">
  function muestra_oculta(id){
  if (document.getElementById){ //se obtiene el id
  var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
  el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
  $("#divid").load(" #divid");
  $("#HistorialDSolicitudes").load(" #HistorialDSolicitudes");
  $("#EstadoDCuenta").load(" #EstadoDCuenta");
  $("#Consumo").load(" #Consumo");
  $("#ConveniosDPago").load(" #ConveniosDPago");
  }
  }





     // $("#divid").load(" #divid");


  </script>


<div class="tab" >

  <button class="tablinks" onclick="openCity(event, 'HistorialDSolicitudes')">Historial De Solicitudes</button>
  <button class="tablinks" onclick="openCity(event, 'EstadoDCuenta')">Estado De Cuenta</button>
  <button class="tablinks" onclick="openCity(event, 'Consumo')">Historial De Consumos</button>
  <button class="tablinks" onclick="openCity(event, 'ConveniosDPago')">Convenios De Pago</button>

</div>

<div id="HistorialDSolicitudes" class="tabcontent">
  <?php include "HistoricoSolicitudes.php";?>
</div>

<div id="EstadoDCuenta" class="tabcontent">
  <?php include "EstadoCuenta.php";?>
</div>

<div id="Consumo" class="tabcontent">
    <?php include "Consumo.php";?>
</div>
<div id="ConveniosDPago" class="tabcontent">
  <?php include "ConveniosPagos.php";?>
</div>



<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>



<?php
}
?>




<script src="js/jquery.min.js"></script>
<script src="js/funciones.js"></script>

<?php include "includes/fooder.php";?>
</body>
</html>