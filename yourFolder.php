<?php
	$dirHandle = opendir("./".$_COOKIE['user']);
	while (($plik=readdir($dirHandle))!== false){
		echo "plik: $plik<br/>";
	}
	closedir($dh);
?>