<?php
    //echo "in php";
    require('../phpFiles/database.php');
    // When form submitted, insert values into the database.
    session_start();
    //$donor_id = $_SESSION['donor_id'];
    if (isset($_POST['save'])) {

        $donor_weight = $_POST['weight'];
        $donor_age = $_POST['age'];
        $last_donation_date = $_POST['last_donation_date'];
        $donor_med_condition = $_POST['med_conditions'];
        
        /*
        $query = "UPDATE donor_prerequisites SET age = '$donor_age',weight = '$donor_weight',last_donated_date = '$last_donation_date',medical_condition = '$donor_med_condition' 
        WHERE donor_id = ".$_SESSION['donor_id']." AND (NOT EXISTS (INSERT INTO donor_prerequisites(donor_id,age,weight,last_donated_date,medical_condition)
        VALUES (".$_SESSION['donor_id'].",'$donor_age','$donor_weight','$last_donation_date','$donor_med_condition')))";
        */
        $query = 
        "INSERT INTO donor_prerequisites(
            donor_id,
            age,
            weight,
            last_donated_date,
            medical_condition
            )
        VALUES (
            ".$_SESSION['donor_id'].",
            '$donor_age',
            '$donor_weight',
            '$last_donation_date',
            '$donor_med_condition'
            ) 
            ON DUPLICATE KEY 
        UPDATE 
            age = '$donor_age',
            weight = '$donor_weight',
            last_donated_date = '$last_donation_date',
            medical_condition = '$donor_med_condition'";
         
        $result   = mysqli_query($con, $query) or die(mysqli_error($con));
        
        if ($result) {
            //echo "Successful!";
            /*
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='../html/donor.html'>Login</a></p>
                  </div>";
            */
            //echo "<script>location.href = '../html/donor.html';</script>";   
            //echo "YOUR DATA IS SENT TO THE BLOODBANK. please check again with in an hour";    
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
                <h1>Blood Bank Management System</h1>
                <h2>Your valuable donation saves 3 lives</h2>
                <div class="topNavigationBar">
                    <a class="active" href="index.html">HOME</a>
                    <a href="seek.html">LOOKING FOR BLOOD</a>
                    <a href="donor.html">WANT TO DONATE</a>
                    <a href="aboutus.html">ABOUT US</a>
                </div>
                <div class = "datasavingMessage">
                    <p>Your data has sent to the blood bank. Your date will be confirmed within an hour.<br>Thank you!</p>
                </div>
                
            </body>
            </html>

            <?php 
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }
    }else{
        echo "Noooo!!!";
    }
?>