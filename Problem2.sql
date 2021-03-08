/*
Problem 2 solution
Script to create the schema and tables
and then selects all employees full name and address

Tested on MySQL Workbench
 */

DROP SCHEMA IF EXISTS `KarlsTestSchema` ;
CREATE SCHEMA IF NOT EXISTS `KarlsTestSchema` DEFAULT CHARACTER SET utf8mb4 ;
USE `KarlsTestSchema` ;

CREATE TABLE IF NOT EXISTS Employees (
	employeeID int AUTO_INCREMENT,
    firstName varchar(50),
    lastName varchar(50),
    PRIMARY KEY(employeeID)
);

CREATE TABLE IF NOT EXISTS Provinces (
	provinceID int,
    province varchar(2),
    PRIMARY KEY(provinceID)
);

CREATE TABLE IF NOT EXISTS Addresses (
	addressID int AUTO_INCREMENT,
    employeeID int,
    address varchar(50),
    city varchar(50),
    provinceID int,
    postalCode varchar(6),
    movedInDate DATE,
    PRIMARY KEY(addressID),
    FOREIGN KEY (employeeID) REFERENCES Employees(employeeID),
    FOREIGN KEY (provinceID) REFERENCES Provinces(provinceID)
);

INSERT INTO Employees (firstName, lastName)
VALUES ("Karl", "Rezansoff");
INSERT INTO Employees (firstName, lastName)
VALUES ("John", "Rezansoff");

INSERT INTO Provinces (provinceID, province)
VALUES (1, "AB");
INSERT INTO Provinces (provinceID, province)
VALUES (2, "BC");

INSERT INTO Addresses (employeeID, address, city, provinceID, postalCode, movedInDate)
VALUES (1, "5656 Victoria Dr", "Vancouver", 2, "v5p3w4", STR_TO_DATE('1-01-2020', '%d-%m-%Y'));
INSERT INTO Addresses (employeeID, address, city, provinceID, postalCode, movedInDate)
VALUES (2, "1862 Western Way", "Grand Forks", 2, "v0h1h4", STR_TO_DATE('1-01-2020', '%d-%m-%Y'));


SELECT concat(Employees.firstName, ' ', Employees.lastName) AS 'Full Name',
concat(Addresses.address, ' ', Addresses.city, ' ', Provinces.province, ' ', Addresses.postalCode) AS Address
FROM Employees
JOIN Addresses ON Employees.employeeID=Addresses.employeeID
JOIN Provinces ON Addresses.provinceID=Provinces.provinceID;



