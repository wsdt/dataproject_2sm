<html>
<head>
    <!-- Viewport für Mobile Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scaleable=no">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/navBar.css">
    <link rel="stylesheet" href="../css/general.css">
    <script type="text/javascript" src="../js/login_logout.js"></script>
    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>

    <!--<script type="text/javascript">
        //Hier inline, da eig nur hier gebraucht

        function evtlAskForPermissionToDeleteData() {
            //If alle Felder leer mache prompt alert und frage mit JA Eingabe ob Profildaten (exkl. Passwort und Username) aus Datenbank zu löschen. Ist also nicht gleich Account löschen
            var username = document.getElementById('username').value;
            var password_old = document.getElementById('passwort_old').value;
            var password_new = document.getElementById('passwort_new').value;
            var password_new_repeat = document.getElementById('passwort_new_repeat').value;
            var vname = document.getElementById('vname').value;
            var nname = document.getElementById('nname').value;
            var kurzbeschreibung = document.getElementById('kurzbeschreibung').value;
            var geschlecht = document.getElementsByName('persongender'); //ACHTUNG keine einzelne Variable

            if (username === "" && password_old === "" && password_new === ""
            && password_new_repeat === "" && vname === "" && nname === "" &&
            kurzbeschreibung === "" && geschlecht[0].checked === false && geschlecht[1].checked === false) {
                if(window.confirm("You have not entered anything! \n Do you want to delete your profile data? \n" +
                    "This does not delete your account!")) {
                    var deleteProfileData = true;

                    var request = $.ajax({
                        //TODO: Datei wird scheinbar nicht gefunden?
                        url: "db/deleteProfildata.php",
                        type: "post",
                        data: {
                            deleteProfileData: true
                        },
                        success: function (receivedData) {
                            //console.log(receivedData.prototype.toString());
                        }
                    });
                } //else do nothing.
            return false;
            }
        }

    </script>-->

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
    if (!isset($_POST['deleteProfilData'])) { //Wenn Profildaten nicht gelöscht werden sollen
        //Undefinierte Indizes to empty string, so muss beim erstmaligen Eintragen nicht zwingend ganzes Profil ausgefüllt werden
        if (!isset($_POST['nname'])) { $nname = "";} else { $nname = $_POST['nname'];}
        if (!isset($_POST['vname'])) { $vname = "";} else { $vname = $_POST['vname'];}
        if (!isset($_POST['kurzbeschreibung'])) { $kurzbeschreibung = "";} else { $kurzbeschreibung = $_POST['kurzbeschreibung'];}
        if (!isset($_POST['persongender'])) { $persongender = "m";} else { $persongender = $_POST['persongender'];}//obwohl standardmaessig gesetzt, hier nochmal vorsichtshalber pruefen

        if ($profildata_available) {
            //TODO: Hier Tabelle updaten mit untenstehenden Formulardaten
            //require 'db/dbNewConnection.php';

            $sql = "UPDATE Profil
                    SET username='".escapeString($_COOKIE['Username'])."', nname='".escapeString($nname)."', vname='".
                    escapeString($vname)."', kurzbeschreibung='".escapeString($kurzbeschreibung)."', persongender='".escapeString($persongender)."'
                    WHERE username='".escapeString($_COOKIE['Username'])."';";

            if(!mysqli_query($tunnel,$sql)) {
                echo "ERROR: Profildaten konnten nicht gespeichert werden! (update)";
            }
            //mysqli_close($tunnel);
        } else {
            //require 'db/dbNewConnection.php';

            $sql = "INSERT INTO Profil (username, nname ,vname, kurzbeschreibung, persongender)
                      VALUES ('".escapeString($_COOKIE['Username'])."','".escapeString($nname)."','".
                escapeString($vname)."','".escapeString($kurzbeschreibung)."','".escapeString($persongender)."');";
                if(!mysqli_query($tunnel,$sql)) {
                    echo "ERROR: Profildaten konnten nicht gespeichert werden! (insert)";
                }
            //mysqli_close($tunnel);
        }

    } else {
        deleteProfildata(); //Lösche Profildaten
    }

    //TODO: Noch extra hier für Passwort Routine schreiben
}


if (!$profildata_available) {
    echo "<h2>Herzlich Willkommen ".$_COOKIE['Username']."! </h2>";
    echo "<p>Sie haben zu Ihrem erstellten Profil noch keine genaueren Angaben gemacht. Möchten Sie dies hier nachholen?</p>";
    createProfilForm(false,false,false,false);
} else {
    while ($row = $fetched_array) {
        //VON HIER BIS...
        echo "<table>";
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
        echo "</table><br /><br />";
        //... BIS HIER, könnte man auskommentieren, wenn man die Profildaten nur über Formular ausgeben lassen möchte
        createProfilForm($row['nname'], $row['vname'], $row['kurzbeschreibung'], $row['persongender']);
        break; //Es soll nur ein Profil ausgegeben werden (da Username = Primär/Fremdschlüssel dürfte ohnehin nur ein Profil zurückgegeben werden)
    }

}



mysqli_close($tunnel);
?>
</body>

</html>
