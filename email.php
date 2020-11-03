<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$area = $_POST['area'];
$fone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];
$assunto = $_POST['assunto'];

if ($area == "Comercial") {
  $email_saida = "alex.skarlak@gmail.com";
}
elseif ($area == "Financeiro") {
  $email_saida = "matheuspoli.10@gmail.com";
}
elseif ($area == "RH") {
  $email_saida = "upload.matheus.10@gmail.com";
}

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->IsSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'upload.matheus.10@gmail.com';
  $mail->Password = 'IECC2020';
  $mail->Port = 587;

  $mail->setFrom('upload.matheus.10@gmail.com');
  // $mail->addAddress('matheuspoli.10@gmail.com');
  $mail->addAddress($email_saida);

  $mail->isHTML(true);
  // $mail->Subject = "Fomulário";
  $mail->Subject = "Fomulario - $assunto";
  $mail->Body = "
    <strong>Mensagem do formulário de contato</strong><br> <strong>Nome: </strong>$nome<br><strong>E-mail: </strong>$email<br><strong>Telefone: </strong>$fone<br><strong>Mensagem: </strong>$mensagem
  ";

  if($mail->send()){
    header("Location: index1.html");
  }
  else{
    echo "E-mail não enviado";
  }

} catch (Exception $e) {
  echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>
