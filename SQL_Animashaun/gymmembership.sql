CREATE DATABASE gymmembersship;
--EXECUTE THIS COMMAND FIRST
--CLICK TO THE DATABASE AND CHOOSE EDIT BY SQL

--EXECUTE THIS AFTER
CREATE TABLE gym_member

(
    id int not null auto_increment unique,
    firstname varchar(100),
    lastname varchar(100),
    gym_member_id varchar(100),
    membership_duration smallint,
    membership_location varchar(100),
    primary key (id)
);

-- EXECUTE FROM CREATE TABLE UNTIL THE LAST SEMICOLON BELOW THE PRIMARY KEY


INSERT INTO gym_member(id, firstname,lastname,gym_member_id,membership_duration, membership_location)
VALUES
(1,"Ayomide","Animashaun","56833",6,"Warsaw"),
(2,"Kembang","Desa","55467",12,"Warsaw"),
(3,"Maciej","Skrolowsky","77777",8,"Lublin"),
(4,"Rudi","Ramawan","60072",9,"Lodz"),
(5,"Kunti","Bogel","54345",6,"Krakow"),
(6,"Tulsa","King","66666",9,"Krakow")

ALTER TABLE gym_member ADD UNIQUE (gym_member_id);