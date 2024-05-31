<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: dashboard.php');
}

include_once 'connection.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Validation
    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($confirmpassword)) {
        echo "Please fill in all fields.";
    } elseif ($password !== $confirmpassword) {
        echo "Password and Confirm Password do not match.";
    } else {
        // Check if user already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "User already exists.";
        } else {
            // Insert new user
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (username, firstname, lastname, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $username, $firstname, $lastname, $email, $phone, $hashedPassword);
            if ($stmt->execute()) {
                
                header('location: index.php');
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section class="bg" mt-5>
        <div class="formContent">
            <form action="register.php" method="POST">
                <h3>registration-form</h3>
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter Mobile number">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create password">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="confirm-password" name="confirmpassword" placeholder="confirm password">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate">
                        I accepts all terms & conditions
                    </label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" name="submit"  id="button">Register Now</button>
                </div>
                <p>Already have an account?<a href="index.php">Login Now</a></p>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>