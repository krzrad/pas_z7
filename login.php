<?php 
	if ($_COOKIE["user"]) {
		header("Location: yourFolder.php");
	} else echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<title>Radowski</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<BODY>
	Formularz logowania
	<form method="post" action="verify.php">
		Login:<input type="text" name="user" maxlength="20" size="20"><br>
		Hasło:<input type="password" name="pass" maxlength="20" size="20"><br>
		<input type="submit" value="Zaloguj"/></br>
		<a href="rejestracja.html">Zarejestruj się</a>
	</form>
	</BODY>
	</HTML>';
?>