<?php

require("connect.php");
session_start();

if (isset($_POST['register'])) {

    $fullname = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username = $_POST["username"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO `users`(`fullname`, `email`, `password`, `username`, `gender`) 
            VALUES ('$fullname','$email','$password','$username','$gender')";
    if (mysqli_query($conn,$sql)) {
        header("location:../php/register.php?Warning= Registered Successfully");
    }
    else {
        header("location:../php/register.php?Warning= There is an error = ".mysqli_error($conn));
    }
}elseif (isset($_POST['login'])) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE username = '".$username."' AND password = '".$password."' ";

        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);
        
        if ($row['role']=="customer") {
            $_SESSION['username'] = $username;
            header("location:../php/index.php");
        }
        elseif ($row['role']=='admin') {
            $_SESSION['username'] = $username;
            $row['role'] = $userrole;
            $_SESSION['role'] = $userrole;
            header("location:../php/admin-navigation.php");
        }
        else {
            header("location:../php/login.php?Warning= Please Enter Correct Username or Password");
        }
    }
}
?>