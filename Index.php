<?php
session_start();


$connection = mysqli_connect('localhost', 'root', '', 'easter.gg');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['save'])) {
    $game_name = mysqli_real_escape_string($connection, $_POST['game_name']);
    $egg_title = mysqli_real_escape_string($connection, $_POST['egg_title']);
    $brief_description = mysqli_real_escape_string($connection, $_POST['Brief-Description']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $image = $_FILES['image']['name'];
    $video_link = mysqli_real_escape_string($connection, $_POST['video_link']);
    $release_date = mysqli_real_escape_string($connection, $_POST['release_date']);
    $name = mysqli_real_escape_string($connection, $_POST['Myname']);

    // Check if image already exists
    if (file_exists("uploads/" . $image)) {
        $_SESSION['status'] = 'Image Already Exists';
        header('location: index.php');
    } else {
        // Insert into database
        $insert_query = "INSERT INTO `easter-eggs` (`Game-Name`, `Easter-Title`, `Game-desc`, `Description`, `Image`, `Release-date`, `Video-link`, `name`) VALUES ('$game_name', '$egg_title', '$brief_description', '$description', '$image', '$release_date', '$video_link', '$name')";
        
        if (mysqli_query($connection, $insert_query)) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $image);
            $_SESSION['status'] = "Image stored successfully";
            header('location: index.php');
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($connection);
            header('location: AddEaster.php');
        }
    }
}

if (isset($_POST['update_image'])) {
    $user_id = mysqli_real_escape_string($connection, $_POST['id']);
    $game_name = mysqli_real_escape_string($connection, $_POST['game_name']);
    $egg_title = mysqli_real_escape_string($connection, $_POST['egg_title']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $new_image = $_FILES['image']['name'];
    $old_image = mysqli_real_escape_string($connection, $_POST['image_old']);
    $video_link = mysqli_real_escape_string($connection, $_POST['video_link']);
    $release_date = mysqli_real_escape_string($connection, $_POST['release_date']);

    // If new image is uploaded, check if it already exists
    if ($new_image != '') {
        if (file_exists("uploads/" . $new_image)) {
            $_SESSION['status'] = 'Image Already Exists';
            header('location: EditEaster.php');
            exit();
        }
    } else {
        $new_image = $old_image;
    }

    // Update database
    $update_query = "UPDATE `easter-eggs` SET `Game-Name`='$game_name', `Easter-Title`='$egg_title', `Description`='$description', `Image`='$new_image', `Release-date`='$release_date', `Video-link`='$video_link' WHERE `id`='$user_id'";

    if (mysqli_query($connection, $update_query)) {
        if ($new_image != $old_image) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $new_image);
            unlink("uploads/" . $old_image);
        }

        $_SESSION['status'] = "Image updated successfully";
        header('location: index.php');
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($connection);
        header('location: EditEaster.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/index.css">
    <title>Home | Easter.gg - Find and know Easter eggs of fun games</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <div class="banner">
            <div class="bg">
                <div class="content">
                    <p class="header1">
                        Discover the world's top
                    </p>
                    <p class="header2">
                        Gaming Easter Eggs
                    </p>
                    <p class="header3">
                        Explore work from the most famous
                    </p>
                    <p class="header4"> games easter eggs, engage and have fun!! </p>
                    <a href="Gallery.php"><button class="Addhome"> Explore Gallery</button></a>
                </div>
                <img class="hallow" src="Images/Hollow-Knight-PNG-Images-HD1-removebg.png">

            </div>
        </div>
        <section id="fun-facts">
            <h1>Did You Know?</h1>
            <div class="facts-container">
                <div class="fact">
                    <p><strong>Pac-Man's Shape:</strong> Pac-Man's design was inspired by a pizza missing a slice!</p>
                </div>
                <div class="fact">
                    <p><strong>First Easter Egg:</strong> The first video game Easter egg appeared in <em>Adventure</em>
                        (1980) for the Atari 2600!</p>
                </div>
                <div class="fact">
                    <p><strong>Mario's Name:</strong> Mario was named after the landlord of Nintendo's first warehouse
                        in the U.S.</p>
                </div>
            </div>
        </section>

        <section id="about-us">
            <div class="about-content">
                <h2 class="about-title">About Us</h2>
                <p class="about-description">
                    At <strong>Easter.gg</strong>, we’re passionate about uncovering the hidden gems in your favorite
                    games.
                    Our platform is dedicated to celebrating the creativity and surprises that developers weave into
                    their worlds.
                    From classic Easter eggs to the newest discoveries, we bring gamers together to share, explore, and
                    connect.
                </p>
                <p class="about-description">
                    Whether you're a casual gamer or a hardcore explorer, Easter.gg is your go-to place to celebrate the
                    joy of discovery. Join us in exploring the secrets and stories behind the games you love!
                </p>
            </div>
        </section>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>