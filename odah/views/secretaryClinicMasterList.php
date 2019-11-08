<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <?php 

$conn = connect();

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM clinic 
JOIN branch ON clinic.clinic_branch = branch.branch_id  
WHERE secretaryId = '$id'";
$result = mysqli_query($conn,$sql);

$id1 = $_SESSION['user_id'];
$sql1 = "SELECT * FROM clinic WHERE secretaryId = '$id'";
$result1 = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_assoc($result1)){
  $id = $row1['clinic_id'];
}


?>

 <div id="content-wrapper">

  <div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Patient List Masterlist</li>
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
              <th>Clinic Name</th>
              <th>Branch</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
           <tbody align="center">
                <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";

                  if($row['clinic_name'] == '') {
                      echo "<td>Add Clinic Name</td>";
                     }else{
                      echo "<td>{$row['clinic_name']}</td>";
                     }

                  if($row['branch_id'] == 0) {
                      echo "<td>Main Branch</td>";
                     }else{
                      echo "<td>{$row['branch_name']}</td>";
                     }

                    if($row['clinic_status'] == '0') {
                       echo "<td><span class='badge badge-danger'>Not Accepted</span></td>";
                    }

                    if($row['clinic_status'] == '1') {
                       echo "<td><span class='badge badge-success'>Accepted</span></td>";
                    }

                    if($row['clinic_status'] == '2') {
                       echo "<td><span class='badge badge-primary'>Pending</span></td>";
                    }
                 
                    echo "<td>";
                    echo "<div class='btn-group'>";

                    echo "<a class='' href='secretaryViewClinic.php?viewClinicId={$row['clinic_id']}'><button type='submit' class='btn btn-success' onclick='return confirm('Are you sure?')'>View Clinic</button> </a>";
               
                  
                                           echo "</div>";
                                      echo "</td>";
                                    echo "</tr>"; 
                                       } ?>
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

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.viewPatientDetails', function(){
        var patientId = $(this).attr("id");
         $.ajax({
             url:"../controllers/userController.php",
             method:"POST",
             data:{patientId:patientId},
             dataType:"json",
             success:function(data){
                $('.user_id').html(data.user_id);
                $('.patient_fullname').html(data.user_fname+' '+data.user_mi+' '+data.user_lname);
                $('.patient_dob').html(data.user_dob);
                $('.patient_gender').html(data.user_gender);
                $('.patient_contactNumber').html(data.user_contact);
                $('.patient_email').html(data.user_email);
                $('#viewPatientDetails').modal('show');
            }
        })
    })

});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.editAdmin', function(){
        var adminId = $(this).attr("id");
        $.ajax({
          url:"../controllers/adminController.php",
            method:"POST",
            data:{adminId:adminId},
            dataType:"json",
            success:function(data){
                $('#user_name').val(data.user_name);
                $('#id').val(data.user_id);
                $('#user_type').val(data.user_type);
                $('#user_lname').val(data.user_lname);
                $('#user_fname').val(data.user_fname);
                $('#user_mi').val(data.user_mi);
                $('#user_email').val(data.user_email);
                $('#user_contact').val(data.user_contact);
                $('#user_dob').val(data.user_dob);
                $('#user_gender').val(data.user_gender);
                $('#editAdmin').modal('show');
            }
        })
    })

});
</script>
