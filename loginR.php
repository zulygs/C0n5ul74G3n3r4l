<?php
$alert = '';
session_start();

if (isset($_POST['insert2']) && $_POST['usuarioo'] != "jcorzo" ) {
    include "conexion.php";


    $user=$_POST['usuarioo'];
    $clav  = $_POST['pass'];
   
    
    
    $query2 = "SELECT a.activo_usu,a.id_usu, a.nombre_usu, a.codigo_usu, a.id_rol,b.diasCaducidad,b.NumIntentos FROM  SEG_USUARIOS a,  Login b  where a.CODIGO_USU='$user' AND upper(a.eliminado_usu) = 'N' AND upper(a.activo_usu) = 'A' and b.cnsw='S' and  a.ID_USU = b.IdLogin and PWDCOMPARE('$clav', b.contrasenia) = 1 ";

  
    $eje_query2 = sqlsrv_query($con, $query2);
    
    
   
   if(sqlsrv_has_rows($eje_query2) < 1){
     $alert = 'Usuario o Contraseña INCORRECTOS';
     session_destroy();
      
}else{
    while($data2 = sqlsrv_fetch_array($eje_query2)){
      //print_r($data2);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data2['id_usu'];
        $_SESSION['nombre'] = $data2['nombre_usu'];
        $_SESSION['user']   = $data2['codigo_usu'];
        $_SESSION['rol']    = $data['id_rol'];
        header('location: DetalleInmuebleC2.php');
    }
}

   
}
/*SELECT a.activo_usu,a.id_usu, a.nombre_usu, a.codigo_usu, a.id_rol,b.diasCaducidad,b.NumIntentos 
FROM  seg_usuarios a,  Login b 
WHERE a.codigo_usu = 'cmiranda' AND upper(a.eliminado_usu) = 'N' AND upper(a.activo_usu) = 'A' AND b.cnsw='S'
and  a.ID_USU = b.IdLogin and PWDCOMPARE('Guate2017*', b.contrasenia) = 1;*/
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
    <form class="form needs-validation" novalidate method="POST" action="login.php">
      <div class="form-group">

        <label for="usuario">Usuario:</label>

        <input type="text" name="usuarioo" id="user-group" class="form-control" placeholder="Usuario" value="" required  >
        <div class="invalid-feedback">
                   Ingrese su usuario
                </div>
      </div>
      <div class="form-group">
                <label for="usuario">Contraseña:</label>
        <input type="password" name="pass" id="pass-group" class="form-control"  placeholder="Contraseña" value="" required  >
        <div class="invalid-feedback">
                   Ingrese su contraseña
                </div>
      </div>
            <div class="form-group alert"> <?php echo isset($alert) ? $alert : ''; ?></div>

      <div class="form-group">
        <button type="submit" id="click" name="insert2" class="btn btn-primary btn-block"><span class = "fa fa-arrow-right"></span>  Ingresar <br />
      </div>
    </form>
  </div>
  </div>
<?php include "includes/fooder.php";?>
</body>
</html>
