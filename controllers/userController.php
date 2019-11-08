<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php

// User Login - this is for all the users
if(isset($_POST['loginUser'])){
	userLogin();
}

// User Update - this is for updating all the users info
if(isset($_POST['updateUser'])){
  userUpdate();
}

if(isset($_GET['enableClinicId'])){
  enableClinic();
}

// User Changepassword - this if for changing the password for all the users
if(isset($_POST['changePasswordUser'])){
		changeUserPassword();
}

// View Details - this is for Clinic Dental Masterlist 
if(isset($_POST['clinicId'])){
  fetchClinicDetails();
}

// View Details - this is for Admin Masterlist 
if(isset($_POST['adminId'])){
  fetchAdminDetails();
}

// View Details - this is for Patient Masterlist 
if(isset($_POST['patientId'])){
  fetchPatientDetails();
}

// View Details - this is for Secretary Masterlist 
if(isset($_POST['secretaryId'])){
  fetchSecretaryDetails();
}

// View Details - this is for Dentist Masterlist 
if(isset($_POST['dentistId'])){
  fetchDentistDetails();
}

// Disable Dentist
if(isset($_GET['disableDentistId'])){
	dentistDisable();
}

// Disable Patients
if(isset($_GET['disablePatientId'])){
	patientDisable();
}

// Disable Secretary
if(isset($_GET['disableSecretaryId'])){
	secretaryDisable();
}

// Disable Secretary
if(isset($_GET['disableAdminId'])){
	adminDisable();
}

// Enable Accounts
if(isset($_GET['enableAccountId'])){
	accountEnable();
}

// Delete Accounts 
if(isset($_GET['deleteAccountId'])){
  accountDelete();
}

function enableClinic(){
  $conn = connect();
  $id = $_GET['enableClinicId'];
  $sql = "UPDATE `clinic` SET `clinic_account`= '1' WHERE `clinic_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
  		$str ="Clinic Disabled";
      header("Location:../views/adminDentalClinic.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }
}
function fetchClinicDetails(){
  $conn = connect();
    $id = $_POST['clinicId'];
    $sql = "SELECT * FROM clinic JOIN user ON clinic.secretaryId = user.user_id
    WHERE clinic_id = '$id' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
} 


function fetchAdminDetails(){
	$conn = connect();
    $id = $_POST['adminId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '1' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}	

function fetchDentistDetails(){
	$conn = connect();
    $id = $_POST['dentistId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '3' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}	

function fetchSecretaryDetails(){
	$conn = connect();
    $id = $_POST['secretaryId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '2' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}

function fetchPatientDetails(){
	$conn = connect();
    $id = $_POST['patientId'];
    $sql = "SELECT * FROM user WHERE user_id = $id AND user_type = '4' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}

function adminDisable(){
  $conn = connect();
  $id = $_GET['disableAdminId'];
  $sql = "UPDATE `user` SET `user_account`= '0' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
        $str = "Admin Account is Disabled";
      header("Location:../views/adminMasterlist.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function dentistDisable(){
  $conn = connect();
  $id = $_GET['disableDentistId'];
  $sql = "UPDATE `user` SET `user_account`= '0' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
        $str = "Dentist Account is Disabled";
      header("Location:../views/adminDentistMasterlist.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function secretaryDisable(){
  $conn = connect();
  $id = $_GET['disableSecretaryId'];
  $sql = "UPDATE `user` SET `user_account`= '0' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
      $str = "Secretary Account is Disabled";
      header("Location:../views/adminSecretaryMasterlist.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function patientDisable(){
  $conn = connect();
  $id = $_GET['disablePatientId'];
  $sql = "UPDATE `user` SET `user_account`= '0' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
        $str= "Patient Account is Disabled";
      header("Location:../views/adminPatientMasterlist.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function accountEnable(){
  $conn = connect();
  $id = $_GET['enableAccountId'];
  $sql = "UPDATE `user` SET `user_account`= '1' WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
        $str = "This Account is Enabled";
      header("Location:../views/adminSettings.php?success=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}

function accountDelete(){
  $conn = connect();
  $id = $_GET['deleteAccountId'];
  $sql = "DELETE FROM `user` WHERE `user_id` = '$id' ";
  $result = mysqli_query($conn, $sql);

  if($result){
        $str = "Account Remove";
      header("Location:../views/adminSettings.php?danger=".$str);
    }else{
      echo "ERROR!" .mysqli_error($conn);
    }

}


function changeUserPassword(){
	$conn = connect();
	$id = $_POST['user_id'];
	$current = md5($_POST['current_password']);
	$new = md5($_POST['new_password']);
	$comfirm = md5($_POST['comfirm_password']);

	if($new == $comfirm){
		$sql = "SELECT * FROM user WHERE user_id ='$id' AND user_password = '$current' ";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);

		if($row[0] == $id && $row[2] == $current){
			$sql = "UPDATE user SET user_password = '$new' WHERE user_id = '$id' ";
			$result = mysqli_query($conn,$sql);

			if($result){
				$str = "User Password Successfully Changed";
				header("Location:../views/index.php?success=".$str);
			}else{
				echo "ERROR!". mysqli_error($conn);
			}

		}else{
			$str = "Wrong Current Password";
			header("Location:../views/index.php?error=".$str);
		}
	}else{
		$str = "Password not match!";
		header("Location:../views/index.php?error=".$str);
	}

} 

function userUpdate(){
	$conn = connect();
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$user_lname = $_POST['user_lname'];
	$user_fname = $_POST['user_fname'];
	$user_mi = $_POST['user_mi'];
	$user_email = $_POST['user_email'];
	$user_contact = $_POST['user_contact'];
	$user_dob = $_POST['user_dob'];
	$user_gender = $_POST['user_gender'];
	$sql = "UPDATE `user` SET `user_name` = '$user_name', `user_lname` = '$user_lname', `user_fname` = '$user_fname', `user_mi` = '$user_mi', `user_email` = '$user_email', `user_contact` = '$user_contact', `user_dob` = '$user_dob', `user_gender` = '$user_gender' WHERE `user_id` = '$user_id' ";
    $result = mysqli_query($conn, $sql);

      print_r($sql);
	if($result){
          $str = "User information is successfully updated";
        header("Location:../views/index.php?success=".$str);
    }else{
        echo "ERROR!" .mysqli_error($conn);
    }
}


function userLogin(){
	$username=$_POST['user_name'];
	$password= md5($_POST['user_password']);
	$secret = "secretAdmin";
	$conn=connect();
	$sql = "SELECT * FROM user WHERE user_name='$username' AND user_password='$password' AND user_account = 1 LIMIT 1";
	$result= mysqli_query($conn,$sql);

	 if (mysqli_num_rows($result) > 0) {
    
	 	while($row = mysqli_fetch_assoc($result)) {
   
		if($row['is_activated'] == 1){

     
      setSession($row['user_id'],$row['user_name'],$row['user_type'],$row['user_fname'],$row['user_lname'],$row['user_mi'],$row['user_addName'],$secret);
        $str = "";
      header('Location:../views/index.php?success='.$str);
    }else{
      $error =  "Please click activation link in your email to verify account!";
      header('Location:../views/home/home.php?error='.$error);

    }
	 	}
	 } else {
		$error =  "Incorrect Username and/or Password!";
	 	header('Location:../views/home/home.php?error='.$error);
	 }
	 	mysqli_close($conn);
}
?>
