<?php


include_once "connection.php";

if (isset($_GET['id']) && isset($_GET['status'])) {
    $status = $_GET['status'] == 'active' ? 1 : 0;
    $id = $_GET['id'];

    $sql = "UPDATE heading SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $id);
    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $conn->error;
    }
    exit(); 
}


$sql = "SELECT * FROM heading";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>heading-section</title>
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
                        <a href="logout.php" class="btn btn-danger text-white ">Logout</a>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-2">
                                <h4>Heading-Section</h4>
                                <a href="add_heading.php" class="btn btn-primary text-end">+ Add More</a>
                            </div>
                           
                                <table class="paragraph">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Heading 1</th>
                                            <th>Heading 2</th>
                                            <th>Paragraph</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['heading1'] . "</td>";
                                            echo "<td>" . $row['heading2'] . "</td>";
                                            echo "<td>" . $row['paragraph'] . "</td>";
                                            echo "<td>";
                                            echo "<div class='form-check form-switch'>";
                                            echo "<input class='form-check-input' type='checkbox' role='switch' id='flexSwitchCheckChecked_" . $row['id'] . "' " . ($row['status'] == '1' ? 'checked' : '') . " onchange='updateStatus(" . $row['id'] . ")'>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "</tr>";
                                           
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No data found in the table.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        function updateStatus(headingId) {
            var isChecked = document.getElementById("flexSwitchCheckChecked_" + headingId).checked;
            var status = isChecked ? 'active' : 'inactive';

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "heading_section.php?id=" + headingId + "&status=" + status, true);
            xhttp.send();
        }
    </script>


</body>

</html>