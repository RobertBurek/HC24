<?php

	@session_start();
$nazwapliku=$_SESSION['nazwapliku'];
$nazwStr=$_GET['strona']; 	
if (isset($_FILES['plik']))
{
$max_rozmiar = 1024*1024;
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if ($_FILES['plik']['size'] > $max_rozmiar) {
        echo 'Błąd! Plik jest za duży!';
    } else {
//        echo 'Odebrano plik. Początkowa nazwa: '.$_FILES['plik']['name'];
//       echo '<br/>';
//        if (isset($_FILES['plik']['type'])) 
//		{
//            echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
 //       }
//		$pathplikow=$_SERVER['PATH_TRANSLATED'];
		@$pathplikarch=str_replace("kopiapliku.php","images_old/".$nazwStr."/".$_FILES['plik']['name'],$_SERVER['PATH_TRANSLATED']);
		@$pathplik=str_replace("kopiapliku.php","images/".$_FILES['plik']['name'],$_SERVER['PATH_TRANSLATED']);
		$file = $_FILES['plik']['name'];
		$newfile = $pathplikarch.$_FILES['plik']['name'];
       @move_uploaded_file($_FILES['plik']['tmp_name'],$pathplik);
	   
//	   @move_uploaded_file($file,$pathplikarch);
//	   echo  $file.' -- '.$newfile.' -- '.$pathplikarch;  exit();
	   copy ( $pathplik , $pathplikarch );
//	   copy ($pathplik.$_FILES['plik']['tmp_name'],$pathplikarch.$_FILES['plik']['tmp_name']);

//		echo $pathplikow;exit();
//		 echo $_FILES['plik']['name'];exit();

require_once "connect.php";
if($autor && $tresc && $data && $id_newsa) 
	{
		$polaczenie = @new mysqli($host,$db_user,$db_haslo,$db_nazwa);
			if ($polaczenie->connect_errno!=0)
			{
		echo "Error: ".$polaczenie->connect_erno." Opis: ".$polaczenie->connect_error;
			}
			else{	
			$rezultat = $polaczenie->query(sprintf("UPDATE `Strony` SET `baner` = '%s' WHERE `Strony`.`nazwa_strony` = '%s';",
																						mysqli_real_escape_string($polaczenie,$_FILES['plik']['name']),
																						mysqli_real_escape_string($polaczenie,$nazwStr)));
						
					$polaczenie->close();
					}
	}


																														//		$noweDane  = $_SESSION['nowyplik'];
																														//		$zmwiersz=$_POST['nrwiersza'];
																														//		$noweDane[$zmwiersz]=$_FILES['plik']['name']."\r\n";
																														//		$fp = fopen($_SESSION['zrodlopliku'],"w");
																														//		flock($fp, LOCK_EX);
																														//		foreach ($noweDane as $line_num => $line)
																														//		fwrite($fp,$line);
																														//		flock($fp, LOCK_UN);
																														//		fclose($fp);
//	   copy ( $file , $newfile );
    }
} else {
//   echo 'Błąd przy przesyłaniu danych!';
}
}


if (isset($_POST['nrwierszat']))
{
$noweDane  = $_SESSION['nowyplik'];
$zmwierszt=$_POST['nrwierszat'];
if ($_POST['zmtytul']=="") {$noweDane[$zmwierszt]="&nbsp\r\n";} else {$noweDane[$zmwierszt]=$_POST['zmtytul']."\r\n";};
$fp = fopen($_SESSION['zrodlopliku'],"w");
flock($fp, LOCK_EX);
foreach ($noweDane as $line_num => $line)
fwrite($fp,$line);
flock($fp, LOCK_UN);
fclose($fp);
}

if ((isset($_POST['nrwiersza1']))or(isset($_POST['nrwiersza2'])))
{
$noweDane  = $_SESSION['nowyplik'];
$zmwiersz1=$_POST['nrwiersza1'];
$zmwiersz2=$_POST['nrwiersza2'];
if ($_POST['zmtytul1']=="") {$noweDane[$zmwiersz1]="&nbsp\r\n";} else {$noweDane[$zmwiersz1]=$_POST['zmtytul1']."\r\n";};
if ($_POST['zmtytul2']=="") {$noweDane[$zmwiersz2]="&nbsp\r\n";} else {$noweDane[$zmwiersz2]=$_POST['zmtytul2']."\r\n";};
$fp = fopen($_SESSION['zrodlopliku'],"w");
flock($fp, LOCK_EX);
foreach ($noweDane as $line_num => $line)
fwrite($fp,$line);
flock($fp, LOCK_UN);
fclose($fp);
}


if (isset($_POST['archkom']))
{
$wierszarchiwkom=$_POST["nrwierszaarchkom"];
$nazwatabeli=$_POST["nazwatabeli"];
$noweDane  = $_SESSION['nowyplik'];
$noweDane[$wierszarchiwkom+3]=$noweDane[$wierszarchiwkom];
$fp = fopen($_SESSION['zrodlopliku'],"w");
flock($fp, LOCK_EX);
foreach ($noweDane as $line_num => $line)
fwrite($fp,$line);
flock($fp, LOCK_UN);
fclose($fp);
require_once "connect.php";
$polaczenie = @new mysqli($host,$db_user,$db_haslo,$db_nazwa);
if ($polaczenie->connect_errno!=0)
{
echo "Error: ".$polaczenie->connect_erno." Opis: ".$polaczenie->connect_error;
}
else
{
$rezultat = $polaczenie->query("DELETE FROM ".$nazwatabeli);
$polaczenie->close();	
}
}			

if (isset($_SESSION['nowyplik'])) unset($_SESSION['nowyplik']);	
//	if (isset($_SESSION['zlehaslo'])) unset($_SESSION['zlehaslo']);
//	if (isset($_SESSION['zleimie'])) unset($_SESSION['zleimie']);
			
/*
{
$noweDane  = $_SESSION['nowyplik'];
$zmwiersz=$_POST['nrwiersza'];
$noweDane[$zmwiersz]=$_POST['zmtytul1'];
$fp = fopen("index.php", "w");
if(!flock($fp, LOCK_EX))
	{
	   fclose($fp);
		return;
	} 
	else
	{
		fputs($fp, $noweDane);
		flock($fp, LOCK_UN);
		fclose($fp);
	}
unset($_SESSION['nowyplik']);
}*/

 @header('Location:'.$nazwapliku);

/*	
	require_once "connect.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_haslo,$db_nazwa);
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_erno." Opis: ".$polaczenie->connect_error;
	}
	else{
	$login = str_replace(' ', '_', $_POST['login']);
	$haslo=$_POST['haslo'];

		$login = htmlentities($login, ENT_QUOTES, "UTF-8");

	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM uzytkownicy WHERE login='%s'",
		mysqli_real_escape_string($polaczenie,$login))))
	{
		$ile_login = $rezultat->num_rows;
		if ($ile_login>0) 
		{
				$wiersz = $rezultat->fetch_assoc();

			if (password_verify($haslo, $wiersz['haslo']))
				{
				
							
				$_SESSION['zalogowany']=true;

				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['login'];
				$_SESSION['imie'] = $wiersz['imie'];
				$_SESSION['czyadmin'] = $wiersz['prawa'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location:index.php');
				}
				else 
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location:login.php');
				}
				
		} else {
			
			$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			header('Location:login.php');
		}
		
	}
	
	$polaczenie->close();
	}
	*/
	
?>