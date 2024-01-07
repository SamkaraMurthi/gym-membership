CREATE DATABASE studentdatabase;
CREATE TABLE studentdata_nm

(
    id int not null auto_increment unique,
    firstname_nm varchar(100),
    lastname_nm varchar(100),
    studentid_nm varchar(100),
    yearofstudy_nm smallint,
    birthplace_nm varchar(100),
    primary key (id)
);
INSERT INTO studentdata_nm(id, firstname_nm,lastname_nm,studentid_nm,yearofstudy_nm,birthplace_nm)
VALUES
(1,"Nishan","Mukhopadhyay","60850",1,"India"),
(2,"Inji","Budiman","65430",2,"Azerbaijian"),
(3,"Piotr","Zaremba","68892",1,"Lublin"),
(4,"Revas","Kardamonis","56798",1,"Berlin"),
(5,"Sapna","Sharma","54787",2,"India"),
(6,"King","Ruther","65478",1,"Delhi")

ALTER TABLE studentdata_nm ADD UNIQUE (studentid_kn);

CREATE TABLE parents_nm
(
    id int not null auto_increment unique,
    parentsname_nm varchar(100),
    parentsage_nm varchar(100),
    occupation_nm varchar(100),
    primary key (id)
);