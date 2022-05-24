<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request for donation camp</title>
    <link rel="stylesheet" href="../css/donationCampForm.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<div class="imageContainer" id="imageContainer">

    <div class="topNavigationBar">
        <img>
        <ul>
            <li><a href="main.html">Home</a></li>
            <li><a href="lookingForBlood.html">Looking for blood</a></li>
            <li><a href="donor.html">Want to donate</a></li>
            <li><a href="donationCamp.php">Donation camp</a></li>
            <li><a href="aboutus.html">About us</a></li>
        </ul>
    </div>

        
    <h2>Request For Donation Camp </h2><br>
        
        <form class="form" method="post" action="../phpFiles/hospital_request.php">
            
        <div class="main">

            <div class="divContent">

                

                <div class="div1">
                    <label3> Organization name:</label3>
                    <input class="username" type="text" id="OrganizationName" name="OrganizationName">
                </div><br>

                <div class="div1">
                    <label3>Contact Number:</label3>
                    <input class="username" type="text" id="contact" name="contact">
                </div><br>
              
                
                <div class="div1">
                    <label3>Select the blood bank: </label3>
                    
                    <?php
                        require('../phpFiles/database.php');

                        // When form submitted, insert values into the database.
                        session_start();

                        if($r_set = $con->query("SELECT blood_bank_name, blood_bank_id from blood_bank")){

                            echo "<select class='username' id='bloodbank' name='bloodbank'>";

                            while ($row = $r_set->fetch_assoc()) {

                                echo "<option value = $row[blood_bank_id]>  $row[blood_bank_name]  </option>";
                            }

                            echo "</select>";

                        }else{

                            echo $con->error;

                        }     
                    ?>
                </div><br><br>

                

                <div class="div1">
                    <label3>Address:</label3>
                    <input class="username" type="text" id="Address" name="recepientNic">
                </div><br>

                <div class="div2">

                        <input class="loginbutton2" type="submit" name= "save" value="Send Request">

                </div><br>
                

            </div> 

        </div><br>                    

        </form>
         
    
    </div>

</body>
</html>