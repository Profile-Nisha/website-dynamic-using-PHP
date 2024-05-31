<?php


include_once 'connection.php';





$sql = "SELECT * FROM slider";
$result = mysqli_query($conn, $sql);



if (isset($_GET['status'])) {
    $status = $_GET['status'] == 'active' ? 1 : 0;

    // Update the status of the slider
    $sql = "UPDATE slider SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $_GET['id']);
    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
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
                        <h5><a href="heading_section.php">Heading-Section</a></h5>
                        <a href="logout.php" class="btn btn-danger text-white">Logout</a>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="d-flex justify-content-between mt-2">
                        <h4>Slider/Banner</h4>

                        <a href="slider.php" class="btn btn-primary text-end">+ Add More</a>



                    </div>
                    <table class="tab">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Slider Name</td>
                                <td>Image</td>
                                <td>Published Date</td>
                                <td>Published</td>
                                <td>Order</td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['slidername'] ?></td>
                                        <td><img src="<?php echo $row['pic'] ?>" alt="img" width="150"></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked_<?php echo $row['id']; ?>" <?php echo $row['status'] == '1' ? 'checked' : '0'; ?> onchange="updateStatus(<?php echo $row['id']; ?>)">
                                            </div>
                                        </td>


                                        <td><?php echo $row['sliderorder'] ?></td>
                                        <td><a href="./edit.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a></td>
                                    </tr>

                            <?php }
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this data?")) {

                window.location.href = "./delete.php?id=" + id;
            } else {

            }
        }
    </script>
    <script>
        function updateStatus(sliderId) {
            var isChecked = document.getElementById("flexSwitchCheckChecked_" + sliderId).checked;
            var status = isChecked ? 'active' : 'inactive';

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "dashboard.php?id=" + sliderId + "&status=" + status, true);
            xhttp.send();
        }
    </script>


</body>

</html>