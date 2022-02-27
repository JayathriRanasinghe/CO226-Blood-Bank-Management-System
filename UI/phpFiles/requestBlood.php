<?php
    require('database.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {

        $hospital_login = $_POST['Hospital_login'];    // removes backslashes
        //echo $hospital_login;
        // Check user is exist in the database
        $query = "SELECT * FROM hospital WHERE contact_number='$hospital_login'";
        
        //$result2 = $con->query($query);
        $result = mysqli_query($con, $query) or die(mysql_error());
        //echo $result;
        $rows = mysqli_num_rows($result);
        echo $rows;
        
        //$con->close();
        if ($rows == 1) {
            //$_SESSION['username'] = $username; 
            // Redirect to hospital blood request form page
            
            echo "<script>location.href = '../html/seeker_hospitals.html';</script>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Login details.</h3><br/>
                  <p class='link'>Click here to <a href='../html/hospitalReq.html'>Login</a> again.</p>
                  </div>";
        }
    }
?>