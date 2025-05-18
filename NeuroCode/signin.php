<?php
$h1 = mysqli_connect("localhost", "root", "", "neurocode"); 

$username = $_POST['username'];
$password = $_POST['password']; 


$h2 = "SELECT * FROM users WHERE UserName = '$username' OR Email = '$username';";
$r = mysqli_query($h1, $h2);
$num = mysqli_num_rows($r);

if ($num == 1) {
    $row = mysqli_fetch_assoc($r); 
    $salt = $row['Salt']; 
    $hash = $password . $salt; 
    $hashedPass = md5($hash);

    if ($hashedPass == $row['PassWord']) { 
        session_start();
        $_SESSION['username'] = $row['UserName']; 
        header("location:profile.php");
    } else {
        header("location:signin.html"); 
    }
} else {
    header("location:signin.html");
}
?>