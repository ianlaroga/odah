<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

<?php 
$conn = connect();

//$id = $_SESSION['user_id'];

//var_dump($id);

$id = $_GET['uid'];
$clinicId = $_GET['viewClinicId'];
$conn = connect();
$sql = "SELECT * FROM clinic 
JOIN user 
ON clinic.secretaryId = user.user_id  
WHERE clinic.secretaryId = '$id' 
AND clinic_id = '$clinicId' ";
$result = mysqli_query($conn,$sql);


while($row = mysqli_fetch_assoc($result)){
    $clinic_name = $row['clinic_name']; 
    $clinic_location = $row['clinic_location']; 
    $clinic_contact = $row['clinic_contact'];
    $clinic_phone = $row['clinic_phone'];
    $clinic_city = $row['clinic_city'];
    $clinic_permit1 = $row['clinic_permit1'];
    $clinic_image = $row['clinic_image'];

    $start_day = $row['start_day'];
    $end_day = $row['end_day'];
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
    $start_day_2 = $row['start_day_2'];
    $end_day_2 = $row['end_day_2'];
    $start_time_2 = $row['start_time_2'];
    $end_time_2 = $row['end_time_2'];     
}

?>
<style href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css"></style>
<style href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.css
"></style>
<div id="content-wrapper">
  <div class="container-fluid">

  
  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-body">
    <form action="../controllers/clinicController.php" method="POST" enctype="multipart/form-data" >
  <div>
     <h3>Update Clinic Details</h3>
        <hr>
  </div>

    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

    <input type="hidden" name="clinic" value="<?php echo $clinicId; ?>">

    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
              <label>Clinic Business Permit</label> <small style="color:red">required*</small>  
                <input type="hidden" name="orig_permit" value="<?php echo $clinic_permit1; ?>"> 
                <input type="file" class="form-control" name="permit">
            </div>
          </div>
      </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
              <label>Clinic Image</label> <small style="color:red">required*</small>  
               <input type="hidden" name="orig_image" value="<?php echo $clinic_image; ?>"> 
                <input type="file" class="form-control" name="image">
            </div>
          </div>
      </div>
     

     <div class="form-group">
        <div class="row">

            <div class="col-md-3">
              <label>Clinic Name:</label> <small style="color:red">required*</small>  
                <input type="text" class="form-control" name="clinic_name" value="<?php echo $clinic_name?>">
            </div>

            <div class="col-md-3"> 
              <label>Clinic City:</label> <small style="color:red">required*</small>  
                <input type="text" class="form-control" name="clinic_city" value="<?php echo $clinic_city?>">
            </div>

            <div class="col-md-3">
              <label>Clinic Phone Number:</label> <small style="color:red">required*</small>
                <input type="text" pattern="\d*" maxlength="11" minlength="11" class="form-control" name="clinic_phone" value="<?php echo $clinic_phone?>">
            </div>

            <div class="col-md-3">
              <label>Clinic Tel Number:</label> <small style="color:red">required*</small>
                <input type="text"  class="form-control" name="clinic_contact" value="<?php echo $clinic_contact?>">
            </div>

          </div>
      </div>

     
       <div class="form-group">
        <div class="row">
            <div class="col-md-12"> 
              <label>Clinic Address:</label> <small style="color:red">required*</small>
               <textarea class="form-control" oninput="getAddress()" id="clinic_address" rows="5" placeholder="Clinic Address" name="clinic_address" value="<?php echo $clinic_location ?>"><?php echo $clinic_location ?></textarea>
            </div>
          </div>
      </div>

         <div class="form-group">
        <div class="row">

            <div class="col-md-3">
              <label>Clinic Day Start</label> <small style="color:red">required*</small>
                <select class="form-control" name="start_day">
                    <option hidden selected value="<?php echo $start_day ?>"><?php echo $start_day ?></option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option> 
                </select>
            </div>

             <div class="col-md-3">
              <label>Clinic Day End</label> <small style="color:red">required*</small>
                <select class="form-control" name="end_day">
                    <option hidden selected value="<?php echo $end_day?>"><?php echo $end_day ?></option> 
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>

             <div class="col-md-3">
              <label>Clinic Time Start</label> <small style="color:red">required*</small>
                <select class="form-control" name="start_time">
                      <option hidden selected value="<?php echo $start_time?>"><?php echo $start_time?></option>
                              <option value="7:30 AM">7:30 AM</option>
                              <option value="8:00 AM">8:00 AM</option>
                              <option value="8:30 AM">8:30 AM</option>
                              <option value="9:00 AM">9:00 AM</option>
                              <option value="9:30 AM">9:30 AM</option>
                              <option value="10:00 AM">10:00 AM</option>
                              <option value="10:30 AM">10:30 AM</option>
                              <option value="11:00 AM">11:00 AM</option>
                              <option value="11:30 AM">11:30 AM</option>
                              <option value="12:00 PM">12:00 PM</option>
                              <option value="12:30 PM">12:30 PM</option>
                              <option value="1:00 PM">1:00 PM</option>
                              <option value="1:30 PM">1:30 PM</option>
                              <option value="2:00 PM">2:00 PM</option>
                              <option value="2:30 PM">2:30 PM</option>
                              <option value="3:00 PM">3:00 PM</option>
                              <option value="3:30 PM">3:30 PM</option>
                              <option value="4:00 PM">4:00 PM</option>
                              <option value="4:30 PM">4:30 PM</option>
                              <option value="5:00 PM">5:00 PM</option>
                              <option value="5:30 PM">5:30 PM</option>
                              <option value="6:00 PM">6:00 PM</option>
                              <option value="6:30 PM">6:30 PM</option>
                              <option value="7:00 PM">7:00 PM</option>
                              <option value="7:30 PM">7:30 PM</option>
                              <option value="8:00 PM">8:00 PM</option>
                              <option value="8:30 PM">8:30 PM</option>
                              <option value="9:00 PM">9:00 PM</option>
                           </select>
               
            </div>

             <div class="col-md-3">
              <label>Clinic Time End</label> <small style="color:red">required*</small>
                <select class="form-control" name="end_time">
                              <option hidden selected value="<?php echo $end_time?>"><?php echo $end_time?></option>
                              <option value="7:30 AM">7:30 AM</option>
                              <option value="8:00 AM">8:00 AM</option>
                              <option value="8:30 AM">8:30 AM</option>
                              <option value="9:00 AM">9:00 AM</option>
                              <option value="9:30 AM">9:30 AM</option>
                              <option value="10:00 AM">10:00 AM</option>
                              <option value="10:30 AM">10:30 AM</option>
                              <option value="11:00 AM">11:00 AM</option>
                              <option value="11:30 AM">11:30 AM</option>
                              <option value="12:00 PM">12:00 PM</option>
                              <option value="12:30 PM">12:30 PM</option>
                              <option value="1:00 PM">1:00 PM</option>
                              <option value="1:30 PM">1:30 PM</option>
                              <option value="2:00 PM">2:00 PM</option>
                              <option value="2:30 PM">2:30 PM</option>
                              <option value="3:00 PM">3:00 PM</option>
                              <option value="3:30 PM">3:30 PM</option>
                              <option value="4:00 PM">4:00 PM</option>
                              <option value="4:30 PM">4:30 PM</option>
                              <option value="5:00 PM">5:00 PM</option>
                              <option value="5:30 PM">5:30 PM</option>
                              <option value="6:00 PM">6:00 PM</option>
                              <option value="6:30 PM">6:30 PM</option>
                              <option value="7:00 PM">7:00 PM</option>
                              <option value="7:30 PM">7:30 PM</option>
                              <option value="8:00 PM">8:00 PM</option>
                              <option value="8:30 PM">8:30 PM</option>
                              <option value="9:00 PM">9:00 PM</option>
                           </select>
                        </div>
                      </div>
                  </div>

      <div class="form-group">
        <div class="row">

            <div class="col-md-3">
              <label>Clinic Day Start</label> 
                <select class="form-control" name="start_day_2">
                  <option hidden selected value="<?php echo $start_day_2?>"><?php echo $start_day_2?></option> 
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option> 
                </select>
            </div>

             <div class="col-md-3">
              <label>Clinic Day End</label> 
                <select class="form-control" name="end_day_2">
                    <option hidden selected value="<?php echo $end_day_2?>"><?php echo $end_day_2?></option> 
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>

             <div class="col-md-3">
              <label>Clinic Time Start</label> 
                    <select class="form-control" name="start_time_2">
                              <option hidden selected value="<?php echo $start_time_2?>"> <?php echo $start_time_2?></option>
                              <option value="7:30 AM">7:30 AM</option>
                              <option value="8:00 AM">8:00 AM</option>
                              <option value="8:30 AM">8:30 AM</option>
                              <option value="9:00 AM">9:00 AM</option>
                              <option value="9:30 AM">9:30 AM</option>
                              <option value="10:00 AM">10:00 AM</option>
                              <option value="10:30 AM">10:30 AM</option>
                              <option value="11:00 AM">11:00 AM</option>
                              <option value="11:30 AM">11:30 AM</option>
                              <option value="12:00 PM">12:00 PM</option>
                              <option value="12:30 PM">12:30 PM</option>
                              <option value="1:00 PM">1:00 PM</option>
                              <option value="1:30 PM">1:30 PM</option>
                              <option value="2:00 PM">2:00 PM</option>
                              <option value="2:30 PM">2:30 PM</option>
                              <option value="3:00 PM">3:00 PM</option>
                              <option value="3:30 PM">3:30 PM</option>
                              <option value="4:00 PM">4:00 PM</option>
                              <option value="4:30 PM">4:30 PM</option>
                              <option value="5:00 PM">5:00 PM</option>
                              <option value="5:30 PM">5:30 PM</option>
                              <option value="6:00 PM">6:00 PM</option>
                              <option value="6:30 PM">6:30 PM</option>
                              <option value="7:00 PM">7:00 PM</option>
                              <option value="7:30 PM">7:30 PM</option>
                              <option value="8:00 PM">8:00 PM</option>
                              <option value="8:30 PM">8:30 PM</option>
                              <option value="9:00 PM">9:00 PM</option>
                           </select>               
                        </div>

             <div class="col-md-3">
              <label>Clinic Time End</label> 
                <select class="form-control" name="end_time_2">
                              <option hidden selected value="<?echo $end_time_2f?>"><?php echo $end_time_2?></option>
                              <option value="7:30 AM">7:30 AM</option>
                              <option value="8:00 AM">8:00 AM</option>
                              <option value="8:30 AM">8:30 AM</option>
                              <option value="9:00 AM">9:00 AM</option>
                              <option value="9:30 AM">9:30 AM</option>
                              <option value="10:00 AM">10:00 AM</option>
                              <option value="10:30 AM">10:30 AM</option>
                              <option value="11:00 AM">11:00 AM</option>
                              <option value="11:30 AM">11:30 AM</option>
                              <option value="12:00 PM">12:00 PM</option>
                              <option value="12:30 PM">12:30 PM</option>
                              <option value="1:00 PM">1:00 PM</option>
                              <option value="1:30 PM">1:30 PM</option>
                              <option value="2:00 PM">2:00 PM</option>
                              <option value="2:30 PM">2:30 PM</option>
                              <option value="3:00 PM">3:00 PM</option>
                              <option value="3:30 PM">3:30 PM</option>
                              <option value="4:00 PM">4:00 PM</option>
                              <option value="4:30 PM">4:30 PM</option>
                              <option value="5:00 PM">5:00 PM</option>
                              <option value="5:30 PM">5:30 PM</option>
                              <option value="6:00 PM">6:00 PM</option>
                              <option value="6:30 PM">6:30 PM</option>
                              <option value="7:00 PM">7:00 PM</option>
                              <option value="7:30 PM">7:30 PM</option>
                              <option value="8:00 PM">8:00 PM</option>
                              <option value="8:30 PM">8:30 PM</option>
                              <option value="9:00 PM">9:00 PM</option>
                           </select>
                         </div>
                      </div>
                  </div>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
     <div class="card-header">

          <a href="secretaryViewClinic.php?viewClinicId=<?php echo $clinicId ?>" type="button" name="update" class="btn btn-danger btn mr-2">Back</a>
          <button type="submit" name="updateClinic" class="btn btn-primary btn mr-2">Update</button>
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

<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.min.js"></script>
<script src="https://unpkg.com/mapbox@1.0.0-beta9/dist/mapbox-sdk.min.js"></script>
<?php require('footer.php'); ?>
<script>
function getAddress(){
  var address = document.getElementById('clinic_address').value;
mapboxgl.accessToken = 'pk.eyJ1IjoiaG9tZXNhbmRjb25kb3MiLCJhIjoiY2p4Y2xqdGM4MDA3aTNubXd1Zm84dXp5MyJ9.MLd-FoLj3qnmOVSqMVMfEQ';

var geocoder = new MapboxGeocoder({
	    accessToken: mapboxgl.accessToken
	});

  var client = new MapboxClient(mapboxgl.accessToken);

  var test = client.geocodeForward(address, function(err, data, res) {
           // data is the geocoding result as parsed JSON
           // res is the http response, including: status, headers and entity properties
     
           var coordinates = data.features[0].center;

           console.log(coordinates);
           $('#lat').val(coordinates[1]);
          $('#lng').val(coordinates[0]);
  });
}
        

</script>