<?php
$alert = '';
$valor = 0;
include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if(!isset($_SESSION['active3'])){
  echo "<script>window.location='index.html';</script>";
} 
 
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logoo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      Usuarios Sascim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include "includes/scriptes.php";?>
    <?php include "functions.php"?>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <style type="text/css">
      * {
        margin:0px;
        padding:0px;
      }
      ul, ol {
        list-style:none;
      }
      .nav li a {
        background-color:gray;
        color:#fff;
        text-decoration:none;
        padding:10px 12px;
        display:block;
        }
        .nav li a:hover {
          background-color:#434343;
        }
        .nav li ul {
          display:none;
          min-width:140px;
        }
        .nav li:hover > ul {
          display:block;
        }
      </style>
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
      
    </head>
    <body class="">
      <?php include('includes/bodyPrincipal.php'); ?>
      <center> 
        <div class="panel-header panel-header-lg" id="lateral">
          <div class="container container-form-lg">
          </div>
        </div>
      </center>
      <!--   Core JS Files   -->
      <?php include('includes/ScriptPrincipal.php'); ?>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/funciones.js"></script>
    </body>
    </html>