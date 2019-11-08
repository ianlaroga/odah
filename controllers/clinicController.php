<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php


if (isset($_POST['clinicId'])){
	fetchClinicID();
}


if(isset($_POST['updateClinic'])){
  clinicUpdate();
}



function clinicUpdate(){
	$conn = connect();

	$id=$_POST['clinic'];
	$name =$_POST['clinic_name'];
	$contact =$_POST['clinic_contact'];
	$address =$_POST['clinic_address'];
	$dayStart =$_POST['start_day'];
	$dayEnd =$_POST['end_day'];
	$timeStart =$_POST['start_time'];
	$timeEnd =$_POST['end_time'];

	$city = $_POST['clinic_city'];
	$phone = $_POST['clinic_phone'];
	$dayStart2 =$_POST['start_day_2'];
	$dayEnd2 =$_POST['end_day_2'];
	$timeStart2 =$_POST['start_time_2'];
	$timeEnd2 =$_POST['end_time_2'];
	$lat =$_POST['lat'];
	$lng =$_POST['lng'];



	$permit = $_POST['orig_permit'];
		//check if file uploaded exists and there are no errors during upload
		if(isset($_FILES['permit']) && $_FILES['permit']['error'] == 0){

			if($_FILES['permit']['type'] == "image/png" || $_FILES['permit']['type'] == "image/jpeg") {

				if($_FILES['permit']['type'] < 10000000){
					//define the new location and name of the photo (images/1001_mypic.png)
					$permit = "../images/" .$name."_".$_FILES['permit']['name'];
					//tell PHP to move the file from where and to where
					move_uploaded_file($_FILES['permit']['tmp_name'], $permit);	
				}
			}
		}

	$image = $_POST['orig_image'];
		//check if file uploaded exists and there are no errors during upload
		if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

			if($_FILES['image']['type'] == "image/png" || $_FILES['image']['type'] == "image/jpeg") {

				if($_FILES['image']['type'] < 10000000){
					//define the new location and name of the photo (images/1001_mypic.png)
					$image = "../images/" .$name."_".$_FILES['image']['name'];
					//tell PHP to move the file from where and to where
					move_uploaded_file($_FILES['image']['tmp_name'], $image);	
				}
			}
		}

	$sql = "UPDATE `clinic` SET `clinic_name` = '$name', `clinic_location` = '$address', `clinic_contact` = '$contact', `start_day` = '$dayStart' , `end_day` = '$dayEnd' , `start_time` = '$timeStart' , `end_time` = '$timeEnd' , `clinic_image` = '$image', `clinic_permit1` = '$permit', `clinic_city` = '$city', `clinic_phone` = '$phone', `start_day_2` = '$dayStart2', `end_day_2` = '$dayEnd2', `start_time_2` = '$timeStart2', `end_time_2` = '$timeEnd2', `lat` = '$lat', `lng` = '$lng' WHERE `clinic_id` = '$id' ";
    $result = mysqli_query($conn, $sql);

    
 
	if($result){
			$str ="Updated The Clinic Information";
        header("Location:../views/secretaryViewClinic.php?viewClinicId=$id?success=".$str);
    }else{
        echo "ERROR!" .mysqli_error($conn);
    }
}


//View Data for Clinic
function fetchClinicID(){
	$conn = connect();
    $id = $_POST['clinicId'];
    $sql = "SELECT * FROM clinic JOIN dentist ON clinic.dentistId = dentist.dentist_id JOIN user ON clinic.secretaryId = user.user_id WHERE clinic_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo json_encode($row);
}

?>
