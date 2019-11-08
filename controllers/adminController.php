<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php

// Add New Admin
if(isset($_POST['addAdmin'])){
	adminAdd();
}

// Add New Secretary
if(isset($_POST['addSecretary'])){
	secretaryAdd();
}

// Accepted Clinic
if(isset($_GET['acceptClinicId'])){
	clinicAccept();
}

// Disable Clinic
if(isset($_GET['disableClinicId'])){
	clinicDisable();
}

// Declined Clinic
if(isset($_GET['declineClinicId'])){
	clinicDecline();
}

// Enable Clinic
if(isset($_GET['enableClinicId'])){
  clinicEnable();
}

// Delete Accounts 
if(isset($_GET['deleteClinicId'])){
	clinicDelete();
}


function clinicEnable(){
  $conn = connect();
  $id = $_GET['enableClinicId'];
  $sql = "UPDATE `clinic` SET `clinic_account`= '1' WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  var_dump($sql);
  if($result){
  		$str = "Clinic Enabled";
      header("Location:../views/adminSettings.php?success=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function clinicDelete(){
  $conn = connect();
  $id = $_GET['deleteClinicId'];
  $sql = "DELETE FROM `clinic` WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  var_dump($sql);
  if($result){
  		$str = "Clinic Remove from the system";
      header("Location:../views/adminSettings.php?danger".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}


function clinicAccept(){
  $conn = connect();
  $id = $_GET['acceptClinicId'];
  $sql = "UPDATE `clinic` SET `clinic_status`= '1' WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
  		$str = "This clinic is approved";
      header("Location:../views/adminDentalClinic.php?success=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function clinicDecline(){
  $conn = connect();
  $id = $_GET['declineClinicId'];
 $sql = "UPDATE `clinic` SET `clinic_status`= '0' WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
  		$str ="This clinic is declined";
      header("Location:../views/adminDentalClinic.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function clinicDisable(){
  $conn = connect();
  $id = $_GET['disableClinicId'];
  $sql = "UPDATE `clinic` SET `clinic_account`= '0' WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
  		$str ="Clinic Disabled";
      header("Location:../views/adminDentalClinic.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }
}

function adminAdd(){
	$user_username=$_POST['user_username'];
	$user_password= 'password';
	$hash_pass= md5($user_password);
	$user_firstname=$_POST['user_firstname'];
	$user_lastname=$_POST['user_lastname'];
	$user_mi=$_POST['user_mi'];
	$user_email=$_POST['user_email'];
	$user_contact=$_POST['user_contact'];
	$user_dob=$_POST['user_dob'];
	$user_age=$_POST['user_age'];
	$user_contact=$_POST['user_contact'];
	$user_gender=$_POST['user_gender'];
	$user_type='1';
	$user_account = '1';


	$conn=connect();
	
	$sql = "INSERT INTO user (user_id,user_name,user_password,user_fname,user_lname,user_mi,user_email,user_dob,user_age,user_contact,user_gender,user_type,user_account, is_activated)
	 VALUES (NULL,'$user_username','$hash_pass','$user_firstname','$user_lastname','$user_mi','$user_email','$user_dob','$user_age','$user_contact','$user_gender','$user_type','$user_account', 1)";

	$result = mysqli_query($conn, $sql);
	if($result){
			$str = "Successfully Created New Administrator Account ";
		header("location:../views/adminMasterlist.php?success=".$str);
	}else{
		echo "ERROR!". mysqli_error($conn);
	}
}



function secretaryAdd(){

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
	$user_age=$_POST['user_age'];
	$user_gender=$_POST['user_gender'];
	$user_type='2';
	$status = '1';
	$user_account = '1';


	$conn=connect();
	
	$sql = "INSERT INTO user (user_id,user_name,user_password,user_fname,user_lname,user_mi,user_email,user_dob,user_contact,user_age,user_gender,user_type,user_status,user_account, is_activated)
	 VALUES (NULL,'$user_username','$hash_pass','$user_firstname','$user_lastname','$user_mi','$user_email','$user_dob','$user_contact','$user_age','$user_gender','$user_type','$status','$user_account', 1)";

	if(mysqli_query($conn,$sql)) {
		$last_id = mysqli_insert_id($conn);
		$clinic_name = '';
		$clinic_location = '';
		$clinic_contact = '';
		$dayStart = '';
		$dayEnd = '';
		$timeStart = '';
		$timeEnd = '';
		$dentistId = '';
		$clinic_image = '';
		$clinic_permit1 = '';
		$clinic_status = '2';
		$clinic_account = '1';


		$sql2= "INSERT INTO clinic (clinic_id,secretaryId,clinic_name,clinic_location,clinic_contact,start_day,end_day,start_time,end_time,dentistId,clinic_image,clinic_permit1,clinic_status,clinic_account) VALUES (
		NULL,'$last_id','$clinic_name','$clinic_location','$clinic_contact','$dayStart','$dayEnd',
		'$timeStart','$timeEnd','$dentistId','$clinic_image','$clinic_permit1','$clinic_status','$clinic_account')";

	 $result = mysqli_query($conn,$sql2);
	 $clin_id = $conn->insert_id;
	 $sql3 = "INSERT INTO rating(rating_number,clinic_id) VALUES('5', '$clin_id') ";
	 $conn->query($sql3);

	 $sql4 = "INSERT INTO services(services_name,clinicId) VALUES('Tooth Extraction', '$clin_id') ";
	 $conn->query($sql4);

	 if($result){
	 		$str = "Successfully Create New Secretary Account";
		header("location:../views/adminSecretaryMasterlist.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   }
}



?>
