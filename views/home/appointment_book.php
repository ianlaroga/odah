<?php
require("../../controllers/connection.php");
session_start();
$conn = connect();
$id = $_GET['bookID'];
$sql = "SELECT * FROM clinic WHERE clinic_id = '$id' ";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $clinic_id   = $row['clinic_id'];
    $clinic_name = $row['clinic_name'];
}

$sqlService = "SELECT * FROM services WHERE clinicId = '$id' ";
$sqlResult = $conn->query($sqlService);

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Online Dental Appointment Hub</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/full.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Book An Appointment</h1>
          <p style="color:black">Please fill up this appointment form.</p>   
          <form action="../../controllers/secretaryController.php" method="POST" style="border:0"> 

           <input type="hidden" name="clinic_id" value="<?php echo $clinic_id?>">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'];?>">


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                          <legend style="color:black">Patient Name:</legend>
                            <input type="text" name="patient_name" placeholder="Enter Patient Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                          <legend style="color:black">Patient Type:</legend>
                            <select name="patient_type" style="margin-top: 15px" class="form-control">
                              <option value="adult">Adult</option>
                              <option value="child">Child</option>
                            </select>
                        </div>
                    </div>
                  </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                          <legend style="color:black">Email Address:</legend>
                            <input type="email" name="email" placeholder="Enter Patient Email" class="form-control" required>
                        </div>
                      </div>

                      <div class="col-md-6">
                         <div class="form-group">
                          <legend style="color:black">Contact Number:</legend>
                            <input type="number" name="contact" placeholder="Enter Contact Number" class="form-control" required>
                        </div>
                    </div>
                  </div>

                <h1>Appointment Details</h1>

              <div class="row">

                  
                  <div class="col-md-6">
                    <div class="form-group">
                        <legend style="color:black">Date</legend>
                            <input type="date" name="date" min="<?php echo date('Y-m-d', time() + 86400); ?>" placeholder="Enter Date" class="form-control" required>
                        </div>
                    </div>

                     <div class="col-md-6">
                    <div class="form-group">
                       <legend style="color:black">Time:</legend>
                        <select class="form-control" name="time">
                              <option disabled selected>Select A Time:</option>
                              <option value="9:00 AM">9:00 AM</option>
                              <option value="10:00 AM">10:00 AM</option>
                              <option value="11:00 AM">11:00 AM</option>
                              <option value="12:00 PM">12:00 PM</option>
                              <option value="1:00 PM">1:00 PM</option>
                              <option value="2:00 PM">2:00 PM</option>
                              <option value="3:00 PM">3:00 PM</option>
                              <option value="4:00 PM">4:00 PM</option>
                              <option value="5:00 PM">5:00 PM</option>
                              <option value="6:00 PM">6:00 PM</option>
                              <option value="7:00 PM">7:00 PM</option>
                              <option value="8:00 PM">8:00 PM</option>
                              <option value="9:00 PM">9:00 PM</option>
                              <option value="10:00 PM">10:00 PM</option>
                           </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <legend style="color:black">Services:</legend>
                             <select class="form-control" name="services">
                               <option disabled selected>Select A Services:</option>
                              <?php foreach($sqlResult as $row){ ?>
                              <option value="<?php echo $row['services_name']; ?>"><?php echo $row['services_name']; ?></option>
                             
                            <?php } ?>
                             
                             
                           </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                        <legend style="color:black">Clinic Name:</legend>
                            <input type="text" value="<?php echo $clinic_name ?>"  class="form-control" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                            <input type="checkbox" id="toggle" checked=><small>I hereby give my full consent having reviewed and understood the Data Privacy Notice of <?php echo $clinic_name ?> to allow the company to process my data in accordance to the Data Privacy Act of 2012.</small>
                            <a href="view_data_privacy.php?privacyID=<?php echo $clinic_id ?>">Click here To Review Data Privacy Note of <?php echo $clinic_name ?></a> 
                        </div>
                    </div>
                </div>

               
                       <div class="form-group" align="center">
                            <button type="submit" name="bookAppointment" id="bookAppointment" class="btn btn-info">Submit</button>
                            <a href="home.php" class="btn btn-danger" value="Cancel">Cancel</a>
                        </div>
              </form>

 <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  $('#toggle').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {
        
        $('#bookAppointment').removeAttr('disabled'); //enable input
        
    } else {
        $('#bookAppointment').attr('disabled', true); //disable input
    }
});
</script>



</body>
</html>


