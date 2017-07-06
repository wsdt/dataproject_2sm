<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blue Surface Seeker</title>
    <link href="../css/general.css" rel="stylesheet">
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/general.css">
    <script type="text/javascript" src="../js/login_logout.js"></script>
</head>
<body>
<form action="home.php" action="POST"/>
Kampagnenname: <input type="text" name="Name"/><br/>
Anfang: <input type="date" name="Anfang"/><br/>
Ende: <input type="date" name="Ende"/><br/>
kurzbeschreibung: <input type="text" name="kurzbeschreibung"/><br/>
Priorität: <input type="color" name="Priorität"/><br/>
<input type="submit" value="Absenden"/>
</form>
<?php
require_once 'functions.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!

// LOAD PAGE -------------------------------------------------------------------------------------------------
echo "<header>";
createNav();
echo "</header>";
echo "<h1 class='text-center'>WElCOME TO BLUE SURFACE SEEKER EMPLOYEE LOGIN!</h1>";

//Creates logout button anywhere you want it
createLogoutButton();

// MARKETING CAMPAGINS ----------------------------------------------------------------------------------------------

//TODO: Place here marketing campaign tables etc. 

INCLUDE 'db/dbNewConnection.php';


?>
</body>
</html>