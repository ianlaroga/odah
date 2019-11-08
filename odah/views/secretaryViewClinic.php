<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php 
$conn = connect();

$id = $_SESSION['user_id'];
$clinicId = $_GET['viewClinicId'];

$conn = connect();
$sql = "SELECT * FROM clinic JOIN user ON clinic.secretaryId = user.user_id  
WHERE secretaryId = '$id' AND clinic_id = '$clinicId' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<div id="content-wrapper">
  <div class="container-fluid">

  
  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-body">
    <form action="../controllers/userController.php" method="POST">
  <div>
    <div class="row">
      <div class="col-md-8">
        <h3>View Clinic</h3>
      </div>
      </div>
        <hr>
  </div>
    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
     <div class="form-group">
        <div class="row">
            <div class="col-md-3">
              <label>Clinic Name:</label> <small style="color:red">required*</small>    
                <?php
                if($row['clinic_name'] == ''){
                   echo "<h4>Add Clinic Name</h4>"; 
                }else{
                   echo "<h4>{$row['clinic_name']}</h4>"; 
                }?>
            </div>

      
             <div class="col-md-3">
              <label>Clinic Address:</label>  <small style="color:red">required*</small>   
              <div class="card" style="border:0px">
              <?php
                if($row['clinic_location'] == ''){
                   echo "<h4>Add Clinic Location</h4>"; 
                }else{
                   echo "<h4>{$row['clinic_location']}</h4>"; 
                }?>
                </div>
            </div>

            <div class="col-md-3">
              <label>Clinic City:</label>  <small style="color:red">required*</small>   
                <div class="card" style="border:0px">
                <?php
                  if($row['clinic_city'] == ''){
                     echo "<h4>Add Clinic City</h4>"; 
                  }else{
                     echo "<h4>{$row['clinic_city']}</h4>"; 
                  }?>
                  </div>
            </div>

            <div class="col-md-3">
              <label>Clinic Contact Numbers:</label>  <small style="color:red">required*</small>   
                <div class="card" style="border:0px">
                <?php
                  if($row['clinic_contact'] == ''){
                     echo "<h4>Add Clinic Telephone Number</h4>"; 
                  }else{
                     echo "<h4>Tel # {$row['clinic_contact']}</h4>"; 
                  }?>

                  <?php
                  if($row['clinic_phone'] == ''){
                     echo "<h4>Add Clinic Phone Number</h4>"; 
                  }else{
                     echo "<h4>Cell # {$row['clinic_phone']}</h4>"; 
                  }?>

                  </div>
            </div>

          </div>
      </div>

      <div class="form-group">
        <div class="row">

            <div class="col-md-3">
              <label>Clinic Day</label>  <small style="color:red">required*</small>
                <?php
                if($row['start_day'] == ''){
                   echo "<h4>Add Clinic Day</h4>"; 
                }else{
                   echo "<h4>{$row['start_day']} - {$row['end_day']} </h4>"; 
                }?>
            </div>

            <div class="col-md-3">
               <label>Clinic Time:</label> <small style="color:red">required*</small>
              <?php
                if($row['start_time'] == ''){
                    echo "<h4>Add Clinic Time</h4>"; 
                }else{
                   echo "<h4>{$row['start_time']} - {$row['end_time']}</h4>"; 
                }?>
            </div>

            <div class="col-md-3">
              <label>Clinic Day</label>  
                <?php
                if($row['start_day_2'] == ''){
                   echo "<h4>Add Clinic Day</h4>"; 
                }else{
                   echo "<h4>{$row['start_day_2']} - {$row['end_day_2']} </h4>"; 
                }?>
            </div>

            <div class="col-md-3">
               <label>Clinic Time:</label>
              <?php
                if($row['start_time_2'] == ''){
                    echo "<h4>Add Clinic Time</h4>"; 
                }else{
                   echo "<h4>{$row['start_time_2']} - {$row['end_time_2']}</h4>"; 
                }?>
             </div>
          </div>
      </div>

  

      <hr class="mt-2">
      
       <div class="form-group mt-5">
        <div class="row">
            <div class="col-md-3">
              <label>Business Permit:</label> <small style="color:red">required*</small>  
               <?php
                if($row['clinic_permit1'] == ''){
                    echo "<img src='../images/add_image.png'>"; 
                }else { ?>
                  <img src="../images/<?php echo $row['clinic_permit1'] ?>" width="260" height="180" style="margin-bottom:10px">    
                <?php } ?>
            </div>

                <div class="col-md-3 ml-4">
                   <label>Clinic Image:</label> <small style="color:red">required*</small>  
                    <?php
                    if($row['clinic_image'] == ''){
                       echo "<img src='../images/add_image.png'>"; 
                      }else { ?>
                        <img src="../images/<?php echo $row['clinic_image'] ?>" width="260" height="180" style="margin-bottom:10px">    
                <?php } ?>
                </div>
              </div>
          </div>
    


   <div class="card-header">
        <a href="secretaryClinicMasterList.php" type="button" name="update" class="btn btn-danger btn mr-2">Back</a>
        <a href="secretaryUpdateClinic.php?viewClinicId=<?php echo $clinicId?>&uid=<?php echo $id ?>" type="button" name="update" class="btn btn-primary btn mr-2">Update</a>
        <a data-toggle="modal" data-target="#addServices" type="button" class="btn btn-success pull-right" style="color:white"></i>Add Services</a>

  
   <!--<a data-toggle="modal" data-target="#addClinicBranch" type="button" class="btn btn-success pull-right" style="color:white"></i>Add Clinic Branch</a> -->




    </div>
  </form>
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

<!-- adding new clinic branch -->
<div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content ">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Services:</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="../controllers/secretaryController.php" method="POST">
                        <div class="row">
                              <div class="col-lg-12">


              <input type="hidden" name="clinicId" value="<?php echo $clinicId; ?>"> 
 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Add Services:</label>
                          <input type="text" class="form-control" name="services_name">
                        </div>
                      </div>
                  </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Add Service Price:</label>
                          <input type="text" class="form-control" name="services_price">
                        </div>
                      </div>
                  </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Add Legends:</label>
                          <input type="text" class="form-control" name="legend_color">
                        </div>
                      </div>
                  </div>

            <div class="modal-footer">
                <button type="submit" name="addServices" class="btn btn-primary">Add</button>
            </div>

                </div>
            </div>
        </form>

      
    <div class="card-body">
      <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Services Name</th>
              <th>Services Price </th>
              <th>Legend Color</th>
              <th>Actions</th>
            </tr>
          </thead>
           <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    $sql = "SELECT * FROM services WHERE clinicId = '$clinicId' ";
                    $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['services_name']}</td>";
                    echo "<td>{$row['services_price']}</td>";
                    echo "<td> 
                    <div class='row'>
                      <div class='col-md-4'>
                      <i class='fa fa-square' style='color:{$row['legend_name']}'></i>
                      </div>
                      <div class='col-md-4'>
                       {$row['legend_name']}
                       </div>
                       </div>
                    </td>";
                  
                    echo "<td>";
                    echo "<div class='btn-group'>";
                  
                   echo "<a class='services' href='../views/secretaryEditServices.php?editID={$row['services_id']}&viewClinicId={$clinicId}' ><button type='submit' name='services' class='btn btn-primary ml-1' onclick='return confirm('Are you sure?')'>Update</button> </a>";
               
                   echo "<a class='services' href='../controllers/secretaryController.php?delID={$row['services_id']}&viewClinicId={$clinicId}' ><button type='submit' name='services' class='btn btn-danger ml-1' onclick='return confirm('Are you sure?')'>Delete</button> </a>";


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


    </div>
</div>
</div>
</div>
</div>
</div>


<?php require('footer.php'); ?>
