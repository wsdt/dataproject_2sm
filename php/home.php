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
</head>
<body>
<header>
    <div class="nav">
        <ul>
            <li class="home"><a href="home.php">Home</a></li>
            <li class="profile"><a class="active" href="Profile.php">Profil</a></li>
            <li class="news"><a href="news.php">News</a></li>
            <li class="impressum"><a href="impressum.php">Impressum</a></li>
            <li class="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>
<?php
require_once 'functions.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!

// LOAD PAGE -------------------------------------------------------------------------------------------------

echo "<h1 class='text-center'>WElCOME TO BLUE SURFACE SEEKER EMPLOYEE LOGIN!</h1>";



// LOAD PAGE END ----------------------------------------------------------------------------------------------


?>
</body>
</html>