<?php
session_start();
include('Connect.php'); // Include your database connection

$errors = array(); // Array to hold errors

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect user inputs
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple form validation
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Check if the user already exists in the database
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if ($user['username'] === $username) {
                $errors[] = "Username already exists";
            }
            if ($user['email'] === $email) {
                $errors[] = "Email already exists";
            }
        }

        // If no errors, insert the user into the database
        if (count($errors) == 0) {
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['username'] = $username;
                header("Location: login.php"); // Redirect to login page after successful signup
                exit;
            } else {
                $errors[] = "Error: Could not register user.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('head.php'); ?>
<link rel="stylesheet" href="Styles/SignUp.css">
    <title>Sign Up | Easter.gg - Join the Easter.gg Community</title>
</head>
<body>
<?php include('header.php');?>
<main>
    <form method="POST" action="SignUp.php">
        <h1>Sign Up</h1>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Enter Your Name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter Your Email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter Your Password" required>

        <button type="submit" name="Sign Up">Sign Up</button>

        <div class="Loginlink">
            <p>Already have an account? <a href="login.php">Login</a></p>
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
