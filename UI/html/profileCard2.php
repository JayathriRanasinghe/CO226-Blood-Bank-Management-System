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
    } else{
        echo "connected!";
    }
     
    echo $donor_username . ':' . $donor_password;
    // Writing a mysql query to retrieve data  
    $sql = "SELECT * FROM donor_account WHERE email='$donor_username' AND password='$donor_password'";
    $result = $conn->query($sql); 
}
    if ($result->num_rows > 0) { 
      // Show each data returned by mysql 
      while($row = $result->fetch_assoc()) { 
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

            
            
            <div class="display">
                <h1>[Next donation]</h1>
                <div class="subTextDisplay">
                    <p>[date]</p>
                    <p>[Time]</p>
                    <p>[blood bank]</p>
                </div>
                
                <h2>[Last Donation]</h2>
                <div class="subTextDisplay">
                    <p>[Date | Send to {Blood bank}]</p>
                </div>
                
            </div>


            <!-- the donor profile card -->
            

            <div class="card">
                <img src="../images/male_profilePic.png" alt="male_profile_pic" style="width:100%">
                <h1> <?php echo $row["donor_fname"] . " " . $row["donor_lname"]; ?> </p> </h1>
                <p class=""> <?php echo $row["district"] ?> </p> </p>
                <p><?php echo "No of donations: " . $row["password"]; ?> </p>
                <p><button>Contact</button></p>
            </div> 
        </body>
        </html>
    	<!-- USING HTML HERE : Here I am using php within html tags --> 
    	
        
    <?php 
      } 
    } else { 
      echo "0 results"; 
    } 
     
    // Closing mysql connection 
    $conn->close(); 
    ?> 