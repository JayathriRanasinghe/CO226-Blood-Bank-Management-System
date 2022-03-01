<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bloodBankDesign.css">
</head>
<body>
    <h1>Blood Bank Management System</h1>
    <h2>Your valuable donation saves 3 lives</h2>

    <div class="topNavigationBar">
        <a class="active" href="index.html">HOME</a>
    
        <div class="dropdown">
            
            <button class="dropbtn">LOOKING FOR BLOOD 
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
    
              <a href="../phpFiles/bloodAvailability.php">Check Blood Availability</a>
              <a href="hospitalReq.html">Request Blood</a>
              
            </div>
    
        </div>
    
    
         <!--<a href="../phpFiles/bloodAvailability.php">LOOKING FOR BLOOD</a> -->
        <a href="donor.html">WANT TO DONATE</a>
        <a href="aboutus.html">ABOUT US</a>
    </div>
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
            <button class = "btn btn1" >Donor bookings</button>
        </a>
        <a href = "organizationRequest.php">
            <button class = "btn btn1">Organization requests</button>
        </a>
        <a href = "bloodStockAvilable.php">
            <button class = "btn btn1">Blood availability</button>
        </a>
        <a href = "hospitalRequest.html">
            <button class = "btn btn1">Hospital requests</button> 
        </a>
    </div>



</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 764cd4aedce9e9646dc345bd3cb2f6014617a7e7
