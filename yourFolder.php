<?php
	$DBhost = 'sql.kradowskipas.nazwa.pl:3306';
	$DBuser = 'kradowskipas_chmurka';
	$DBpassword ='zAdanie7';
	$DBname = 'kradowskipas_chmurka';
	$connect = mysqli_connect($DBhost,$DBuser,$DBpassword,$DBname);
	if(!$connect){
		echo "Błąd połączenia z MySQL!".PHP_EOL;
		echo "Err. no.: ".mysqli_connect_errno().PHP_EOL;
		echo "Error: ".mysqli_connect_error().PHP_EOL;
		exit;
	};
	$result = mysqli_query($connect, "SELECT * FROM users WHERE login='$login'"); 
	$dirHandle = opendir("./".$_COOKIE['user']);
	while (($plik=readdir($dirHandle))!== false){
		echo "plik: $plik<br/>";
	}
	closedir($dirHandle);
?>
<a href="wyslij.html">Prześlij plik</a><br>
<a href="logout.php">Wyloguj</a>