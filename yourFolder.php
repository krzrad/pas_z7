<?php
	$dirHandle = opendir("./".$_COOKIE['user']);
	while (($plik=readdir($dirHandle))!== false){
		echo "plik: $plik<br/>";
	}
	closedir($dirHandle);
?>
<a href="wyslij.html">Prześlij plik</a><br>
<a href="logout.php">Wyloguj</a>