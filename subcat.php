<?php
	$dirhandle = opendir('./'.$_COOKIE['user']."/".$_GET['cat']."/");
	/*while (false !== ($plik=readdir($dirHandle))){
		if($plik!="." and $plik!=".."){
			if(is_file("./".$_COOKIE['user']."/".$plik)){
				echo '<a href="download.php?file='.$cat.'/'.$plik.'">'.$plik.'</a><br/>';
			} 
		}
	}*/
	closedir($dirHandle);
?>
<a href="wyslij.html">Prześlij plik</a><br>
<a href="yourFolder.php">Wróć</a><br>