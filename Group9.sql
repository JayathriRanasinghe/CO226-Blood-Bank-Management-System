/*
BLOOD BANK MANAGEMENT SYSTEM

GROUP 09: 
		E/18/030 ATHTHANAYAKA A.M.S.
		E/18/282 RANASINGHE R.A.N.S.
        E/18/283 RANASINGHE R.D.J.M.
*/

-- creating the database
CREATE DATABASE BLOODBANK;
-- accesss the created database
USE BLOODBANK;

-- create a table to store blood bank details
CREATE TABLE blood_bank (
	blood_bank_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    chief_mo_nic VARCHAR(20) NOT NULL,
    district VARCHAR(20) NOT NULL); 

ALTER TABLE blood_bank AUTO_INCREMENT=1000;

-- insert data into the blood bank table
INSERT INTO blood_bank (chief_mo_nic, district)
VALUES ("8342222261", "Kalutara"),
("7252222261", "Colombo"),
("7112855200", "Ragama"),
("7352222261", "Kegalle" ),
("6812222261", "Kandy"),
("6112849525", "Maharagama"), 
("7662222445", "Matale" ),
("7372229617", "Kurunegala"), 
("6912226066", "Karapitiya" ),
("8332222261", "Gampaha" ),
("9382232261", "Panadura" ),
("5812388001", "Peradeniya"), 
("6632222261", "Ampara"),
("8472222061", "Hambanthota"), 
("6212222261", "Jaffna");

-- create table to store the admin details of each blood bank
CREATE TABLE admin (
    blood_bank_id INT PRIMARY KEY,
    name VARCHAR(40),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));

-- insert data to the admin table
INSERT INTO admin(blood_bank_id, name)
VALUES(1000, "Thurusha Perera"),
(1001, "Namal Weerasinhe"),
(1002, "Chithra Perera"),
(1003, "Ananda Somaratne"),
(1004, "Hemal Perera"),
(1005, "Sunil Abeweera"),
(1006, "Lahiru Samaraweera"),
(1007, "Anula Ranathunga"),
(1008, "Peter Dias"),
(1009, "Nimal Weerasinhe"),
(1010, "Keerthi Silva"),
(1011, "Anil Perera"),
(1012, "Palitha Karunaratna"),
(1013, "Chamara Silva"),
(1014, "Nimali Weerasiri");

-- create table to store donor details
-- Donors can register themselves to the system by making donor accounts
CREATE TABLE donor_account (
	donor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donor_fname VARCHAR(40) NOT NULL,
    donor_lname VARCHAR(40) NOT NULL,
   donor_nic VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    birthday DATE NOT NULL,
    address VARCHAR(150) NOT NULL,
    district VARCHAR(15) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    password VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL);

-- create a table to store the donor's prerewuisites
-- If a donor needs to donate blood, they have to provide some prerequisits
CREATE TABLE donor_prerequisites (
	donor_id INT PRIMARY KEY,
    age INT NOT NULL,
    weight FLOAT NOT NULL,
    last_donated_date DATE,
    medical_condition VARCHAR(200),
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));

-- A donor who fulfils the preriquisites can book a time to donate blood
-- Booking times of online donations are starting at 8.00 am in each blood bank
CREATE TABLE online_donation ( 
	donation_id INT AUTO_INCREMENT PRIMARY KEY,
	donor_id INT NOT NULL,
    blood_bank_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));


-- insert data into the donor accont table
INSERT INTO donor_account (donor_fname, donor_lname, donor_nic , gender, 
birthday, address, district, blood_group, password ,email)
VALUES("Janani","Abesekara","993541514V","female","1999-06-14","No.36 Sri Ramanathan Road, Colombo 13","Colombo","A+","1234janani#","jananiAb@gmail.com"),
("Saduni","Perera","198245156545","female","1982-10-22","No.201, Shanthi Villa,Silkhouse Street","Kandy","O-","sP65894&*","saduni5151@gmail.com"),
("Vidura","Wikramasinghe","895454875V","male","1989-05-05","No.10/C, Samagi Road,Narammala","Kurunagala","B-","vidura1989","viduraW@gmail.com"),
("Gayan","Madhushan","694122454V","male","1969-12-17","No.15/A/C,2nd Avenue,Aththanagalla","Gampaha","B+","69124#*GM","gayan2568madu@gmail.com"),
("Mahesh","Perera","196287933265","male","1962-03-25","No.45/2,Dutugamunu road,Thissapura","Ampara","O+","mahesh$Pe","maheshperera@gmail.com"),
("Semini","Madhusika","726935478V","female","1972-11-15","No.5/BC,C.W.W.Kannangara Road,Waththegama","Matale","A-","4546semini@","semini1115@gmail.com"),
("Ravindra","Gunarathna","934687198V","male","1993-09-19","No.151/2,Tangalle Road,Ambalantota","Hambanthota","B+","RG1234?&","ravindragun@gmail.com"),
("Pushpa","Erathna","684796321V","female""male","1968-04-23","No.12/8,Isuru Uyana,Ballapitiya","Kaluthara","AB+","pushpa?123P","pushpa23@gmail.com"),
("Anjalee","Wikramasinghe","886974321V","female","1988-12-25","No.48/M,Gothami Road,Imaduwa","Galle","O+","881225anj#","anjwickama@gmail.com"),
("Pushpika","Wijethunga","634795639V","female","1963-07-13","No.92, Stanley Thilakarathne Mawatha,Nugegoda","Colombo","B-","713push&?","pushpika132@gmail.com"),
("Gamini","Kumara","199348789666","male","1993-10-18","No.10/3,Water Supply area,Rathmalgahawewa","Anuradhapura","A+","gaminiK78","gamini1018@gmail.com"),
("Indrasiri","Liyanage","851239746V","male","1985-02-26","No.538/2,Marble beach side,Mawadichchenai","Tricomalee","AB-","9310indra$","indrasiri@gmail.com"),
("Peshala","De Silva","641587963V","male","1964-01-30","No.B21,Yatigaloluwa","Nuwara Eliya","A-","pesh64?*","dgpeshala2@gmail.com"),
("Ashan","Rathnasekara","741257963V","male","1974-02-17","No.70-3/F,Church road,Karandeniya","Puththalama","B-","23Ashan#$","ashan4565@gmail.com"),
("Kushani","Withanage","821547698V","female","1982-06-20","No.12 Dematagoda Place,Colombo 09","Colombo","O+","0620kushani@","kushaniWith@gmail.com");

-- insert data to the donor_prerequisites table
INSERT INTO donor_prerequisites (donor_id, age, weight, last_donated_date, medical_condition)
VALUES(1, 25, 55, "2010-02-09", "no any significant illness"),
(2, 24, 65, NULL, "no any significant illness"),
(3, 40, 61, "2010-12-09", "no any significant illness"),
(4, 23, 65, NULL, "no any significant illness"),
(5, 35, 59, "2016-08-03", "no any significant illness"),
(7, 45, 63, "2009-04-01", "currently no any significant illness. Has gone through a hernia surgery 2 years ago."),
(8, 43, 55, "2012-02-03", "no any significant illness"),
(9, 26, 50, "2018-04-23", "no any significant illness"),
(10, 50, 70, "2007-10-09", "no any significant illness"),
(11, 44, 60, "2014-01-30", "no any significant illness"),
(13, 28, 58, "2017-05-09", "no any significant illness"),
(15, 30, 68, "2015-09-25", "recovered from covid-19 3 months ago");

-- insert data to the online_donation table
INSERT INTO online_donation(donor_id,blood_bank_id,date,time)
VALUES(1,1004,"2022-02-18","08:00:00"),
(2,1001,"2022-03-01","08:00:00"),
(3,1000,"2022-03-03","13:00:00"),
(4,1001,"2022-03-07","10:00:00"),
(5,1010,"2022-03-09","08:00:00"),
(7,1002,"2022-03-14","08:00:00"),
(8,1009,"2022-03-16","10:00:00"),
(9,1004,"2022-03-21","13:00:00"),
(10,1001,"2022-03-23","10:00:00"),
(11,1001,"2022-03-28","08:00:00"),
(13,1002,"2022-04-04","08:00:00");


-- The blood table contains details about donated blood bags
CREATE TABLE blood (
	blood_bag_id INT NOT NULL PRIMARY KEY,
    blood_group VARCHAR(5) NOT NULL,
    donor_id INT,
    blood_bank_id INT NOT NULL,
    test_status BOOLEAN,
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));
    
-- When the donor_id and bloobag_id is given, the following procedure will insert the data to the necessary columns in the blood table.
DELIMITER //
CREATE PROCEDURE FillBloodTable(bloodbagID INTEGER, donor INTEGER)
BEGIN
INSERT INTO blood(blood_bag_id, blood_group, donor_id, blood_bank_id, test_status) values
(bloodbagID, (SELECT blood_group FROM donor_account WHERE donor_id=donor), donor, (SELECT blood_bank_id FROM online_donation WHERE donor_id=donor), NULL);
END //
DELIMITER ;

-- create a table to store the blood stock details in all the blood banks
CREATE TABLE blood_stock (
	blood_bag_id INT PRIMARY KEY,
    blood_bank_id INT,
    blood_group VARCHAR(5),
     FOREIGN KEY(blood_bag_id) REFERENCES blood(blood_bag_id),
     FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));

 -- When the blood bags are sent to the blood banks, they will be tested. 
 -- Only the blood bags which pass the tests will be sent to the blood stocks.
 -- This trigger will automatically fill the blood stock table once the test status is updated inthe blood table.
delimiter //
CREATE TRIGGER test_result_entered
AFTER UPDATE
ON blood FOR EACH ROW
BEGIN
	IF (NEW.test_status = 1) THEN
		INSERT INTO blood_stock(blood_bag_id,blood_bank_id,blood_group)
		VALUES(NEW.blood_bag_id,NEW.blood_bank_id,NEW.blood_group);
	END IF;
END //
delimiter ;  

-- call the procedure to fill the blood table
call FillBloodTable(10023, 1);
call FillBloodTable(10024, 2);
call FillBloodTable(10025, 3);
call FillBloodTable(10026, 4);
call FillBloodTable(10030, 5);
call FillBloodTable(10031, 7);
call FillBloodTable(10032, 8);
call FillBloodTable(10033, 9);
call FillBloodTable(10034, 10);
call FillBloodTable(10035, 11);
call FillBloodTable(10036, 13);

-- update the test_status in the blood table as 1 for several blood bags
update blood set test_status=1 where blood_bag_id in (10023, 10024, 110025, 10026, 10031,10032,10033, 10035, 10036);


-- table to store the details of the organizations which hold donation camps
CREATE TABLE organization (
	organizer_name VARCHAR(50) NOT NULL,
    contact_number VARCHAR(10) NOT NULL,
    address VARCHAR(100) NOT NULL,
    blood_bank_id INT,
    estimated_blood_units INT,
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));

-- hospitals can seek blood from the blood banks.
-- create a table to store the seeker details
CREATE TABLE hospital (
	contact_number VARCHAR(10) PRIMARY KEY NOT NULL,
    hospital_name VARCHAR(20),
    blood_bank_id INT,
    blood_group VARCHAR(10),
    amount INT,
    recepient_nic VARCHAR(20),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));
    
    
-- insert data to the hospital(seekers) table
INSERT INTO hospital(blood_bank_id, hospital_name, contact_number, recepient_nic, amount, blood_group)
VALUES (1004, "Cancer Institute - Maharagama", "011285025253", "5912345322v", 1, "O+"),
(1001, "Castle Street Hospital for Women", "011269623132", "5512300322v", 1, "A+"),
(1010, "Central Hospital (Pvt) Ltd", "0114665500", "5212389320v", 1, "O+"),
(1002, "Chest Hospital - Ragama", "0112958271", "4512785332v", 1, "O-"),
(1001, "Colombo (North) - Ragama", "0112959261","7894235635v", 1, "B+"),
(1001, "Colombo (South) - Kalubowila", "0112763065", "6912345334v", 1, "O+"),
(1001, "Colombo General Hospital (National)", "0112691111", "7912245732v", 1, "B-"),
(1009, "Gampaha - General", "0332222261", "8672625312v", 1, "A-"),                     
(1009, "Hemas Hospital", "0117888888", "5935341022v", 1, "A+"),
(1014, "Jaffna Teaching Hospital", "0212222261", "4812435300v", 1, "O+"),
(1000, "Kalutara - General", "034222226162", "7312378312v", 1, "A+"),
(1004, "Kandy Teaching Hospital", "0812233337", "6712312300v", 1, "O+"),
(1008, "Karapitiya Teaching Hospital", "0912232267", "5112024527v", 1, "B+"),
(1007, "Kurunegala Teaching Hospital", "0372222262", "5912383452v", 1, "B-"),
(1001, "Lady Ridgeway Hospital", "011269371112", "8774165356v", 1, "A+");

-- -- insert data to the organization table
INSERT INTO organization(organizer_name,contact_number,address,blood_bank_id,estimated_blood_units)
VALUES ("Sri Lanka Red Cross","0112691095","106, Dharmapala Mawatha,Colombo 07",1001,10),
("Association of Accounting Technicians","0112559670","No. 540, Ven. Muruththettuwe Ananda Nahimi Mw, Narahenpita, Colombo 05",1001,13),
("Public utilities commission","0112392607","6th Floor, St Michaels Rd, Colombo",1007,20),
("CSD welfare society","0112554797","23, Station Road, Bambalapitiya, Colombo 04",1002,25),
("First friend campus","0777230033","21,Sri Math Kuda Rathwatte Mawatha,Kandy",1004,15),
("Janasarana foundation","0114578263","Ward Place,Colombo 07",1001,12),
("Celinco life","025-2234886","Anuradhapura Branch 5 54, Dharmapala Mawatha, Anuradhapura",1001,18),
("DIMO Lanka","0112449797","No:65,Jethawana Road,Colombo 14",1007,22),
("Sri lankan troops","0572227165","Army camp,Diyathalawa",1008,20),
("Sumathi holdings","0112352352"," 491 Galle Rd, Colombo",1004,24),
("Cleanco","0113010374","No 111/D, Ja-ela Road, Akarawita, Gampaha",1009,11),
("SLCG","0112457786","Ministry of defence,Wellawattha",1001,31),
("Brandix","0114786497","No 503/1, Rev. Muruththettuwe Ananda Nahimi Mawatha, Thimbirigasyaya Road, Narahenpita, Colombo 5",1008,12),
("Muslim Aid","0112076160","22-2 Sirimal Mawatha, Dehiwala-Mount Lavinia",1001,23),
("Asia capital PLC","0115320000","No 102, Bauddhaloka Mawatha, Colombo ",1000,16);

-- Test 123
--asdfsafsadf