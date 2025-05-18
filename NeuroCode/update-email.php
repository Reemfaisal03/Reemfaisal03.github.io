<?php
session_start();
$h1 = mysqli_connect("localhost", "root", "", "neurocode");
if (!$h1) {
    die("Connection failed: " . mysqli_connect_error());
}
$email = $_POST['email'];
$username = $_SESSION['username'];
$h2 = "UPDATE `users` SET `email`='$email' WHERE `username`='$username'";
if (mysqli_query($h1, $h2)) {
    echo "Email updated successfully.";
} else {
    echo "Error updating email: " . mysqli_error($h1);
}
mysqli_close($h1);
?>