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


// Navigation einfügen und verlinken
echo "<header>";
createNav();
echo "</header>";
?>
<section>
    <div class="text-center"><h1>Breaking News</h1>
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="POST">
            Titel:     <input type="text" name="title"/><br/>
            Text:      <textarea id="text" name="textarea" cols="35" rows="4"></textarea><br/>
            <input type="submit" value="Absenden"/>
        </form>
    </div>
    <?php
    if(!empty($_POST)) {
        INCLUDE 'db/dbNewConnection.php';
        $title = $_POST['title'];
        $textarea = $_POST['textarea'];
        if (strlen($title) > 0 && strlen($textarea) > 0) {
            $news = "INSERT INTO News (title, newstext) VALUES ('" . $title . "','" . $textarea . "')";
            $pushnews = mysqli_query($tunnel, $news) or DIE ("Fehler: " . mysql_error());
            echo 'Der Eintrag war erfolgreich';
        } else {
            echo 'Ihre Angaben sind fehlerhaft.';
        }
        mysqli_close($tunnel);
    }







    ?>
    <?php
    INCLUDE 'db/dbNewConnection.php';

    $getnews="SELECT * FROM News ORDER BY newsID DESC";
    $ergebnis1=mysqli_query($tunnel, $getnews);

    while($row1 = mysqli_fetch_array($ergebnis1))
    {
        echo"<h1 class='text-center'>".$row1['title']."</h1>";
        echo"<p class='text-center'>".$row1['newstext']."</p><br><br>";
    }

    mysqli_close($tunnel);
    ?>
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