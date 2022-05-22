<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/design.css">
</head>
<body>
    
    <div class="imageContainer" id="imageContainer">
      <div class="topNavigationBar">
        <img>
        <ul>
          <li><a href="main.html">Home</a></li>
          <li><a href="lookingForBlood.html">Looking for blood</a></li>
          <li><a href="donor.html">Want to donate</a></li>
          <li><a href="donationCamp.php">Donation camp</a></li>
          <li><a href="aboutus.html">About us</a></li>
        </ul>
      </div>
      <div class="content">
        <?php
            session_start();
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $databaseName = "BLOODBANK";

            // connect to mysql
            $connect = mysqli_connect($hostname, $username, $password, $databaseName);
            $id = $_POST["BloodBankID"] ;
            $retriveFromAdmin = "SELECT blood_bank_name,blood_bank_id,blood_bank_address,district,contact_number,chief_mo_nic FROM blood_bank WHERE blood_bank_id = $id";
            $retriveResult = mysqli_query($connect,$retriveFromAdmin);

            while($row = mysqli_fetch_assoc($retriveResult)){
                echo"<br>";
                echo"Blood bank name   :- {$row['blood_bank_name']}";
                echo"<br>";
                echo"Blood bank address:- {$row['blood_bank_address']}";
                echo"<br>";
                echo"District          :- {$row['district']}";
                echo"<br>";
                echo"Contact number    :- {$row['contact_number']}";
                echo"<br>";
                echo"Chief MO NIC      :- {$row['chief_mo_nic']}";
                    
                    $_SESSION['bb_id'] = $row['blood_bank_id'];
                    
            }

            mysqli_close($connect);
        

        ?>
        <div class="ycontainer">
            <a href = "../phpFiles/onlineDonorRequests.php">
                <button type="button"><span></span> Donor bookings</button>
            </a>
            <a href = "organizationRequest.php">
                <button type="button"><span></span> Organization requests</button>
            </a>
            <a href = "bloodStockAvilable.php">
                <button type="button"><span></span> Blood availability</button>
            </a>
            <a href = "hospitalRequest.html">
                <button type="button"><span></span> Hospital requests</button> 
            </a>
        </div>
       </div>

    </div>
    



</body>
</html>
