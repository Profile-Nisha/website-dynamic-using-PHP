<?php
include_once 'connection.php';

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $slidername = $_POST['slidername'];
    $sliderorder = $_POST['sliderorder'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["pic"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check !== false) {
        if(move_uploaded_file($_FILES["pic"]["tmp_name"], $targetFilePath)){
            $sql = "UPDATE slider SET slidername='$slidername', sliderorder='$sliderorder', pic='$targetFilePath' WHERE id='$id'";
            if(mysqli_query($conn, $sql)){
                header('location:dashboard.php');
                echo "Records were updated successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
