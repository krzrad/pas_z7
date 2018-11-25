<?php
	$badLoginLimit = 3;
	$lockoutTime = 60;

	$login = $_POST['user'];
	$password = md5($_POST['pass']);
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
			$failedLogin = $rekord['failedLogin'];
			$tries = $rekord['tries'];
			if(($tries >= $badLoginLimit)
			&&(time()-$failedLogin < lockoutTime)){
				echo 'Przykro mi, ale zostałeś zablokowany :(<br><a href="login.php">Wróć</a>';
			} else if($rekord['haslo']==$password){
				$loginGood = 1;
				mysqli_query($connect, "UPDATE users SET tries = '0'
				WHERE idU= '".$rekord['idU']."';");
				setcookie("user",$rekord['login'],time()+3600);
				header("Location: yourFolder.php");
			} else {
				$loginGood = 0;
				if(time() - $failedLogin > $lockoutTime){
					mysqli_query($connect, "UPDATE users SET failedLogin = '".time()."',
					tries = '1' WHERE idU= '".$rekord['idU']."';");
				} else {
					mysqli_query($connect, "UPDATE users SET failedLogin = '".time()."',
					tries = '".$tries++."' WHERE idU= '".$rekord['idU']."';");
				}
				echo 'Dane logowania nieprawidłowe!<br><a href="login.php">Wróć</a>';
			}
			mysqli_query($connect, "INSERT INTO logi (idu,dataGodzina, prawidlowe) VALUES ('"
			.$rekord['idU']."','".date("Y-m-d H:i:s",time())."','".$loginGood."');") or die(mysqli_error($connect));
		} else {
			echo 'Dane logowania nieprawidłowe!<br><a href="login.php">Wróć</a>';
		}
		mysqli_close($connect);
	}
?>