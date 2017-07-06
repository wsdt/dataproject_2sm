<?php

/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 06.07.2017
 * Time: 20:37
 */
class Newsclass
{
    private $newsID;
    private $title;
    private $newstext;


    function __destruct()
    { //Delete News
        $this->newsID = null;
        $this->title = null;
        $this->newstext = null;
    }
    //GETTER/SETTER
    function setnewsID($newsID) {
        $this->newsID = $newsID;
    }
    function getnewsID() {
        return $this->newsID;
    }
    function settitle($title) {
        $this->title=$title;
    }
    function gettitle() {
        return $this->title;
    }
    function setnewstext($newstext) {
        $this->newstext = $newstext;
    }
    function getnewstext() {
        return $this->newstext;
    }

    //Functions

    function DB_executeSQLstatement($sql) {
        $tunnel = $this->establishDBConnection();
        $result = mysqli_query($tunnel, $sql);
        $this->closeDBConnection($tunnel);
        return $result;
    }
    function DB_deleteNews() {
        //var_dump($this->getnewsID());
        $sql = "DELETE FROM News WHERE NewsID=".$this->getnewsID().";";

        if(($this->DB_executeSQLstatement($sql))===false) {
            echo "ERROR: News could not be deleted. (in DB_deleteNews())";
        }
    }

    function closeDBConnection($tunnel) //Tunnel = DB Verbindung/Instanz übergeben
    {
        if (!mysqli_close($tunnel)) {
            echo "FATAL_ERROR: Datenbank-Verbindung konnte nicht geschlossen werden. [in isUsernameAvailable()]";
        }
    }

    function establishDBConnection()
    {
        return require 'db/dbNewConnection.php'; //Gib Tunnel zurück, return wrschl. nicht mal notwendig
    }

}