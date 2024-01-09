CREATE DATABASE studentdatabase;
CREATE TABLE studentdata_kn

(
    id int not null auto_increment unique,
    firstname_kn varchar(100),
    lastname_kn varchar(100),
    studentid_kn varchar(100),
    yearofstudy_kn smallint,
    birthplace_kn varchar(100),
    primary key (id)
);
INSERT INTO studentdata_kn(id, firstname_kn,lastname_kn,studentid_kn,yearofstudy_kn,birthplace_kn)
VALUES
(1,"Nishan","Mukhopadhyay","60850",1,"India"),
(2,"Inji","Budiman","65430",2,"Azerbaijian"),
(3,"Piotr","Zaremba","68892",1,"Lublin"),
(4,"Revas","Kardamonis","56798",1,"Berlin"),
(5,"Sapna","Sharma","54787",2,"India"),
(6,"King","Ruther","65478",1,"Delhi")

ALTER TABLE studentdata_kn ADD UNIQUE (studentid_kn);

CREATE TABLE parents_kn
(
    id int not null auto_increment unique,
    parentsname_kn varchar(100),
    parentsage_kn varchar(100),
    occupation_kn varchar(100),
    primary key (id)
);