<?php
$connection = mysqli_connect('localhost', 'root', '', 'easter.gg');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/Gallery.css">
    <title>Gallery | Easter.gg - Explore Easter-Themed Creations and Art</title>
</head>

<body>
    <?php include('header.php'); ?>
    <main class="gallery">
        <h1 class="gallery-title">Easter Egg Gallery</h1>
        <div class="search-container">
            <input type="text" placeholder="SEARCH FOR EASTER EGG" class="search-input">
        </div>
        <div class="gallery-grid">
            <?php
            // Fetch data from the database
            $query = "SELECT `id`, `Game-Name`, `Image`, `Game-desc` FROM `easter-eggs`";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                // Loop through each row in the result
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="card">
                        <!-- Dynamically populate card with data -->
                        <img src="uploads/<?php echo ($row['Image']); ?>" alt="<?php echo ($row['Game-Name']); ?>" class="card-img">
                        <h2 class="card-title"><?php echo ($row['Game-Name']); ?></h2>
                        <h2 class="card-description"><?php echo ($row['Game-desc']); ?></h2>
                        <a href="Details.php?id=<?php echo ($row['id']); ?>" class="card-link">View Details</a>
                    </div>
                    <?php
                }
            } else {
                // If no records found
                echo "<p>No games found in the gallery.</p>";
            }
            ?>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="JavaScript/Gallery.js"></script>
</body>

</html>
