<?php
     $hostname = "localhost";
     $username = "root";
     $password = "";
     $databaseName = "BLOODBANK";

    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    // only if the button is clicked
       

        // select the name of the bb not the id
        $query = "SELECT * FROM donor_prerequisites";

        // Perform query
        $result = mysqli_query($connect, $query); 

        $not_available = "<br>No new registrations<br><br>";
        
        // if the query return any blood banks,
        if ($result -> num_rows > 0){ // result is an array
            
            $dataRow = "";
            // fetch each element from the array
            while ($row = mysqli_fetch_array($result)) {

                // create a row of data to be displayed 
                
                $dataRow = $dataRow."<tr><td class=td2 >$row[1]</td><td class=td2 >$row[2]</td><td class=td2 >$row[3]</td><td class=td2 >$row[4]</td><td class=td2 ><button>button</button></td></tr>";
    
            }
        // if no blood bags available in blood banks,
        }else{

            $dataRow = "";
            $dataRow = $dataRow."<tr><td></td><td>$not_available</td><td></td></tr>";
        }
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookings</title>
    <link rel="stylesheet" href="../css/design.css">
</head>
<body>
    <h1>Blood Bank Management System</h1>
    <h2>Blood Stock Availability</h2>
    <div class="topNavigationBar">
        <a class="active" href="index.html">HOME</a>
        <a href="seek.html">LOOKING FOR BLOOD</a>
        <a href="donor.html">WANT TO DONATE</a>
        <a href="aboutus.html">ABOUT US</a>
    </div>
    

    <br><br><br>

    <div class="parent">

        <table class="table3">  
            <tr>
                <th class="th2">Age</th>
                <th class="th2">Weight</th>
                <th class="th2">Last donated date</th>
                <th class="th2">Medical conditions</th>
                <th class="th2">Approval</th>
                <!-- <th class="th2">Last Updated Date</th> -->
            </tr>   
                <tr class="th3"><?php echo $dataRow;?></tr>
            
    
        </table>

    </div>
    
    
</body>
</html>
