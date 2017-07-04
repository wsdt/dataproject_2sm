<html>
<head>
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <!-- Verlinken der Css Dateien -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
</head>
<title>News</title>
<body>
<?php
require_once 'functions.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!

?>

<!-- Navigation einfügen und verlinken -->
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
<section>
    <!-- Überschrift einbinden, hit the floor ist das SStylesheet für die Schriftart-->
    <div class="text-center">
        <br>
        <br>
        <div><h1>Breaking News</h1></div>
        <!-- Text und zweite Überschrift-->
        <h2>DATA ENGINEEER GESUCHT!</h2>
    <p>WIR suchen dich! Bewirb dich Jetzt bei BlUE SURFACE SEEKER!
            <br>
            Top Aufstiegchancen und ein gutes Gehalt?
            <br>
            Falls du Intressiert bist, Bewirb dich unter den Kontaktdaten im <a href="impressum.php">Impressum! </a>
    </p>
    </div>
</section>
<!-- Bild einfügen -->
<!-- Falls der Mauszeiger auf das Bild zeigt, Wahrer Ultra anzeigen-->
<div class="text-center">
    <img title="BLUE SURFACE SEEKER" alt="BLUE SURFACE SEEKER" src="../images/Logo.jpg" width="600" height="740"/>
</div>
</body>
</html>


</section>


</body>
</html>