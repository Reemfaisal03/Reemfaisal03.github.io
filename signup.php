<?php
$h1 = mysqli_connect("localhost","root","","neurocode");
$firstname = $_POST['first-name']; 
$lastname = $_POST['last-name']; 
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$h2 = "SELECT * FROM users WHERE UserName = '$username' OR Email = '$email';";
$r = mysqli_query($h1,$h2);
$num = mysqli_num_rows($r);
    if ($num==0){
        $salt=rand(1,2000);
        $hash = $password.$salt;
        $hashedPass = md5($hash);
        $h3  = "INSERT INTO `users`(`FirstName`, `LastName`, `Email`, `UserName`, `PassWord`, `Salt`) VALUES ('$firstname','$lastname','$email','$username','$hashedPass', '$salt')";
        mysqli_query($h1,$h3);
        header("location:signin.html");
        }
    else{
        header("location:signup.html");
}
?>