<html>
<head>
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



// Navigation einbinden!
echo "<header>";
    createNav();
    echo "</header>";

INCLUDE 'db/dbNewConnection.php';

$sql = "SELECT Username
              ,nname
              ,vname
              ,kurzbeschreibung
              ,persongender
              FROM Profil";

$result = mysqli_query($tunnel,$sql);

$fetched_array = mysqli_fetch_array($result);
if (empty($fetched_array)) {
    echo "<h2>Herzlich Willkommen ".$_COOKIE['Username']."! </h2>";
    echo "<p>Sie haben zu Ihrem erstellten Profil noch keine genaueren Angaben gemacht. Möchten Sie dies hier nachholen?</p>";

    //TODO: Hier Insert Formular anzeigen für Dateneingabe (Formular soll über PHP Funktion generiert werden, da UPDATE bei Profil EDIT wenn nicht leer


} else {
    echo "<table>";
    while ($row = $fetched_array) {
        echo "<tr><td>Username: </td>";
        echo "<td>" . $row['Username'] . "</td></tr>";
        echo "<tr><td>Nachname: </td>";
        echo "<td>" . $row['nname'] . "</td></tr>";
        echo "<tr><td>Vorname: </td>";
        echo "<td>" . $row['vname'] . "</td></tr>";
        echo "<tr><td>Kurzbeschreibung: </td>";
        echo "<td>" . $row['kurzbeschreibung'] . "</td></tr>";
        echo "<tr><td>Geschlecht: </td>";
        echo "<td>" . $row['persongender'] . "</td></tr>";
        break; //Es soll nur ein Profil ausgegeben werden (da Username = Primär/Fremdschlüssel dürfte ohnehin nur ein Profil zurückgegeben werden)
    }
    echo "</table>";
}

?>
</body>

</html>
