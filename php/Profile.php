<html>
<head>
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/general.css">
    <script type="text/javascript" src="../js/login_logout.js"></script>

    <script type="text/javascript">
        //Hier inline, da eig nur hier gebraucht

        function evtlAskForPermissionToDeleteData() {
            //If alle Felder leer mache prompt alert und frage mit JA Eingabe ob Profildaten (exkl. Passwort und Username) aus Datenbank zu löschen. Ist also nicht gleich Account löschen
            var username = document.getElementById('username').value;
            var password_old = document.getElementById('password_old').value;
            var password_new = document.getElementById('password_new').value;
            var password_new_repeat = document.getElementById('password_new_repeat').value;
            var vname = document.getElementById('vname').value;
            var nname = document.getElementById('nname').value;
            var kurzbeschreibung = document.getElementById('kurzbeschreibung').value;
            var geschlecht = document.getElementsByName('persongender'); //ACHTUNG keine einzelne Variable

            if (username === "" && password_old === "" && password_new === ""
            && password_new_repeat === "" && vname === "" && nname === "" &&
            kurzbeschreibung === "" && geschlecht[0].checked === false && geschlecht[1].checked === false) {
                if(window.confirm("You have not entered anything! \n Do you want to delete your profile data? \n" +
                    "This does not delete your account!")) {
                    //TODO: DELETE Profile Data
                } //else do nothing.
            }
        }

    </script>

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
$profildata_available = !empty($fetched_array);

if (!empty($_POST) && isset($_POST['profil_edited'])) {
    //TODO: Insert oder Update Statement wenn Profil aktualisiert oder erstmals ergänzt wird.
    //TODO: IMPORTANT: Es ist ok wenn bei manchen Felder nichts angegeben wird. Dann wird einfach null oder nichts in die Datenbank gespeichert,
    //TODO: ABER: bei UPDATE besonders darauf zu achten, dass NULL-Werte (also leere Formularfelder) NICHT die bestehenden Werte in der Datenbank überschreiben
    if ($profildata_available) {
        //TODO: Hier Tabelle updaten mit untenstehenden Formulardaten
    } else {
        //TODO: Hier Insert in Tabelle mit untenstehenden Formulardaten
    }

}


if ($profildata_available) {
    echo "<h2>Herzlich Willkommen ".$_COOKIE['Username']."! </h2>";
    echo "<p>Sie haben zu Ihrem erstellten Profil noch keine genaueren Angaben gemacht. Möchten Sie dies hier nachholen?</p>";
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

createProfilForm();

mysqli_close($tunnel);
?>
</body>

</html>
