<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/EditEaster.css">
    <title> Edit Easter | Easter.gg - Customize Your Easter Content</title>
</head>

<body>
    <!-- Header -->
    <?php include('header.php'); ?>
    <!-- Main Content -->
    <main>
        <div class="form-container">
            <h1 class="header1">Edit Your Easter Egg</h1>

            <?php

            $connection = mysqli_connect('localhost', 'root', '', 'easter.gg');
            $id = $_GET['id'];
            $fetch_image_query = "SELECT * FROM `easter-eggs` WHERE id= '$id'";
            $fetch_image_query_run = mysqli_query($connection, $fetch_image_query);

            if (mysqli_num_rows($fetch_image_query_run) > 0) {
                foreach ($fetch_image_query_run as $row) {
                    // echo $row['id'];
                    ?>

                    <form action="index.php" method="POST" enctype="multipart/form-data" class="edit-form">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"

                        <!-- Game Name -->
                        <label for="game_name">Game Name</label>
                        <input type="text" id="game_name" name="game_name" value="<?php echo $row['Game-Name']; ?>" required>

                        <!-- Easter Egg Title -->
                        <label for="egg_title">Easter Egg Title</label>
                        <input type="text" id="egg_title" name="egg_title" value="<?php echo $row['Easter-Title']; ?>" required>

                        <!-- Description -->
                        <label for="description">Description</label>
                        <textarea id="description" name="description" cols="40" rows="10"
                            required><?php echo ($row['Description']); ?></textarea>

                        <!-- Image -->
                        <label for="image">Update Image (optional)</label>
                        <input type="file" name="image">
                        <input type="hidden" id="image" name="image_old" accept="image/*" value="<?php echo $row['Image']; ?>">
                        <img src="<?php echo "uploads/".$row['Image']; ?>" alt="image">
                        

                        <!-- Video Link -->
                        <label for="video_link">Video Link</label>
                        <input type="url" id="video_link" name="video_link" value="<?php echo $row['Video-link']; ?>">

                        <!-- Release Date -->
                        <label for="release_date">Release Date</label>
                        <input type="date" id="release_date" name="release_date" value="<?php echo $row['Release-date']; ?>">

                        <!-- Buttons -->
                        <div class="button-group">
                           <button type="submit" class="save-btn" name="update_image">Save Changes</button>
                            <a href="ManageSubmissions.php" class="cancel-btn">Cancel</a>
                        </div>
                    </form>
                    <?php

                }
            } else {
                echo "no data found";
            }


            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html> 