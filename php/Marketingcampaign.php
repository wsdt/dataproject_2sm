<?php

/**
 * Created by IntelliJ IDEA.
 * User: kevin
 * Date: 06.07.2017
 * Time: 10:51
 */
class Marketingcampaign
{
    private $campaignID;
    private $campaignName;
    private $dateofbegin;
    private $dateofend;
    private $costumerID;
    private $campaignteamID;
    private $priorityID;

    //GETTER/SETTER
    function setCampaignID($campaignID) {
        $this->campaignID = $campaignID;
    }
    function getCampaignID() {
        return $this->campaignID;
    }
    function setCampaignName($campaignName) {
        $this->campaignName = $campaignName;
    }
    function getCampaignName() {
        return $this->campaignName;
    }
    function setDateofbegin($dateofbegin) {
        $this->dateofbegin=$dateofbegin;
    }
    function getDateofbegin() {
        return $this->dateofbegin;
    }
    function setDateofend($dateofend) {
        $this->dateofend = $dateofend;
    }

    function getDateofend()
    {
        return $this->dateofend;
    }
    function setCostumerID($costumerID) {
        $this->costumerID = $costumerID;
    }
    function getCostumerID() {
        return $this->costumerID;
    }
    function setCampaignTeamID($campaignteamid) {
        $this->campaignteamID = $campaignteamid;
    }
    function getCampaignTeamID() {
        return $this->campaignteamID;
    }
    function setPriorityID($priorityid) {
        $this->priorityID = $priorityid;
    }
    function getPriorityID() {
        return $this->priorityID;
    }
    //END of Getter/Setter
    //DB functions
    function DB_insertCampaign() {

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