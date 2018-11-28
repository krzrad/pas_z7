<?php
	if (!$_COOKIE['user']){
		header("Location: login.php");
	} else {
		echo '<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		</head> ';
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
					echo '<div class="col-1 col-s-1"><a href="download.php?file='.$plik.'">';
					switch(mime_content_type("./".$_COOKIE['user']."/".$plik)){
						case "image/gif":
							echo '<img src="image_gif.svg">';
							break;
						case "image/jpeg":
							echo '<img src="image_jpg.svg">';
							break;
						case "image/png":
							echo '<img src="image_png.svg">';
							break;
						case "image/x-ms-bmp":
							echo '<img src="image_bmp.svg">';
							break;
						case "text/plain":
							echo '<img src="text.svg">';
							break;
						default :
							echo '<img src="file.svg">';
							break;
					}
					echo '</a>'.$plik.' '.mime_content_type("./".$_COOKIE['user']."/".$plik).'<br/></div>';
				} else if(is_dir("./".$_COOKIE['user']."/".$plik)){
					echo '<div class="col-1 col-s-1">
					<a href="subcat.php?cat='.$plik.'"><img src="directory.svg"></a>'.$plik.'<br/>
					</div>';
				}
			}
		}
		closedir($dirHandle);
		echo '<div class="row">
				<div class="col-1 col-s-1">
					<a href="wyslij.php"><img src="upload_file.svg"></a>Prześlij plik
				</div>
				<div class="col-1 col-s-1">
					<a href="tworzkat.php"><img src="newdir.svg"></a>Utwórz nowy katalog
					<a href="logout.php"><img src="logout.svg"></a>Wyloguj
				</div>
			</div>';
	}
?>
