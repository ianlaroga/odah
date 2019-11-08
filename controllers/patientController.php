<?php require('connection.php'); ?>
<?php require('sessions.php'); ?>
<?php
	require  "../paymaya/sample/Checkout/User.php";
	use PayMaya\PayMayaSDK;
	use PayMaya\API\Checkout;
	use PayMaya\Model\Checkout\Item;
	use PayMaya\Model\Checkout\ItemAmount;
	use PayMaya\Model\Checkout\ItemAmountDetails;

if(isset($_POST['signupPatient'])){
	patientSignup();
}
if(!empty($_GET['pay'])){
	paymaya();
}
if(isset($_GET['cancelId'])){
	cancelAppointment($_GET['cancelId'], $_GET['clinicId']);
}
if(isset($_GET['activation_code'])){
	activateAccount($_GET['activation_code']);

	$str = "Your account has been activated. You can now login.";
	header("location:../views/home/home.php?success=".$str);
}
function paymaya(){

		PayMayaSDK::getInstance()->initCheckout("pk-lNAUk1jk7VPnf7koOT1uoGJoZJjmAxrbjpj6urB8EIA", 
												"sk-fzukI3GXrzNIUyvXY3n16cji8VTJITfzylz5o5QzZMC", 
												"SANDBOX");

		// Item
		$itemAmountDetails = new ItemAmountDetails();
		$itemAmountDetails->shippingFee = "00.00";
		$itemAmountDetails->tax = "00.00";
		$itemAmountDetails->subtotal = "100.00";
		$itemAmount = new ItemAmount();
		$itemAmount->currency = "PHP";
		$itemAmount->value = "100.00";
		$itemAmount->details = $itemAmountDetails;
		$item = new Item();
		$item->name = "Downpayment";
		$item->code = "downpayment";
		$item->description = "Downpayment fee for dental.";
		$item->amount = $itemAmount;
		$item->totalAmount = $itemAmount;

		// Checkout
		$itemCheckout = new Checkout();
		$user = new User();
		$itemCheckout->buyer = $user->buyerInfo();
		$itemCheckout->items = array($item);
		$itemCheckout->totalAmount = $itemAmount;
		$itemCheckout->requestReferenceNumber = "123456789";
		$itemCheckout->redirectUrl = array(
			"success" => "http://localhost/odah/odah/views/patientDentalRecord.php?status=success&id=" . $_GET['id'] ,
			"failure" => "http://localhost/odah/odah/views/patientDentalRecord.php?status=fail",
			"cancel" =>  "http://localhost/odah/odah/views/patientDentalRecord.php?status=cancel"
			);
		$itemCheckout->execute();
		$itemCheckout->retrieve();

		
		 echo "<script>window.location.href= '". $itemCheckout->url ."' </script>";

}
function cancelAppointment($id, $clinicId){
	$conn=connect();
	$sql = "UPDATE appointment set status = 'cancelled' WHERE appointment_id = '$id' ";
	$result = $conn->query($sql);

	$getUser = "SELECT * FROM appointment WHERE appointment_id = '$id' ";
	$getUserResult = $conn->query($getUser);

	$user = mysqli_fetch_assoc($getUserResult);
	
	if($result){
		$sqlUser = "SELECT * FROM appointment WHERE clinicId = '$clinicId' AND appointment_date = '$user[appointment_date]' AND user_id != '$user[user_id]' AND status = 'pending' ";
		$sqlResult = $conn->query($sqlUser);
		
		foreach($sqlResult as $row){

				$number = $row['patient_contact'];
				$message = $row['patient_name'] . " cancelled his/her schedule on ". date('F d, Y', strtotime($row['appointment_date']))  . " at" . $row['appointment_time'] . ".";
				$apicode = 'TR-IANSE126298_G8NWI';

				$ch = curl_init();
							$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
							curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
							curl_setopt($ch, CURLOPT_POST, 1);
							 curl_setopt($ch, CURLOPT_POSTFIELDS, 
							          http_build_query($itexmo));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_exec ($ch);
				            curl_close ($ch);

				
		}
		echo "<script>alert('Cancelled!')</script>";
		echo "<script>history.back()</script>";

	}

}
function activateAccount($code){
	$conn=connect();
	
	$sql = "UPDATE user SET is_activated = 1 WHERE verification_code = '$code' ";
	$conn->query($sql);

}
// Creating an Admin
function patientSignup(){
	$username=$_POST['username'];
	$user_password= $_POST['password'];
	$hash_pass= md5($user_password);
	$user_firstname=$_POST['firstname'];
	$user_lastname=$_POST['lastname'];
	$user_mi=$_POST['mi'];
	$user_email=$_POST['email'];
	$user_contact=$_POST['contact'];
	$user_dob=$_POST['dob'];
	$user_gender=$_POST['gender'];
	$age=$_POST['age'];
	$user_type = '4';
	$user_status = '2';
	$user_account = '1';
	$verification = rand();

	if($age < 18){
		echo "<script>alert('Age should be 18 and above in order to register in this system')</script>";
		echo "<script>history.back()</script>";
		
	}else{
		$conn=connect();
		$sqlCheck = "SELECT * FROM user WHERE user_email = '$user_email' ";
		$sqlResult = $conn->query($sqlCheck);

		if($sqlResult->num_rows > 0){
			echo "<script>alert('Email already taken!')</script>";
			echo "<script>history.back()</script>";
		}
	else{
	
	$sql = "INSERT INTO user (user_id,user_name,user_password,user_fname,user_lname,user_mi,user_email,user_contact,user_dob,user_gender,user_type,user_status,user_account, verification_code)
	 VALUES (NULL,'$username','$hash_pass','$user_firstname','$user_lastname','$user_mi','$user_email','$user_contact','$user_dob' ,'$user_gender','$user_type','$user_status','$user_account', '$verification')";


	if(mysqli_query($conn,$sql)) {
		$last_id = mysqli_insert_id($conn);
		$clinic_id = '';

		sendEmail($verification,$user_email);
	
		$sql2= "INSERT INTO patient (patientId,userId,clinicID) VALUES (
		NULL,'$last_id','$clinic_id')";

	 $result = mysqli_query($conn,$sql2);

	 if($result){
		 
	 		$str = "Successfully Created New Account. Please click actication link in your email to verify account. Thank you!";
		header("location:../views/home/home.php?success=".$str);
	 }else{
	 	echo "ERROR!". mysqli_error($conn);
	 }
   }
}
}
}

function sendEmail($verification,$email){

			require '../mailer/PHPMailerAutoload.php';
			require '../mailer/credential.php';

			$mail = new PHPMailer;

			// $mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'ADMINISTRATOR');
			$mail->addAddress($email);     // Add a recipient
         // Name is optional
			$mail->addReplyTo(EMAIL);
		 
			$mail->isHTML(true);                                  // Set email format to HTML
			$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "?activation_code=" . $verification ;
			$mail->Subject = 'ODAH Account Verification';
			$mail->Body    = "Thank you for registering Online Dental Appointment Hub! Please click <a href='" .$url ."'>here</a> to activate your account.";
		

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
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
