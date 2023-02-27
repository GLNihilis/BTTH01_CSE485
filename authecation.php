<?php
include('connection.php');
session_start();

try{
    if(isset($_POST['login_btn'])){
        
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $message = '<label>All fields are required</label>';
        } else {
            $query = "SELECT * FROM users WHERE username =:username AND password =:password";
            $statement = $conn -> prepare($query);
            $statement -> execute(

            );
            $count = $statement -> rowCount();
            if($count == 1){
                $_SESSION["username"] = $_POST["username"];
                header("location:login_success.php");
            } else {
                $message = '<label>Wrong Data</label>';
            }
        }
    }
} catch(PDOException $error){
    $message = $error -> getMessage();
}
?>