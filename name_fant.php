<?php

require_once('config.php');
session_start();


if (!empty($_POST['name']) && $_POST["submit"]){
    $team_name = $_POST['name'];
    
    $_SESSION['name']=$team_name;
    $sql1 = "UPDATE `users` SET `status`='submitted'";
    $result1 = mysqli_query($conn,$sql1);
    
    $sql = "CREATE TABLE `$team_name` ( Country VARCHAR(30) ,id VARCHAR(30) UNIQUE KEY, Name VARCHAR(30) , position VARCHAR(50))";
    
    
    $result = mysqli_query($conn,$sql);
    
    $email = $_SESSION['email-log'];
    $conTable ="INSERT INTO `userconn`(`email`, `Contab`) VALUES ('$email','$team_name')";
    $conTable_result = mysqli_query($conn,$conTable);

    if ($result){
        header('location:forward.php');
    }
}
?>
