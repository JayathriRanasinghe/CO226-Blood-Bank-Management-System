<?php
    require('database.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['login'])) {
        $username = $_POST['donorUsername'];    // removes backslashes
        $password = $_POST['donorPW'];
        // Check user is exist in the database
        $query    = "SELECT * FROM donor_account WHERE email='$username'
                     AND password='$password'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            echo "<script>location.href = '../html/profileCard.html';</script>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='../html/donor.html'>Login</a> again.</p>
                  </div>";
        }
    }
?>