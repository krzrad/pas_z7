<?php
	$badLoginLimit = 3;
	$lockoutTime = 60;

	$login = $_POST['user'];
	$password = $_POST['pass'];
	if(IsSet($_POST['user'],$_POST['pass'])){
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
		$rekord = mysqli_fetch_array($result);
		if($rekord){
			$czas = time();
			$date = date("Y-m-d H:i:s",$czas);
			if($rekord['haslo']==$password){
				$loginGood = 1;
				mysqli_query($connect, "UPDATE users SET tries = '0'
				WHERE idU= '".$rekord['idu']."';");
				setcookie("user",$rekord['login'],$czas+3600);
				header("Location: yourFolder.php");
			} else {
				$loginGood = 0;
				mysqli_query($connect, "UPDATE users SET failedLogin = '".$date."', tries = '". $rekord['tries']+1 ."
				WHERE idU= '".$rekord['idu']."';");
				if($date-$rekord['failedLogin']<$lockoutTime) {
					echo "Przykro mi, ale zostałeś zablokowany :(";
				} else {
					echo "Błąd";
				}
			}
			mysqli_query($connect, "INSERT INTO logi (idu,dataGodzina, prawidłowe) VALUES ('"
			.$rekord['idu']."','".$date."','".$loginGood."');");
		} else {
			echo 'Dane logowania nieprawidłowe!<br><a href="login.html">Wróć</a>';
		}
		mysqli_close($connect);
	}
?>