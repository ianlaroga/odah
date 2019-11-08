<?php require('header.php');?>

<?php require('navigation.php');?>


<?php 
$conn = connect();
$sql = "SELECT * FROM user WHERE user_account = '0' ";
$result = mysqli_query($conn,$sql);


$sql2 = "SELECT * FROM clinic WHERE clinic_account = '0' ";
$result2 = mysqli_query($conn,$sql2);
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Admin</a>
          </li>
          <li class="breadcrumb-item active">User Control</li>
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

            <div class="container">

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#user">User Control</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#clinic">Clinic Control</a>
  </li>
</ul>

<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active show" id="user">
    <br>
   <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Actions </th>
                  </tr>
                </thead>
                <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['user_name']}</td>";

                    if($row['user_type'] == 1){
                    echo "<td>Admin</td>";
                    }
                    if($row['user_type'] == 2){
                    echo "<td>Secretary</td>";
                    }
                    if($row['user_type'] == 3){
                    echo "<td>Dentist</td>";
                    }
                    if($row['user_type'] == 4){
                    echo "<td>Patient</td>";
                    }
                  
              
                    echo "<td>";
                    echo "<div class='btn-group'>";

               
                    echo "<a class='enableAccount' href='../controllers/userController.php?enableAccountId={$row['user_id']}' ><button type='submit' name='enableAccount' class='btn btn-success' onclick='return confirm('Are you sure?')'>Enable</button> </a>";
              
                    echo "<a class='deleteAccount' href='../controllers/userController.php?deleteAccountId={$row['user_id']}' ><button type='submit' name='deleteAccount' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Delete</button> </a>";
                                            echo "</div>";
                                        echo "</td>";
                                    echo "</tr>"; 
                                    }
                                        ?>
                                    </form>
                                 </tbody>
                     
                
          </table>
      </div>
  </div>

  <div class="tab-pane fade" id="clinic">
     <br>
    <div class="table-responsive">
              <table class="table table-bordered" id="clinicTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Clinic ID</th>
                    <th>Clinic Name</th>
                    <th>Actions </th>
                  </tr>
                </thead>
                <tbody align="center">
                 <form action="controllers" method="GET">
                <?php
                    while($row2 = mysqli_fetch_assoc($result2)){
                    echo "<tr>";
                    echo "<td>{$row2['clinic_id']}</td>";
                    echo "<td>{$row2['clinic_name']}</td>";

              
            
                    echo "<td>";
                    echo "<div class='btn-group'>";
              

                    echo "<a class='enableClinicId' href='../controllers/userController.php?enableClinicId={$row2['clinic_id']}' ><button type='submit' name='enableClinicId' class='btn btn-success' onclick='return confirm('Are you sure?')'>Enable</button> </a>";
              
                    echo "<a class='deleteClinicId' href='../controllers/adminController.php?deleteClinicId={$row2['clinic_id']}' ><button type='submit' name='deleteClinicId' class='btn btn-danger' onclick='return confirm('Are you sure?')'>Delete</button> </a>";
                                            echo "</div>";
                                        echo "</td>";
                                    echo "</tr>"; 
                                    }
                                        ?>
                                    </form>
                                 </tbody>
                              </table>
                          </div>
                        </div>

                      </div>
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
 

<?php require('footer.php');?>


<script type="text/javascript">
  $(".enableAccount").click(function(){
    return confirm("Are you sure you want to enable this account?");
  })
</script>


<script type="text/javascript">
  $(".enableClinicId").click(function(){
    return confirm("Are you sure you want to enable this clinic?");
  })
</script>

<script type="text/javascript">
  $(".deleteClinicId").click(function(){
    return confirm("Are you sure you want to delete this clinic?");
  })
</script>

<script type="text/javascript">
  $(".deleteAccount").click(function(){
    return confirm("Are you sure you want to delete this account?");
  })
</script>