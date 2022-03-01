<?php 


require("database.php");
$id = $_POST['id'];


$query1 = "UPDATE donor_prerequisites 
        SET 
            request_status = 1
        WHERE
            donor_id = '$id'";

        
        $result   = mysqli_query($con, $query1) or die(mysqli_error($con));
        
        $query2 = "SELECT blood_bank_name FROM donor_prerequisites WHERE donor_id = '$id'";
        $result2   = mysqli_query($con, $query2) or die(mysqli_error($con));
        if ($result2->num_rows > 0) { 
            
            while($row = $result2->fetch_assoc()) { 
                $bb_name = $row["blood_bank_name"];
                
            }
        }


        $query3 = "SELECT date, time FROM online_donation_view 
        where online_donation_view.blood_bank_name = '$bb_name'
        ORDER BY donation_id DESC LIMIT 1";
        
        $result3   = mysqli_query($con, $query3) or die(mysqli_error($con));
        
        if ($result3->num_rows > 0) { 
            
            while($row = $result3->fetch_assoc()) { 
                $date = $row["date"];
                $time = $row["time"];
            }
        
        echo $date,$time;
        $query4 = "INSERT INTO online_donation(donor_id,date,time) VALUES('$id','$date','$time')";
        $result4   = mysqli_query($con, $query4) or die(mysqli_error($con));
        
        //online_donation.time >= CURRENT_TIME()

        //updating the time with 1 hour
        $query5_1 = "UPDATE online_donation
                        SET time = time + interval 1 hour
                        where donor_id='$id' AND online_donation.time < '16:00:00'";
        
        $query5_2 = "UPDATE online_donation
                    SET date = date + interval 1 day,
                    time = '08:00:00' 
                    where donor_id='$id' AND online_donation.time = '16:00:00'";

        $result5_1   = mysqli_query($con, $query5_1) or die(mysqli_error($con));
        $result5_2   = mysqli_query($con, $query5_2) or die(mysqli_error($con));

    }else{
        //if the blood bank is not available in the system
        //date giving starts from next day 08:00:00
        $dt1=date('Y-m-d', strtotime(' +1 day'));
        $query6 = "INSERT INTO online_donation(donor_id,date,time) VALUES('$id','$dt1','08:00:00')";
        $result6   = mysqli_query($con, $query6) or die(mysqli_error($con));
    }

        if ($result) {
            
            echo "Request Accepted!";     
        } else{
            echo "Unsuccessfull Registration!";
            echo "<p class='link'>Click here to <a href='donorRegister.html'>registration</a> again.</p>";
        }


?>
