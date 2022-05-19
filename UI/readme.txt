UPDATE YOUR PAGE DETAILS


main.html - home page [not designed yet]

index.html - the direct links to the users


pages:
[JAYATHRI]

database connection ---------------------[database.php]

donor login -----------------------------[donor.html]
            getting username and password and direct it to the [profileCard2.php]
donor registration pages ----------------[donorRegister.html]
            getting all the necessary data form action directed to the [register_form.php]
            this file does not show anything to the user(unless an error occurs)
            again directed to [donor.html]
logged user page ------------------------[profileCard2.php]

booking a date prerequiristics ----------[donor_prereq.html]
            after data saving button clicked, directed to the [donor_prereq.php]
            <data_saved_message>
donor prerequiristics table <BB_side> ---[onlineDonorRequests.php]
            after accept button pressed [acceptRequest.php]
            after reject button pressed [rejectRequest.php]

[NETHMI]

hospital requests -----------------------------[hospitalReq.html]
            a page asking to fill the req form - click it
request form ----------------[seeker_hospitals.php]
            enter the data in the form
            blood availability part not included bcz it messes everything -_-
            click send request
            it will give a msg saying request sent to blood bank
admin page to accept hospital requests <BB_side> ------------------------[onlineHospitalRequests.php]
            after accept button pressed [acceptRequest.php]
            after reject button pressed [rejectRequest.php]
            accept part not done yet

blood availability ----------[bloodAvailability.php]

top navigator bar -------------------- [navigatorBar.php]
            this is the correct one
            if php file -> use php require command in a php file 
            if html file -> copy paste the code in html file (but the css file used for the navigator bar is design.css)            

[SATHSARANI]



*******************************************************NOTES*************************************************************
bankAdmin.html - blood bank admin logged into the system -------------> [bloodBank.php]
*************************************************************************************************************************