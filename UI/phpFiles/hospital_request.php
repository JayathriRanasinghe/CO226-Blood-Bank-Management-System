<?php
    require('../phpFiles/database.php');
    
    // When form submitted, insert values into the database.
    session_start();
    
    $hospital_name = $_POST['Hospitalname'];
    $hospital_number = $_POST['contact'];
    $bloodbank_id = $_POST['bloodbank'];
    $recepient = $_POST['recepientNic'];
    $blood_grp = $_POST['bloodGroup'];
    $amount = $_POST['amount'];
    // comment is not included bcz it was not taken as a column in the hospital table
    
    // $query2 = "SELECT blood_bank_id FROM blood_bank WHERE blood_bank_name = '$bloodbank_id'";
    // $bb_id   = mysqli_query($con, $query2) or die(mysqli_error($con));
    // $row = mysqli_fetch_array($bb_id);
    // echo $bloodbank_name;

    $query = 
    "INSERT INTO hospital(
        blood_bank_id,
        hospital_name,
        recepient_nic,
        contact_number, 
        amount, 
        blood_group)
    VALUES (
        '$bloodbank_id',
        '$hospital_name',
        '$recepient',
        '$hospital_number',
        '$blood_grp',
        '$amount'
        ) 
        ON DUPLICATE KEY UPDATE 
        blood_bank_id = '$bloodbank_id',
        hospital_name = '$hospital_name',
        recepient_nic = '$recepient',
        contact_number = '$hospital_number', 
        amount = '$amount',
        blood_group = '$blood_grp'";
        
    $result   = mysqli_query($con, $query) or die(mysqli_error($con));
    
    if ($result) {
        ?>
            echo '
            <script>window.alert("You request has been sent to the blood bank. You will be contacted soon.");
            window.location.href='../html/main.html';
            </script>'

        <?php 
    } else{
        ?>

            echo '
            <script>window.alert("Error recording your request. Please Try Again.");
            window.location.href='../html/main.html';
            </script>'

        <?php
        
    }
    
    
?>