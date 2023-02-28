<?php
        include 'config.php';
        $txtCatName = $_POST['txtCatName'];
        try{               
                $sql="INSERT INTO theloai(ten_tloai) VALUES ('$txtCatName')";
                $conn->exec($sql);
                header('Location:category.php');
        }
        catch(PDOException $e){
         echo $e->getMessage();
        }      
?>
