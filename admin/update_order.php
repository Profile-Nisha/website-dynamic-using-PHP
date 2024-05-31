<?php
include_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $id = $_POST['id'];
    $sliderorder = $_POST['sliderorder'];

    // Update the slider order in the database
    $sql = "UPDATE slider SET sliderorder=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sliderorder, $id);
    if ($stmt->execute()) {
        echo "Slider order updated successfully";
    } else {
        echo "Error updating slider order: " . $conn->error;
    }
}
?>
