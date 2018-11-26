<?php
	$cat = $_GET['cat'];
	$dirHandle = opendir('./'.$_COOKIE['user']."/".$cat."/");
	while (false !== ($plik=readdir($dirHandle))){
		if($plik!="." and $plik!=".."){
			if(is_file("./".$_COOKIE['user']."/".$cat."/".$plik)){
				echo '<a href="download.php?file='.$cat.'/'.$plik.'">'.$plik.'</a><br/>';
			} 
		}
	}
	closedir($dirHandle);
	echo "<a href=\"wyslij.php?cat=".$cat."\">Prześlij plik</a><br>";
?>
<a href="yourFolder.php">Wróć</a><br>