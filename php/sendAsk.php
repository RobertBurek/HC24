<?php

$name = $_POST['nameSurname'];
$mail = $_POST['mailAdress'];
$content = $_POST['contentMail'];


function sendInfoMail($nameInfo, $mailInfo, $contentInfo)
{
    header("content-type: application/json; charset=utf-8");
    $headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: 8bit";
    $message_body = " " . $nameInfo . " wysłał/a zapytanie o ofertę.\n";
    $message_body .= "O treści: " . $contentInfo . " \n";
    $message_body .= "Odpowiedź odeślij na adres mailowy: " . $mailInfo . "\n";
    $message_body .= "Info ze strony HC24.pl";
    mail("robertburek@wp.pl", "Zapytanie od " . $nameInfo, $message_body, $headers);
}

header('Location: '.$_SERVER['HTTP_REFERER']);
sendInfoMail($name, $mail, $content);