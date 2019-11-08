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
	<!--Registration Form-->
<!--Registration Form-->
    <div class="container">
      <form action="../../controllers/patientController.php" method="POST" style="border:0">
        <h1>Registration Form</h1>
          <p style="color:black">Please fill in this form to create an account.</p>   

           <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <legend style="color:black">Username:</legend>
                            <input type="text" name="username" placeholder="Enter Username" class="form-control" required>
                        </div>
                    </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <legend style="color:black">Password:</legend>
                            <input type="password" minlength="8" name="password" placeholder="Enter Password" class="form-control" required>
                        </div>
                    </div>
                </div>

        
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                          <legend style="color:black">First Name:</legend>
                            <input type="text" name="firstname" placeholder="Enter First Name" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                                 <div class="form-group">
                                    <legend style="color:black">Last Name:</legend>
                                 <input type="text" name="lastname" placeholder="Enter Last Name" class="form-control" required>
                            </div>
                      </div>

                        <div class="col-md-4">
                                 <div class="form-group">
                                    <legend style="color:black">Middle Name:</legend>
                                 <input type="text" name="mi" placeholder="Enter Middle Name" class="form-control">
                            </div>
                        </div>

                    </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <legend style="color:black">Email Address:</legend>
                            <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required>
                        </div>
                    </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <legend style="color:black">Contact Number</legend>
                            <input type="text" pattern="\d*" maxlength="11" minlength="11" name="contact" placeholder="Enter Contact Number" class="form-control" required>
                        </div>
                    </div>
                </div>

                 <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <legend style="color:black">Date Of Birth:</legend>
                            <input type="date" max="<?php echo date('Y-m-d'); ?>" name="dob" id="dob" onchange="calculate()" placeholder="Enter Date of Birth" class="form-control" required>
                        </div>
                    </div>
                     <div class="col-md-4">
                    <div class="form-group">
                          <legend style="color:black">Age</legend>
                            <input type="number" name="age" class="form-control" id="age" readonly>
                        </div>
                    </div>
                     <div class="col-md-4">
                    <div class="form-group">
                        <legend style="color:black">Gender</legend>
                           <select class="form-control" name="gender">
                                <option disabled selected>Select A Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                   
                </div>

             
                        <div class="form-group" align="center">
                            <button type="submit" class="btn btn-info" name="signupPatient">Submit</button>
                            <a href="home.php" class="btn btn-danger" value="Cancel">Cancel</a>
                        </div>
               </form>

 <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
        function calculate(){
              var dob = $('#dob').val();
              
              var today = new Date();
              var birthDate = new Date(dob);
              var age = today.getFullYear() - birthDate.getFullYear();
              var m = today.getMonth() - birthDate.getMonth();
              if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                  age = age - 1;
              }

              $('#age').val(age);
        }

  </script>
</body>

</html>
