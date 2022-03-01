<?php 


require("database.php");
$id = $_POST['id'];

$query1 = "UPDATE donor_prerequisites 
        SET 
            request_status = 1
        WHERE
            donor_id = '$id'";

        
        $result   = mysqli_query($con, $query1) or die(mysqli_error($con));
        





        if ($result) {
            
            echo "Request Accepted!";     
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }


?>
