CREATE DATABASE MARKETINGCOMPANY;
/*DROP DATABASE MARKETINGCOMPANY;*/
USE MARKETINGCOMPANY;


CREATE TABLE Campaignteam (
	campaignteamID INT AUTO_INCREMENT
    ,teamname VARCHAR (50)
    ,PRIMARY KEY (campaignteamID)
    ); 

INSERT INTO Campaignteam VALUES
(1,''Team1''),
(2,''Team2''),
(3,''Team3''),
(4,''Team4''),
(5,''Team5''),
(6,''Team6'');


CREATE TABLE Costumer (
	costumerID INT AUTO_INCREMENT
    ,companyname VARCHAR (50)
    ,chiefname VARCHAR (50)
    ,chiefnumber VARCHAR (80)
    , PRIMARY KEY (costumerID)
    );

/* INSERT INTO standard costumers */
/*
AUTO INCREMENT SHOULD ALSO WORK
INSERT INTO Costumer VALUES
(''Company1'',''Chef1'',''1548452''),
(''Company2'',''Chef2'',''1546565''),
(''Company3'',''Chef3'',''6565655''),
(''Company4'',''Chef4'',''8941132''),
(''Company5'',''Chef5'',''9876512''),
(''Company6'',''Chef6'',''8455665'');*/
INSERT INTO Costumer VALUES
(1,''Company1'',''Chef1'',''1548452''),
(2,''Company2'',''Chef2'',''1546565''),
(3,''Company3'',''Chef3'',''6565655''),
(4,''Company4'',''Chef4'',''8941132''),
(5,''Company5'',''Chef5'',''9876512''),
(6,''Company6'',''Chef6'',''8455665'');

CREATE TABLE Venue (
	venueID INT AUTO_INCREMENT
    ,venuename VARCHAR (50)
    ,country VARCHAR (50)
    ,adress VARCHAR (50)
    ,maxPersons INTEGER
    , PRIMARY KEY (venueID)
    );


CREATE TABLE Priority (
	priorityID INT AUTO_INCREMENT
    , prioritycolour VARCHAR (50)
    , hexcode VARCHAR (50)
    , PRIMARY KEY (priorityID)
	);

/* INSERT Standard priorities */
/*INSERT INTO Priority VALUES
	(1,''red'',''#ff0000''),
    (2,''yellow'',''#ffff00''),
    (3,''green'',''#00ff00'');*/
INSERT INTO Priority VALUES /*AUTO_Increment oben*/
	(''red'',''#ff0000''),
    (''yellow'',''#ffff00''),
    (''green'',''#00ff00'');


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
	campaignID INT AUTO_INCREMENT
    ,campaignName VARCHAR (50)
    ,dateofbegin DATE
    ,dateofend DATE
    ,costumerID INT NOT NULL
    ,campaignteamID INT
    ,priorityID INT NOT NULL
    ,FOREIGN KEY (costumerID) REFERENCES Costumer (costumerID)
    ,FOREIGN KEY (campaignteamID) REFERENCES Campaignteam (campaignteamID)
    ,FOREIGN KEY (priorityID) REFERENCES Priority (priorityID)
	,PRIMARY KEY (campaignID)
	);

    INSERT INTO Campaign VALUES ('Test','15.05.2017',
    '20.05.2017',1,1,1)

CREATE TABLE Eventplanning (
	eventplanningID INT AUTO_INCREMENT
    ,eventname VARCHAR (50)
    ,beginofevent DATE
    ,endofevent DATE
    ,campaignID INT NOT NULL
    ,venueID INT
    ,priorityID INT NOT NULL
    ,FOREIGN KEY (campaignID) REFERENCES Campaign (campaignID)
    ,FOREIGN KEY (venueID) REFERENCES Venue (venueID)
    ,FOREIGN KEY (priorityID) REFERENCES Priority (priorityID)
    ,PRIMARY KEY (eventplanningID)
    );


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