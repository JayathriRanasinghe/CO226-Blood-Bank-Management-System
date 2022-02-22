
<?php
//*************************unwanted file***********
require('database.php');
    //session_start();
    //check the connection
    
    //if(isset($_POST['login']))
    // SQL query to select data from database
    $sql = "SELECT * FROM donor_account WHERE email = $username ";
    $result = $mysqli->query($sql);
    $mysqli->close(); 
?>