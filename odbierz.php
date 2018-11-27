<?php
	if (!$_COOKIE['user']){
		header("Location: login.php");
	} else {
		$cat=$_POST['cat'];
		$max_rozmiar = 1000000;
		if (is_uploaded_file($_FILES['plik']['tmp_name']))
		{
			if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
			else
			{
				echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
				if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
				if ($cat != null) {$ext=$cat.DIRECTORY_SEPARATOR;}
				$path = $_SERVER['DOCUMENT_ROOT'].$_COOKIE['user'].DIRECTORY_SEPARATOR.$ext;
				move_uploaded_file($_FILES['plik']['tmp_name'],$path.$_FILES['plik']['name']);
			}
		}
		else {echo 'Błąd przy przesyłaniu danych!<br><a href=\"yourFolder.php\">Wróć</a>';}
	}
?>