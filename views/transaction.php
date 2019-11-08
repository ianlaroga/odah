<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <?php 

$conn = connect();

$sql = "SELECT * FROM appointment JOIN clinic ON clinic.clinic_id = appointment.clinicId JOIN user ON appointment.user_id = user.user_id ";
$result = mysqli_query($conn,$sql);

?>

 <div id="content-wrapper">

  <div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Transaction</li>
  </ol>

  <?php
                if (isset($_GET['danger'])){
                    $danger = $_GET['danger'];   
                    echo '<div class="alert alert-danger text-center">';
                    echo $danger;
                    echo '</div>';
                }

                 if (isset($_GET['error'])){
                    $error = $_GET['error'];   
                    echo '<div class="alert alert-danger text-center">';
                    echo $error;
                    echo '</div>';
                }

                if (isset($_GET['success'])){
                    $success = $_GET['success'];
                    echo '<div class="alert alert-success text-center">';
                    echo $success;
                    echo '</div>';
                }
    ?>

  
  <!-- DataTables Example -->
  <div class="card mb-3">
   
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Patient Fullname</th>
              <th>Clinic Name</th>
              <th>Patient Type</th>
              <th>Appointment Date</th>
              <th>Clinic Services</th>
              <th>Status</th>
            </tr>
          </thead>
           <tbody align="center">
                <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                    <td><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></td>

                    <td><?php echo $row['clinic_name']; ?></td>
                    <td><?php echo $row['patient_type']; ?></td>
                     
                    <td><?php echo $row['appointment_date']; ?></td>
                
                    <td><?php echo $row['clinic_services']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                                    </tr>
                               <?php        } ?>
                                    </form>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
      <!-- /.container-fluid -->


      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><h5><b>Dental Clinic Management System</h5></b></span>
          </div>
        </div>
      </footer>


</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>


<!--View Patient Information-->
<div class="modal fade" id="viewPatientDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Patient Details</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="" method="POST" onsubmit="return confirm('Are you sure?')">
             <div class="form-group">
                  <div class="row">
                    <div class="col-lg-5">
                        <h6>Full Name:</h6>
                           <p class="patient_fullname"></p> 
                          </div>
                           <div class="col-lg-4">
                        <h6>Email Address:</h6>
                           <p class="patient_email"></p>
                          </div>
                        </div>
                      </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-5">
                        <h6>Contact Number:</h6>
                           <p class="patient_contactNumber"></p> 
                          </div>
                           <div class="col-lg-4">
                        <h6>Birthday:</h6>
                           <p class="patient_dob"></p>
                          </div>
                           <div class="col-lg-2">
                            <h6>Age:</h6>
                           <p class="patient_contactNumber"></p> 
                          </div>
                        </div>
                      </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                        <h6>Gender:</h6>
                           <p class="patient_gender"></p> 
                          </div>
                        </div>
                      </div>

                
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
        </div>
    </div>
</div>
</div>
<!-- end view info for admin -->


<?php require('footer.php'); ?>




