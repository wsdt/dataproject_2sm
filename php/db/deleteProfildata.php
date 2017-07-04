<?php
/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 04.07.2017
 * Time: 23:59
 */
require_once '../functions.php';
pageAuthentification(true); //Login-Page is the only exception where false should be placed!

echo "hi";
if (!empty($_POST) && $_POST['deleteProfileData'] === true) { //eig. doppelte Prüfung, da in Profile.php schon geprüft
    //Kann nicht über Klasse Employee gelöst werden zumindest nicht besonders sinnvoll, da Employee Klasse einen anderen Entitätstyp repräsentiert auch wenn Username vorkommt!
    INCLUDE 'dbNewConnection.php';

    $sql = "DELETE FROM Profil WHERE Username='".$_COOKIE['Username']."';"; //$_Post Username macht keinen Sinn, da ja eig nichts eingegeben (siehe Profile.php)

    $result = mysqli_query($tunnel,$sql);
    var_dump($result);
    return $result;
} else {
    return $_POST;
}

