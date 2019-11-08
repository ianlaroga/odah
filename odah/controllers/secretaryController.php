<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php

if(isset($_POST['addDentist'])){
	dentistAdd();
}

// View Details - this is for Dentist Masterlist 
if(isset($_POST['dentistSecId'])){
  fetchSecDentistDetails();
}

if(isset($_POST['walkinPatientAdd'])){
	walkIn();
  }


// View Details - this is for Dentist Masterlist 
if(isset($_POST['patientSecId'])){
  fetchSecPatientDetails();
}

// View Details - this is for Dentist Masterlist 
if(isset($_POST['bookAppointment'])){
  appointmentBook();
}

// View Details - this is for Dentist Masterlist 
if(isset($_POST['addClinicBranch'])){
  clinicBranchAdd();
}

if(isset($_POST['addServices'])){
  clinicServicesAdd();
}

if(isset($_GET['delID'])){
  clinicServicesDelete();
}

if(isset($_POST['updateServices'])){
  clinicServicesUpdate();
}

function walkIn(){
	$conn=connect();


	$patient_name = $_POST['patient_name'];
	$patient_type = $_POST['patient_type'];
	$user_email = $_POST['user_email'];
	$user_contact = $_POST['user_contact'];
	$appointment_date = $_POST['appointment_date'];
	$clinic_id = $_POST['clinic_id'];
	$appointment_time = $_POST['appointment_time'];
	$service = $_POST['service'];


	$sql = "INSERT INTO appointment (appointment_id,clinicId,patient_name,patient_email,patient_contact,appointment_date,appointment_time,clinic_services, patient_type)
	 VALUES (NULL,'$clinic_id','$patient_name','$user_email','$user_contact','$appointment_date','$appointment_time','$service','$patient_type')";
	 $result = mysqli_query($conn,$sql);

	 if($result){
	 	$str = "Successfully Booked An Appointment!!";
		header("location:../views/secretaryAppointmentMasterlist.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   
	
}
function clinicServicesUpdate(){

	$conn=connect();

	$services_name = $_POST['services_name'];
	$services_price = $_POST['services_price'];
	$legend_color = $_POST['legend_color'];
	$clinicId = $_POST['clinicId'];
	$editId = $_POST['editID'];

	$sql = "UPDATE services SET `services_name` = '$services_name', `legend_name` = '$legend_color', `services_price` = '$services_price' WHERE `services_id` = '$editId' ";
	 $result = mysqli_query($conn,$sql);

	 if($result){
		header("location:../views/secretaryViewClinic.php?viewClinicId=$clinicId");
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
}

function clinicServicesDelete(){

	$conn = connect();
	$id = $_GET['delID'];
	$clinicId = $_GET['viewClinicId'];
	$sql = "DELETE FROM services WHERE services_id = '$id' ";
	$result = mysqli_query($conn,$sql);

	if($result){
		header("location:../views/secretaryViewClinic.php?viewClinicId=$clinicId");
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
}

function clinicServicesAdd(){

	$conn=connect();

	$services_name = $_POST['services_name'];
	$services_price = $_POST['services_price'];
	$legend_color = $_POST['legend_color'];
	$clinicId = $_POST['clinicId'];

	$sql = "INSERT INTO services (services_id,services_name,legend_name,services_price,clinicId)
	 VALUES (NULL,'$services_name','$legend_color','$services_price','$clinicId')";
	 $result = mysqli_query($conn,$sql);

	 if($result){
		header("location:../views/secretaryViewClinic.php?viewClinicId=$clinicId");
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
}

// Creating A New Branch
function clinicBranchAdd(){

	$conn=connect();
	$secretary_id=$_POST['secretaryId'];
	$clinic_id=$_POST['clinicId'];
	$query = "SELECT * FROM clinic WHERE clinic_id = $clinic_id";
	$queryResult = mysqli_query($conn,$query);
	while($queryRow = mysqli_fetch_assoc($queryResult)){
		 	$id 			= 	$queryRow['clinic_id'];
		 	$clinicName 	= 	$queryRow['clinic_name'];
		 	$clinicContact 	= 	$queryRow['clinic_contact'];
		 	$startDay 		= 	$queryRow['start_day'];
		 	$endDay 		= 	$queryRow['end_day'];
		 	$startTime 		= 	$queryRow['start_time'];
		 	$endTime 		= 	$queryRow['end_time'];
		 	$image 			= 	$queryRow['clinic_image'];
		 	$permit1 		= 	$queryRow['clinic_permit1'];
	}

	$status = '2';
	$clinic_account = '1';

	// clinic branch id
	$branch_code=$_POST['branch_code'];

	// clinic branch location
	$clinic_address=$_POST['branch_address'];
	
	$sql = "INSERT INTO clinic (clinic_id,secretaryId,clinic_name,clinic_location,clinic_contact,start_day,end_day,start_time,end_time,clinic_image,clinic_permit1,clinic_status,clinic_account,clinic_branch)
	 VALUES (NULL,'$secretary_id','$clinicName','$clinic_address','$clinicContact','$startDay','$endDay','$startTime','$endTime','$image','$permit1','$status','$clinic_account','$branch_code')";
	 $result = mysqli_query($conn,$sql);

	 if($result){
	 	$str = "New Clinic Branch is created";
		header("location:../views/secretaryClinicMasterList.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   }


// Creating A New User
function appointmentBook(){

	$patient_name=$_POST['patient_name'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$date=$_POST['date'];
	$time=$_POST['time'];
	$services=$_POST['services'];
	$clinicId=$_POST['clinic_id'];
	$user_id=$_POST['user_id'];
	$patient_type=$_POST['patient_type'];

	$conn=connect();

	$sqlCheck = "SELECT * FROM appointment WHERE clinicId = '$clinicId' AND appointment_date = '$date' AND appointment_time = '$time' AND status = 'accepted' ";
	$sqlResult = $conn->query($sqlCheck);

	if($sqlResult->num_rows > 0){
		echo "<script>alert('Appointment date is already taken. Please try again.')</script>";
		echo "<script>history.back()</script>";
	}else{
	$sql = "INSERT INTO appointment (appointment_id,clinicId,patient_name,patient_email,patient_contact,appointment_date,appointment_time,clinic_services, user_id, patient_type)
	 VALUES (NULL,'$clinicId','$patient_name','$email','$contact','$date','$time','$services', '$user_id','$patient_type')";
	 $result = mysqli_query($conn,$sql);

	 if($result){
	 	$str = "Successfully Booked An Appointment!!";
		header("location:../views/home/home.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   }
}



function fetchSecPatientDetails(){
	$conn = connect();
    $id = $_POST['patientSecId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '4' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}	



function fetchSecDentistDetails(){
	$conn = connect();
    $id = $_POST['dentistSecId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '3' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}	




// Creating A New User
function dentistAdd(){
	$user_username=$_POST['user_username'];
	$user_password= 'password';
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
	$status = '1';
	$user_account = '1';

	$conn=connect();
	$sql = "INSERT INTO user (user_id,user_name,user_password,user_fname,user_lname,user_mi,user_email,user_dob,user_contact,user_gender,user_type,user_status,user_account, is_activated)
	 VALUES (NULL,'$user_username','$hash_pass','$user_firstname','$user_lastname','$user_mi','$user_email','$user_dob','$user_contact','$user_gender','$user_type','$status','$user_account', 1)";

	if(mysqli_query($conn,$sql)) {
		$last_id = mysqli_insert_id($conn);
		$secretaryId = $_POST['id'];
		$image = '';
		$license = '';

		$sql2= "INSERT INTO dentist (dentist_id,userId,secretary_Id,dentist_image,dentist_license) VALUES (
		NULL,'$last_id','$secretaryId','$image','$license')";

	 $result = mysqli_query($conn,$sql2);

	 if($result){
	 		$str = "Successfully Created A New Dentist Account";
		header("location:../views/secretaryDentistMasterlist.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   }
}





?>
