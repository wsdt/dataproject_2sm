/*
IMPORTANT: Achtung, wie gewünscht befinden sich unten an dieser Datei die verwendeten Select, Insert,...-Statements aus unseren Dateien.
Bitte führen Sie diese hier nicht direkt auf der Datenbank aus, da diese nur zur Veranschaulichung dienen und ohnehin so keinen Sinn machen.

Des Weiteren: Wir haben uns bei diesem Projekt mehr auf umfangreiche Funktionalitäten konzentriert (Objektorientierung, Admin-Rechte, etc.)
deshalb haben wir aufgrund der knappen Zeit die uns trotz regelmäßiger Arbeit durch die Finger geronnen ist, wenig Wert auf das äußere
Erscheinungsbild (CSS, etc.) gelegt. Ich hoffe Sie lassen derartige Faktoren nicht in die Noten einfließen.

*/


CREATE DATABASE MARKETINGCOMPANY;
/*DROP DATABASE MARKETINGCOMPANY;*/
USE MARKETINGCOMPANY;


CREATE TABLE Costumer (
	costumerID INT NOT NULL AUTO_INCREMENT
    ,companyname VARCHAR (50)
    ,chiefname VARCHAR (50)
    ,chiefnumber VARCHAR (80)
    , PRIMARY KEY (costumerID)
    );


CREATE TABLE Priority (
	priorityID INT NOT NULL AUTO_INCREMENT
    , prioritycolour VARCHAR (50)
    , hexcode VARCHAR (50)
    , PRIMARY KEY (priorityID)
	);


CREATE TABLE Employees (
	Username VARCHAR (50)
    ,Passwort VARCHAR(255)
    ,isAdmin BOOLEAN not null default 0
    ,UNIQUE (Username)
    ,PRIMARY KEY (Username)
    );


CREATE TABLE Profil  (
	 Username VARCHAR (50)
    ,nname VARCHAR (50)
    ,vname VARCHAR (50)
    ,kurzbeschreibung VARCHAR (500)
    ,persongender CHAR (1) NOT NULL
    ,FOREIGN KEY (Username) REFERENCES Employees (Username)
    ,PRIMARY KEY (Username)
    );

INSERT INTO Campaign VALUES ('15','12','1997-12-15','1999-12-12', 1,1);

CREATE TABLE Campaign (
	campaignID INT NOT NULL AUTO_INCREMENT
    ,campaignName VARCHAR (50)
    ,teamname VARCHAR (50)
    ,dateofbegin VARCHAR(10)
    ,dateofend VARCHAR(10)
    ,costumerID INT NOT NULL
    ,priorityID INT NOT NULL
    ,FOREIGN KEY (costumerID) REFERENCES Costumer (costumerID)
    ,FOREIGN KEY (priorityID) REFERENCES Priority (priorityID)
	,PRIMARY KEY (campaignID)
    ,UNIQUE(teamname)
	);




CREATE TABLE News (
	newsID INT NOT NULL AUTO_INCREMENT
	,title VARCHAR (50)
	,newstext VARCHAR (500)
    ,PRIMARY KEY (newsID)
    );


/* Es gibt nur diese 3 Prioritäten, daher ist es sinnvoller diese direkt in die Datenbank einzubinden */

INSERT INTO Priority VALUES
	(1,'red','#ff0000'),
    (2,'yellow','#ffff00'),
    (3,'green','#00ff00');


/*Wir haben 1 Update sowie jeweils 3 Insert Delete und Read Beispiele, aus Zeitgründen füllten wir die Kunden
einsweilen mittels Insert auf, das die Marketingfirma bereits mit der Website arbeiten kann
wärendessen wir die Feinheiten noch programmieren */

INSERT INTO Costumer VALUES
(1,'Company1','Chef1','1548452'),
(2,'Company2','Chef2','1546565'),
(3,'Company3','Chef3','6565655'),
(4,'Company4','Chef4','8941132'),
(5,'Company5','Chef5','9876512'),
(6,'Company6','Chef6','8455665');


/*SQL Statements aus unseren Dateien*/
/*Marketingcampaign.php (class): DB_showAllCampaigns(), Anzeigen der Marketingkampagnen*/
SELECT campaignID, campaignName, teamname, dateofbegin,
dateofend, companyname, hexcode FROM Campaign as a
INNER JOIN Priority as b
ON b.priorityID = a.priorityID
INNER JOIN Costumer as c
ON c.costumerID = a.costumerID
ORDER BY campaignID ASC;

/*EMPLOYEE.PHP (class): loadUser_from_DB() */
SELECT * FROM Employees WHERE Username = '[PHP VARIABLE]';

/*EMPLOYEE.PHP (class): DB_updateUser()*/
UPDATE Employees
	SET username='[PHP VAR]', Passwort='[PHP VAR]', isAdmin=0 /*Instead of 0 = [PHP VAR]*/
    WHERE username='[PHP VAR]';

/*EMPLOYEE.PHP (class): DB_addUser()*/
INSERT INTO Employees (Username, Passwort, isAdmin) VALUES ('[PHP VAR]', '[PHP VAR]', '[PHP VAR]');

/*EMPLOYEE.PHP (class) DB_deleteUser()*/
DELETE FROM Profil WHERE Username='[PHP VAR]';
DELETE FROM Employees WHERE Username='[PHP VAR]';

/*EMPLOYEE.PHP (class) isUsernameAvailable()*/
SELECT Username FROM Employees WHERE username = '[PHP VAR]';

/*functions.php deleteProfileData() */
DELETE FROM Profil WHERE Username='[PHP VAR]';

/*Marketingcampaign.php (class), DB_insertCampaign() */
INSERT INTO Campaign VALUES (1 /*instead of 1 [PHP VAR]*/,'[PHP VAR]','[PHP VAR]','[PHP VAR]','[PHP VAR]',
        1 /*Instead of 1 a [PHP VAR]*/,1 /*Instead of 1 a [PHP VAR]*/);

/*Marketingcampaign.php (class), DB_deleteCampaign()*/
DELETE FROM Campaign WHERE campaignID=1 /*Instead of 1 a [PHP VAR]*/;

/*Marketingcampaign.php (class), DB_updateCampaign()*/
UPDATE Campaign SET campaignID=1/*Instead of 1 a [PHP VAR]*/,
        campaignName='[PHP VAR]', dateofbegin='[PHP VAR]',
        dateofend='[PHP VAR]', costumerID=1/*Instead of 1 a [PHP VAR]*/,
        teamname='[PHP VAR]', priorityID=1/*Instead of 1 a [PHP VAR]*/;

/*News.php, inline*/
INSERT INTO News (title, newstext) VALUES ('[PHP VAR]','[PHP VAR]');

/*News.php, inline*/
SELECT * FROM News ORDER BY newsID DESC;

/*NewsClass.php (class), DB_deleteNews()*/
DELETE FROM News WHERE NewsID=1 /*Instead of 1 [PHP VAR]*/;

/*OLD SOLUTION FOR USER (everything worked, but we changed it)*/
/* EMPLOYEES: Registration is only possible by the IT-department (nevertheless we implemented a registration field with
db-connection in our web-project. In our example all following accounts are admins. */

/*
CREATE USER ''Johnny''@''localhost'' IDENTIFIED BY ''ibimsadatenbank'';
GRANT ALL PRIVILEGES ON * . * TO ''Johnny''@''localhost'';
CREATE USER ''Kevin''@''localhost'' IDENTIFIED BY ''123'';
GRANT ALL PRIVILEGES ON * . * TO ''Kevin''@''localhost'';
CREATE USER ''Tino''@''localhost'' IDENTIFIED BY ''okeausdemsenegal'';
GRANT ALL PRIVILEGES ON * . * TO ''Tino''@''localhost'';
CREATE USER ''Michael''@''localhost'' IDENTIFIED BY ''grussundsonne'';
GRANT ALL PRIVILEGES ON * . * TO ''Michael''@''localhost'';

FLUSH PRIVILEGES; */

