<?
srand((double)microtime()*1000000);
$znacznik = md5(uniqid(rand()));

// dane o odbiorcy, nadawcy i załączniku
$odbiorca = "odbiorca@adres.pl";
$tytul = "Masz list...";
$nadawca_imie = "Janko Nadawca";
$nadawca_email = "janko@nadawca.pl";
$plik = "logo.gif";
$typpliku = "image/gif";
$nazwapliku = "mojelogo.gif";

// treść listu
$tresclistu = "
Witaj,

wysyłam Ci list z załącznikiem!
";

// definicja nagłówków
$naglowki  = "From: $nadawca_imie <$nadawca_email>\n";
$naglowki .= "MIME-Version: 1.0\n";
$naglowki .= "Content-Type: multipart/mixed;\n";
$naglowki .= "\tboundary=\"___$znacznik==\"";

// nagłówki listu
$tresc="--___$znacznik==\n";
$tresc .="Content-Type: text/plain; charset=\"iso-8859-2\"\n";
$tresc .="Content-Transfer-Encoding: 8bit\n";
$tresc .="\n$tresclistu\n";

// nagłówki i obsługa załącznika
$tresc .="--___$znacznik==\n";
$tresc .="Content-Type: $typpliku\n";
$tresc .="Content-Disposition: attachment;\n";
$tresc .=" filename=\"$nazwapliku\"\n";
$tresc .="Content-Transfer-Encoding: base64\n\n";
$f = fopen($plik,"r");
$dane = fread($f,filesize($plik));
fclose($f);
$tresc .= chunk_split(base64_encode($dane));
$tresc .="--___$znacznik==--\n";

// wysłanie listu
mail($odbiorca,$tytul,$tresc,$naglowki);
?>