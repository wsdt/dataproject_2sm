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


// LOAD PAGE END ----------------------------------------------------------------------------------------------


?>
</body>
</html>