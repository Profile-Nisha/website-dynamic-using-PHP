<?php
session_start();
if(isset($_SESSION['username'])){
    header('location: dashboard.php');
}
include_once 'connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['firstname'];
                $_SESSION['id'] = $user['id'];
                header('location: dashboard.php');
                
            } else {
                echo "Incorrect email or password.";
            }
        } else {
            echo "User not found.";
        }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
  <section class="bg" mt-5>
        <div class="formContent">
            <form action="index.php" method="POST">
                <h3>Login</h3>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
                <div class="d-grid gap-2">
                    <button name="submit" class="btn btn-primary" type="submit">Login</button>
                </div><br>

                <p> <span>forget password?</span></p>
                <p class="pi">Don't have an account?<a href="register.php">Register Now</a></p>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>