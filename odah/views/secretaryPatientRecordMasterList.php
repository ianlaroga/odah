<?php require('header.php'); ?>

 <?php require('navigation.php'); ?>

 <div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Secretary</a>
    </li>
    <li class="breadcrumb-item active">Patient Record Master List</li>
  </ol>

  
  <!-- DataTables Example -->
  <div class="card mb-3">
   
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Patient ID</th>
              <th>Patient Name</th>
              <th>Dental Service</th>
              <th>Price</th>
              <th>Date</th>
              <th>Time</th>
              <th>Doctor</th>
              <th>Status</th>
            </tr>
          </thead>
           <tbody align="center">
                 <!--<form action="controllers" method="GET">
                <?php
                    //while($row = mysqli_fetch_assoc($result)){
                    //echo "<tr>";
                    //echo "<td>{$row['section_id']}</td>";
                    //echo "<td>{$row['section_name']}</td>";
                  
                    //echo "<td>";
                    //echo "<div class='btn-group'>";

                   // echo "<a href='viewClass.php?deleteClassId={$row['class_id']}' ><button type='submit' name='deleteClass' class='btn btn-info' onclick='return confirm('Are you sure?')'><i class='fa fa-times'></i>View Class </button> </a>";
               
                    //echo "<button type='submit' id='{$row['section_id']}' name='editSection' class='btn btn-primary editSection'> <i class='fa fa-eraser'></i> Edit</button>";
              
                   //echo "<a class='deleteSection' href='../controllers/sectionController.php?deleteSectionId={$row['section_id']}' ><button type='submit' name='deleteSection' class='btn btn-danger' onclick='return confirm('Are you sure?')'><i class='fa fa-trash'></i> Delete</button> </a>";
                     //                       echo "</div>";
                     //                 echo "</td>";
                     //               echo "</tr>"; 
                     //                  } ?>
                     //               </form>
                     //            </tbody>
                     -->
          
          
        </table>
      </div>
    </div>
    <div class="card-header">
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
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Registration for Walk-in Patients:</h5>
  </div>

  <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="../controllers/sectionController.php" method="POST">
                        <div class="row">
                            <div class="col-lg-12">   
                              
            <div class="modal-footer">
                <button type="submit" name="addSection" class="btn btn-primary">Add</button>
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

<!-- edit user -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
      </div>

<div class="modal-body">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" action="../controllers/sectionController.php" method="POST" onsubmit="return confirm('Are you sure?')">
                <div class="form-group">
                <input type="hidden" id="id" name="id" value="">
             
    <div class="modal-footer">
            <button type="submit" name="updateSection" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit -->

<?php require('footer.php'); ?>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.editSection', function(){
        var sectionId = $(this).attr("id");
        $.ajax({
          url:"../controllers/sectionController.php",
            method:"POST",
            data:{sectionId:sectionId},
            dataType:"json",
            success:function(data){
                $('#section_name').val(data.section_name);
                $('#id').val(data.section_id);
                $('#editSection').modal('show');
            }
        })
    })

});
</script>

<script type="text/javascript">
  $(".deleteSection").click(function(){
    return confirm("Are you sure you want to delete this section?");
  })
</script>