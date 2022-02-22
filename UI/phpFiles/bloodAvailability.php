<?php
     $hostname = "localhost";
     $username = "root";
     $password = "nsr123sddn";
     $databaseName = "BLOODBANK";

    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    if (isset($_POST['search'])) {
        $district = $_POST['district'];    // removes backslashes
        $bloodgroup = $_POST['bloodgrp'];
        // mysql select query
        $query = "SELECT * FROM blood_stock WHERE blood_group='$bloodgroup'";
        

        // result for method one
        $result1 = mysqli_query($connect, $query);
        

        $dataRow = "";

        while($row2 = mysqli_fetch_array($result1))
        {
            
            $dataRow = $dataRow."<tr><td>$row2[1]</td><td>$row2[2]</td><td>$row2[0]</td></tr>";
        }
    }
        

?>

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
    <h2>Blood Stock Availability</h2>
    <div class="topNavigationBar">
        <a class="active" href="index.html">HOME</a>
        <a href="seek.html">LOOKING FOR BLOOD</a>
        <a href="donor.html">WANT TO DONATE</a>
        <a href="aboutus.html">ABOUT US</a>
    </div>
    <div class="donorLogin">
        <h3 style="text-align: center; color: brown;"> Search Blood Stock </h3>
        
    </div>
    <div class="parent">

    <form class="form" method="post" action="../phpFiles/bloodAvailability.php">
       
    <table><tr>
    <td>
        <label>Select District: </label>
        <select id="district" name="district">
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
    </td>

    <td><label> &nbsp;&nbsp;|&nbsp;&nbsp; </label></td>

    <td>
        <label>Select Blood Group: </label>
        <select id="bloodgrp" name="bloodgrp">
            <option value="O+">O+</option>
            <option value="A+">A+</option>
            <option value="B+">B+</option>
            <option value="O-">O-</option>
            <option value="A-">A-</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>

        </select>

    </td>

    </tr></table>
    </div>

    <div class="center">
        <input type="submit" name= "search" value="Search">
    </div>

    <br><br><br>

    <div class="parent">

        <table class="table2">

            
            <tr>
                <th class="th2">Blood Bank</th>
                <th class="th2">Blood Group</th>
                <th class="th2">Availability</th>
                <th class="th2">Last Updated Date</th>
            </tr>
                
                <?php echo $dataRow;?>

            <tr>
                
            </tr>
    
        </table>

    </form>
    
    </div>
    
    
</body>
</html>