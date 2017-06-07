CREATE DATABASE MARKETINGCOMPANY;

USE MARKETINGCOMPANY;


CREATE TABLE Campaignteam (
	campaignteamID INT AUTO_INCREMENT
    ,campaignteamname VARCHAR (50)
    ,PRIMARY KEY (campaignteamID)
    ); 
	    
    
CREATE TABLE Costumer (
	costumerID INT AUTO_INCREMENT
    ,companyname VARCHAR (50)
    ,chiefname VARCHAR (50)
    ,chiefnumber VARCHAR (80)
    , PRIMARY KEY (costumerID)
    );
    

CREATE TABLE Venue (
	venueID INT AUTO_INCREMENT
    ,venuename VARCHAR (50)
    ,maxPersons INTEGER
    , PRIMARY KEY (venueID)
    );
    
    
CREATE TABLE Priority (
	priorityID INT AUTO_INCREMENT
    , prioritycolour VARCHAR (50)
    , PRIMARY KEY (priorityID)
	);


CREATE TABLE Persons (
	 personsID INT AUTO_INCREMENT 
    ,nname VARCHAR (50)
    ,vname VARCHAR (50)
    ,personsgender CHAR (1) NOT NULL
    ,campaignteamID INT
    ,FOREIGN KEY (campaignteamID) REFERENCES Campaignteam (campaignteamID)
    ,PRIMARY KEY (personsID)
    );


CREATE TABLE Campaign (
	campaignID INT AUTO_INCREMENT
    ,campaignName VARCHAR (50)
    ,dateofbegin DATE
    ,dateofend DATE
    ,costumerID INT NOT NULL
    ,campaignteamID INT NOT NULL
    ,priorityID INT NOT NULL
    ,FOREIGN KEY (costumerID) REFERENCES Costumer (costumerID)
    ,FOREIGN KEY (campaignteamID) REFERENCES Campaignteam (campaignteamID)
    ,FOREIGN KEY (priorityID) REFERENCES Priority (priorityID)
	,PRIMARY KEY (campaignID)
	);
    
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
	

   

CREATE USER 'Johnny'@'localhost' IDENTIFIED BY 'ibimsadatenbank';
GRANT ALL PRIVILEGES ON * . * TO 'Johnny'@'localhost';
CREATE USER 'Kevin'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON * . * TO 'Kevin'@'localhost';
CREATE USER 'Tino'@'localhost' IDENTIFIED BY 'okeausdemsenegal';
GRANT ALL PRIVILEGES ON * . * TO 'Tino'@'localhost';
CREATE USER 'Michael'@'localhost' IDENTIFIED BY 'grussundsonne';
GRANT ALL PRIVILEGES ON * . * TO 'Michael'@'localhost';

FLUSH PRIVILEGES; 