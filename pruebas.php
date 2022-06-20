<?php 
session_start();
include("conexion1.php");
$check="";
if (isset($_POST['insert'])){
if (isset($_POST["check"])=="check" && ($_POST['usuario']=='lrodriguez' || $_POST['usuario']=='ccorado') )
{

$user=$_POST['usuario'];
$clav  = md5(mysqli_real_escape_string($con, $_POST['pass']));
$clav2  = $_POST['pass'];
setcookie ("user", "$user", time () + 604800);
setcookie ("clav", "$clav2", time () + 604800);


if ($user=='vaniad'|| $user=='Admin'|| $user=='lrodriguez'|| $user=='ycifuentes'|| $user=='ecorzo'|| $user=='ccorado'|| $user=='cmiranda'||$user=='evelasquez') {
      $user=$user;
    }
    $query = "SELECT * from usuario where usuario = '$user' and clave = '$clav' ";
    $eje_query = mysqli_query($con, $query);
    $result    = mysqli_num_rows($eje_query);
    if ($result > 0) {
        $data = mysqli_fetch_array($eje_query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['user']   = $data['usuario'];
        $_SESSION['user2']  = $data['usuario'];
        $_SESSION['user3']  = $data['usuario'];
        $_SESSION['rol']    = $data['rol'];
        header('location: pruebass.php');


}

if($_COOKIE['clav']<>"")
{

$user=$_COOKIE['user'];
$clav=$_COOKIE['clav'];
 $query = "SELECT * from usuario where usuario = '$user' and clave = '$clav' ";
    $eje_query = mysqli_query($con, $query);
    $result    = mysqli_num_rows($eje_query);
    if ($result > 0) {
        $data = mysqli_fetch_array($eje_query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['user']   = $data['usuario'];
        $_SESSION['user2']  = $data['usuario'];
        $_SESSION['user3']  = $data['usuario'];
        $_SESSION['rol']    = $data['rol'];
        header('location: pruebass.php');
}
}
}
else{

 $va='';

    $user=$_POST['usuario'];
    /*$user = mysqli_real_escape_string($con,$_POST['usuario']);*/
    $clav  = md5(mysqli_real_escape_string($con, $_POST['pass']));
    if ($user=='vaniad'|| $user=='Admin'|| $user=='lrodriguez'|| $user=='ycifuentes'|| $user=='ecorzo'|| $user=='ccorado'|| $user=='cmiranda'||$user=='evelasquez') {
      $va=$user;
    }
    
    
    $query = "SELECT * from usuario where usuario = '$va'
              and clave = '$clav' ";

  
    $eje_query = mysqli_query($con, $query);
    $result    = mysqli_num_rows($eje_query);

    if ($result > 0) {
        $data = mysqli_fetch_array($eje_query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['user']   = $data['usuario'];
        $_SESSION['user2']  = $data['usuario'];
        $_SESSION['user3']  = $data['usuario'];
        $_SESSION['rol']    = $data['rol'];
        header('location: pruebass.php');
    } else {
        $alert = 'Usuario o Contraseña INCORRECTOS';
        session_destroy();
    }
}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php include "includes/scriptes.php";?>
<title>Login /  Sistema Clientes</title>
<link href="css/font-roboto" rel="stylesheet">
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/font-awesome.css">
<style type="text/css">

*{
    margin: 0;
    padding: 0;
}
body{
  background: rgba(168, 160, 159, 0.8);
    line-height: 18px;
    background-image: url(imagenfondo.jpg);
  margin: 0 auto;
  background-size: 100%;
  background-repeat: no-repeat;
  background-position: center ;
}
.form-group::before{
    font-family: "Font Awesone\ 5 free";
}

.form-group#user-group::before{
    content: "\f007";
}
.form-group#pass-group::before{
    content: "\f023";
}
</style>
</head>
<body>
  <div class= "container container-form">
       <center><img src="gotita.png" width="200px"></center>
        <h3 class="titulo">Ingreso Sistema</h3>
    <form class="form needs-validation" novalidate method="POST" action="pruebas.php">
      <div class="form-group">

        <label for="usuario">Usuario:</label>

        <input type="text" name="usuario" id="user-group" class="form-control" placeholder="Usuario" value="<?php if(isset($_COOKIE['user'])=='lrodriguez' || isset($_COOKIE['user'])=='ccorado'){echo($_COOKIE['user']) ;}?>" required  >
        <div class="invalid-feedback">
                   Ingrese su usuario
                </div>
      </div>
      <div class="form-group">
                <label for="usuario">Contraseña:</label>
        <input type="password" name="pass" id="pass-group" class="form-control"  placeholder="Contraseña" value="<?php if(isset($_COOKIE['clav'])=='lrodriguez' || isset($_COOKIE['clav'])=='ccorado'){echo($_COOKIE['clav']) ;}?>" required  >
        <div class="invalid-feedback">
                   Ingrese su contraseña
                </div>
      </div>
      <div class="form-group">
        <label >Recordarme:</label>        
        <input type="checkbox" name="check" id="check" class=""   value="check"  checked>
       
      </div>
            <div class="form-group alert"> <?php echo isset($alert) ? $alert : ''; ?></div>

      <div class="form-group">
        <button type="submit" id="click" name="insert" class="btn btn-primary btn-block"><span class = "fa fa-arrow-right"></span>  Ingresar <br />
      </div>
    </form>
  </div>
  </div>
<?php include "includes/fooder.php";?>
</body>
</html>