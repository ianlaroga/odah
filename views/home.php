<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Online Dental Appointment Hub</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/full.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Online Dental Appointment Hub</a>
      <!-- Button trigger modal -->
      <button type="button" class="btn-btn-default" data-toggle="modal" data-target="#login">Login</button>
      <!-- Modal -->
      <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="log">
        <div class="modal-dialog" role="intro">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="login">Welcome:</h5>
            </div>
              <!-- Login Form -->
              <!--<form action="">-->
              <div class="container">
                <label for="username"><b>Username:</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                <label for="password"><b>Password:</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <span class="forgotpassword"><a href="forgotpassword.php">Forgot password?</a></span>
                <br>
                <button type="login" class="loginbutton">Login</button>
                <button type="button" class="cancelbutton" data-dismiss="modal" aria-label="close">Cancel</button>
                <br>
                <span class="signup">No account?<a href="signup.php"> Sign-up here!</a></span>
              </div>
            </div>

             <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
    
      </div>
    </div>
  </div>

</div>
</div>

</div>
</nav>

      <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Login
              <span class="sr-only">(current)</span>
            </a>
        </ul>
      </div>
    </div>
  </nav>
  Page Content -->

    <div class="container">
    <div class="row">
          <div class="col-md-12">
            <h1>Online Dental Hub at your service!</h1>
          </div>
      </div>
      <br>

       <div class="row">
          <div class="col-md-8">
            <input type="text" class="form-control" name="search">
          </div>
           <div class="col-md-4">
            <a class="btn btn-success" style="color:white">Search</a>
          </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-1">
          <label>Rating</label>
          <select class="form-control">
            <option>5</option>
             <option>4</option>
              <option>3</option>
               <option>2</option>
                <option>1</option>
          </select>
      </div>

        <div class="col-md-2">
          <label>Price</label>
          <select class="form-control">
            <option>5000</option>
              <option>5000</option>
                <option>5000</option>
                  <option>5000</option>
          </select>
      </div>

       <div class="col-md-2">
          <label>Date</label>
          <input type="date" class="form-control" name="date">
      </div>

      <div class="col-md-2">
          <label>Time</label>
          <input type="time" class="form-control" name="time">
      </div>

       <div class="col-md-3">
          <label>Services</label>
          <select class="form-control">
            <option>Tooth Extraction</option>
              <option>Cleaning</option>
                <option>Light Cure</option>
                  <option>Oral Prophylaxis</option>
                    <option>RCT</option>
          </select>
      </div>

    </div>
  </div>





  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
