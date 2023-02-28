<?php
    include 'config.php';
    $id = $_GET['id'];
    try{
        $sql= "DELETE FROM tacgia WHERE ma_tacgia='$id'; ALTER TABLE theloai AUTO_INCREMENT = 1";
        $conn->exec($sql);
        header('Location:author.php');
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
   
?>