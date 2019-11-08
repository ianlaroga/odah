<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php

if(isset($_POST['addDentist'])){
	dentistAdd();
}

if(isset($_GET['deleteDentistId'])){
	dentistDelete();
}

if (isset($_POST['userId'])){
	fetchDentistID();
}

if(isset($_POST['services_id'])){
	addTeethChart();
}

function addTeethChart(){
$services_id=$_POST['services_id'];
	$type= $_POST['type'];
	$tooth= $_POST['tooth'];
	$dentistID=$_POST['dentistID'];
	$patientId=$_POST['patientId'];


$conn=connect();
	
	$sql = "INSERT INTO toothchart (tooth_place,dentist_id, patient_id, serviceId) VALUES('$tooth', '$dentistID' , '$patientId', '$services_id')";

	$result = $conn->query($sql);

	if($result){
			$str = "Successfully Added";
		header("location:../views/viewTeethChart.php?patientId=$patientId&type=$type&success=".$str);
	}else{
		echo "ERROR!". mysqli_error($conn);
	}
}
// Creating A New User
function dentistAdd(){
	$user_username=$_POST['user_username'];
	$user_password= $_POST['user_password'];
	$hash_pass= md5($user_password);
	$user_firstname=$_POST['user_firstname'];
	$user_lastname=$_POST['user_lastname'];
	$user_mi=$_POST['user_mi'];
	$user_email=$_POST['user_email'];
	$user_contact=$_POST['user_contact'];
	$user_dob=$_POST['user_dob'];
	$user_contact=$_POST['user_contact'];
	$user_gender=$_POST['user_gender'];
	$user_type='3';


	$conn=connect();
	
	$sql = "INSERT INTO user (user_id,user_name,user_password,user_fname,user_lname,user_mi,user_email,user_dob,user_contact,user_gender,user_type, is_activated)
	 VALUES (NULL,'$user_username','$hash_pass','$user_firstname','$user_lastname','$user_mi','$user_email','$user_dob','$user_contact','$user_gender','$user_type', 1)";



	$result = mysqli_query($conn, $sql);

	if($result){
			$str = "Successfully Created A New Dentist Account";
		header("location:../views/secretaryDentistMasterlist.php?success=".$str);
	}else{
		echo "ERROR!". mysqli_error($conn);
	}
}

//Deleting a Dentist
function dentistDelete(){
	$conn=connect();
	$id = $_GET['deleteDentistId'];
	$sql = "DELETE FROM `user` WHERE user_id = '$id' ";
	$result = mysqli_query($conn, $sql);

	if($result){
			$str = "This dentist is remove from the system";
		header("location:../views/secretaryDentistMasterlist.php?danger=".$str);
	}else{
		echo "ERROR!". mysqli_error($conn);
	}

}

//View Data for Admin
function fetchDentistID(){
	$conn = connect();
    $id = $_POST['userId'];
    $sql = "SELECT * FROM user  WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}

?>
