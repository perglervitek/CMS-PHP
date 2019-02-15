<?php
include "db.php";
session_start();

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string( $connection,$username);
    $password = mysqli_real_escape_string( $connection,$password);


    $query = "SELECT * FROM users WHERE user_name='{$username}'";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){
        die(mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($query_result)){
       $db_username = $row["user_name"];
       $db_password = $row["user_password"];
       $db_firstname = $row["user_firstname"];
       $db_lastname = $row["user_lastname"];
       $db_role = $row['user_role'];
    }

    $pwdcheck= password_Verify($password,$db_password);

    if($username !== $db_username && $pwdcheck!== $db_password){
        header("Location: ../index.php");
    }else if($username == $db_username && $pwdcheck== $db_password){
        $_SESSION["username"] = $db_username;
        $_SESSION["firstname"] = $db_firstname;
        $_SESSION["lastname"] = $db_lastname;
        $_SESSION["role"] = $db_role;
        header("Location: ../admin");
    }else{
        header("Location: ../index.php");
    }
}

