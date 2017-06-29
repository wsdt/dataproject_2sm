<?php

class Employee
{
//Definition der Eigenschaften name, email und password
    private $username;
    private $password;
    private $isAdmin=false; //Standardmaeßig false außer explizit über Setter gesetzt

    //Konstruktor
    function __construct1($username, $password, $password_verify, $saveToDatabase) //Wenn saveToDatabase = true, dann wird DB_addUser() ausgeführt
    {
        if (!(
            $this->setUsername($username) ||
            $this->setPassword($password, $password_verify))) {
            $this->__destruct();
            echo "ERROR: User konnte nicht erstellt werden! (Employee.php, Class Error)";
            return false;
        } else {
            if ($saveToDatabase) {
                $this->DB_addUser(); //Adde User in der Datenbank
            }
            return true;
        }
    }

    //Konstruktor
    function __construct2($username, $hash, $saveToDatabase)
    {
        if (!(
            $this->setUsername($username) ||
            $this->setPasswordHash($hash))
        ) {
            $this->__destruct();
            echo "ERROR: User konnte nicht erstellt werden! (Employee.php, Class Error)";
            return false;
        } else {
            if ($saveToDatabase) {
                $this->DB_addUser();
            }
            return true;
        }
    }

    function __destruct()
    { //Delete User in PHP-Code
        $this->username = null;
        $this->password = null;
        $this->isAdmin = null;
    }

//DB-Operationen
    function loadUser_from_DB($username) // = BENUTZERPROFIL aus Datenbank laden
    {
        require 'db/dbNewConnection.php';
        $sql = "SELECT * FROM Employee WHERE Username = '".$username."';";
        $user = mysqli_query($tunnel, $sql);
        if (empty($user)) {
            $this->closeDBConnection($tunnel);
            return false; //Say that user was not found
        } else {
            $tmp_user = new Employee();

            while ($tmp = mysqli_fetch_array($user)) {
                $tmp_user->setUsername($tmp['Username']);
                $tmp_user->setPasswordHash($tmp['Passwort']);
                /*if ($tmp['isAdmin'] == true) {
                    $tmp_user->makeAdmin();
                }*/
            }
            $this->closeDBConnection($tunnel); //use static method from Highscore.php
            return $tmp_user; //Gib User zurück für den übergebener Username passt, wenn keiner existiert wird false zurückgegeben
        }
    }

    function DB_addUser()
    {
        if ($this->isUsernameAvailable()) {
            require 'db/dbNewConnection.php';
            $sql = "INSERT INTO Users (username, passwort) VALUES ('" . $this->getUsername() . "', '" . $this->getPasswordHash() . "');";
            $result = mysqli_query($tunnel, $sql);

            $this->closeDBConnection($tunnel);

            if (!$result) {
                echo "DB ERROR: User konnte nicht in die Datenbank übertragen werden! [in DB_addUser()]";
                return false;
            } else {
                return true;
            }
        } else {
            echo "DB ERROR: Username bereits vorhanden! Bitte wählen Sie einen anderen!";
            return false;
        }
    }

    function DB_deleteUser()
    { //works, tested
        require 'db/dbNewConnection.php';
        $sql_hc = "DELETE FROM Highscore WHERE Username='".$this->getUsername()."';"; //Lösche auch Highscore-Eintrag
        $sql_us = "DELETE FROM Users WHERE Username='".$this->getUsername()."';";
        $result = mysqli_query($tunnel, $sql_hc);
        $result2 = mysqli_query($tunnel, $sql_us);
        if (!$result || !$result2) {
            echo "DB ERROR: User konnte in der Datenbank nicht gelöscht werden! [in DB_deleteUser()]";
        }

        $this->closeDBConnection($tunnel);
    }


    function isUsernameAvailable()
    {
        require "db/dbNewConnection.php"; //Nicht require_once da sonst evtl. nur einmal für diese Datei aufgerufen

        $control = 0;
        $sql = "SELECT username FROM Users WHERE username = '" . $this->username . "'";
        $result = mysqli_query($tunnel, $sql) or die("DB ERROR: Verbindung konnte nicht hergestellt werden! [in isUsernameAvailable()]");
        while ($row = mysqli_fetch_object($result)) {
            $control++;
        }

        $this->closeDBConnection($tunnel); //Schließe Datenbankverbindung

        //Username wird überprüft, ob bereits vorhanden, dann wird true zurückgegeben wenn keiner vorhanden war
        if ($control != 0) {
            return false;
        } else {
            return true;
        }

    }

    function closeDBConnection($tunnel) //Tunnel = DB Verbindung/Instanz übergeben
    {
        if (!mysqli_close($tunnel)) {
            echo "FATAL_ERROR: Datenbank-Verbindung konnte nicht geschlossen werden. [in isUsernameAvailable()]";
        }
    }

//Getter/Setter definieren
    function makeAdmin() {
        $this->isAdmin = true;
    }

    function isAdmin() { // = GETTER
        return $this->isAdmin;
    }

    function setUsername($username)
    {
        require 'db/dbNewConnection.php';
        if (empty($username) || $username == null || strlen($username) < 4) {
            $this->closeDBConnection($tunnel);
            return false;
        } else {
            $this->username = mysqli_real_escape_string($tunnel, strtoupper($username)); //Speichere Usernamen in Grossbuchstaben in die Datenbank
            $this->closeDBConnection($tunnel);
            return true;
        }
    }

    function getUsername()
    {
        return strtoupper($this->username);
    }

    function setPasswordHash($hash)
    {
        //Setze Passwort unverschlüsselt, da schon verschlüsselt in DB gespeichert wurde
        if (empty($hash)) {
            //Achtung, diese Funktion darf nur genutzt werden, wenn der übergebene Wert ein Hash ist!
            return false;
        } else {
            $this->password = $hash;
            return true;
        }
    }

    function setPassword($password, $password_verify)
    { //Passwort-Setzung nur mit Kontrolleingabe möglich
        //Verschlüssle Passwort
        if (empty($password) || empty($password_verify) || $password != $password_verify //0 kommt raus, wenn beide Strings gleich
            || strlen($password) < 4) {
            //nur $password auf Länge zu prüfen, da er bei Ungleichheit ohnehin hier reinspringt
            //Wenn ein Passwort leer, den Sicherheitsbestimmungen nicht entspricht oder beide Passwörter ungleich sind gib false zurück.
            //Hier keinen Dummy-Wert setzen, da sonst im Fehlerfall das Passwort überschrieben wird.
            return false;
        } else {
            require 'db/dbNewConnection.php';
            $this->password = password_hash(mysqli_real_escape_string($tunnel, $password), PASSWORD_BCRYPT);
            $this->closeDBConnection($tunnel);
            return true;
        }
    }

    function getPasswordHash()
    {
        //Übergib verschlüsseltes Passwort
        return substr($this->password,0,60);
    }

    function isPasswordValid($password_for_check)
    {
        //Prüfe ob Passwort ok
        return password_verify($password_for_check, $this->getPasswordHash());
    }
}


?>