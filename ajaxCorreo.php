<?php  
$alert  = '';
$existe = '';
require 'fpdf/fpdf.php';
include "conexion.php";
include "function.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmail/src/Exception.php';
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'vendor/autoload.php';


$fechaa=$_REQUEST["fechas"];
$pdf = new FPDF('P', 'mm', 'legal');
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 5);
$pdf->setfillcolor(174, 214, 241);
$pdf->SetDrawColor(174, 214, 241);
$archivo_      = "Reconexiones";
$filename      = "temporales4/$archivo_.pdf";
$busqueda = "SELECT sol_id,dbo.alote(inm_id) as lote,sol_fecha,sol_Descripcion,dbo.devuelveNombreServicio(ser_id) as servicio, 
   dbo.recuperaNombreUsuario(ser_usuario) as usuario,ser_TelefonoOtroSolicitante,plo_id,dbo.recuperaNombrePlomero(plo_id) as nombreplo
   from agu_SolicitudesDeServicio where sol_Estado=2 and CAST(sol_fecha as date) ='$fechaa' and dbo.recuperaNombreUsuario(ser_usuario)='sistemas'
   order by sol_id asc";
   $buscar = sqlsrv_query($con, $busqueda);
   $pdf->AddPage();

$i=0;
$pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->Cell(10, 7, "No.", 1, 0, 'C');

    $pdf->Cell(20, 7, "Solicitud", 1, 0, 'C');
    
    $pdf->Cell(30, 7, "Fecha", 1, 0, 'C');
    $pdf->Cell(50, 7, "Servicio", 1, 0, 'C');
    $pdf->Cell(25, 7, "Lote", 1, 0, 'C');

    $pdf->Cell(50, 7, "Descripción", 1, 1, 'C');

   while($fila = sqlsrv_fetch_array($buscar)){
   $sol_id_ = $fila["sol_id"];
    $lote_ = $fila["lote"];
      $sol_fecha_ = date_format($fila["sol_fecha"],"Y-m-d H:i:s");
      $sol_Descripcion_ = $fila["sol_Descripcion"];
      $servicio_ = $fila["servicio"];
    $i++;
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(10, 7, $i, 1, 0, 'C');

    $pdf->Cell(20, 7, $sol_id_, 1, 0, 'C');
    
    $pdf->Cell(30, 7, $sol_fecha_, 1, 0, 'C');
    $pdf->Cell(50, 7, $servicio_, 1, 0, 'C');
    $pdf->Cell(25, 7, $lote_, 1, 0, 'C');

    $pdf->Cell(50, 7, $sol_Descripcion_, 1, 1, 'C');
    
  }
  $pdf->Output($filename, 'F');

 
 if ($buscar) {
        $mail = new PHPMailer(true);
        try{
         $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = true;
    $mail->SMTPAuth = true;
    $mail->Username = 'sasciminformatica@gmail.com';   //username
    $mail->Password = 'Guate2019*';
   /*$mail->Username = 'zulygalicia4@gmail.com';   //username
    $mail->Password = 'ocefnkqoqgbxhxgn';*/
        $mail->Port = 587;
        $mail->SMTPDebug  = 0;//0 no muestra errores, 1 muestra solo si hay errores, 2 muestra todo el estado
    $mail->setFrom('sasciminformatica@gmail.com', 'Sascim Informatica');
        $mail->addAddress('vc.delc@gmail.com', 'Vania'); 
        
        $mail->addAttachment(($filename));
        $mail->isHTML(true);
        $mail->Subject = 'Reconexiones'.$fechaa;
        $mail->Body    = 'Adjunto: Reconexiones Web';
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo'<script type="text/javascript">
            alert("CORREO ENVIADO EXITOSAMENTE");
            history.go(-3);
            </script>';
            //echo "<h1 style=\"color:red;\" >CORREO ENVIADO EXITOSAMENTE: </h1>" . $correousuario;
        }
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
    


  # code...
  else{
     echo'<script type="text/javascript">
            alert("No se Encontraron Registros");
            history.go(-2);
            </script>';
  }

 ?>