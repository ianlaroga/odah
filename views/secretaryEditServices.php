<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <?php

    $conn = connect();
    $id = $_SESSION['user_id'];
    $servicesId   = $_GET['editID']; 
    $clinicId     = $_GET['viewClinicId'];

    $sql = "SELECT * FROM services  WHERE services_id = '$servicesId' AND clinicId = '$clinicId'  ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);


?>

 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Secretary</a>
    </li>
    <li class="breadcrumb-item active">Update Services</li>
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
              <form action="../controllers/secretaryController.php" method="POST">
                  <div class="row">
                      <div class="col-lg-12">
                          <div>
                            <h3>Update Services</h3>
                              <hr>
                          </div>

              <input type="hidden" name="clinicId" value="<?php echo $clinicId; ?>">

              <input type="hidden" name="editID" value="<?php echo $row['services_id']; ?>"> 
 
              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Services Name:</label>
                          <input type="text" class="form-control" name="services_name" value="<?php echo $row['services_name']; ?>">
                        </div>
                      </div>
                  </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Prices:</label>
                          <input type="text" class="form-control" name="services_price" value="<?php echo $row['services_price']; ?>">
                        </div>
                      </div>
                  </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                      <label>Legends:</label>
                          <input type="text" class="form-control" name="legend_color" value="<?php echo $row['legend_name']; ?>">
                        </div>
                      </div>
                  </div>

            <div class="modal-footer">
                <button type="submit" name="updateServices" class="btn btn-primary">Update</button>
                <a href="secretaryViewClinic.php?viewClinicId=<?php echo $clinicId ?>" class="btn btn-danger">Back</a>
            </div>

                </div>
            </div>
        </form>



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

