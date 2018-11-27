<?php
	if (!$_COOKIE['user']){
		header("Location: login.php");
	} else {
		echo '<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		</head> ';
		$cat = $_GET['cat'];
		$dirHandle = opendir('./'.$_COOKIE['user']."/".$cat."/");
		while (false !== ($plik=readdir($dirHandle))){
			if($plik!="." and $plik!=".."){
				if(is_file("./".$_COOKIE['user']."/".$cat."/".$plik)){
					echo '<div class="col-1 col-s-1"><a href="download.php?file='.$cat.'/'.$plik.'">';
					switch(mime_content_type('./'.$_COOKIE['user']."/".$cat."/".$plik)){
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
					echo '</a>'.$plik.' '.mime_content_type('./'.$_COOKIE['user']."/".$cat."/".$plik).'<br/></div>';
				} 
			}
		}
		closedir($dirHandle);
		echo "<a href=\"wyslij.php?cat=".$cat."\">Prześlij plik</a><br>";
	}
?>
<a href="yourFolder.php">Wróć</a><br>