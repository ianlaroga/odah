<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php
 $conn = connect();
 $id = $_SESSION['user_id'];
 $sql = "SELECT * FROM  appointment JOIN clinic ON appointment.clinicId = clinic.clinic_id JOIN dentist ON dentist.secretary_id  = clinic.secretaryId WHERE userId = '$id' ";
 $result = mysqli_query ($conn,$sql);
?>


 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dentist</a>
    </li>
    <li class="breadcrumb-item active">Dentist Master List</li>
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
              <th>Patient ID Number</th>
              <th>Patient Full Name</th>
              <th>Appointment Schedule</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
           <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                   foreach($result as $row){
                    ?>
                    <tr>
                    <td><?php echo $row['appointment_id']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                  
                    <td><?php echo $row['appointment_date'] . " " . $row['appointment_time'];  ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                    <div class='btn-group'>
                    <a class='btn btn-primary' href='done.php?id=<?php echo $row['appointment_id']; ?>' >Done</a>
                     
                      <a class='btn btn-primary' style="margin-left:10px" href='viewTeethChart.php?patientId=<?php echo $row['appointment_id']; ?>&type=<?php echo $row['patient_type']; ?>&dentisId=<?php echo $id; ?>' >View Teeth Chart</a>
                      <a class='btn btn-success text-white' style="margin-left:10px" onclick="printModal('<?php echo $row['patient_name']; ?>', '<?php echo $row['appointment_date']; ?>')" >Print</a>

            
                                      </div>
                                          </td>
                                          </tr> 
                                     <?php  } ?>
                                    </form>
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

<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="print.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   

             <div class="form-group">
             <input type="hidden" id="patientname" name="name">
             <input type="hidden" id="patientdate" name="date">
              <label>Description</label>
               <textarea name="description" class="form-control"></textarea>
              </div>
             
            <div class="modal-footer">
                <button type="submit"  class="btn btn-primary">Print</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

</div>

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

function printModal(name,date){
    $("#patientname").val(name);
    $("#patientdate").val(date);
    $("#printModal").modal("show");
}
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