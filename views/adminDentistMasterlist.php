<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php 
$conn = connect();
$sql = "SELECT * FROM user JOIN dentist ON dentist.userId = user.user_id JOIN clinic ON clinic.secretaryId = dentist.secretary_id WHERE user_type = '3' AND user_account = '1' ";
$result = mysqli_query($conn,$sql);
?>


 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dentist Master List</li>
  </ol>

  
  <!-- DataTables Example -->
  <div class="card mb-3">
   
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Clinic Name</th>
              <th>Dentist Fullame</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
           <tbody align="center">
                <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['clinic_name']}</td>";
                    echo "<td>{$row['user_name']}</td>";

                    if($row['user_status'] == '0') {
                       echo "<td><span class='badge badge-danger'>Not Accepted</span></td>";
                    }

                    if($row['user_status'] == '1') {
                       echo "<td><span class='badge badge-success'>Active</span></td>";
                    }

                     if($row['user_status'] == '2') {
                       echo "<td><span class='badge badge-primary'>Pending</span></td>";
                    }
                  
                    echo "<td>";
                    echo "<div class='btn-group'>";

                    echo "<button type='submit' id='{$row['user_id']}' name='viewDentistDetails' class='btn btn-primary viewDentistDetails'>View Info</button>";

                     echo "<a class='disabledDentist' href='../controllers/userController.php?disableDentistId={$row['user_id']}' ><button type='submit' name='disabledDentist' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Disabled</button> </a>";
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

<!-- edit user -->
<div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="../controllers/adminController.php" method="POST" onsubmit="return confirm('Are you sure?')">


               <input type="hidden" id="id" name="id" value=""> 

                <input type="hidden" id="user_type" name="user_type" value="">
               
                 <div class="form-group">
                <label>User Name</label>
                  <input type="text" id="user_name" name="user_name" class="form-control" >
               </div>

                <div class="form-group">
                 <label>User Last Name</label>
                  <input type="text" id="user_lname" name="user_lname" class="form-control" >
               </div>

                <div class="form-group">
               <label>User First Name</label>
                  <input type="text" id="user_fname" name="user_fname" class="form-control" >
               </div>

                <div class="form-group">
                 <label>User Mi</label>
                  <input type="text" id="user_mi" name="user_mi" class="form-control" >
               </div>

                <div class="form-group">
               <label>User Email</label>
                  <input type="email" id="user_email" name="user_email" class="form-control" >
               </div>

                <div class="form-group">
               <label>User Contact</label>
                  <input type="number" id="user_contact" name="user_contact" class="form-control" >
               </div>

                <div class="form-group">
                 <label>User DOB</label>
                  <input type="date" id="user_dob" name="user_dob" class="form-control" >
               </div>

                <div class="form-group">
              <label>User Gender</label>
                  <input type="text" id="user_gender" name="user_gender" class="form-control" >
               </div>

    <div class="modal-footer">
            <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- End Edit -->

<!-- add user -->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Registration for Admins:</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="../controllers/adminController.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   

             <div class="form-group">
              <label>Admin Username:</label>
                <input type="text" class="form-control" name="user_username">
                        </div>

                <div class="form-group">
              <label>Admin Password:</label>
                <input type="password" class="form-control" name="user_password">
                        </div>

                <div class="form-group">
              <label>Admin First Name:</label>
                <input type="text" class="form-control" name="user_firstname">
                        </div>

                      <div class="form-group">
              <label>Admin Last Name:</label>
                <input type="text" class="form-control" name="user_lastname">
                        </div>

                      <div class="form-group">
              <label>Admin Mi:</label>
                <input type="text" class="form-control" name="user_mi">
                        </div>

                        <div class="form-group">
              <label>Admin Email:</label>
                <input type="email" class="form-control" name="user_email">
                        </div>


                        <div class="form-group">
              <label>Admin Date of Birth:</label>
                <input type="date" class="form-control" name="user_dob">
                        </div>

                             <div class="form-group">
              <label>Admin Contact:</label>
                <input type="text" class="form-control" name="user_contact">
                        </div>

                                   <div class="form-group">
              <label>Admin Gender:</label>
                <select class="form-control">
                  <option value="male">Male</option>
                  <option value="female">Female</option> 
                </select>
                        </div>

                     
             
            <div class="modal-footer">
                <button type="submit" name="addAdmin" class="btn btn-primary">Add</button>
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

<!--View Admin Information-->
<div class="modal fade" id="viewDentistDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Dentist Details</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="" method="POST" onsubmit="return confirm('Are you sure?')">
             <div class="form-group">
                  <div class="row">
                    <div class="col-lg-5">
                        <h6>Full Name:</h6>
                           <p class="dentist_fullname"></p> 
                          </div>
                           <div class="col-lg-4">
                        <h6>Email Address:</h6>
                           <p class="dentist_email"></p>
                          </div>
                        </div>
                      </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-5">
                        <h6>Contact Number:</h6>
                           <p class="dentist_contactNumber"></p> 
                          </div>
                           <div class="col-lg-4">
                        <h6>Birthday:</h6>
                           <p class="dentist_dob"></p>
                          </div>
                           <div class="col-lg-2">
                            <h6>Age:</h6>
                           <p class="dentist_contactNumber"></p> 
                          </div>
                        </div>
                      </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-6">
                        <h6>Gender:</h6>
                           <p class="dentist_gender"></p> 
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
    $(document).on('click','.viewDentistDetails', function(){
        var dentistId = $(this).attr("id");
         $.ajax({
             url:"../controllers/userController.php",
             method:"POST",
             data:{dentistId:dentistId},
             dataType:"json",
             success:function(data){
                $('.user_id').html(data.user_id);
                $('.dentist_fullname').html(data.user_fname+' '+data.user_mi+' '+data.user_lname);
                $('.dentist_dob').html(data.user_dob);
                $('.dentist_gender').html(data.user_gender);
                $('.dentist_contactNumber').html(data.user_contact);
                $('.dentist_email').html(data.user_email);
                $('#viewDentistDetails').modal('show');
            }
        })
    })

});
</script>



<script type="text/javascript">
  $(".disabledDentist").click(function(){
    return confirm("Are you sure you want to disable this account?");
  })
</script>