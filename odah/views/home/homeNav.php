 <!-- Navigation -->
 <?php 
 session_start();

 ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="home.php">Online Dental Appointment Hub</a>
    <!-- Button trigger modal -->
    <?php if(!empty($_SESSION['user_type'])){  ?>
         <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
          <i class="fa fa-user-circle fa-fw"></i> <?php echo $_SESSION["user_fname"];?> <?php echo $_SESSION["user_mi"];?> <?php echo $_SESSION["user_lname"];?>
          <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php if($_SESSION['user_type'] == 1){
          echo "<a class='dropdown-item' href='../adminSettings.php'>Admin Settings</a>";
          echo "<hr>";
          }?>  
          <a class="dropdown-item" href="../index.php">Dashboard</a> 
        <!--   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myInfo">My Info</a> 
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword">Change Password</a> -->
          <hr>
          <a class="dropdown-item" href="../logout.php"  style="text-align:center">Sign Out</a>
        </div>
      </li>
     </ul>
    </div>
    <?php  }else{ ?>
      <button type="button" class="btn-btn-default" data-toggle="modal" data-target="#login">Login</button>
      <?php } ?>

      <!-- Modal -->
      <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="log">
        <div class="modal-dialog" role="intro">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="login">Login Form</h5>
            </div>

                <!-- Login Form -->
                    <!--<form action="">-->
                    <div class="container">
                      <form role="form" method="POST" action="../../controllers/userController.php" style="border:0">


                     <div class="form-group">
                      <label for="username"><b>Username</b></label>
                      <input type="text" placeholder="Enter Username" name="user_name" required>
                     </div>

                      <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="user_password" required>
                     </div>

                        <span class="signup">No account?<a href="signup.php"> Sign-up here!</a></span>

                      <br>
                      <button class="loginbutton" type="submit" name="loginUser" value="login">Login</button>

                      <button type="button" class="cancelbutton" data-dismiss="modal" aria-label="close">Cancel</button>

                      <br>
                  </form>
                </div>
            </div>
       </div>
    </div>


        <div class="modal fade" id="bookAppointment" tabindex="-1" role="dialog" aria-labelledby="log">
        <div class="modal-dialog" role="intro">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="login">Book An Appointment</h5>
            </div>

                <!-- Login Form -->
                    <!--<form action="">-->
                    <div class="container">
                      <form role="form" method="POST" action="../../controllers/userController.php" style="border:0">


                     <div class="form-group">
                      <label for="username"><b>Username</b></label>
                      <input type="text" placeholder="Enter Username" name="user_name" required>
                     </div>

                      <div class="form-group">
                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="user_password" required>
                     </div>

                        <span class="signup">No account?<a href="signup.php"> Sign-up here!</a></span>

                      <br>
                      <button class="loginbutton" type="submit" name="loginUser" value="login">Login</button>

                      <button type="button" class="cancelbutton" data-dismiss="modal" aria-label="close">Cancel</button>

                      <br>
                  </form>
                </div>
            </div>
       </div>
    </div>


  </div>
</nav>