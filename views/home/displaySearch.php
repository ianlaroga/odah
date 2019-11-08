<?php require('../../controllers/connection.php'); 
$conn = connect();

  $rate = '';
  $price = '';
  $services = '';
  $clinic_name = '';

if(!empty($_GET['rate'])){
  $rate = $_GET['rate'];
}
if(!empty($_GET['services'])){
  $services = $_GET['services'];
}
if(!empty($_GET['clinic_name'])){
  $clinic_name = $_GET['clinic_name'];
}
if(!empty($_GET['price'])){
  $price = $_GET['price'];
}
$sql = "SELECT * FROM services GROUP BY services_name";
$result = $conn->query($sql);


?>
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
  <link href=""> 
  <link rel='dns-prefetch' href='//api.tiles.mapbox.com' />
<link rel='dns-prefetch' href='//api.mapbox.com' />
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' />
  <link href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.css' />
  <link href='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.css' />
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' />
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' />
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
</head>
  
<body>

   <?php require('homeNav.php');?>
      
  <div class="container">
  <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Online Dental Hub at your service!</h1>
                    </div>
                </div>
                <br>
                <form method="get" action="displaySearch.php" style="border: none;">
                 
                    <div class="row">
                    <div class="col-md">
                            <label>Rating:</label>
                            <select class="form-control" name="rate">
                              <option value=""></option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>

                        <div class="col-md">
                            <label>Price:</label>
                            <input type="text" class="form-control" name="price" style="margin-top:-1px;">
                        </div>

                        <div class="col-md">
                            <label>Services:</label>
                            <select class="form-control" name="services">
                            <option value=""></option>
                              <?php foreach($result as $row){ ?>
                                <option value="<?php echo $row['services_name']; ?>"><?php echo $row['services_name']; ?></option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-11">
                    <label>Search Term:</label>
                            <input type="text" class="form-control" name="clinic_name">
                        </div>
                        <div class="col-md-1" style="margin-top:30px">
                            <button class="btn btn-success" type="submit" style="color:white">Search</button>
                        </div>
                </form>
                </div>
                <div id="map"></div>
        </div>
     
  <hr color="black">

     <!-- Page Content -->
    <div class="container">
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-12">
   <?php 
    $array = array(
      "clinic_id" => "",
      "clinic_name" => "",
      "clinic_contact" => "",
      "lat" => "",
      "lng" => ""
    );

    $array1 = array();
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM clinic";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$query=mysqli_query($conn,"SELECT ROUND(AVG(rating_number),0)  as rating_ave,rating.clinic_id, clinic_name, clinic_contact,
                  lat, lng, clinic_image, clinic_branch, branch_name, clinic_location, clinic_city, start_day, end_day,
                  start_time, end_time, start_day_2, end_day_2, start_time_2, end_time_2, clinic_phone, clinic_contact
                   FROM clinic 
                JOIN branch ON branch.branch_id = clinic.clinic_branch
                JOIN services ON clinic.clinic_id = services.clinicId 
                JOIN rating ON rating.clinic_id = clinic.clinic_id
                WHERE clinic_status = '1' 
                AND clinic_account = '1' 
                AND clinic_name LIKE '%$clinic_name%'
                AND (services_name LIKE '%$services%' AND services_price LIKE '%$price%')
                GROUP BY clinic.clinic_id
                HAVING rating_ave LIKe '%$rate%'
                 ORDER BY clinic.clinic_id DESC 
              LIMIT $offset,$no_of_records_per_page");
        while ($row=mysqli_fetch_array($query)) {
             $array['clinic_id'] = $row['clinic_id'];
              $array['clinic_name'] = $row['clinic_name'];
              $array['clinic_contact'] = $row['clinic_contact'];
              $array['lat'] = $row['lat'];
              $array['lng'] = $row['lng'];
              array_push($array1, $array);

              $clinicID = $row['clinic_id'];
              $sqlServices = "SELECT * FROM services WHERE clinicId = '$clinicID' LIMIT 5 ";
              $sqlResult = mysqli_query($conn,$sqlServices);

              $sqlRate = "SELECT ROUND(AVG(rating_number),0) as rating_avg FROM rating WHERE clinic_id = '$clinicID' ";
              $sqlRateResult =  mysqli_query($conn,$sqlRate);
              $sqlRateResult = mysqli_fetch_assoc($sqlRateResult);
            
          ?>

          <!-- Start -->
          <div class="card mb-4">
               <div class="card-body">
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-4">
                <img src="../../images/<?php echo $row['clinic_image'] ?>" width="320" height="250" style="margin-bottom:10px;"> 
               <div class="col-md-12">
                   <?php if($row['clinic_branch'] == '0') {?>
                    <h3  style='font-size:40px;text-align:center'>Main Branch</h3>
                      <?php }else{ ?> 
                        <h3  style='font-size:40px;text-align:center'><?php echo $row['branch_name'] ?></h3>
                         <?php } ?>
                </div>
                  </div>

              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-4">
                     <h3><?php echo $row['clinic_name'] ?></h3>
                      </div>

                         <div class="col-md-4">
                         <p>Address: <?php echo $row['clinic_location'] ?></p> 
                        </div>

                        <div class="col-md-4">
                         <p>City: <?php echo $row['clinic_city'] ?></p> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style='border: 1px solid'>
                           <h3>Operating Hours</h3>
                              <div class="row">
                                 <div class="col-md-3">
                                    <h6>
                                      <p><?php echo $row['start_day']?> - <?php echo $row['end_day']?> </p>
                                   </h6>
                                </div>

                              <div class="col-md-3">
                                  <h6>
                                    <p><?php echo $row['start_time']?> - <?php echo $row['end_time']?></p>
                                  </h6>
                              </div>

                              <div class="col-md-3">
                                <?php if($row['start_day_2'] == '') { ?>
                                  
                               <?php } else { ?>
                                  <h6>
                                    <p><?php echo $row['start_day_2']?> - <?php echo $row['end_day_2']?> </p>
                                 </h6>
                                <?php } ?>
                              </div>

                              <div class="col-md-3">
                                <?php if($row['start_day_2'] == '') { ?>
                                  
                               <?php } else { ?>
                                  <h6>
                                    <p><?php echo $row['start_time_2']?> - <?php echo $row['end_time_2']?> </p>
                                 </h6>
                                <?php } ?>
                              </div> 
                            </div>
                        </div>
                    </div>

                     <div class="row" style='border: 1px solid'>
                        <div class="col-md-6">
                           <h3>Contact Us</h3>
                            <div class="row">
                             <div class="col-md-6">
                                <h6>
                                  <p># <?php echo $row['clinic_phone']?></p>
                                </h6>
                              </div>
                              <div class="col-md-6">
                                <h6>
                                  <p># <?php echo $row['clinic_contact']?></p>
                                </h6>
                              </div> 
                             </div>
                          </div>
                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-8">
                                <h1 style='text-align: center'> 
                                <?php if($sqlRateResult['rating_avg']){ ?>
                                  Ratings
                                <?php } ?>
                                </h1>
                              </div>
                             <div class="col-md-4">
                                    <h1 style='text-align:center'><?php echo $sqlRateResult['rating_avg']; ?></h1>
                              </div> 
                              <div class="col-md-8">
                              </div>
                                <div class="col-md-4">
                                <h6>
                                    <p style='text-align: center'>
                                    <?php for($i=0;$i < $sqlRateResult['rating_avg']; $i++){ ?>
                                    ☆
                                    <?php } ?>
                                    </p>
                                </h6>
                              </div>
                             </div>
                          </div>
                      </div>

                    
                      <div class="row" style='border: 1px solid'>
                        <div class="col-md-4">
                           <h3 style='text-align:center;margin-top:30px'>Our Services</h3>
                          </div>
                          <div class="col-md-8">
                            <div class="row">
                             <div class="col-md-6">
                              <?php while($sqlRow = mysqli_fetch_array($sqlResult)) { 
                                ?>
                                    <h6>
                                        <p><?php echo $sqlRow['services_name'];?> - <?php echo $sqlRow['services_price'];?> </p>
                                    </h6>
                                  <?php } ?>
                                </div> 
                             </div>
                          </div>
                        </div>

                    
                   <div class="row mt-2">

                    <div class="col-md-8">
                     
                      <?php
                        if(!empty($_SESSION['user_type'])){ ?>
                            <a href="appointment_book.php?bookID=<?php echo $clinicID ?>" class="btn btn-success">BOOK AN APPOINTMENT</a>
                            <a onclick="showModal('<?php echo $clinicID ?>', '<?php echo $_SESSION['user_id']; ?>')"  class="btn btn-info text-white">RATE</a>
                    <?php }else{ ?>
                   <a href="#" data-toggle="modal" data-target="#login" class="btn btn-success">BOOK AN APPOINTMENT</a>
                    <?php } ?>
                      
                    </div>
                     </div>

                   </div> 
                 </div>
              </div>
            </div>
          <div class="card-footer text-muted">
        </div>
      </div>

    <?php }
  
    ?>
            <!-- End -->
            <form method="post" action="rate.php">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rating Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="clinicID" name="clinicID">
      <input type="hidden" id="user_id" name="user_id">
        <select class="custom-select" id="inputGroupSelect01" name="rating_number">
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
          <option value="4">Four</option>
          <option value="5">Five</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Rate</button>
      </div>
    </div>
  </div>
</div>
        </form>
        <!-- Pagination -->


    <ul class="pagination justify-content-center mb-4">
        <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
        </li>
        <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
    </ul>

        </div>
<style type="text/css">
  
  #map { height: 480px; }
</style>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.js"></script>
      <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.min.js"></script>
        <script src="https://unpkg.com/mapbox@1.0.0-beta9/dist/mapbox-sdk.min.js"></script>
          <script src="https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js
"></script>

 <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
   integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
   crossorigin=""></script>
<script>
   function showModal(clinicID, user_id){
        $("#clinicID").val(clinicID);
        $("#user_id").val(user_id);
        $("#exampleModal").modal("show");
    }
  var obj = <?php echo json_encode($array1); ?>;
  var lat;
  var lng;
  console.log(obj);
  if ("geolocation" in navigator) { 
    navigator.geolocation.getCurrentPosition(position => { 
        lat = position.coords.latitude;
        lng = position.coords.longitude 


      var mymap = L.map('map').setView([lat, lng], 13);

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiaG9tZXNhbmRjb25kb3MiLCJhIjoiY2p4Y2xqdGM4MDA3aTNubXd1Zm84dXp5MyJ9.MLd-FoLj3qnmOVSqMVMfEQ'
      }).addTo(mymap);

      var redIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });
      var marker = L.marker([lat, lng], {icon: redIcon}).addTo(mymap);
      marker.bindPopup("<b>Your Location</b>").openPopup();

      for(var i =0; i < obj.length; i++){
        if(obj[i].lat != "" && obj[i].lng != ""){
        var marker = L.marker([obj[i].lat, obj[i].lng]).addTo(mymap);
        var html = "<b>"+obj[i].clinic_name+"</b>"+ 
                    "<p>"+obj[i].clinic_contact +"</p>" +
                      "<a  href='appointment_book.php?bookID="+obj[i].clinic_id+"' class=btn btn-success'>Book</a>";
        marker.bindPopup(html);
        }
      }
      
    // markers.addLayer(L.marker([[10.2990, 123.9639]));
    // add more markers here...

        mymap.addLayer(markers);




    });
  }


</script>
</body>

</html>
