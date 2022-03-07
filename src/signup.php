<?php
    include('classes/DB.php');
    include('classes/User.php');

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $pass = $_POST["password"];
        $email = $_POST["email"];

    $user2 = new User($username,$pass,$email);

    $user2->addUser($user2);
    // header('location:loginHtml.php');

    }
