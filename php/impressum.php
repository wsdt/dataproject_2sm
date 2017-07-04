<html>
<head>
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <!-- Verlinken der Css Dateien -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/general.css">
    <script type="text/javascript" src="../js/login_logout.js"></script>
</head>
<title>News</title>
<body>
<?php
require_once 'functions.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!


//Navigation einfügen und verlinken
echo "<header>";
    createNav();
    echo "</header>";
    ?>
<section>


    <!-- Impressumtext einfügen, Hier wurde mit Absicht eine normale Überschrift gewählt! -->
    <div class="text-center">
        <br>
        <br>
        <br>
        <h1>Impressum</h1>
        <p><strong>Betreiber:</strong><br />Gruß Sonne<br />Far Away 1000<br />6330 Kufstein</p>
        <br>
        <p><strong>Kontakt:</strong><br />Telefon: 089/1234567-8<br />Telefax: 089/1234567-9<br />E-Mail: Gruß@sonne.at<br />Website: <a href="https://theflatearthsociety.org/home">Flatearther</a></p>
        <br>
        <p><strong>Bei redaktionellen Inhalten:</strong></p>
        <p>Verantwortlich nach § 55 Abs.2 RStV<br />Moritz Schreiberling<br />Musterstraße 2<br />80999 München</p>
    </div>
</section>


</body>
</html>
