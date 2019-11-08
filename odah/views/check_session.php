<?php

if(!isset($_SESSION['user_type'])){ //if login in session is not set
    header("Location: login.php");
}
?>  