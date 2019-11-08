<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php
 $conn = connect();
 $id = $_SESSION['user_id'];
 $sql = "SELECT * FROM dentist 
 JOIN user ON dentist.userId = user.user_id
 WHERE user_type = '3' AND secretary_Id = '$id' ";
 $result = mysqli_query ($conn,$sql);
?>

 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Secretary</a>
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
              <th>Dentist Full Name</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
           <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['user_fname']} {$row['user_lname']}</td>";

                    if($row['user_status'] == '0') {
                       echo "<td><span class='badge badge-danger'>Deactive</span></td>";
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
               
                   
              
                   // echo "<a class='disabledDentist' href='../controllers/secretaryController.php?disableDentistId={$row['user_id']}' ><button type='submit' name='disabledDentist' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Disabled</button> </a>";
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
                <button data-toggle="modal" data-target="#addDentist" type="button" class="btn btn-success pull-right">Add Dentist</button>
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

<!-- add user -->
<div class="modal fade" id="addDentist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Registration for Dentist:</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                   <form action="../controllers/secretaryController.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   

              <input type="hidden" name="id" value="<?php echo $id?>">

             <div class="form-group">
                <div class="row">
                    <div class="col-md-10">
              <label>Username:</label>
                <input type="text" class="form-control" name="user_username">
                        </div>
                      </div>
                  </div>

            <div class="form-group">
                  <div class="row">
                    <div class="col-md-5">
              <label>First Name:</label>
                <input type="text" class="form-control" name="user_firstname">
                        </div>

            <div class="col-md-5">
              <label>Last Name:</label>
                <input type="text" class="form-control" name="user_lastname">
                        </div>

            <div class="col-md-2">
              <label>Mi:</label>
                <input type="text" class="form-control" name="user_mi">
                        </div>
                      </div>
                    </div>
                
    
           <div class="form-group">
              <div class="row">
                <div class="col-md-7">
              <label>Email:</label>
                <input type="email" class="form-control" name="user_email">
                        </div>

                <div class="col-md-5">
              <label>Date of Birth:</label>
                <input type="date" class="form-control" name="user_dob">
                        </div>
                      </div>
                    </div>

            <div class="form-group">
              <div class="row">
                  <div class="col-md-7">
              <label>Contact Number:</label>
                <input type="text" class="form-control" name="user_contact">
                        </div>

                    <div class="col-md-5">
                       <label>Gender:</label>
                          <select class="form-control" name="user_gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option> 
                            <option value="Other">Other</option> 
                          </select>
                    </div>

                      </div>
                    </div>

            <div class="modal-footer">
                <button type="submit" name="addDentist" class="btn btn-primary">Add</button>
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

<!--View Patient Information-->
<div class="modal fade" id="viewDentistDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Dentist Details</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="#../controllers/secretaryController.php" method="POST">
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
        var dentistSecId = $(this).attr("id");
         $.ajax({
             url:"../controllers/secretaryController.php",
             method:"POST",
             data:{dentistSecId:dentistSecId},
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
  $(".deleteDentist").click(function(){
    return confirm("Are you sure you want to delete this Dentist?");
  })
</script>