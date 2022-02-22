<?php
    //echo "in php";
    require('database.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['save'])) {
        $firstname = $_POST['donorFirstname'];
        $lastname = $_POST['donorLastname'];
        $nic = $_POST['nic'];
        $gender = $_POST['gender'];
        $bday = $_POST['donor_bday'];
        $district = $_POST['district'];
        $address = $_POST['addressDonor'];
        $bloodgroup = $_POST['bloodgroup'];
        $password = $_POST['donor_reg_password'];
        $email    = $_POST['donoremail'];
        

        $query = "INSERT INTO donor_account(donor_id,donor_fname,donor_lname,donor_nic,gender,birthday,address,district,blood_group,password,email)
        VALUES (NULL,'$firstname','$lastname','$nic','$gender','$bday','$address','$district','$bloodgroup','$password','$email')";
        
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