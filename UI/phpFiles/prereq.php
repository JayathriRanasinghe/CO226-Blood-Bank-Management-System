<?php
    echo "in php";
    require('database.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['save'])) {
        
        $weight = $_POST['weight'];
        $age = $_POST['age'];
        $last_donation_date = $_POST['last_donation_date'];
        $med_conditions = $_POST['med_conditions'];
        

        $query = "INSERT INTO donor_prerequisites(donor_id,age,weight,last_donated_date,medical_condition)
        VALUES (NULL,'$age','$weight','$last_donated_date','$medical_condition')";
        
        $result   = mysqli_query($con, $query) or die(mysqli_error($con));
        
        if ($result) {
            //echo "Successful!";
            /*
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='../html/donor.html'>Login</a></p>
                  </div>";
            */
            echo "<script>location.href = '../html/donor.html';</script>";     
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }
    }else{
        echo "Noooo!!!";
    }
?>