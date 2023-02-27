<?php
    session_start();

    if(isset($_POST['btnLogin'])){
        
        $user = $_POST['txtUser'];
        $pass = $_POST['txtPass'];

        if($user == 'd' && $pass == ''){
            $_SESSION[''] = $user;
            header("Location:");
        }else{
            header("Location:?error='Invalid user or pass'");
        }
    }


?>