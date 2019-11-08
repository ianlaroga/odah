<?php require('../../controllers/connection.php'); ?>
<?php require('../../controllers/sessions.php'); ?>

<?php

$conn = connect();

$clinicID = $_POST['clinicID'];
$user_id = $_POST['user_id'];
$rating_number = $_POST['rating_number'];

$sql = "INSERT INTO rating(rating_number, patient_id, clinic_id) VALUES ('$rating_number', '$user_id', '$clinicID') ";
$result = $conn->query($sql);

if($result){
    echo "<script>alert('Rating Sent!')</script>";
    echo "<script>history.back()</script>";
}

?>