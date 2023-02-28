<?php
        // Kết nối tới database
        $con = mysqli_connect('localhost', 'root', '11032002', 'btth01_cse485');

        // Lấy dữ liệu từ form
        $tieude = $_POST['txtTieuDe'];
        $ten_bhat = $_POST['txtTenBaiHat'];
        $ma_tloai = $_POST['sltTheLoai'];
        $tomtat = $_POST['txtTomTat'];
        $noidung = $_POST['txtNoiDung'];
        $ma_tgia = $_POST['sltTacGia'];
        $hinhanh = $_FILES['fileHinhAnh']['name'];
        $ngayviet = date('Y-m-d H:i:s');

        // Kiểm tra các trường dữ liệu
        if ($tieude == "" || $ten_bhat == "" || $ma_tloai == "" || $ma_tgia == "") {
        echo "<script>alert('Vui lòng nhập đầy đủ các trường thông tin bắt buộc!');</script>";
        echo "<script>window.location = 'add_article.php'</script>";
        die();
        }

        // Upload hình ảnh
        if ($hinhanh != "") {
        $target_dir = "../images/songs/";
        $target_file = $target_dir . basename($_FILES["fileHinhAnh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $extensions_arr)) {
                move_uploaded_file($_FILES["fileHinhAnh"]["tmp_name"], $target_file);
        } else {
                echo "<script>alert('Chỉ chấp nhận file ảnh định dạng JPG, JPEG, PNG hoặc GIF!');</script>";
                echo "<script>window.location = 'add_article.php'</script>";
                die();
        }
        }

        // Thêm bài viết vào database
        $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, hinhanh, ngayviet) VALUES ('$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', '$noidung', '$ma_tgia', '$hinhanh', '$ngayviet')";
        $result = mysqli_query($con, $sql);

        if ($result) {
        echo "<script>alert('Thêm bài viết thành công!');</script>";
        echo "<script>window.location = 'article.php'</script>";
        } else {
        echo "<script>alert('Thêm bài viết thất bại!');</script>";
        echo "<script>window.location = 'add_article.php'</script>";
        }
?>