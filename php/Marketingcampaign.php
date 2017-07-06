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
        $sql = "INSERT INTO Campaign VALUES (".$this->getCampaignID().",'".$this->getCampaignName()."','".$this->getTeamname()."','".$this->getDateofbegin()."','".$this->getDateofend()."',
        ".$this->getCostumerID().",".$this->getPriorityID().");";

        if(($this->DB_executeSQLstatement($sql)) === false) {
            echo "ERROR: Campaign could not be inserted. (in DB_insertCampaign())";
        }
    }

    function DB_deleteCampaign() {
        $sql = "DELETE FROM Campaign WHERE campaignID=".$this->getCampaignID().";";

        if(($this->DB_executeSQLstatement($sql))===false) {
            echo "ERROR: Campaign could not be deleted. (in DB_deleteCampaign())";
        }
    }

    function DB_updateCampaign() { /*Works, tested, but unused*/
        $sql = "UPDATE Campaign SET campaignID=".$this->getCampaignID().",
        campaignName='".$this->getCampaignName()."', dateofbegin='".$this->getDateofbegin()."', 
        dateofend='".$this->getDateofend()."', costumerID=".$this->getCostumerID().",
        teamname='".$this->getTeamname()."', priorityID=".$this->getPriorityID().";";

        if(($this->DB_executeSQLstatement($sql))===false) {
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

        //Load current user
        $curr_user = new Employee();
        $username_tmp = "";
        if (isset($_COOKIE['Username']) || isset($_POST['Username'])) {
            if (!isset($_COOKIE['Username']) && isset($_POST['Username'])) {
                $username_tmp = $_POST['Username'];
            } else if (isset($_COOKIE['Username']) && !isset($_POST['Username'])) {
                $username_tmp = $_COOKIE['Username'];
            }
        } else {
            echo "WARNING: Please refresh site. Could not find cookie or post-var! (in DB_showAllCampaigns())";
        }
        $curr_user = $curr_user->loadUser_from_DB($username_tmp);

        $lastrow = 0;

        if($result->num_rows <= 0) {
            echo "<h3>Keine Campagnen vorhanden.<p>&nbsp;</p></h3>";
            if($curr_user->isAdmin()) {
                echo "<table class='campaigns'>";
                //Generiere Überschriften
                echo "<tr><th>ID</th><th>Kampagnenname</th><th>Team(-name)</th>
                <th>Start</th><th>Ende</th><th>Kunde</th><th>Priorität</th>";
            } //Wenn kein Admin sind keine Textfelder, dann sollen auch keine Headings sein

        } else {
            //Kampagnen vorhanden
            echo "<table class='campaigns'>";
            //Generiere Überschriften
            echo "<tr><th>ID</th><th>Kampagnenname</th><th>Team(-name)</th>
            <th>Start</th><th>Ende</th><th>Kunde</th><th>Priorität</th>";

            if ($curr_user->isAdmin()) {
                echo "<th colspan='2'>Optionen</th></tr>";
            }

            while ($row = mysqli_fetch_array($result)) {
                echo "<form name='form_campaign_row' action='".$_SERVER['PHP_SELF']."' method='post'>";
                echo "<tr><td>".$row['campaignID']."</td>
                <td>".$row['campaignName']."</td><td>".$row['teamname']."</td>
                <td>".$row['dateofbegin']."</td><td>".$row['dateofend']."</td>
                <td>".$row['companyname']."</td><td style='background-color: " .$row['hexcode']. ";'>&nbsp;</td>";
                if($curr_user->isAdmin()) {
                    echo "<td><edit</td><td><input type='submit' name='delete_campaign' value='Delete'/></td>"; //TODO: als formular nicht mit ajax wenn möglich
                }
                echo "<input type='hidden' name='campaignID' value='".$row['campaignID']."'/>";

                //Notice: Diese Felder wären für ein Update der Kampagnen hilfreich gewesen, wurde aus Zeitgründen aber weggelassen, da ein Update-Statement schon in der Profile.php vorhanden ist.
                /*<input type='hidden' name='campaignName' value='".$row['campaignName']."'/>
                <input type='hidden' name='teamname' value='".$row['teamname']."'/>
                <input type='hidden' name='dateofbegin' value='".$row['dateofbegin']."'/>
                <input type='hidden' name='dateofend' value='".$row['dateofend']."'/>
                <input type='hidden' name='costumerID' value='".$row['costumerID']."'/>
                <input type='hidden' name='priorityID' value='".$row['priorityID']."'/>";*/

                echo "</tr></form>";
                $lastrow = $row['campaignID'];
            }
            }
        //Prüfe ob Admin
        if ($curr_user->isAdmin()) {
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' name='new_campaign' method='post'>";
            echo "<tr><td><input type='text' name='campaignID' value='" . ($lastrow + 1) . "' readonly/></td>
                    <td><input type='text' name='campaignName'/></td><td><input type='text' name='teamname'/></td>
                    <td><input type='date' name='dateofbegin'/></td><td><input type='date' name='dateofend'/></td>
                    <td><input type='number' name='companyID' placeholder='Type in companyID not name!'/></td>
                    <td><input type='number' name='priorityID' placeholder='Type in priorityID not name!'/></td>
                    <td><input type='submit' value='Save' name='saveNewCampaign'/></td><td><input type='reset' value='Reset'/></td></tr>";
            echo "</form>";

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