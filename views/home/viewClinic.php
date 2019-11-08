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

   <?php require('homeNav.php');?>
      

  
  <div class="container">
    <div class="row">
          <div class="col-md-12">
            <h1 class="text-center">Online Dental Hub at your service</h1>
          </div>
      </div>
    

      <label>Search Term:</label>
          <div class="row">
              <div class="col-md-8">
                <input type="text" class="form-control" name="search">
              </div>
                 <div class="col-md-4">
                  <a class="btn btn-success" href="displaySearch.php" style="color:white">Search</a>
                </div>
          </div>
      <br>

      <div class="row">
        <div class="col-md-1">
          <label>Rating:</label>
          <select class="form-control">
            <option>5</option>
             <option>4</option>
              <option>3</option>
               <option>2</option>
                <option>1</option>
          </select>
      </div>

        <div class="col-md-2">
          <label>Price:</label>
          <select class="form-control">
            <option>5000</option>
              <option>5000</option>
                <option>5000</option>
                  <option>5000</option>
          </select>
      </div>

       <div class="col-md-2">
          <label>Date:</label>
          <input type="date" class="form-control" name="date">
      </div>

      <div class="col-md-2">
          <label>Time:</label>
          <input type="time" class="form-control" name="time">
      </div>

       <div class="col-md-3">
          <label>Services:</label>
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

  <hr color="black">

     <!-- Page Content -->
    <div class="container">
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-12">
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="" alt="">
               <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                       <h5 class="card-title">Rating</h5>
                    </div>
                    <div class="col-md-6">
                       <h5 class="card-title">Gentle Dental Care Clinic</h5>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <br>
                    <br>

                    <div class="col-md-3">
                    <h1>5.0</h1>
                  </div>

                  <div class="col-md-9">
                      <h3>Cebu City, Address Here</h3>
                  </div>

                   <div class="col-md-3">
                    <p>☆☆☆☆☆</p>
                  </div>

                    <div class="col-md-2">
                    <button class="btn btn-primary">Get Directions</button>
                  </div>

                    <div class="col-md-3">
                   <button class="btn btn-success" style="margin-left:-50px">Set an appointment</button>
                  </div>

                 
                 </div>
             </div>
          </div>
        </div>


 <div class="container">
  <ul class="nav nav-tabs">

  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#overview">Overview</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#dentist">Dentist</a>
  </li>

   <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#service">Services</a>
  </li>

  
</ul>

<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active show" id="overview">
    <br>
    <h3>About Gentle Dental Care Clinic</h3>
      <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. </p>
    <div class="row">
        <div class="col-md-3">
            Open Hours:
        </div>
         <div class="col-md-3">
            Contact Number: 0917 620 7361
        </div>
      </div>
      <br>
       <div class="row">
        <div class="col-md-3">
          <h6>Monday To Sunday:</h6>
           <p>9:00AM - 12:00PM</p>
           <p>1:00PM - 04:00PM</p>
           <p>5:00PM - 9:00PM</p>
        </div>
      </div>
  </div>

  <div class="tab-pane fade" id="dentist">
     <br>
     <div class="row">
        <div class="col-md-4">
      <img src="../images/doctor1.jpg" alt="" width="300" height="200">
    </div>
     <div class="col-md-8">
      <h3>Dr. Charmie Redona</h3>
      <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. </p>
        </div>
     </div>
  </div>

  <div class="tab-pane fade" id="service">
     <br>
    <div class="row">
        <div class="col-md-3">
           <p> - Braces</p>
           <p> - RCT</p>
           <p> - Tooth Extraction</p>
           <p> - Light Cure/laser</p>
           <p> - Oral Prophylaxis</p>
           <p> - Denture</p>
        </div>
         <div class="col-md-6">
           <p>P5000</p>
           <p>P5000</p>
           <p>P800 (posterior) P600 (anterior)</p>
           <p>P600</p>
           <p>P600</p>
           <p>P800 (posterior) P600 (anterior) P600 (anterior)</p>
        </div>
      </div>
  </div>
</div>
</div>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
