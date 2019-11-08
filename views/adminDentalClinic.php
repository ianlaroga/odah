<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <?php 

$sql = "SELECT * FROM clinic 
JOIN branch ON clinic.clinic_branch = branch.branch_id
WHERE clinic_account = '1' ";
$result = mysqli_query($conn,$sql);
?>

 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dental Clinic List</li>
  </ol>

  <!-- DataTables Example -->
  <div class="card mb-3">
   
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Dental Clinic Name</th>
              <th>Dental Clinic Branch</th>
              <th>Dental Clinic Permit</th>
              <th>Dental Clinic Image</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
           <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                  
                  if($row['clinic_name'] == '' ) {
                     echo "<td>Add Clinic Name</td>";
                   }else{
                     echo "<td>{$row['clinic_name']}</td>";
                   }
                   ?>

                   <?php
                     if($row['branch_id'] == 0) {
                      echo "<td>Main Branch</td>";
                     }else{
                      echo "<td>{$row['branch_name']}</td>";
                     } 
                     ?>

                   <?php if($row['clinic_permit1'] == '') { 
                        echo "<td><img src='../images/add_image.png' width='200' height='150'></td>";
                      }else{
                     ?>
                   <td><img src="../images/<?php echo $row['clinic_permit1'] ?>" width="200" height="150" style="margin-bottom:10px"></td>
                   <?php } ?>


                  <?php if($row['clinic_image'] == '') { 
                        echo "<td><img src='../images/add_image.png' width='200' height='150'></td>";
                      }else{
                     ?>
                   <td><img src="../images/<?php echo $row['clinic_image'] ?>" width="200" height="150" style="margin-bottom:10px"></td>
                   <?php } ?>

                   <?php 
                 
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

                   echo "<button type='submit' id='{$row['clinic_id']}'   name='viewClinicDetails' class='btn btn-primary viewClinicDetails '>View Info</button>";

                   // if status = not accepted: show accept and disabled
                   if($row['clinic_status'] == '0') {

                   echo "<a class='acceptedClinic' href='../controllers/adminController.php?acceptClinicId={$row['clinic_id']}'><button type='submit' name='acceptedClinic' class='btn btn-success' onclick='return confirm('Are you sure?')'>Accept</button> </a>";

                    echo "<a class='disabledClinic' href='../controllers/adminController.php?disableClinicId={$row['clinic_id']}'><button type='submit' name='disabledClinic' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Disabled</button> </a>";

                    }

                  // if status = accept:show disabled
                  if($row['clinic_status'] == '1') {

                   echo "<a class='disabledClinic' href='../controllers/adminController.php?disableClinicId={$row['clinic_id']}'><button type='submit' name='disabledClinic' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Disabled</button> </a>";

                    }

                  // if status = pending: show accept and decline
                  if($row['clinic_status'] == '2') {

                   echo "<a class='acceptedClinic' href='../controllers/adminController.php?acceptClinicId={$row['clinic_id']}'><button type='submit' name='acceptedClinic' class='btn btn-success' onclick='return confirm('Are you sure?')'>Accept</button> </a>";

                   echo "<a class='declinedClinic' href='../controllers/adminController.php?declineClinicId={$row['clinic_id']}'><button type='submit' name='declinedClinic' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Decline</button> </a>";

                    }

                                            echo "</div>";
                                      echo "</td>";
                                    echo "</tr>"; 
                                       } ?>
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


<!--View Clinic Information-->
<div class="modal fade" id="viewClinicDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <div class="col-md-6">
            <label>Clinic Name:</label>
           <h3 class="modal-title clinic_name" id="exampleModalLabel"></h3>
          </div>
          <div class="col-md-6">
            <label>Address:</label>
            <h5 class="modal-title clinic_location" id="exampleModalLabel"></h5>
          </div>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
            <form role="form" action="" method="POST" onsubmit="return confirm('Are you sure?')">

            <input type="hidden" class="clinic_id">

           <div class="form-group">
              <div class="row">

               <div class="col-md-6">
                  <label>Clinic Secretary:</label>
                    <h5 class="clinic_secretary"></h5>
                </div>

              <!--   <div class="col-md-6">
                  <label>Business Permit:</label>
                    <img src="../images/" class="clinic_image" width="300">
                </div> -->
              </div>
           </div>

        
            <div class="form-group">
              <div class="row">
              <div class="col-md-6">
                  <label>Clinic Dentist:</label>
                    <h5 class="clinic_dentist"></h5>
              </div>

               <!--  <div class="col-md-6">
                  <label>Dentist License:</label>
                    <img src="../images/clinic2.jpg" class="dentist_image" width="300">
                </div> -->
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
</div>
<!-- end view info for clinic -->



<?php require('footer.php'); ?>


<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.viewClinicDetails', function(){
        var clinicId = $(this).attr("id");
         $.ajax({
             url:"../controllers/userController.php",
             method:"POST",
             data:{clinicId:clinicId},
             dataType:"json",
             success:function(data){
                $('.clinic_id').html(data.clinic_id);
                $('.clinic_name').html(data.clinic_name);
                $('.clinic_location').html(data.clinic_location);
                $('.clinic_description').html(data.clinic_description);
                $('.clinic_rating').html(data.clinic_rating);
                $('.clinic_contact').html(data.clinic_contact);
                $('.clinic_dentist').html(data.dentist_name);
                $('.clinic_image').html(data.clinic_image);
                $('.clinic_secretary').html(data.user_fname+' '+data.user_mi+' '+data.user_lname);
                $('#viewClinicDetails').modal('show');
          }
        })
      })

});
</script>

<script type="text/javascript">
  $(".acceptedClinic").click(function(){
    return confirm("Are you sure you want to accept this clinic?");
  })
</script>

<script type="text/javascript">
  $(".disabledClinic").click(function(){
    return confirm("Are you sure you want to disabled this clinic?");
  })
</script>

<script type="text/javascript">
  $(".declinedClinic").click(function(){
    return confirm("Are you sure you want to decline this clinic?");
  })
</script>