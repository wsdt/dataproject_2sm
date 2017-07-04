<?php
/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 29.06.2017
 * Time: 18:57
 */
function createNav() {
    echo "<div class=\"nav\">
        <ul>
            <li class=\"home\"><a href=\"home.php\">Home</a></li>
            <li class=\"profile\"><a class=\"active\" href=\"Profile.php\">Profil</a></li>
            <li class=\"news\"><a href=\"news.php\">News</a></li>
            <li class=\"impressum\"><a href=\"impressum.php\">Impressum</a></li>
            <li class=\"logout\"><a href='#' onclick='logCurrentUserOut()' \">Logout</a></li>
        </ul>
    </div>";
}

function createProfilForm() {
    echo "<table><form method='post' name='profil_edit_form' action='".$_SERVER['PHP_SELF']."' onsubmit='evtlAskForPermissionToDeleteData()'>";
    echo "<tr><td>Username: </td><td><input type='text' id='username' name='username' placeholder='".$_COOKIE['Username']."' /></td>";
    echo "<tr><td>Old password: </td><td><input id='passwort_old' type='password' name='passwort_old' placeholder='Type in old pwd to change it' /></td>";
    echo "<tr><td>New password: </td><td><input id='passwort_new' type='password' name='passwort_new' placeholder='Your future password' /></td>";
    echo "<tr><td>New password (repeat): </td><td><input id='passwort_new_repeat' type='password' name='passwort_new_repeat' placeholder='Repeat new password' /></td>";
    echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
    echo "<tr><td>Vorname: </td><td><input id='vname' type='text' name='vname' placeholder='Max'/></td>";
    echo "<tr><td>Nachname: </td><td><input id='nname' type='text' name='nname' placeholder='Mustermann'/></td>";
    echo "<tr><td>Kurzbeschreibung: </td><td><textarea id='kurzbeschreibung' name='kurzbeschreibung' placeholder='Interesting facts about you. :)'></textarea></td>";
    echo "<tr><td>Geschlecht: </td><td><input type='radio' name='persongender' value='w'> Weiblich\n<input type='radio' name='persongender' value='m'> Männlich</td>";
    echo "<tr><td><input type='reset' value='Formular leeren'/></td><td><input type='submit' name='profil_edited' value='Profil aktualisieren'></td></tr>";
    echo "</form></table>";
}


function createLogoutButton() {
    //This function creates a logout-button at that place where this function will be called.
    //IMPORTANT: To show the button accurately, the page which uses this function must embed bootstrap (css) AND login_logout.js
    echo "<button type='button' class='btn btn-danger' onclick='logCurrentUserOut()'>Logout</button>";
}


function pageAuthentification($show_errorpage) { //recommended: true
    require_once 'Employee.php';

    $current_employee = new Employee();
    if (!isset($_POST['Username']) && !isset($_POST['Passwort'])) {
        if (isset($_COOKIE['Username']) && isset($_COOKIE['Passwort'])) {
            $current_employee->setUsername($_COOKIE['Username']);
            $current_employee->setPasswordHash($_COOKIE['Passwort']); //Übergib Pwd als Hash, da in Cookie Hash gespeichert sein sollte.
            //Standard = kein Admin
            $login_success = $current_employee->authentificateUser($current_employee->getPasswordHash(),true,true);
            if (!$login_success) {
                include_once 'db/dbNoAuthorization.php';}
            echo "found cookies and used them";
        } else {
            if ($show_errorpage) {
                include_once 'db/dbNoAuthorization.php';}
        }
    } else if (isset($_POST['Username']) && isset($_POST['Passwort'])) {
        $current_employee->setUsername($_POST['Username']);

        if ($_POST['login_or_register'] == "login") {
            //$current_employee->setPassword($_POST['Passwort'], $_POST['Passwort']); NICHT SETPASSWORD NUTZEN, da sonst neuer HASH-Wert!!!
            $login_success = $current_employee->authentificateUser($_POST['Passwort'],false,true); //exit() in noauthorization.php, so following could would not be executed

            $tmp_user = $current_employee->loadUser_from_DB($current_employee->getUsername()); //to get the same hash for cookie saving

            if($login_success) {
                echo "set cookie";
                setcookie("Username", $current_employee->getUsername(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
                setcookie("Passwort", $tmp_user->getPasswordHash(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
            }
            $tmp_user->__destruct();
        } else if ($_POST['login_or_register'] == "register") {
            $isOk = $current_employee->setPassword($_POST['Passwort'], $_POST['Passwort_repeat']);
            if ($isOk) {
                if ($current_employee->DB_addUser()) {
                    echo "registered user and set cookie";
                    setcookie("Username", $current_employee->getUsername(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
                    setcookie("Passwort", $current_employee->getPasswordHash(), time() + 60 * 60 * 12); //Cookies laufen in 12h ab
                } else {
                    echo "ERROR: Ihre Registrierung ist leider fehlgeschlagen! (in functions.php)";
                }
            }
        } else {
            if ($show_errorpage) {
                include_once 'db/dbNoAuthorization.php';}
        }
    } else {
        if ($show_errorpage) {
            include_once 'db/dbNoAuthorization.php';}
    }
}