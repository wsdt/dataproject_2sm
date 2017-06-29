<?php
	include "dbDetails.php";

	/*if (empty($user) || empty($pwd)) {
        include_once 'dbNoAuthorization.php';
    }*/

	$tunnel = mysqli_connect($server, $user, $pwd, $db) or die(include_once 'dbNoAuthorization.php');

	//echo "<p><strong>PHP Info: </strong>DB Verbindung erfolgreich hergestellt.</p>";
?>