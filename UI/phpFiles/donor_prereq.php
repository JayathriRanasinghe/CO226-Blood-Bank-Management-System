<?php
    require('../phpFiles/database.php');
    
    // When form submitted, insert values into the database.
    session_start();
    
    if (isset($_POST['save'])) {
        $blood_bank = $_POST['bloodbank'];
        $donor_weight = $_POST['weight'];
        $donor_age = $_POST['age'];
        $last_donation_date = $_POST['last_donation_date'];
        $donor_med_condition = $_POST['med_conditions'];
        $request_status = 2;
        
        /*
        $query = "UPDATE donor_prerequisites SET age = '$donor_age',weight = '$donor_weight',last_donated_date = '$last_donation_date',medical_condition = '$donor_med_condition' 
        WHERE donor_id = ".$_SESSION['donor_id']." AND (NOT EXISTS (INSERT INTO donor_prerequisites(donor_id,age,weight,last_donated_date,medical_condition)
        VALUES (".$_SESSION['donor_id'].",'$donor_age','$donor_weight','$last_donation_date','$donor_med_condition')))";
        */
        $query = 
        "INSERT INTO donor_prerequisites(
            blood_bank_name,
            donor_id,
            age,
            weight,
            last_donated_date,
            medical_condition,
            request_status
            )
        VALUES (
            '$blood_bank',
            ".$_SESSION['donor_id'].",
            '$donor_age',
            '$donor_weight',
            '$last_donation_date',
            '$donor_med_condition',
            '$request_status'
            ) 
            ON DUPLICATE KEY 
        UPDATE 
            blood_bank_name = '$blood_bank',
            age = '$donor_age',
            weight = '$donor_weight',
            last_donated_date = '$last_donation_date',
            medical_condition = '$donor_med_condition',
            request_status = '$request_status'";
         
        $result   = mysqli_query($con, $query) or die(mysqli_error($con));
        
        if ($result) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <link rel="stylesheet" href="../css/design.css">
            </head>
            <body>
            <div class="imageContainer" id="imageContainer">
      <div class="topNavigationBar">
        <img>
        <ul>
          <li><a href="main.html">Home</a></li>
          <li><a href="lookingForBlood.html">Looking for blood</a></li>
          <li><a href="donor.html">Want to donate</a></li>
          <li><a href="aboutus.html">About us</a></li>
        </ul>
      </div>
      <div class = "datasavingMessage">
                    <p>Your data has sent to the blood bank. Your date will be confirmed within an hour.<br>Thank you!</p>
                </div>
                
            </body>
            </html>
        
    </div>

    
                

            <?php 
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }
    }else{
        echo "Noooo!!!";
    }
?>