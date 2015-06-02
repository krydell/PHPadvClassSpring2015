CREATE TABLE Login
(username varchar(30) NOT NULL,
password varchar(100),
pets int,
points int);




CREATE TABLE Pets
(pet_id int NOT NULL,
pet_name varchar(30),
species varchar(20),
happy int,
hungry int,
owner varchar(30));