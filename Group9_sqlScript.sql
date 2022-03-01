/* BLOOD BANK MANAGEMENT SYSTEM - Database development script with sample data

GROUP 09: 
		E/18/030 ATHTHANAYAKA A.M.S.
		E/18/282 RANASINGHE R.A.N.S.
        E/18/283 RANASINGHE R.D.J.M.

Note:

 * A donor can make donor accounts whenever he likes.
   But if he wants to donate blood, he has to fill the prerequisite table. 
 * Once the request_status of the prerequisite table is updated to 1 by the blood bank admin, donor will be given 
   a date and time to donate blood as shown in the online_donation table.
 * The request_status of the organization and hospital tables are also updated to 1 by the blood bank admins, once they have checked the request.
 * Since the blood_stock table is an auto updating table, we have given a trigger to insert data into it.
 * A procedure is given to fill the blood table when blood_bag_id and the donor_id is given. This will reduce entering of same data again and again.

*/

-- drop if there is an existing table
DROP DATABASE IF EXISTS BLOODBANK;

-- creating the database
CREATE DATABASE BLOODBANK;

-- accesss the created database
USE BLOODBANK;

-- create a table to store blood bank details
CREATE TABLE blood_bank (
	blood_bank_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    blood_bank_name VARCHAR(100) NOT NULL,
    blood_bank_address VARCHAR(100) NOT NULL,
    district VARCHAR(20) NOT NULL,
    contact_number CHAR(10),
    chief_mo_nic VARCHAR(12)); 

ALTER TABLE blood_bank AUTO_INCREMENT=1000;

-- insert data into the blood bank table
INSERT INTO blood_bank (blood_bank_name, blood_bank_address, district, contact_number, chief_mo_nic)
VALUES ("BMT Sri Lanka", "National Blood Transfusion Services, Elvitigala Mawatha, Colombo 00500", "Colombo", "0112789654", "698622606v"),
("NHSL Blood Bank", "Kynsey Rd, Colombo 00700", "Colombo", "0112369931", "711285520v"),
("Central Blood Bank Narahenpita", "555 Elvitigala Mawatha, Colombo 00500", "Colombo", "0112789931", "725222261v"),
("Blood Bank-CNTH", "Hospital Inner Road, Ragama 11010", "Gampaha", "0112960535", "735222261v"),
("Blood Bank- Teaching Hospital-Kalubowila", "De Silva Rd, Dehiwala-Mount Lavinia", "Colombo", "0112763262", "681222226v"),
("Blood Bank- Blood donation center in Negombo", "6R6X+QGG, Negombo", "Gampaha", "0332222261", "611284955v"),
("Regional Blood Center - Maharagama", "RWQ9+39J, Boralesgamuwa 10280", "Colombo", "0112849525", "766222445v"),
("Blood bank-Teaching Hospital-Peradeniya", "7H8W+FM4, Kandy", "Kandy", "0812222231", "737222961v"),
("Blood bank-General Hospital-Kandy", "Teaching Hospital, William Gopallawa Mawatha, Kandy", "Kandy", "0812233337", "637222961v"),
("Regional Blood Centre-General Hospital-Nagoda", "HX7P+3J7, Kalutara", "Kalutara", "034226529", "977330234v"),
("National Blood Bank - Badulla", "Blood Bank, Daya Gunasekara Mawatha, Badulla", "Badulla", "0552222124", "691222606v"),
("Blood bank Matara", "AH 43, Matara", "Matara", "0412227232", "833222261v"),
("Blood Bank Udugama", "Udugama Base Hospital,Udugama, South", "Galle", "0914640650", "738223226v"),
("Blood bank- Tanniyutttu", "B296, Tanniyutttu", "Trincomalee", "0212061412", NULL),
("Blood Bank-Dehiattakandiya", "Blood Bank, Base Hospital, Dehiattakandiya", "Ampara", "0632222261", "663222226v"),
("Regional Blood Centre - Teaching Hospital Kurunegala", "F9H5+4Q2, Kurunegala", "Kurunegala", "0372229617", "621899022v"),
("Regional Blood Centre -Jaffna", " Victoria Rd, Jaffna", "Jaffna", "0212223096", NULL),
("Blood Bank - Teaching Hospital Karapitiya", "Hiribura Cross Rd, Karapitiya", "Galle", "0917222961", "661739022v"),
("Blood Bank UHKDU", "University Hospital KDU, Boralesgamuwa", "Colombo", "0710245678", "581230800v"),
("Blood Bank - General Hospital Gampaha", "General Hospital, Colombo Rd, Gampaha", "Gampaha", "0332289007", "725292226v");


-- create table to store the admin details of each blood bank
CREATE TABLE admin (
    blood_bank_id INT PRIMARY KEY,
    name VARCHAR(40),
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));


-- insert data to the admin table
INSERT INTO admin(blood_bank_id, name)
VALUES(1000, "P.M. Thurusha Perera"),
(1001, "W.M. Namal Weerasinhe"),
(1002, "Chithra Perera"),
(1003, "S.A. Ananda Somaratne"),
(1004, "P.A. Hemal Perera"),
(1005, "W.E.R. Sunil Abeweera"),
(1006, "S.A.D. Lahiru Samaraweera"),
(1007, "R.A.D.H. Anula Ranathunga"),
(1008, "Peter Dias"),
(1009, "W.A. Nimal Weerasinhe"),
(1010, "S.M.T. Keerthi Silva"),
(1011, "P.M. Anil Perera"),
(1012, "K.A. Palitha Karunaratna"),
(1013, "Chamara Silva"),
(1014, "H.F. Haleem"),
(1015, "W.A. Kumara Weeramuni"),
(1016, "O.P. Shamila Ovitigala"),
(1017, "K.P. Selwanayagam"),
(1018, "T.G.H. Sunil Tilakasiri"),
(1019, "K.M.C. Weerasinghe");


-- create table to store donor details
-- Donors can register themselves to the system by making donor accounts
CREATE TABLE donor_account (
	donor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    donor_fname VARCHAR(40) NOT NULL,
    donor_lname VARCHAR(40) NOT NULL,
    donor_nic VARCHAR(12) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    birthday DATE NOT NULL,
    address VARCHAR(150) NOT NULL,
    district VARCHAR(20) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    password VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL);


-- create a table to store the donor's prerequisites
-- If a donor needs to donate blood, they have to provide some prerequisits
CREATE TABLE donor_prerequisites (
    blood_bank_name VARCHAR(100), 
	donor_id INT PRIMARY KEY,
    age INT NOT NULL,
    weight FLOAT NOT NULL,
    last_donated_date DATE,
    medical_condition VARCHAR(200),
    request_status BOOLEAN,
    FOREIGN KEY(donor_id) REFERENCES donor_account(donor_id));


-- A donor who fulfils the preriquisites can book a time to donate blood
-- Booking times of online donations are starting at 8.00 am in each blood bank
CREATE TABLE online_donation ( 
	donation_id INT AUTO_INCREMENT PRIMARY KEY,
	donor_id INT NOT NULL,
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
("Pushpa","Erathna","684796321V","female","1968-04-23","No.12/8,Isuru Uyana,Ballapitiya","Kaluthara","AB+","pushpa?123P","pushpa23@gmail.com"),
("Anjalee","Wikramasinghe","886974321V","female","1988-12-25","No.48/M,Gothami Road,Imaduwa","Galle","O+","881225anj#","anjwickama@gmail.com"),
("Pushpika","Wijethunga","634795639V","female","1963-07-13","No.92, Stanley Thilakarathne Mawatha,Nugegoda","Colombo","B-","713push&?","pushpika132@gmail.com"),
("Gamini","Kumara","199348789666","male","1993-10-18","No.10/3,Water Supply area,Rathmalgahawewa","Anuradhapura","A+","gaminiK78","gamini1018@gmail.com"),
("Indrasiri","Liyanage","851239746V","male","1985-02-26","No.538/2,Marble beach side,Mawadichchenai","Tricomalee","AB-","9310indra$","indrasiri@gmail.com"),
("Peshala","De Silva","641587963V","male","1964-01-30","No.B21,Yatigaloluwa","Nuwara Eliya","A-","pesh64?*","dgpeshala2@gmail.com"),
("Ashan","Rathnasekara","741257963V","male","1974-02-17","No.70-3/F,Church road,Karandeniya","Puththalama","B-","23Ashan#$","ashan4565@gmail.com"),
("Kushani","Withanage","821547698V","female","1982-06-20","No.12 Dematagoda Place,Colombo 09","Colombo","O+","0620kushani@","kushaniWith@gmail.com"),
("Dahami","Rathnayake","525972698V","female","1952-02-23","No.45/123,samagi road,Welipana","Kaluthara","A+","dahami1234","dahami52@gmail.com"),
("Nuwan","Palipana","198496731236","male","1984-10-18","No.36/C pannala road,kuliyapitiya","Kurunegala","B+","48#nuwa@","nuwanp@gmail.com"),
("Fathima","Mohomed","698743695V","female","1969-04-05","No.9/78,Abhayagiri area,Meegaswewa","Polonnaruwa","AB+","jkifath67","fathima698@gmail.com"),
("Dilhani","Wimalasekara","786234981V","female","1978-12-26","No.10/1A,Botanical Garden road,Batugammana","Badulla","O+","kkgdil90?","dilhani78@gmail.com"),
("Kusum","Madagoda","926974131V","female","1992-09-09","No.51/L, New town,Aswedduma","Rathnapura","B-","6869kusum","madagodaku@gmail.com"),
("Minoli","Perera","988793326v","female","1998-03-25","No.45,Uduwala road,Udugama","Galle","O+","mino123","mioliperera@gmail.com"),
("Sethmini","Ampitiya","721238478V","female","1972-03-15","No.62, Kothlawala Road, Colombo 2","Colombo","A-","sethmini72","sethminiam@gmail.com"),
("Kushan","Winayaraja","198245156321","male","1982-10-03","No.205, Shanthi Rd, Jaffna","Jaffna","O-","winayakush","kushan@gmail.com"),
("Vidusara","Wikramasiri","795454875V","male","1979-05-05","No.87, Samagi Road, Ibbagamuwa","Kurunagala","B-","vidusara79","vidusara_wick@gmail.com"),
("Gayani","Ranathunga","612269454V","female","1961-10-17","No.15/A/C,Temple Rd,Aththanagalla","Gampaha","A+","123*@gaya","gayani123@gmail.com"),
("Ashani","Dias","841257963V","female","1994-12-17","No.70-3,Church road, Rajagiriya","Colombo","B-","asha@dias","ashani84@gmail.com");


-- insert data to the donor_prerequisites table
INSERT INTO donor_prerequisites (blood_bank_name, donor_id, age, weight, last_donated_date, medical_condition)
VALUES("Central Blood Bank Narahenpita",1, 23, 55, NULL, "no any significant illness"),
("Blood bank-General Hospital-Kandy",2, 30, 65, "2010-09-12", "no any significant illness"),
("Regional Blood Centre - Teaching Hospital Kurunegala",3, 33, 61, "2015-12-09", "no any significant illness"),
("Blood Bank- Blood donation center in Negombo",4, 53, 65, "2007-08-20", "no any significant illness"),
("Blood Bank-Dehiattakandiya",5, 50, 59, "2016-08-03", "no any significant illness"),
("Blood bank Matara",7, 29, 53, "2009-04-01", "no any significant illness"),
("Regional Blood Centre-General Hospital-Nagoda",8, 34, 55, "2012-02-03", "no any significant illness"),
("Blood Bank - Teaching Hospital Karapitiya",9, 34, 50, "2018-04-23", "no any significant illness"),
("BMT Sri Lanka",10, 59, 70, "2007-10-09", "no any significant illness"),
("Blood bank- Tanniyutttu",11, 29, 60, "2018-01-30", "no any significant illness"),
("Blood bank-General Hospital-Kandy",13, 58, 58, "2017-05-09", "no any significant illness"),
("Blood Bank UHKDU",15, 30, 68, "2015-09-25", "recovered from covid-19 3 months ago"),
("Regional Blood Centre - Teaching Hospital Kurunegala",17, 38, 68, "2017-05-09", "no any significant illness"),
("Blood Bank-Dehiattakandiya",18, 53, 49, "2015-05-23", "done heart surgery 2 years ago"),
("National Blood Bank - Badulla",19, 44, 50, "2017-05-09", "no any significant illness"),
("Blood Bank - Teaching Hospital Karapitiya",21, 22, 55, NULL, "no any significant illness"),
("Regional Blood Center - Maharagama",22, 50, 67, "2009-05-09", "no any significant illness"),
("Regional Blood Centre -Jaffna",23, 40, 64, "2014-07-29", "no any significant illness"),
("Regional Blood Centre - Teaching Hospital Kurunegala",24, 43, 62, "2010-05-09", "currently no any significant illness. Has gone through a hernia surgery 2 years ago."),
("Blood Bank - General Hospital Gampaha",25, 61, 59, "2016-07-01", "no any significant illness"),
("Blood Bank- Teaching Hospital-Kalubowila",26, 28, 59, NULL, "no any significant illness");


-- insert data to the online_donation table
INSERT INTO online_donation(donor_id,date,time)
VALUES(1,"2022-02-18","08:00:00"),
(2,"2022-03-01","08:00:00"),
(3,"2022-03-03","13:00:00"),
(4,"2022-03-07","10:00:00"),
(5,"2022-03-09","08:00:00"),
(7,"2022-03-09","08:00:00"),
(8,"2022-03-16","10:00:00"),
(9,"2022-03-21","13:00:00"),
(10,"2022-03-23","10:00:00"),
(11,"2022-03-28","08:00:00"),
(13,"2022-04-04","08:00:00"),
(15,"2022-03-28","08:00:00"),
(17,"2022-04-02","08:00:00"),
(18,"2022-04-03","08:00:00"),
(19,"2022-04-03","10:00:00"),
(21,"2022-04-05","08:00:00"),
(22,"2022-04-05","10:00:00"),
(23,"2022-04-20","08:00:00"),
(24,"2022-05-10","08:00:00"),
(25,"2022-05-10","10:00:00"),
(26,"2022-05-12","08:00:00");


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
(bloodbagID, (SELECT blood_group FROM donor_account WHERE donor_id=donor), donor, (SELECT blood_bank_id FROM blood_bank WHERE blood_bank_name = (SELECT blood_bank_name FROM donor_prerequisites WHERE donor_id=donor)), NULL);
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
call FillBloodTable(10037, 15);
call FillBloodTable(10038, 17);
call FillBloodTable(10039, 18);
call FillBloodTable(10042, 19);
call FillBloodTable(10043, 21);
call FillBloodTable(10044, 22);
call FillBloodTable(10045, 23);
call FillBloodTable(10046, 24);
call FillBloodTable(10050, 25);
call FillBloodTable(10051, 26);


 -- update the test_status in the blood table as 1 for several blood bags
 -- then the blood_stock table will auto updated using the trigger test_result_entered
update blood set test_status=1 where blood_bag_id 
    in (10023, 10024, 10025, 10026, 10031, 10032, 10033, 10034, 10035, 10036, 10037, 10038, 10039, 10042, 10043, 10044, 10045, 10046, 10050, 10051);


-- table to store the details of the organizations which hold donation camps
CREATE TABLE organization (
    donationcamp_id int AUTO_INCREMENT PRIMARY KEY,
	organization_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    address VARCHAR(100) NOT NULL,
    blood_bank_id INT,
    estimated_blood_units INT,
    request_status BOOLEAN,
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));


-- hospitals can seek blood from the blood banks.
-- create a table to store the seeker details
CREATE TABLE hospital (
	contact_number VARCHAR(15) PRIMARY KEY NOT NULL,
    hospital_name VARCHAR(100),
    blood_bank_id INT,
    blood_group VARCHAR(10),
    amount INT,
    recepient_nic VARCHAR(12),
    request_status BOOLEAN, 
    FOREIGN KEY(blood_bank_id) REFERENCES blood_bank(blood_bank_id));
    
    
-- insert data to the hospital(seekers) table
INSERT INTO hospital(blood_bank_id, hospital_name, contact_number, recepient_nic, amount, blood_group)
VALUES (1006, "Cancer Institute - Maharagama", "0112850252", "591234532v", 1, "O+"),
(1001, "Castle Street Hospital for Women", "0112696231", "551230032v", 1, "A+"),
(1000, "Central Hospital (Pvt) Ltd, Colombo", "0114665500", "521239320v", 1, "O+"),
(1003, "Chest Hospital - Ragama", "0112958271", "451278532v", 1, "O-"),
(1003, "Colombo (North) - Ragama", "0112959261","789423635v", 1, "B+"),
(1004, "Colombo (South) - Kalubowila", "0112763065", "691235334v", 1, "O+"),
(1000, "Colombo General Hospital (National)", "0112691111", "791225732v", 1, "B-"),
(1019, "Gampaha - General", "0332222261", "867262512v", 1, "AB-"),                     
(1019, "Hemas Hospital, Kadawatha", "0117888888", "593531022v", 1, "A+"),
(1016, "Jaffna Teaching Hospital", "0212222261", "481243530v", 1, "O+"),
(1009, "Kalutara - General", "0342226162", "731238312v", 1, "A+"),
(1008, "Kandy Teaching Hospital", "0812233337", "671231300v", 1, "O+"),
(1017, "Karapitiya Teaching Hospital", "0912232267", "512024527v", 1, "B+"),
(1015, "Kurunegala Teaching Hospital", "0372222262", "591238452v", 1, "B-"),
(1001, "Lady Ridgeway Hospital", "0112693712", "874165356v", 1, "A+"),
(1015, "Base Hospital Kuliyapitiya", "0378195421", "523456781v", 1, "O-"),
(1016, "District General Hospital, Vavuniya", "0242892262", "791236745v", 1, "B-"),
(1014, "District General Hospital, Ampara", "0632222290", "841238345v", 1, "A-"),
(1008, "Asiri Hospital Kandy", "0814267262", "1999123452", 1, "B+"),
(1003, "Leesons Hospital, Ragama", "0112892262", "811238334v", 1, "AB+");


-- -- insert data to the organization table
INSERT INTO organization(organization_name,contact_number,address,blood_bank_id,estimated_blood_units)
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
("Asia capital PLC","0115320000","No 102, Bauddhaloka Mawatha, Colombo ",1000,16),
("Rotary Club","0773209218","26, Retreat Road, Colombo 4",1002,30),
("Lions Club of Colombo"," 0777590971","B231, Colombo",1003,25),
("Faculty of Enigineering UOP","0812393300","University of Peradeniya, Prof. E. O. E. Pereira Mawatha, Kandy",1004,30),
("Rotaract Club UOP","0774672331","Rotaract Club of University of Peradeniya, B364",1004,26),
("LOLC Insurance","0115500880","481 T. B. Jayah Mawatha, Colombo 01000",1008,40);


-- updating some rows in prerequisite table - update the request_status to 1 when the blood bank admin has checked the particular request
update donor_prerequisites set request_status = 1 WHERE donor_id in (1, 2, 3, 10, 11, 13, 15, 25, 26);


-- updating some rows in hospital table - update the request_status to 1 when the blood bank admin has checked the particular request
update hospital set request_status = 1 WHERE contact_number in ("0112850252", "0112696231", "0114665500");


-- updating some rows in organization table - update the request_status to 1 when the blood bank admin has checked the particular request
update organization set request_status = 1 WHERE donationcamp_id in (1,2,3,4,5,6,7,8,9,10);
