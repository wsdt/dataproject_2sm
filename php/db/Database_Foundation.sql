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


CREATE TABLE Campaign (
	campaignID INT NOT NULL AUTO_INCREMENT
    ,campaignName VARCHAR (50)
    ,teamname VARCHAR (50)
    ,dateofbegin DATE
    ,dateofend DATE
    ,costumerID INT NOT NULL
    ,priorityID INT NOT NULL
    ,FOREIGN KEY (costumerID) REFERENCES Costumer (costumerID)
    ,FOREIGN KEY (priorityID) REFERENCES Priority (priorityID)
	,PRIMARY KEY (campaignID)
    ,UNIQUE(teamname)
	);


SELECT campaignID, campaignName, teamname, dateofbegin,
dateofend, companyname, hexcode FROM

CREATE TABLE News (
	newsID INT NOT NULL AUTO_INCREMENT
	,title VARCHAR (50)
	,newstext VARCHAR (500)
    ,PRIMARY KEY (newsID)
    );


/*Test für Kampagnenabfrage*/
/*INSERT INTO Campaign VALUES
('Test','testteam','15.05.2017','20.05.2017',1,1);*/

/* Es gibt nur diese 3 Prioritäten, daher ist es sinnvoller diese direkt in die Datenbank einzubinden */

INSERT INTO Priority VALUES
	(1,'red','#ff0000'),
    (2,'yellow','#ffff00'),
    (3,'green','#00ff00');


/*Wir haben 3 Update Insert Delete und Read Beispiele, aus Zeitgründen füllten wir die Kunden
einsweilen mittels Insert auf, das die Marketingfirma bereits mit der Website arbeiten kann
wärendessen wir dieFeinheiten noch programmieren */

INSERT INTO Costumer VALUES
(1,'Company1','Chef1','1548452'),
(2,'Company2','Chef2','1546565'),
(3,'Company3','Chef3','6565655'),
(4,'Company4','Chef4','8941132'),
(5,'Company5','Chef5','9876512'),
(6,'Company6','Chef6','8455665');

/* EMPLOYEES: Registration is only possible by the IT-department (nevertheless we implemented a registration field with
db-connection in our web-project. In our example all following accounts are admins. */

    /*TODO: FOREIGN KEY DERWEIL LEER GELASSEN*/
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

