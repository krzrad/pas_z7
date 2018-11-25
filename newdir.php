<?php
	if (mkdir($_COOKIE['user']."/".$_POST['nazwa']))
	{
		echo "Katalog ".$_POST['nazwa']." został utworzony<br><a href=\"yourFolder.php\">Wróć</a>";
	}
	else {echo 'Błąd przy tworzeniu katalogu!<br><a href=\"podkatalog.html\">Wróć</a>';}
?>