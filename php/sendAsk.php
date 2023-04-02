<?php

header('Location: ' . $_SERVER['HTTP_REFERER'] . '#form');

$name = $_POST['nameSurname'];
$mail = $_POST['mailAdress'];
$content = $_POST['contentMail'];
$surface = $_POST['totalSurface'];
$apartments = $_POST['numberApartments'];


function sendInfoMail($nameInfo, $mailInfo, $contentInfo, $surfaceInfo, $apartmentsInfo)
{
    header("content-type: application/json; charset=utf-8");
    $headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: 8bit";
    $message_body = " " . $nameInfo . " wysłał/a zapytanie ofertowe o treści:\n";
    $message_body .= "\"" . $contentInfo . "\"\n";
    $message_body .= "Powierzchnia całkowita nieruchomości: " . $surfaceInfo . " m2. \n";
    $message_body .= "Ilość lokali: " . $apartmentsInfo . " sztuk. \n";
    $message_body .= "Odpowiedź odeślij na adres mailowy: " . $mailInfo . "\n";
    // $message_body .= "Info ze strony http://robertburek.pl/HC24/"."\n";
    $message_body .= "Info ze strony ".$_SERVER['HTTP_REFERER'];
    mail("homecare.24@wp.pl", "Zapytanie od " . $nameInfo, $message_body, $headers);
    mail("homecare.24@hc24.com.pl", "Zapytanie od " . $nameInfo, $message_body, $headers);
}

sendInfoMail($name, $mail, $content, $surface, $apartments);
