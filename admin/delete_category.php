<?php
    include 'config.php';
    $id = $_GET['id'];
    try{
        $sql= "DELETE FROM theloai WHERE ma_tloai='$id'; ALTER TABLE theloai AUTO_INCREMENT = 1";
        $conn->exec($sql);
        header('Location:category.php');
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
   
?>