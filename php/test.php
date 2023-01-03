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
    }
}
}