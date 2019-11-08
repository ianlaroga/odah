<?php require('../controllers/sessions.php'); ?>
<?php require('check_session.php'); ?>
<?php require('../controllers/connection.php');?>
<?php 
$conn = connect();

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM user WHERE user_id = '$id' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<body id="page-top">

  <nav class="navbar navbar-expand navbar-light bg-dark static-top">
    <a class='navbar-brand mr-1' href='index.php' style='color:white'>Online Dental Appointment Hub</a>
    <div class="d-none d-md-inline-block inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
          <i class="fa fa-user-circle fa-fw"></i> <?php echo $row["user_fname"];?> <?php echo $row["user_mi"];?> <?php echo $row["user_lname"];?>
          <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php if($_SESSION['user_type'] == 1){
          echo "<a class='dropdown-item' href='adminSettings.php'>Admin Settings</a>";
          echo "<hr>";
          }?>  
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myInfo">My Info</a> 
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword">Change Password</a>
          <hr>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="text-align:center">Sign Out</a>
        </div>
      </li>
     </ul>
    </div>
  </nav>

  <div id="wrapper">


    <!-- Admin Side Navigation -->
    <?php if($_SESSION['user_type'] == 1){ ?>
      <ul class='sidebar navbar-nav bg-default'>
        <!-- <li class='nav-item'>
           <a class='nav-link' style='color:white' href='#'>
           <i class='fas fa-user'></i>
             <span>Admin Dashboard</span>
           </a>
         </li> -->
        <li class='nav-item'>
          <a class='nav-link' style='color:white' href='adminDentalClinic.php'>
          <i class='fas fa-clinic-medical'></i>
            <span>Dental Clinic</span>
          </a>
        </li>
      <li class='nav-item '>
        <a class='nav-link' style='color:white' href='adminMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Admin Masterlist</span></a>
      </li>

     <li class='nav-item '>
        <a class='nav-link' style='color:white' href='adminDentistMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Dentist Masterlist</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='adminSecretaryMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Secretary Masterlist</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='adminPatientMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Patient Masterlist</span></a>
      </li>

      <li class='nav-item'>
      <a class='nav-link' style='color:white' href='transaction.php'>
      <i class='fas fa-book'></i>
        <span>Transaction</span></a>
    </li>
    </ul>
    <?php  } ?>
    <!-- Secretary Side Navigation -->
   <?php if($_SESSION['user_type'] == 2){ ?>
        <ul class='sidebar navbar-nav bg-dark'>
       <!-- <li class='nav-item '>
         <a class='nav-link' style='color:white'  href='#'>
         <i class='fas fa-user'></i>
           <span>Secretary Dashboard</span>
         </a>
       </li> -->
      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='secretaryAppointmentMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Appointment Masterlist</span></a>
      </li>

      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='secretaryDentistMasterlist.php'>
        <i class='fas fa-book'></i>
          <span>Dentist Masterlist</span></a>
      </li>

 
      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='secretaryClinicMasterList.php'>
        <i class='fas fa-book'></i>
          <span>Clinic Masterlist</span></a>
      </li>

  </ul> 
 <?php } ?> 

     <!-- Dentist Side Navigation -->
    <?php if($_SESSION['user_type'] == 3){ ?>
         <ul class='sidebar navbar-nav bg-dark'>
         <!-- <li class='nav-item ''>
         <a class='nav-link' style='color:white' href='#'>
           <i class='fas fa-user'></i>
           <span>Dentist Dashboard</span>
         </a>
       </li> -->

      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='dentistDentalRecord.php'>
          <i class='fas fa-book'></i>
          <span>Dental Record</span></a>
      </li>
    </ul> 
   <?php } ?>

    <!-- Patient Side Navigation -->
    <?php if($_SESSION['user_type'] == 4){ ?>
    <ul class='sidebar navbar-nav bg-dark'>
      <!-- <li class='nav-item '>
         <a class='nav-link' style='color:white' href='#'>
           <i class='fas fa-user'></i>
          <span>Patient Dashboard</span>
         </a>
       </li> -->
      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='patientDentalRecord.php'>
          <i class='fas fa-book'></i>
          <span>Patient Appointments</span></a>
      </li>  

      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='patientDentalHistory.php'>
          <i class='fas fa-book'></i>
          <span>Patient Dental History</span></a>
      </li>  


      <li class='nav-item'>
        <a class='nav-link' style='color:white' href='home/home.php'>
          <i class='fas fa-book'></i>
          <span>Search Clinics</span></a>
      </li>  
    </ul>
  <?php  } ?>
  


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
  </div>
  <div class="modal-body">Are You Done? Please click the logout button</div>
  <div class="modal-footer">
    <a class="btn btn-success" href="logout.php">Logout</a>
    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
  </div>
</div>
</div>
</div>

<!-- Update User -->
<div class="modal fade" id="myInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">My Info</h5>
      </div>




<div class="modal-body">
  <div class="container">
    <div class="row">
        <form role="form" action="../controllers/userController.php" method="POST">

    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

     <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Username:</label>  
              <input type="text" class="form-control input-field" name="user_name" value="<?php echo $row['user_name']?>">
            </div>
          </div>
      </div>
      
      <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <label>First Name:</label>  
              <input type="text" class="form-control input-field" name="user_fname" value="<?php echo $row['user_fname']?>">
            </div>

            <div class="col-md-4">
              <label>Last Name:</label>  
              <input type="text" class="form-control input-field" name="user_lname" value="<?php echo $row['user_lname']?>">
            </div>

            <div class="col-md-4">
              <label>Mi:</label>  
              <input type="text" class="form-control input-field" name="user_mi" value="<?php echo $row['user_mi']?>">
            </div>
          </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-5">
           <label>Contact Number:</label>
            <input type="text" class="form-control input-field" name="user_contact" value="<?php echo $row['user_contact']?>">
          </div>

          <div class="col-md-4">
           <label>Birthday:</label>
            <input type="text" class="form-control input-field" id="dob" name="user_dob" value="<?php echo $row['user_dob']?>">
          </div>
    
          <div class="col-md-2">
           <label>Age:</label>
            <input type="text" class="form-control input-field" id="age"  disabled>
          </div>
      </div>
    </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
           <label>Email Address:</label>
            <input type="email" class="form-control input-field" name="user_email" value="<?php echo $row['user_email']?>">
          </div>

          <div class="col-md-4">
           <label>Gender:</label>
             <select class="form-control" name="user_gender">
                     <option hidden value="<?php echo $row['user_gender'] ?>">
                      <?php
                      echo $row['user_gender'];
                      ?></option>
                     <option value="Male">Male</option>
                     <option value="Female">Female</option>
                     <option value="Other">Other</option>
                </select>
          </div>
      </div>
    </div>


    <div class="modal-footer">
            <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
        </form>
      </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End Update User Modal -->

<!-- Change Password Modal For User -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
      </div>

<?php 
$conn = connect();
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE user_id = '$id' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>


<div class="modal-body">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form role="form" action="../controllers/userController.php" method="POST">

     <input type="hidden" name="user_id" value="<?php echo $id; ?>">
      
      <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <label>Old Password:</label>  
              <input type="password" id="currentPassword" class="form-control input-field" name="current_password">
            </div>
          </div>
      </div>

      <hr>

      <div class="form-group">
        <div class="row">
        <div class="col-md-8">
          <label>New Password:</label>
            <input type="password" id="newPassword" class="form-control input-field" name="new_password">
          </div>
        </div>
      </div>

      <div class="form-group">
      <div class="row">
        <div class="col-md-8">
          <label>Confirm New Password:</label>
            <input type="password" id="conNewPassword" class="form-control input-field" name="comfirm_password">
          </div>
        </div>
      </div>

    <div class="modal-footer">
            <button type="submit" name="changePasswordUser" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
        </form>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End Change Password -->

<script>
  var dob= new Date(document.getElementById("dob").value);
  
   var ageDifMs = Date.now() - dob.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    var age = Math.abs(ageDate.getUTCFullYear() - 1970);
    document.getElementById("age").value = age;
</script>

