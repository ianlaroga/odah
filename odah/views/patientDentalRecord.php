<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php
 $conn = connect();
 $id = $_SESSION['user_id'];

  if(!empty($_GET['id'])){
  $appointment_id = $_GET['id'];
   $sqlUpdate = "UPDATE  appointment set status = 'accepted' WHERE appointment_id = '$appointment_id' ";
   $conn->query($sqlUpdate);
 }

 $sql = "SELECT * FROM user WHERE user_type = '4' ";
 $result = mysqli_query ($conn,$sql);
 $sqlAppointment = "SELECT * FROM appointment JOIN clinic ON appointment.clinicId = clinic.clinic_id JOIN dentist ON dentist.secretary_id = clinic.secretaryId JOIN user ON user.user_id = dentist.userId WHERE appointment.user_id = '$id' AND status ='pending'   GROUP BY appointment_id";
 $resultAppointment = $conn->query($sqlAppointment);

 $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


?>


 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Patient</a>
    </li>
    <li class="breadcrumb-item active">Patient Appointments</li>
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

                if (isset($_GET['status']) && $_GET['status'] == 'success'){
                
                  echo '<div class="alert alert-success text-center">';
                  echo 'Your payment has been successfully sent.';
                  echo '</div>';
              }

              if (isset($_GET['status'] ) && $_GET['status'] == 'fail'){
                
                echo '<div class="alert alert-danger text-center">';
                echo 'There was an error in processing of your payment. Please try again';
                echo '</div>';
            }

            if (isset($_GET['status']) && $_GET['status'] == 'cancel'){
                
              echo '<div class="alert alert-danger text-center">';
              echo 'Payment Cancelled';
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
              <th>Dentist Name</th>
              <th>Patient Name</th>
              <th>Appointment Schedule</th>
              <th>Service</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
           <tbody align="center">
                 
                <?php
                    foreach($resultAppointment as $row ){
                    echo "<tr>";
                    echo "<td>".$row['clinic_name']."</td>";
                    echo "<td>".$row['user_fname']. " " . $row['user_lname']."</td>";
                   
                  echo "<td>".$row['patient_name']."</td>";
                    echo "<td>".date("F d, Y" , strtotime($row['appointment_date'])). " " . $row['appointment_time']."</td>";
                    echo "<td>".$row['clinic_services']."</td>";
                    echo "<td>".$row['status']."</td>";
                  
                    echo "<td>";
                    echo "<div class='btn-group'>";

                      ?>
                     
                       <a class='btn btn-primary' href="../controllers/patientController.php?pay=true&id=<?php echo  $row['appointment_id'] ?>" onclick="return confirm('Are you sure?')">Pay</a>;

                      
                       <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="../controllers/patientController.php?cancelId=<?php echo  $row['appointment_id']; ?>&clinicId=<?php echo $row['clinicId'] ?>" >Cancel </a>
                      <?php
                                            echo "</div>";
                                      echo "</td>";
                                    echo "</tr>"; 
                                       } ?>
                                   
                                  </tbody>
                </table>
      </div>
    </div>
    <div class="card-header">
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

<!-- add user -->
<div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Adding Classes</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="../controllers/sectionController.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   

             <div class="form-group">
              <label>Section Name</label>
                <input type="text" class="form-control" name="section">
                        </div>
             
            <div class="modal-footer">
                <button type="submit" name="addSection" class="btn btn-primary">Add</button>
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

<!-- edit user -->
<div class="modal fade" id="editSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="../controllers/sectionController.php" method="POST" onsubmit="return confirm('Are you sure?')">
                <div class="form-group">
                <input type="hidden" id="id" name="id" value="">

                <label>Section Name</label>
                  <input type="text" id="section_name" name="section_name" class="form-control" >
               </div>

    <div class="modal-footer">
            <button type="submit" name="updateSection" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit -->

<?php require('footer.php'); ?>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.editSection', function(){
        var sectionId = $(this).attr("id");
        $.ajax({
          url:"../controllers/sectionController.php",
            method:"POST",
            data:{sectionId:sectionId},
            dataType:"json",
            success:function(data){
                $('#section_name').val(data.section_name);
                $('#id').val(data.section_id);
                $('#editSection').modal('show');
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