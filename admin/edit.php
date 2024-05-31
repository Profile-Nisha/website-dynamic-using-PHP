<?php

// error_reporting(0);
include_once 'connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM slider WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit-Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section class="dashboard">
        <div class="containerfluid">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="logo">
                        <img src="assets/images/headerbg.jpg" alt="">
                        <div class="hamburger-menu">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="admin">
                        <h5>Admin</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="dash">
                        <a href="dashboard.php">
                            <h4>Dashboard</h4>
                        </a>
                        <hr>
                        <h5><a href="slider.php">Slider</a></h5>
                        <a href="logout.php" class="btn btn-danger text-white ">Logout</a>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-2">
                                <h4>Edit Slider</h4>
                            </div>
                            <form action="update.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group mt-3">
                                    <label for="username">Slider Name</label>
                                    <input type="text" id="slidername" name="slidername" value="<?php echo $row['slidername']; ?>">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="username">Slider Order</label>
                                    <input type="text" id="sliderorder" name="sliderorder" value="<?php echo $row['sliderorder']; ?>">
                                </div><br>
                                <div class='form-group'>
                                    <label for="image">Uploaded photo:</label><br>
                                    <img src="<?= $row['pic']; ?>" alt="Uploaded Image" style="max-width: 200px;"><br>
                                    <label for="pic">Change photo:</label>
                                    <input type="file" id="pic" name="pic">
                                     
                                </div><br>
                                <br>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="submit">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>