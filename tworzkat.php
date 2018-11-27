<?php
	if (!$_COOKIE['user']){
		header("Location: login.php");
	} else {
	echo '<html>
		<body>
			<form action="newdir.php" method="POST">
				Nazwa katalogu: <input type="text" name="nazwa"/>
				<input type="submit" value="Utwórz"/>
			</form>
		</body>
	</html>';
	}
?>
