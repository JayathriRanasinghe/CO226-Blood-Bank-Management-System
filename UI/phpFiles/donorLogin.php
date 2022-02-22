<?php
    require('database.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {
<<<<<<< HEAD
        $donor_username = $_POST['donorUsername'];    // removes backslashes
        $donor_password = $_POST['donorPW'];;
=======
        $username = $_POST['donorUsername'];    // removes backslashes
        $password = $_POST['donorPW'];
>>>>>>> 8cacf7cd05d559571bc5cf4de7806609860d2b01
        // Check user is exist in the database
        $query    = "SELECT * FROM donor_account WHERE email='$donor_username'
                     AND password='$donor_password'";
        $result2 = $con->query($query);
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        
        
        //$con->close();
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            echo "<script>location.href = '../html/profileCard.php';</script>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='../html/donor.html'>Login</a> again.</p>
                  </div>";
        }
    }
?>