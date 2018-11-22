<?php
	$login = $_POST['user'];
	$password = $_POST['pass'];
	if(IsSet($_POST['user'],$_POST['pass'])){
		$DBhost = 'sql.kradowskipas.nazwa.pl:3306';
		$DBuser = 'kradowskipas_chmurka';
		$DBpassword ='Zadanie7';
		$DBname = 'kradowskipas_chmurka';
		$connect = mysqli_connect($DBhost,$DBuser,$DBpassword,$DBname);
		if(!$connect){
			echo "Błąd połączenia z MySQL!".PHP_EOL;
			echo "Err. no.: ".mysqli_connect_errno().PHP_EOL;
			echo "Error: ".mysqli_connect_error().PHP_EOL;
			exit;
		};
		$result = mysqli_query($connect, "SELECT * FROM users WHERE login='$login'"); 
		$rekord = mysqli_fetch_array($result);
		if($rekord){
			if($rekord['haslo']==$password){
				$loginGood = 1;
			} else {
				$loginGood = 0;
			}
			mysqli_query($connect, "INSERT INTO logi (idu,dataGodzina, prawidłowe) VALUES ('"
			.$rekord['idu']."','".date("Y-m-d H:i:s",time())."','".$loginGood."');");
		} else {
			echo 'Dane logowania nieprawidłowe!<br><a href="login.html">Wróć</a>';
		}
		mysqli_close($connect);
	}
?>