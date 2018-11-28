<?php
	$cat=$_GET['cat'];
	echo "<html>
		<body>
			<form action=\"odbierz.php\" method=\"POST\" ENCTYPE=\"multipart/form-data\">
				<input type=\"file\" name=\"plik\"/>
				<input type=\"hidden\" name=\"cat\" value=\"$cat\"/>
				<input type=\"submit\" value=\"Wyślij plik\"/>
			</form>
		</body>
	</html>";
?>