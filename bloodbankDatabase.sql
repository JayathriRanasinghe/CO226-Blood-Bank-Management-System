CREATE DATABASE bloodbankTest;

CREATE TABLE `donor_account` (
	`donor_id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `donor_fname` VARCHAR(40) NOT NULL,
    `donor_lname` VARCHAR(40) NOT NULL,
    `donor_nic` VARCHAR(20) NOT NULL,
    `gender` ENUM('male', 'female') NOT NULL,
    `birthday` DATE NOT NULL,
    `address` VARCHAR(150) NOT NULL,
    `district` ENUM('ampara','') NOT NULL,
    `blood_group` VARCHAR(5) NOT NULL,
    `password` VARCHAR(20) NOT NULL,
    `email` VARCHAR(40) NOT NULL);
    
CREATE TABLE `donor_prerequisites` (
	`donor_id` INT PRIMARY KEY,
    `age` INT NOT NULL,
    `weight` FLOAT NOT NULL,
    `last_donated_date` DATE,
    `medical_condition` VARCHAR(200),
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));

CREATE TABLE `online_donation` (
	`donor_id` INT PRIMARY KEY,
    `blood_bank_id` INT NOT NULL,
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));

CREATE TABLE `blood` (
	`blood_bag_id` INT NOT NULL PRIMARY KEY,
    `blood group` VARCHAR(5) NOT NULL,
    `donor_id` INT,
    `blood_bank_id` INT NOT NULL,
    `test_status` BOOLEAN,
    FOREIGN KEY(donor_id) REFERENCES online_donation(donor_id),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));
    
CREATE TABLE `blood_bank` (
	`blood_bank_id` INT NOT NULL PRIMARY KEY,
    `chief_mo_nic` INT NOT NULL, #normal nic or someother id number
    `area_code` INT NOT NULL,
    `blood_availability` INT );#???
    
CREATE TABLE `blood_stock` (
	`blood_bag_id` INT PRIMARY KEY,
    `blood_bank_id` INT,
    `blood_group` VARCHAR(5),
    FOREIGN KEY(blood_bag_id) REFERENCES blood(blood_bag_id),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));
    
CREATE TABLE `admin` (
	`admin_id` INT PRIMARY KEY NOT NULL,
    `blood_bank_id` INT,
    `name` VARCHAR(40),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));

CREATE TABLE `organization` (
	`organizer_name` VARCHAR(50) NOT NULL,
    `contact_number` INT(10) NOT NULL,
    `address` VARCHAR(100) NOT NULL,
    `blood_bank_id` INT,
    `estimated_blood_units` INT,
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));
    
delimiter //
CREATE TRIGGER `test_result_entered`
AFTER INSERT
ON blood FOR EACH ROW
BEGIN
	IF (NEW.test_status = 1) THEN
		INSERT INTO blood_stock(blood_bag_id,blood_bank_id,blood_group)
		VALUES(NEW.blood_bag_id,blood_bank_id,blood_group);
	END IF;
END //
delimiter ;
    

#hospital scene eka therenne nane,
/*
CREATE TABLE `hospital` (
	`contact_number` INT(10) PRIMARY KEY NOT NULL,
    `hospital_name` VARCHAR(20),
    `blood_bank_id` INT,


*/
    
    
    

#for deriving the age from bday    
#FROM_DAYS(DATEDIFF(now(),donor_account.birthday))
    
