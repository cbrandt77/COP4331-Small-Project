CREATE DATABASE COP4331;
USE COP4331;
create table Users
(
    ID               int auto_increment primary key,
    DateCreated      datetime    default CURRENT_TIMESTAMP not null,
    DateLastLoggedIn datetime    default CURRENT_TIMESTAMP not null,
    FirstName        varchar(50) default ''                not null,
    LastName         varchar(50) default ''                not null,
    Login            varchar(50) default ''                not null,
    Password         varchar(50) default ''                not null
);

INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (1, '2024-09-01 01:18:37', '2024-09-01 01:18:37', 'Rick', 'Leinecker', 'RickL', 'COP4331');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (2, '2024-09-01 01:18:38', '2024-09-01 01:18:38', 'Sam', 'Hill', 'SamH', 'Test');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (3, '2024-09-01 01:18:38', '2024-09-01 01:18:38', 'Rick', 'Leinecker', 'RickL',
        '5832a71366768098cceb7095efb774f2');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (4, '2024-09-01 01:18:38', '2024-09-01 01:18:38', 'Sam', 'Hill', 'SamH', '0cbc6611f5540bd0809a388dc95a615b');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (5, '2024-09-01 19:52:57', '2024-09-01 19:52:57', 'caleb', 'brandt', 'cbuser', 'cbpass');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (6, '2024-09-01 20:00:17', '2024-09-01 20:00:17', 'f', 'd', 'ff', 'ff');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (7, '2024-09-01 20:01:21', '2024-09-01 20:01:21', 'f', 'd', 'ff', 'ff');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (8, '2024-09-01 20:01:42', '2024-09-01 20:01:42', 'f', 'd', 'ff', 'ff');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (9, '2024-09-01 20:02:36', '2024-09-01 20:02:36', 'f', 'd', 'ff', 'ff');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (10, '2024-09-01 20:03:09', '2024-09-01 20:03:09', 'f', 'd', 'ff', 'ff');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (11, '2024-09-01 20:29:32', '2024-09-01 20:29:32', 'caleb', 'brandt', 'cbuser1', 'password');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (12, '2024-09-01 20:41:25', '2024-09-01 20:41:25', 'Caleb', 'Brandt', 'calebuser', 'calebpassword');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (13, '2024-09-01 22:07:21', '2024-09-01 22:07:21', 'Gavin', 'Mortensen', 'GavinM', 'gavinpass');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (14, '2024-09-01 22:34:17', '2024-09-01 22:34:17', 'Manas', 'Korada', 'ManasK', 'mpass');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (15, '2024-09-01 23:25:11', '2024-09-01 23:25:11', 'Justin', 'Wu', 'JustinW', 'basscod');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (16, '2024-09-02 01:25:56', '2024-09-02 01:25:56', 'Roman', 'Rosario', 'RomanR', 'wordpass');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (17, '2024-09-02 03:17:29', '2024-09-02 03:17:29', 'Maya', 'Eusebio', 'MayaE', 'welovecop4331');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (18, '2024-09-05 17:09:32', '2024-09-05 17:09:32', '(My First Name)', '(My Last Name)', '(A Username for Login)',
        '(A Password of my choice)');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (19, '2024-09-05 18:14:59', '2024-09-05 18:14:59', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (20, '2024-09-05 18:16:45', '2024-09-05 18:16:45', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (21, '2024-09-05 18:18:50', '2024-09-05 18:18:50', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (22, '2024-09-05 18:20:34', '2024-09-05 18:20:34', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (23, '2024-09-05 18:21:03', '2024-09-05 18:21:03', 'fred', 'duckington', 'fredD', 'secret');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (24, '2024-09-05 18:24:22', '2024-09-05 18:24:22', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (25, '2024-09-05 18:26:56', '2024-09-05 18:26:56', 'fred', 'duckington', 'fredD', 'secret');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (26, '2024-09-05 20:55:49', '2024-09-05 20:55:49', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (27, '2024-09-05 20:57:46', '2024-09-05 20:57:46', 'Maya', 'Eusebio', 'wawa', 'wawa');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (28, '2024-09-05 21:20:01', '2024-09-05 21:20:01', 'Jerry', 'Lewis', 'LewisJ', 'JerryLew');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (29, '2024-09-05 22:38:00', '2024-09-05 22:38:00', 'Larry', 'David', 'DavidL', 'LarryD');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (30, '2024-09-12 19:58:25', '2024-09-12 19:58:25', 'x', 'y', 'f', 'z');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (31, '2024-09-12 20:22:30', '2024-09-12 20:22:30', 'Test', 'Test', 'Test', 'Test');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (32, '2024-09-12 20:22:36', '2024-09-12 20:22:36', 'Test', 'Test', 'Test', 'Test');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (33, '2024-09-12 20:24:33', '2024-09-12 20:24:33', 'Po', 'Ta', 'Toe', 'ok');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (34, '2024-09-12 20:25:20', '2024-09-12 20:25:20', 'x', 'y', 'f', 'z');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (35, '2024-09-12 20:35:20', '2024-09-12 20:35:20', 'x', 'y', 'x', 'f');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (36, '2024-09-12 20:36:24', '2024-09-12 20:36:24', 'Rob', 'Bob', 'Sob', 'Knob');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (37, '2024-09-12 20:37:00', '2024-09-12 20:37:00', 'x', 'y', 'f', 'x');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (38, '2024-09-12 21:17:52', '2024-09-12 21:17:52', 'K', 'K', 'K', 'K');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (39, '2024-09-12 21:17:56', '2024-09-12 21:17:56', 'K', 'K', 'K', 'K');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (40, '2024-09-12 21:19:15', '2024-09-12 21:19:15', 'Jack', 'Re', 'Thing', 'thing');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (41, '2024-09-12 21:19:31', '2024-09-12 21:19:31', 'Jack', 'Re', 'Thing', 'thing');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (42, '2024-09-12 21:19:57', '2024-09-12 21:19:57', 'Jack', 'Re', 'Thing', 'thing');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (43, '2024-09-12 21:20:00', '2024-09-12 21:20:00', 'Jack', 'Re', 'Thing', 'thing');
INSERT INTO COP4331.Users (ID, DateCreated, DateLastLoggedIn, FirstName, LastName, Login, Password)
VALUES (44, '2024-09-15 22:54:32', '2024-09-15 22:54:32', 'Bob', 'Hope', 'bobhope', 'hopebob');

create table Contacts
(
    ID     int auto_increment primary key,
    Name   varchar(50) default '' not null,
    Phone  varchar(50) default '' not null,
    Email  varchar(50) default '' not null,
    UserID int         default 0  not null,
    foreign key (UserID) references Users(ID)
);

INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Poppy Lee', '5342731894', 'poppyleedm@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Steve Austin', '7490385748', 'steveaustin@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Steve Austin', '7490385748', 'steveaustin@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Steve Austin', '7490385748', 'steveaustin@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Jerry', '6147392754', 'Seiny@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Barry Allen', '6147392754', 'barryall@gmail.com', 14);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('Barry Allen', '6147392754', 'barryall@gmail.com', 15);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('cypher', '8888888888', 'cypher@hotmail.com', 17);
INSERT INTO COP4331.Contacts (Name, Phone, Email, UserID) VALUES ('maya', '9999999999', 'wawa@trymail.com', 17);

CREATE USER 'TheBest'@'%' IDENTIFIED BY 'WeLoveCOP4331';
GRANT ALL ON COP4331.* TO 'TheBest'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;