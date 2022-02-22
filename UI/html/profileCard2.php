<?php 
    if (isset($_POST['login'])) {
        $donor_username = $_POST['donorUsername'];
        $donor_password = $_POST['donorPW'];
    
    // Server credentials  
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "bloodbank"; 
     
    // Creating mysql connection 
    $conn = new mysqli($servername, $username, $password, $dbname); 
     
    // Checking mysql connection 
    if ($conn->connect_error) { 
      die("Connection failed: " . $conn->connect_error); 
    } /*else{
        echo "connected!";
    }*/
     
    //echo $donor_username . ':' . $donor_password;

    // Writing a mysql query to retrieve data  
    $sql1 = "SELECT * FROM donor_account WHERE email='$donor_username' AND password='$donor_password'"; //donor_account table data
   // $sql2 = "SELECT * FROM online_donation WHERE donor_account.donor_id = online_donation.donor_id ORDER BY donation_id DESC";
   // $sql3 = "SELECT * FROM online_donation WHERE donor_account.donor_id = online_donation.donor_id ORDER BY donation_id DESC LIMIT 1";
    
    $result1 = $conn->query($sql1); 
   // $result2 = $conn->query($sql2) or die($conn->error);
   // $result3 = $conn->query($sql3);
}
    if ($result1->num_rows > 0) { 
      
      while($row = $result1->fetch_assoc()) { 
          $donor_id = $row["donor_id"];
    ?> 
    	 <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profile</title>
            <link rel="stylesheet" href="../css/profileStylesheet.css">
        </head>
        <body>
            <h1>Blood Bank Management System</h1>
            <h2>Your valuable donation saves 3 lives</h2>
            <div class="topNavigationBar">
                <a class="active" href="profileCard.html">HOME</a>
                <a href="seek.html">LOOKING FOR BLOOD</a>
                <a href="donor.html">WANT TO DONATE</a>
                <a href="aboutus.html">ABOUT US</a>
            </div>

            
            <!-- The sidebar -->
            <div class="sidebar">
                <a class="active" href="profileCard.html">Profile</a>
                <a href="donor_bookedDates.html">Booked Dates</a>
                <a href="donor_previouDonations.html">Previous Donations</a>
                <a href="donor_directRequest.html">Direct Requests</a>
                <a href="donor_donationCampNotice.html">Donation Camps</a>
                <br><br><br>
                
                <a class="booking" href="#about">Book a Date</a>
            </div>
            <?php
            
            ?>
            <div class="display">
                <?php
                    //next donations
                    $sql3 = "SELECT * FROM online_donation WHERE  online_donation.donor_id = $donor_id AND online_donation.date > CURRENT_DATE()
                    OR (online_donation.date = CURRENT_DATE() AND online_donation.time >= CURRENT_TIME()) ORDER BY donation_id DESC";
                    $result3 = $conn->query($sql3) or die($conn->error);
                    if ($result3->num_rows > 0) { 
                    // Show each data returned by mysql 
        
                    while($row3 = $result3->fetch_assoc()) { 
                        $bb_id = $row3["blood_bank_id"];
                        $sql4 = "SELECT district FROM blood_bank WHERE blood_bank.blood_bank_id = $bb_id";
                        $result4 = $conn->query($sql4) or die($conn->error);
                        $row4 = $result4->fetch_assoc()
                ?>
                <h1>Next donation</h1>
                <div class="subTextDisplay">
                    <p><?php echo "DATE : ".$row3["date"] ?></p>
                    <p><?php echo "TIME : ".$row3["time"] ?></p>
                    <p><?php echo "BLOODBANK : ".$row4["district"] ." blood bank"?></p>
                </div>
                <?php
                    }
                }
                ?>
                <?php
                //past donations and last donation is at the top
                $sql2 = "SELECT * FROM online_donation WHERE  online_donation.donor_id = $donor_id AND online_donation.date < CURRENT_DATE()
                OR (online_donation.date = CURRENT_DATE() AND online_donation.time <= CURRENT_TIME()) ORDER BY donation_id DESC";
                $result2 = $conn->query($sql2) or die($conn->error);
                if ($result2->num_rows > 0) { 
                // Show each data returned by mysql 
      
                while($row2 = $result2->fetch_assoc()) { 
                ?>
                <h2>[Last Donation]</h2>
                <div class="subTextDisplay">
                    <p><?php echo $row2["date"] ." ".$row2["time"]?></p>
                    <p>[Date | Send to {Blood bank}]</p>
                </div>
                <?php
                    }
                }
                ?>
            </div>


            <!-- the donor profile card -->
            

            <div class="card">
                <img src="../images/male_profilePic.png" alt="male_profile_pic" style="width:100%">
                <h1> <?php echo $row["donor_fname"] . " " . $row["donor_lname"]; ?> </p> </h1>
                <p class=""> <?php echo $row["district"] ?> </p> </p>
                <p><?php echo "No of donations: " .$result2->num_rows; ?> </p>
                <p><button>Contact</button></p>
            </div> 
        </body>
        </html>
    	
        
    <?php 
      } 
    } else { 
      echo "0 results"; 
    } 
     
    // Closing mysql connection 
    $conn->close(); 
    ?> 