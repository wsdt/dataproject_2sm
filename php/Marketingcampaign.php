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
    private $teamname;
    private $priorityID;

    //GETTER/SETTER
    function setCampaignID($campaignID) {
        $this->campaignID = $campaignID;
    }
    function getCampaignID() {
        return $this->campaignID;
    }
    function setTeamname($teamname) {
        $this->teamname=$teamname;
    }
    function getTeamname() {
        return $this->teamname;
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
        $sql = "INSERT INTO Campaign VALUES ('".$this->getCampaignName()."','".$this->getTeamname()."','".$this->getDateofbegin()."','".$this->getDateofend()."',
        ".$this->getCostumerID().",".$this->getPriorityID().");";

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

    function DB_updateCampaign() {
        $sql = "UPDATE Campaign SET campaignID=".$this->getCampaignID().",
        campaignName='".$this->getCampaignName()."', dateofbegin='".$this->getDateofbegin()."', 
        dateofend='".$this->getDateofend()."', costumerID=".$this->getCostumerID().",
        teamname=".$this->getTeamname().", priorityID=".$this->getPriorityID().";";

        if(!($this->DB_executeSQLstatement($sql))) {
            echo "ERROR: Campaign could not be updated. (in DB_updateCampaign())";
        }
    }

    function DB_showAllCampaigns() {
        $sql = "SELECT campaignID, campaignName, dateofbegin, dateofend, "
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