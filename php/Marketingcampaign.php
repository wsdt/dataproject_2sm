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
    function DB_executeSQLstatement($sql) {
        $this->establishDBConnection();
        $result = mysqli_query($tunnel, $sql);
        $this->closeDBConnection($tunnel);
        return $result;
    }

    function DB_insertCampaign() {
        $sql = "INSERT INTO Campaign VALUES (".$this->getCampaignID().",'".$this->getCampaignName()."','".$this->getDateofbegin()."','".$this->getDateofend()."',
        ".$this->getCostumerID().",".$this->getCampaignTeamID().",".$this->getPriorityID().");";

        if(!($this->DB_executeSQLstatement($sql))) {
            echo "ERROR: Campaign could not be inserted. (in DB_insertCampaign())";
        }
    }

    function DB_deleteCampaign() {
        $sql = "DELETE FROM Campaign WHERE campaignID=".$this->getCampaignID().";";

        if(!($this->DB_executeSQLstatement($sql))) {
            echo "ERROR: Campaign could not be deleted. (in DB_deleteCampaign())";
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