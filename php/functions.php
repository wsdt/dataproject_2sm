<?php
/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 29.06.2017
 * Time: 18:57
 */

function pageAuthentification($show_errorpage) { //recommended: true
    require_once 'Employee.php';

    $current_employee = new Employee();
    if (empty($_POST)) {
        if (isset($_COOKIE['Username']) && isset($_COOKIE['Passwort'])) {
            $current_employee->setUsername($_COOKIE['Username']);
            $current_employee->setPasswordHash($_COOKIE['Passwort']); //Übergib Pwd als Hash, da in Cookie Hash gespeichert sein sollte.
            //Standard = kein Admin
            $login_success = $current_employee->authentificateUser($current_employee->getPasswordHash(),true,true);
            if (!$login_success) {include_once 'db/dbNoAuthorization.php';}
            echo "found cookies and used them";
        } else {
            if ($show_errorpage) {include_once 'db/dbNoAuthorization.php';}
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
            if ($show_errorpage) {include_once 'db/dbNoAuthorization.php';}
        }
    } else {
        if ($show_errorpage) {include_once 'db/dbNoAuthorization.php';}
    }
}