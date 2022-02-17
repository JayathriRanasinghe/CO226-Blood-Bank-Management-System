#necessary queries

CREATE DATABASE bloodbankTest2;
USE bloodbankTest2;
DROP DATABASE bloodbankTest2;

DESCRIBE donor_account;
SELECT * FROM donor_account;
TRUNCATE TABLE blood;

SHOW TRIGGERS;
DROP TRIGGER test_result_entered;

SELECT * FROM blood_bank;

INSERT INTO donor_account(donor_fname,donor_lname,donor_nic,gender,birthday,address,district,blood_group,password,email) 
VALUES ('Madhushi','Perera','986700945V','female','1998-06-28','no:12/8,Isuru Uyana,Ballapitiya','kalutara','A+','madhu?123P','madhushiP@gmail.com');

INSERT INTO blood_bank(blood_bank_id, chief_mo_nic,area_code,blood_availability) VALUES (000,123456789,111,2);

INSERT INTO online_donation(donor_id,blood_bank_id,date,time) VALUES (1,111,'2022-02-18','00:00:00');

INSERT INTO blood(blood_bag_id,blood_group,donor_id,blood_bank_id,test_status) VALUES(3,'A+',1,0,1);


#E:\4_sem_4\CO226_database systems\project_bloodBank
describe blood;
TRUNCATE table blood;
select * from blood_bank;
drop database bloodbankTest2;

/* this qurey is for entering data through excel file. but could not enter the data due to a permission error
LOAD DATA LOCAL INFILE "E:/4_sem_4/CO226_database systems/project_bloodBank/Book1.csv" INTO TABLE bbTEST.donor_account
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(donor_id, donor_fname, donor_lname,donor_nic,gender,birthday,address,district,blood_group,password,email);

*/





SELECT * FROM area;
SELECT * FROM donor_account;
SHOW TRIGGERS;
truncate area;

DROP TABLE donor_account;
DROP TABLE blood;
CREATE TABLE `area`(
	`donor_id` INT NOT NULL PRIMARY KEY,
    `area_code` INT NOT NULL
    );
    
describe donor_account;
describe area;