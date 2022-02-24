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
    
    //this thing has to change here this page is displaying once the recipient want to chack the contacts of a direct donor
    $sql1 = "SELECT * FROM donor_account WHERE email='$donor_username' AND password='$donor_password'"; //donor_account table data
    
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
                
                    
                <h1>Contact Details:</h1>
                <div class="subTextDisplay">
                    <p><?php echo "EMAIL : ".$row["email"] ?></p>
                    <p><?php echo "ADDRESS : ".$row["address"] ?></p>
                </div>
                
                <?php
                //past donations and last donation is at the top
                $sql2 = "SELECT * FROM online_donation WHERE  online_donation.donor_id = $donor_id AND online_donation.date < CURRENT_DATE()
                OR (online_donation.date = CURRENT_DATE() AND online_donation.time <= CURRENT_TIME()) ORDER BY donation_id DESC";
                $result2 = $conn->query($sql2) or die($conn->error);
                if ($result2->num_rows > 0) { 
                // Show each data returned by mysql 
      
                while($row2 = $result2->fetch_assoc()) { 
                
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