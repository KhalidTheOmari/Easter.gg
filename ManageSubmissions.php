<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$connection = mysqli_connect('localhost', 'root', '', 'easter.gg');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('head.php'); ?>
    <link rel="stylesheet" href="Styles/ManageSubmissions.css">
    <title>Manage Submissions | Easter.gg - Review and Organize Easter Creations</title>
</head>

<body>
    <!-- Header -->
    <?php include('header.php'); ?>
    <!-- Main Content -->
    <main class="manage-submissions">
        <h1 class="title">Manage Your Submissions</h1>

        <!-- Add New Submission -->
        <div class="add-new">
            <a href="AddEaster.php" class="add-button">+ Add New Submission</a>
        </div>

        <!-- Submissions Table -->
        <table class="submission-table">
            <thead>
                <tr>
                    <th>Game Title</th>
                    <th>Brief Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data for submissions from the database
                $query = "SELECT `id`, `Game-Name`, `Game-desc` FROM `easter-eggs`";

                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    // Loop through each submission and create table rows
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                        <tr> 
                            <td><?php echo ($row['Game-Name']); ?></td>
                            <td><?php echo ($row['Game-desc']); ?></td>
                            <td>
                                <!-- Links for editing and deleting -->
                                <a href="EditEaster.php?id=<?php echo $row['id']; ?>" class="action-btn edit-btn">Edit</a>
                                <a href="DeleteEaster.php?id=<?php echo $row['id']; ?>" class="action-btn delete-btn">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // If no submissions exist
                    echo "<tr><td colspan='3'>No submissions found. Add your first Easter egg!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <?php include('footer.php'); ?>

    <script>
        // Example delete confirmation
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                if (!confirm("Are you sure you want to delete this submission?")) {
                    e.preventDefault();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>
