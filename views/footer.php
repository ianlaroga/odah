

  <!-- End add -->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>


 <script>
    $(document).ready(function() {
        $('#maleStudents').DataTable({
            "scrollY": "100%",
            "responsive": true,
            "paging": true,
            "scrollX": true,
            "searching": true,
            "info": false,
            "ordering": false
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#clinicTable').DataTable({
        });
    });
</script>

  <script>
    $(document).ready(function() {
        $('#femaleStudents').DataTable({
            "scrollY": "100%",
            "responsive": true,
            "paging": true,
            "scrollX": false,
            "searching": true,
            "info": false,
            "ordering": false
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#dataTable1').DataTable({
            "scrollY": "200px",
            "responsive": true,
            "paging": true,
            "scrollX": false,
            "searching": false,
            "info": false,
            "ordering": false
        });
    });
    </script>

        <script>
    $(document).ready(function() {
        $('#viewClassStudentListTable').DataTable({
            "scrollY": "450px",
            "responsive": true,
            "paging": false,
            "scrollX": true,
            "searching": true,
            "info": false,
            "ordering": true
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#viewClassTable').DataTable({
            "scrollY": "450px",
            "responsive": true,
            "paging": true,
            "scrollX": true,
            "searching": true,
            "info": false,
            "ordering": true
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#classRecord').DataTable({
            "scrollY": "510px",
            "responsive": true,
            "paging": true,
            "scrollX": false,
            "searching": false,
            "info": false,
            "ordering": false
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#classStandingTable').DataTable({
            "scrollY": "100%",
            "responsive": true,
            "paging": true,
            "scrollX": false,
            "searching": false,
            "info": false,
            "ordering": false
        });
    });
    </script>
    
</html>
