<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    // this connection can be used in all the php files in order to connect to the database
    // require(database.php) : to use this file
    global $con;
    $con = mysqli_connect("localhost","root","","BLOODBANK");
    
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
