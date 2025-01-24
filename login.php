<?php
session_start();
include('Connect.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        $error = "Please fill in both fields!";
    } else {
    
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

    
        if ($user && $user['password'] === $password) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $email; 
            header("Location: index.php"); 
            exit;
        } else {
            $error = "Invalid email or password!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/login.css">
    <title>Login | Easter.gg - Access Your Account</title>

</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <form method="POST" action="">
            <h1>Login</h1>
            <?php if (isset($error))
                echo "<p class='error'>$error</p>"; ?>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter Your Email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Your Password" id="password" required>
            <button type="submit" name="Login">Login</button>
            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>