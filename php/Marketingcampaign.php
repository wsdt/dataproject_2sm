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

    function __destruct()
    { //Delete Campaign in PHP-Code
        $this->campaignID = null;
        $this->campaignName = null;
        $this->dateofbegin = null;
        $this->dateofend = null;
        $this->costumerID = null;
        $this->teamname = null;
        $this->priorityID = null;
    }

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
        $tunnel = $this->establishDBConnection();
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
        $sql = "SELECT campaignID, campaignName, teamname, dateofbegin, dateofend, companyname, hexcode FROM Campaign as a
                INNER JOIN Priority as b
                ON b.priorityID = a.priorityID
                INNER JOIN Costumer as c
                ON c.costumerID = a.costumerID;";

        $result = $this->DB_executeSQLstatement($sql); //Result = Objekt

        if($result->num_rows <= 0) {
            echo "<h3>Keine Campagnen vorhanden.</h3>";
        } else {
            //Kampagnen vorhanden
            echo "<table class='campaigns'>";
            //Generiere Überschriften
            echo "<tr><th>ID</th><th>Kampagnenname</th><th>Team(-name)</th>
            <th>Start</th><th>Ende</th><th>Kunde</th><th>Priorität</th></tr>";

            $lastrow = 0;

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>".$row['campaignID']."</td>
                <td>".$row['campaignName']."</td><td>".$row['teamname']."</td>
                <td>".$row['dateofbegin']."</td><td>".$row['dateofend']."</td>
                <td>".$row['companyname']."</td><td style='background-color: " .$row['hexcode']. ";'>&nbsp;</td>";
                $lastrow = $row['campaignID'];
            }
            //TODO: if admin: start
            echo "<tr><td><input type='text' name='campaignID' value='".($lastrow+1)."' disabled/></td>
            <td><input type='text' name='campaignName'/></td><td><input type='text' name='teamname'/></td>
            <td><input type='date' name='dateofbegin'/></td><td><input type='date' name='dateofend'/></td>
            <td><input type='number' name='companyID' placeholder='Type in companyID not name!'/></td>
            <td><input type='number' name='priorityID' placeholder='Type in priorityID not name!'/></td></tr>";
            //TODO: if admin ende

            echo "</table>";
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