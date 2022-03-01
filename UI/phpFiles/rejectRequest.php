<?php 


require("database.php");
$id = $_POST['id'];
$query = "UPDATE donor_prerequisites 
        SET 
            request_status = 0
        WHERE
            donor_id = '$id'";

        
        $result   = mysqli_query($con, $query) or die(mysqli_error($con));
        
        if ($result) {
            
            echo "Request Rejected!";     
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }


?>
