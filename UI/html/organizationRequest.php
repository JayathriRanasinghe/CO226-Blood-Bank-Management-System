
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
              <a href="../html/hospitalReq.html">Request Blood</a>
              
            </div>
        </div> 
    
        <a href="donor.html">WANT TO DONATE</a>
        <a href="aboutus.html">ABOUT US</a>
    </div>
    <div class="donorLogin">
        <h1 align = "center">Organizations' request details</h1>
        
    </div>
</body>
</html>

<?php
     $hostname = "localhost";
     $username = "root";
     $password = "";
     $databaseName = "BLOODBANK";

    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    $retriveFromOrganization = "SELECT organization_name,contact_number,address FROM organization WHERE request_status =1";
    $retriveResult = mysqli_query($connect,$retriveFromOrganization);
    
    echo"<table border = '1'>";
    echo"<tr><td>Organization name</td><td>Contact number</td><td>Address</td></tr>";

    while($row = mysqli_fetch_assoc($retriveResult)){
        echo"<tr><td>{$row['organization_name']}</td><td>{$row['contact_number']}</td><td>{$row['address']}</td></tr>";
    }
    echo"</table>";
    

    mysqli_close($connect);
        

?>
