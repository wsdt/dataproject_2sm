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
    echo "<br><br><h1 class='text-center'>Profil Ändern:</h1>";

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
    if (!isset($_POST['deleteProfilData'])) { //Wenn Profildaten nicht gelöscht werden sollen
        //Undefinierte Indizes to empty string, so muss beim erstmaligen Eintragen nicht zwingend ganzes Profil ausgefüllt werden
        if (!isset($_POST['nname'])) { $nname = "";} else { $nname = $_POST['nname'];}
        if (!isset($_POST['vname'])) { $vname = "";} else { $vname = $_POST['vname'];}
        if (!isset($_POST['kurzbeschreibung'])) { $kurzbeschreibung = "";} else { $kurzbeschreibung = $_POST['kurzbeschreibung'];}
        if (!isset($_POST['persongender'])) { $persongender = "m";} else { $persongender = $_POST['persongender'];}//obwohl standardmaessig gesetzt, hier nochmal vorsichtshalber pruefen

        if ($profildata_available) {
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

    //Password Changer; !empty möglich, da 0 z.B. als String übergeben, so kein Problem hier
    if (!empty($_POST['passwort_old']) && !empty($_POST['passwort_new']) && !empty($_POST['passwort_new_repeat'])) {
        $pwd_old = $_POST['passwort_old'];
        $pwd_new = $_POST['passwort_new'];
        $pwd_new_repeat = $_POST['passwort_new_repeat'];


        $tmp_user = new Employee();
        $tmp_user = $tmp_user->loadUser_from_DB($_COOKIE['Username']);

        if($tmp_user->isPasswordValid($pwd_old)) {
            if ($pwd_new !== $pwd_new_repeat || strlen($pwd_new) < 4) {
                echo "ERROR: Password could not be changed! Min. 4 characters and both new password must be equal.";
            } else {
                if(!($tmp_user->setPassword($pwd_new,$pwd_new_repeat))) {
                    echo "ERROR: Surprisingly an error, your new password is not ok!";
                }
                $tmp_user->DB_updateUser();
                //Renew cookies
                setcookie("Username", $tmp_user->getUsername(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
                setcookie("Passwort", $tmp_user->getPasswordHash(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
            }
        } else {
            echo "ERROR: Old Password is wrong!";
        }
    }

    //Admin changer
    $tmp_user = new Employee();
    $tmp_user = $tmp_user->loadUser_from_DB($_COOKIE['Username']);

    if (isset($_POST['makeAdmin'])) {
        $tmp_user->makeAdmin();
    } else if (!isset($_POST['makeAdmin']) && !empty($_POST)){ //sonst beim Aufrufen der Seite keine Admin Rechte mehr
        $tmp_user->unmakeAdmin();
    }
    $tmp_user->DB_updateUser();
}


if (!$profildata_available) {
    echo "<h2 class='text-center'>Herzlich Willkommen ".$_COOKIE['Username']."! </h2>";
    echo "<p class='text-center'>Sie haben zu Ihrem erstellten Profil noch keine genaueren Angaben gemacht. Möchten Sie dies hier nachholen?</p><br><br>";
    createProfilForm(false,false,false,false);
} else {
    while ($row = $fetched_array) {
        //VON HIER BIS...
        echo "<br><br>";
        echo "<table class='table-bordered' style=\"text-align: left; width: 50%; height: 30%; margin-left: auto; margin-right: auto;\"border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >";
        echo "<tr><td><b>Username: </b></td>";
        echo "<td>" . $row['Username'] . "</td></tr>";
        echo "<tr><td><b>Nachname:</b></td>";
        echo "<td>" . $row['nname'] . "</td></tr>";
        echo "<tr><td><b>Vorname: </b></td>";
        echo "<td>" . $row['vname'] . "</td></tr>";
        echo "<tr><td><b>Kurzbeschreibung: </b></td>";
        echo "<td>" . $row['kurzbeschreibung'] . "</td></tr>";
        echo "<tr><td><b>Geschlecht: </b></td>";
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
