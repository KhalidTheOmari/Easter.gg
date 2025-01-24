<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/AddEaster.css">
    <title>Add Easter Content | Easter.gg - Share Your Easter Creations</title>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="form-container">
        <h1 class="header1">Add Game Easter Egg</h1>

        <?php
        if (isset($_SESSION['status']) && $_SESSION != '') {
            echo '' . $_SESSION['status'];
            ?>

            <?php
            unset($_SESSION['status']);
        }
        ?>

        <form action="index.php" method="POST" enctype="multipart/form-data">

            <label for="your name">Your Name</label>
            <input type="text" id="yourName" name="Myname" required>


            <label for="game_name">Game Name</label>
            <input type="text" id="game_name" name="game_name" required>

            <label for="egg_title">Easter Egg Title</label>
            <input type="text" id="egg_title" name="egg_title" required>

            <label for="Brief Description">Brief Description</label>
            <input type="text" id="Brief-Description" name="Brief-Description" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required></textarea>


            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">

            <label for="video_link">Video Link</label>
            <input type="url" id="video_link" name="video_link">

            <label for="release_date">Release Date</label>
            <input type="date" id="release_date" name="release_date">

            <button class="submit" type="submit" name="save">Submit</button>
        </form>
    </div>
    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>