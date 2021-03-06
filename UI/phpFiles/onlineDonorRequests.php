<?php
    session_start();
     $hostname = "localhost";
     $username = "root";
     $password = "";
     $databaseName = "BLOODBANK";

    // connect to mysql
    $connect = mysqli_connect($hostname, $username, $password, $databaseName);

    // only if the button is clicked
    
        // select the name of the bb not the id
        $query = "SELECT DISTINCT donor_prerequisites.*, donor_account.donor_fname, donor_account.donor_lname 
        FROM donor_prerequisites,donor_account,blood_bank 
        WHERE donor_prerequisites.donor_id = donor_account.donor_id AND request_status = 2 
        AND donor_prerequisites.blood_bank_name =(SELECT blood_bank_name FROM blood_bank WHERE blood_bank_id = ".$_SESSION['bb_id'].")";


        // Perform query
        $result = mysqli_query($connect, $query); 

        $not_available = "<br>No new registrations<br><br>";
        
        // if the query return any blood banks,
        if ($result -> num_rows > 0){ // result is an array
            
            $dataRow = "";
            // fetch each element from the array
            while ($row = mysqli_fetch_array($result)) {

                // create a row of data to be displayed 
                $button_id_acc = 'acc'.$row[1];
                $button_id_rej = 'rej'.$row[1];
                //$id = $row[0]
            
                $dataRow = $dataRow."<tr><td class=td2 >$row[7] $row[8]</td><td class=td2 >$row[2]</td><td class=td2 >$row[3]</td><td class=td2 >$row[4]</td>
                <td class=td2 >$row[5]</td><td class=td2 >
                <button id = $button_id_acc onclick = \"acceptFunction(this.id)\">Accept</button><button id=$button_id_rej onclick = \"rejectFunction(this.id)\">Reject</button></td></tr>";
               
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
    <title>Login</title>
    <link rel="stylesheet" href="../css/design.css">
</head>
<body>
    <div class="imageContainer" id="imageContainer">
      <div class="topNavigationBar">
        <img>
        <ul>
          <li><a href="../html/main.html">Home</a></li>
          <li><a href="../html/lookingForBlood.html">Looking for blood</a></li>
          <li><a href="../html/donor.html">Want to donate</a></li>
          <li><a href="../html/donationCamp.php">Donation camp</a></li>
          <li><a href="../html/aboutus.html">About us</a></li>
        </ul>
      </div>


      <div class="content">

        <table class="table3">  
            <tr>
                <th class="th2">Name</th>
                <th class="th2">Age</th>
                <th class="th2">Weight</th>
                <th class="th2">Last donated date</th>
                <th class="th2">Medical conditions</th>
                <th class="th2">Approval</th>
                <!-- <th class="th2">Last Updated Date</th> -->
            </tr>   
            <tr class="th3">
                <?php echo $dataRow;?>
            </tr>
               
        </table>

    </div>
    <div class="content-sub">
        <!--this button will reload the page and it will remove the status updated rows-->
        
        <a href="onlineDonorRequests.php">
            <button type="button"><span></span>RELOAD</button>
        </a>
        
        
    </div>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        //these two functions will handle the changing button color and updating database[request status of donor_prereq]
        function acceptFunction(clicked){
            //for accepting
            document.getElementById(clicked).style.background="green";
            
            var id = clicked.slice(3);
            document.getElementById('rej'+id).style.background="";
            
            var id = parseInt(clicked.slice(3));
            
            $.ajax({
            url:"acceptRequest.php", //the page containing php script
            type: "POST", //request type
            data: {"id":id},
            
            success:function(result){
                    alert(result);
                }
            
            });
        }

        function rejectFunction(clicked){
            //for rejecting
            document.getElementById(clicked).style.background="red";
            
            var id = clicked.slice(3); //removing the 'rej' part to get the id
            document.getElementById('acc'+id).style.background="";
           
            var id = parseInt(clicked.slice(3)); //string id -> int id
            
            //using ajax to pass to the test.php (for updating the database request status)
            $.ajax({
            url:"rejectRequest.php", //the page containing php script
            type: "POST", //request type
            data: {"id":id},
            /*
            success:function(result){
                    alert(result); //alerting the final result
                }
            */
            });
        }
    </script>   
        
    </div>

    
    
    
</body>
</html>
