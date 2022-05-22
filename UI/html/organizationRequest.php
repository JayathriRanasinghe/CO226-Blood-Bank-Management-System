
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
      <h2>Organizations' request details</h2>
      <div class="content">
        
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
    </div>
    </div>
    
</body>
</html>


