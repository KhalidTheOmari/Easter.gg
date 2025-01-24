<?php
// Start the session
session_start();

// Database connection
$connection = mysqli_connect('localhost', 'root', '', 'easter.gg');

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    // Fetch data for the specific ID
    $fetch_image_query = "SELECT * FROM `easter-eggs` WHERE `id` = '$id'";
    $fetch_image_query_run = mysqli_query($connection, $fetch_image_query);

    // Check if a record was found
    if (mysqli_num_rows($fetch_image_query_run) > 0) {
        $row = mysqli_fetch_assoc($fetch_image_query_run);
    } else {
        // Redirect if no record is found
        $_SESSION['status'] = "Easter Egg not found!";
        header("Location: Gallery.php");
        exit();
    }
} else {
    // Redirect if no ID is provided
    $_SESSION['status'] = "No Easter Egg ID specified!";
    header("Location: Gallery.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/Details.css">
    <title>Details | Easter.gg - Learn More About Easter Content</title>
</head>

<body>
    <?php include('header.php'); ?>

    <main class="details">
        <section class="details-content">
            <!-- Dynamic Content -->
            <div class="details-info">
                <h1 class="details-title">Game Name: <span
                        id="game-name"><?php echo ($row['Game-Name']); ?></span></h1>
                <h2 class="details-easter-title">Easter Egg Title: <span
                        id="easter-egg-title"><?php echo ($row['Easter-Title']); ?></span></h2>
                <p class="details-description">
                    <strong>Description:</strong> <?php echo ($row['Description']); ?>
                </p>
                <div class="image-info">
                    <img src="uploads/<?php echo ($row['Image']); ?>" alt="Easter Egg Image"
                        class="details-img">
                    <?php if (!empty($row['Video-link'])): ?>
                        <p><strong>Video of the Easter Egg:</strong> <a
                                href="<?php echo ($row['Video-link']); ?>"
                                target="_blank"><?php echo ($row['Video-link']); ?></a></p>
                    <?php endif; ?>
                </div>
                <ul class="details-meta">
                    <li><strong>Release Date:</strong> <?php echo ($row['Release-date']); ?></li>
                    <li><strong>Added By:</strong> <?php echo ($row['name']); ?></li>
                </ul>
            </div>
                <a href="Gallery.php" class="back-link">Back to Gallery</a>
        </section>
    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>