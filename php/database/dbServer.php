

<html>
	<head>
		<title>Database Information</title>
	</head>
	<body>

		<?php
			include "dbNewConnection.php";
			echo "<h1>Datenbankserver erreichbar unter: </h1>";
			echo "<p>" . $server . "</p>";
		?>
		
	</body>
</html>