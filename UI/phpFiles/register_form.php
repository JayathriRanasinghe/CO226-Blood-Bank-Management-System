<?php
    echo "in php";
    //require('database.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['submit'])) {
        $firstname = $_POST['donorFirstname'];
        //$firstname = mysqli_real_escape_string($con, $firstname);

        $lastname = $_POST['donorLastname'];
        //$lastname = mysqli_real_escape_string($con, $lastname);

        $nic = $_POST['nic'];
        //$nic = mysqli_real_escape_string($con, $nic);

        $gender = $_POST['gender'];

        $bday = $_POST['donor_bday'];
        $district = $_POST['district'];
        $address = $_POST['addressDonor'];
        $bloodgroup = $_POST['bloodgroup'];
        $password = $_POST['donor_reg_password'];
        //$password = mysqli_real_escape_string($con, $password);
        
        // removes backslashes
        //$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        //$username = mysqli_real_escape_string($con, $username);
        $email    = $_POST['donoremail'];
        //$email    = mysqli_real_escape_string($con, $email);
        //$create_datetime = date("Y-m-d H:i:s");

        $con = mysqli_connect("localhost","root","","BLOODBANK");
        // Check connection
        if (!$con){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }else{
            echo "connected!";
        }



        $query = "INSERT INTO `donor_account`(donor_fname,donor_lname,donor_nic,gender,birthday,address,district,blood_group,password,email)
        VALUES ('$firstname','$lastname','$nic','$gender','$bday','$address','$district','$bloodgroup','$password',$email)";
        //$query    = "INSERT into `donor_account` (username, password, email, create_datetime)
          //           VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "Successful!";
           /* echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
                  */
        } else{
            echo "unsuccessfull!";
        }
    }
?>