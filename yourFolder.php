<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head> 
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
	$result = mysqli_query($connect, "SELECT * FROM logi WHERE idU = (SELECT idU FROM users WHERE login='".$_COOKIE['user']."') 
	ORDER BY dataGodzina DESC LIMIT 2;");
	$i = 0;
	$check;
	while($rekord=mysqli_fetch_array($result)){
		$check[$i]=$rekord['prawidlowe'];
		$i++;
	}
	if($check[0]!=$check[1]){
		$result = mysqli_query($connect,"SELECT dataGodzina FROM logi WHERE idU = (
		SELECT idU FROM users WHERE login='".$_COOKIE['user']."'
		) and prawidlowe = 0 ORDER BY dataGodzina DESC LIMIT 2;");
		echo "<div id=\"ostrzezenie\">O ".mysqli_fetch_array($result)['dataGodzina']." doszło do błędnego logowania!</div>";
	}
	$dirHandle = opendir("./".$_COOKIE['user']);
	while (($plik=readdir($dirHandle))!== false){
		if($plik!="." and $plik!=".."){
			if(is_file("./".$_COOKIE['user']."/".$plik)){
				echo '<a href="download.php?file='.$plik.'">'.$plik.'</a><br/>';
			} else if(is_dir("./".$_COOKIE['user']."/".$plik)){
				echo '<a href="subcat.php?cat='.$plik.'">'.$plik.'</a><br/>';
			}
		}
	}
	closedir($dirHandle);
?>
<a href="wyslij.html">Prześlij plik</a><br>
<a href="tworzkat.html">Utwórz nowy katalog</a><br>
<a href="logout.php">Wyloguj</a>