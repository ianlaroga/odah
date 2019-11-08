<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php 
$conn = connect();

$id = $_SESSION['user_id'];

// $sql = "SELECT * FROM clinic WHERE secretaryId = '$id' ";
// $result = mysqli_query($conn,$sql);
// $row = mysqli_fetch_assoc($result);
?>

<div id="content-wrapper">
  <div class="container-fluid">

  
  <!-- DataTables Example -->
  <div class="card mb-3">

    <?php 
        if (isset($_GET['success'])){
          $success = $_GET['success'];
          echo '<div class="alert alert-success text-center">';
          echo '<button class="close" data-dismiss="alert">X</button>';
          echo $success;
          echo '</div>';
        }
      ?> 

    <?php 
          if (isset($_GET['error'])){
            $error = $_GET['error'];
            echo '<div class="alert alert-danger text-center">';
            echo '<button class="close" data-dismiss="alert">X</button>';
            echo $error;
            echo '</div>';
         }
        ?> 
   
<div class="card-body">
    <form action="../controllers/userController.php" method="POST">
  <div>
     <h3>Add New Clinic</h3>
        <hr>
  </div>

    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

     <div class="form-group">
        <div class="row">
            <div class="col-md-6">
              <label>Clinic Name:</label>  
              <input type="text" class="form-control input-field" name="clinic_name">
            </div>
              <div class="col-md-6">
              <label>Clinic Address:</label>  
              <input type="text" class="form-control input-field" name="clinic_address">
            </div>
          </div>
      </div>
      
     
       <div class="form-group">
        <div class="row">
            <div class="col-md-6">
              <label>Clinic Secretary</label>  
              <input type="text" class="form-control input-field" name="clinic_secretary">
            </div>

            <div class="col-md-5">
              <label>Business Permit</label>
                <img src="../images/clinic1.jpg">
                   <input type="file" class="form-control mt-2">  
            </div>
          </div>
      </div>

       <div class="form-group">
        <div class="row">
             <div class="col-md-6">
              <label>Clinic Doctor</label>  
               <select class="form-control" name="clinic_doctor">
                     <option hidden></option>
                     <option value="doctor1">Doctor</option>
                     <option value="doctor2">Doctor2</option>
                     <option value="doctor3">Doctor3</option>
                </select>
            </div>

      
                <div class="col-md-5">
                   <label>Doctor License</label>
                <img src="../images/clinic1.jpg">
                   <input type="file" class="form-control mt-2">  
                </div>
            </div>
          </div>
      </div>




    <div class="form-group">
        <center><button type="submit" name="changeUserPassword" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-danger">Back</a></center>
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


<?php require('footer.php'); ?>
