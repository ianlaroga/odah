<?php session_start();

function setSession($id,$username,$usertype,$fname,$lname,$mi){
	$_SESSION["user_id"] =$id;
	$_SESSION["user_name"] =$username;
	$_SESSION["user_type"]=$usertype;
	$_SESSION["user_fname"]=$fname;
	$_SESSION["user_lname"]=$lname;
	$_SESSION["user_mi"]=$mi;
}


function unsetSession(){
	session_unset();
	session_destroy(); 
}

?>