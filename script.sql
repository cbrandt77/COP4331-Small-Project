create database COP4331;
CREATE TABLE `COP4331`.`Contacts`
(
    `ID` INT UNIQUE AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `FirstName` VARCHAR(50) NOT NULL DEFAULT '',
    `LastName` VARCHAR(50) NOT NULL DEFAULT '',
    `Login` VARCHAR(50) NOT NULL,
    `Password` VARCHAR(50) NOT NULL
);

INSERT INTO COP4331.Contacts VALUE (null, 'Caleb', 'Brandt', 'cb', 'cbpassword');