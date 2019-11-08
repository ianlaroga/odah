<?php
     require("../controllers/connection.php");
     $conn = connect();
    $id = $_GET['id'];
     $sql = "UPDATE appointment SET status= 'done' WHERE appointment_id = '$id' ";
     $result = $conn->query($sql);

     if($result){
         echo "<script>alert('Set as Done!')</script>";
         echo "<script>window.location.href = 'dentistDentalRecord.php' </script>";
     }



?>