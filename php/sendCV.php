<?
srand((double)microtime()*1000000);
$znacznik = md5(uniqid(rand()));

// dane o odbiorcy, nadawcy i załączniku
$odbiorcaWPPL = "homecare.24@wp.pl";
$odbiorcaHC24COMPL = "homecare.24@hc24.com.pl";
$tytul = "Jestem zainteresowana/y ...";
$nadawca_imie = "Szukam Pracy";
$nadawca_email = "szukam@pracy.pl";
// $plik = "logo.gif";
// $plik = "add.gif";
$plik = $_FILES['plik']['name'];
// $plik = $_POST['plik'];
// $typpliku = "image/gif";
$typpliku = "application/pdf";
// $nazwapliku = "mojelogo.pdf";
$nazwapliku = $_FILES['plik']['name'];
// $nazwapliku = $plik;
$content = $_POST['contentMail'];




// function function_alert($message) {
      
//     // Display the alert box 
//     echo "<script>alert('$message');</script>";
// }
  
  
// Function call
// function_alert($plik);
// echo "<b>Nazwa pliku: </b>".$_FILES['plik']['name']."<br />";
// echo "<b>Typ pliku: </b>".$_FILES['plik']['type']."<br />";
// echo "<b>Rozmiar pliku: </b>".$_FILES['plik']['size']."<br />";
// echo "<b>Nazwa pliku tymczasowego: </b>".$_FILES['plik']['tmp_name']."<br /><br />";



// treść listu
$tresclistu = '
Witaj, kilka zdań ode mnie: 
" '.$content.' " ';

// definicja nagłówków
$naglowki  = "From: $nadawca_imie <$nadawca_email>\n";
$naglowki .= "MIME-Version: 1.0\n";
$naglowki .= "Content-Type: multipart/mixed;\n";
$naglowki .= "\tboundary=\"___$znacznik==\"";

// nagłówki listu
$tresc="--___$znacznik==\n";
$tresc .="Content-Type: text/plain; charset=utf-8\r\n";
$tresc .="Content-Transfer-Encoding: 8bit\n";
$tresc .="\n$tresclistu\n";

// nagłówki i obsługa załącznika
$tresc .="--___$znacznik==\n";
// $tresc .="Content-Type: $typpliku\n";
// $tresc .="Content-Type: $typpliku\n";
$tresc .="Content-Disposition: attachment;\n";
$tresc .=" filename=\"$nazwapliku\"\n";
$tresc .="Content-Transfer-Encoding: base64\n\n";
$f = fopen($_FILES['plik']['tmp_name'],"r");
$dane = fread($f,filesize($_FILES['plik']['tmp_name']));
fclose($f);
$tresc .= chunk_split(base64_encode($dane));
$tresc .="--___$znacznik==--\n";

// wysłanie listu
mail($odbiorcaWPPL,$tytul,$tresc,$naglowki);
mail($odbiorcaHC24COMPL,$tytul,$tresc,$naglowki);

header('Location: ' . $_SERVER['HTTP_REFERER'] . '#contact');

?>