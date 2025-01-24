<?php

$connection = mysqli_connect('localhost', 'root', '', 'easter.gg');

$id = $_GET['id'];
$sql = "DELETE FROM `easter-eggs` WHERE id = $id;";

$result = mysqli_query($connection,$sql);

if($result) {
    header("Location: index.php");
} else {
    mysqli_error($conn);
}


?>