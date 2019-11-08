<?php require('../../controllers/connection.php'); 
$conn = connect();

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

</head>

<body>

    <?php require('homeNav.php');?>

        <div class="container">
            <?php
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
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Online Dental Hub at your service!</h1>
                    </div>
                </div>
                <br>
                <form method="get" action="displaySearch.php">
                 
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
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.slim.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<style>
    form {
        border: none !important;
    }
</style>