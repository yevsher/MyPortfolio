<?php
$to      = $_POST['emailTo'];
$subject = 'Заявка с сайта'. " " . "http://".$_SERVER['HTTP_HOST'];
$message = "E-mail:" . " " . $_POST['email'] . " " . "Skype:" . " " .  $_POST['skype'] . " " . "IP:" . " " . $_SERVER['SERVER_ADDR'];
$headers = 'From: yevgeniy.shershniov@gmail.com' . "\r\n" .
    'Reply-To: yevgeniy.shershniov@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$sent = mail($to, $subject, $message, $headers);
?> 