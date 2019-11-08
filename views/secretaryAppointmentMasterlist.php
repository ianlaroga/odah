
<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <?php
 $conn = connect();
 $id = $_SESSION['user_id'];
 $sql = "SELECT * FROM appointment 
 JOIN clinic ON appointment.clinicId = clinic.clinic_id
 JOIN user ON clinic.secretaryId = user.user_id 
 WHERE secretaryId = '$id'; ";
 $result = mysqli_query ($conn,$sql);

 $sqlId = "SELECT * FROM clinic WHERE secretaryId = '$id' ";
 $resultId = $conn->query($sqlId);

 $resultId = mysqli_fetch_assoc($resultId);


?>

 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Secretary</a>
    </li>
    <li class="breadcrumb-item active">Patient Master List</li>
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
              <th>Patient Name</th>
              <th>Patient Contact Number</th>
              <th>Services</th>
              <th>Appointment Date</th>
              <th>Status</th>
              <!-- <th>Actions</th> -->
           
            </tr>
          </thead>
           <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['patient_name']}</td>";
                     echo "<td>{$row['patient_contact']}</td>";
                      echo "<td>{$row['clinic_services']}</td>";
                       echo "<td>{$row['appointment_date']}  {$row['appointment_time']}</td>";
                       echo "<td>{$row['status']}</td>";
                  
                    // echo "<td>";
                    // echo "<div class='btn-group'>";

                  //     echo "<a class='disabledDentist' href='#../controllers/userController.php?disableDentistId={$row['appointment_id']}' ><button type='submit' name='disabledDentist' class='btn btn-success' onclick='return confirm('Are you sure?')'>Set Appointment</button> </a>";

                  // echo "<button type='submit' id='{$row['appointment_id']}' name='viewPatientDetails' class='btn btn-primary viewPatientDetails'>View Info</button>";
               
                   
                  //  echo "<a class='disabledDentist' href='#../controllers/userController.php?disableDentistId={$row['appointment_id']}' ><button type='submit' name='disabledDentist' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Cancel</button> </a>";


                                      //       echo "</div>";
                                      // echo "</td>";
                                    echo "</tr>"; 
                                       } ?>
                                    </form>
                                  </tbody>
                </table>
      </div>
    </div>
    <div class="card-header">
         <button data-toggle="modal" data-target="#addPatientWalkIn" type="button" class="btn btn-success pull-right">Walk-in Patient</button>
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

<<!-- add secretary -->
<div class="modal fade" id="addPatientWalkIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Patient Walk-in Clinic:</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="../controllers/secretaryController.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   

      
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                      <label>Patient Name:</label>
                         <input type="text" class="form-control" name="patient_name">
                            </div>
                          </div>
                        </div>

              <div class="form-group">
                 <div class="row">
                    <div class="col-md-12">
                        <label>Patient Type</label>
                          <select class="form-control" name="patient_type">
                            <option value="adult">Adult</option>
                            <option value="child">Child</option>  
                          </select>
                        </div>
                      </div>
                    </div>
                   

           <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <label>Email:</label>
                        <input type="email" class="form-control" name="user_email">
                        </div>
                      
                       
              <input type="hidden" class="form-control" value="<?php echo  $resultId['clinic_id']; ?>" name="clinic_id">
           <div class="col-md-6">
              <label>Contact Number:</label>
                <input type="text" class="form-control" name="user_contact">
                        </div>
                      </div>
                    </div>


            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label>Appointment Date:</label>
                     <input type="date" class="form-control" min="<?php echo date('Y-m-d', time() + 86400); ?>" name="appointment_date">
                       </div>
                      

                      <div class="col-md-6">
                        <label>Appointment Time:</label>
                           <input type="time" class="form-control" name="appointment_time">
                        </div>
                      </div>
                    </div>
                    

                    <div class="form-group">
                 <div class="row">
                    <div class="col-md-12">
                        <label>Clinic Services</label>
                          <select class="form-control" name="service">
                            <option hidden selected>Select A Clinic Services</option>
                            <?php 
                            $sql = "SELECT * FROM services 
                            JOIN clinic ON services.clinicId = clinic.clinic_id
                            JOIN user ON user.user_id = clinic.secretaryId  
                            WHERE secretaryId = '$id' ";
                            $result = mysqli_query($conn,$sql);
                            
                            while($row = mysqli_fetch_assoc($result)){
                             echo "<option value='{$row['services_id']}'><option>{$row['services_name']}</option>";
                              }
                            ?>  
                          </select>
                         
                        </div>
                      </div>
                    </div>

            <div class="modal-footer">
                <button type="submit" name="walkinPatientAdd" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>


<?php require('footer.php'); ?>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.viewPatientDetails', function(){
        var patientSecId = $(this).attr("id");
         $.ajax({
             url:"../controllers/secretaryController.php",
             method:"POST",
             data:{patientSecId:patientSecId},
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
  $(".deleteSection").click(function(){
    return confirm("Are you sure you want to delete this section?");
  })
</script>