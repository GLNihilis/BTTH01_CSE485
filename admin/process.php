<?php
        include 'config.php';
        $txtThanh = $_POST['txtThanh'];
        try{               
                $sql="INSERT INTO theloai(ten_tacgia) VALUES ('$txtThanh')";
                $conn->exec($sql);
                header('Location:author.php');
        }
        catch(PDOException $e){
         echo $e->getMessage();
        }      
?>