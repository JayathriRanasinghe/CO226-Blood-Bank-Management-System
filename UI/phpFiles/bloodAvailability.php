<?php
     $hostname = "localhost";
     $username = "root";
     $password = "";
     $databaseName = "BLOODBANK";

    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    // only if the button is clicked
    if (isset($_POST['search'])) {

        $district = $_POST['district'];    
        $bloodgroup = $_POST['bloodgrp'];
       

        // select the name of the bb not the id
        $query = "SELECT blood_bank_name, blood_bank_address, contact_number FROM blood_bank WHERE blood_bank_id in (SELECT blood_bank_id FROM blood_stock WHERE 
        (blood_bank_id in (SELECT blood_bank_id FROM blood_bank WHERE district = '$district')) & (blood_group = '$bloodgroup'))";

        // Perform query
        $result = mysqli_query($connect, $query); 

        $available = "Blood stock is available";
        $not_available = "<br>No blood stocks of the given blood group available at the blood banks of the given district.<br><br>";
        
        // if the query return any blood banks,
        if ($result -> num_rows > 0){ // result is an array
            
            $dataRow = "";
            // fetch each element from the array
            while ($row = mysqli_fetch_array($result)) {

                // create a row of data to be displayed 
                
                $dataRow = $dataRow."<tr>
                                     <td class=td2 >$row[0]<br>$row[1]<br>$row[2]</td>
                                     <td class=td2 >$bloodgroup</td>
                                     <td class=td2 >$available</td>
                                     </tr>";
    
            }
        // if no blood bags available in blood banks,
        }else{

            $dataRow = "";
            $dataRow = $dataRow."<tr><td></td><td>$not_available</td><td></td></tr>";
        }
            
        
    }else{
        $dataRow = "";
    }
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/forTablePages.css">
</head>
<body>  
    <div class="imageContainer" id="imageContainer">
      <div class="topNavigationBar">
        <img>
        <ul>
          <li><a href="../html/main.html">Home</a></li>
          <li><a href="../html/lookingForBlood.html">Looking for blood</a></li>
          <li><a href="../html/donor.html">Want to donate</a></li>
          <li><a href="../html/donationCamp.php"">Donation camp</a></li>
          <li><a href="../html/aboutus.html">About us</a></li>
        </ul>
      </div>
    <h1 style="text-align: center; color: brown;"> Search Blood Stock </h1>   
     
    <div class="main">

        <form class="form" method="post" action="../phpFiles/bloodAvailability.php"> 
            <div class="select">  
            <label class="label1">Select District: </label>
                <select class="district" id="district" name="district">
                    <option value="ampara">Ampara</option>
                    <option value="anuradhapura">Anuradhapura</option>
                    <option value="badulla">Badulla</option>
                    <option value="batticaloa">Batticaloa</option>
                    <option value="colombo">Colombo</option>
                    <option value="galle">Galle</option>
                    <option value="gampaha">Gampaha</option>
                    <option value="hambanthota">Hambanthota</option>
                    <option value="jaffna">Jaffna</option>
                    <option value="kalutara">Kalutara</option>
                    <option value="kandy">Kandy</option>
                    <option value="kegalle">Kegalle</option>
                    <option value="kilinochchi">Kilinochchi</option>
                    <option value="kurunegala">Kurunegala</option>
                    <option value="mannar">Mannar</option>
                    <option value="matale">Matale</option>
                    <option value="matara">Matara</option>
                    <option value="moneragala">Moneragala</option>
                    <option value="mullaitive">Mullaitivu</option>
                    <option value="nuwaraeliya">Nuwara Eliya</option>
                    <option value="polonnaruwa">Polonnaruwa</option>
                    <option value="puttalam">Puttalam</option>
                    <option value="ratnapura">Ratnapura</option>
                    <option value="trincomalee">Trincomalee</option>
                    <option value="vavuniya">Vavuniya</option>
                </select>
                 
            <label class="label2">Select Blood Group: </label>
                <select class="bloodGroup" id="bloodgrp" name="bloodgrp">
                    <option value="O+">O+</option>
                    <option value="A+">A+</option>
                    <option value="B+">B+</option>
                    <option value="O-">O-</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
                <input class="searchButton" type="submit" name="search" value="Search">
            </div>
            
    </div>

    

    <br><br><br>

    <div class="center3">

        <table class="content-table">

            
            <tr>
                <th class="th2">Blood Bank</th>
                <th class="th2">Blood Group</th>
                <th class="th2">Availability</th>
                <!-- <th class="th2">Last Updated Date</th> -->
            </tr>
                
                <?php echo $dataRow;?>

            <tr>
                
            </tr>
    
        </table>
        </form>
   
    
    </div>
        
    </div>
    
    
    
    
</body>
</html>
