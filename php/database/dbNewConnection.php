<?php
	include "dbDetails.php";
	
	$tunnel = mysqli_connect($server, $user, $pwd, $db) or die("<p><strong style='color:#ff0000;'>PHP Error: </strong>Verbindung konnte nicht hergestellt werden.</p>");

	//echo "<p><strong>PHP Info: </strong>DB Verbindung erfolgreich hergestellt.</p>";
?>