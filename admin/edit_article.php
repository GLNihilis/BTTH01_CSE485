<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
    <script src="../js/ckeditor/ckeditor.js"></script>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">

        <?php
        // Kết nối tới database
        $con = mysqli_connect('localhost', 'root', '11032002', 'btth01_cse485');

        // Lấy giá trị ma_bviet từ URL
        if (isset($_GET['id'])) {
            $ma_bviet = intval($_GET['id']);
        } else {
            // Nếu không có mã bài viết, chuyển hướng về trang danh sách bài viết
            header('Location: article.php');
            exit();
        }

        // Truy vấn SQL để lấy dữ liệu của bài viết có ma_bviet tương ứng
        $sql = "SELECT bv.*, tl.ten_tloai, tg.ten_tgia FROM baiviet bv, theloai tl, tacgia tg 
        WHERE bv.ma_tgia = tg.ma_tgia AND bv.ma_tloai = tl.ma_tloai AND bv.ma_bviet = $ma_bviet";
        $result = mysqli_query($con, $sql);

        // Lấy dữ liệu bài viết từ kết quả truy vấn
        $article = mysqli_fetch_assoc($result);
        ?>


        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa bài viết</h3>
                <form action="process_edit_article.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTieuDe">Mã bài viết</span>
                        <input style="background-color: #DCDCDC" readonly type="text" class="form-control" name="txtMaBViet" value="<?php echo $article['ma_bviet']; ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTieuDe">Tiêu đề (*)</span>
                        <input type="text" class="form-control" name="txtTieuDe" value="<?php echo $article['tieude']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTenBaiHat">Tên bài hát (*)</span>
                        <input type="text" class="form-control" name="txtTenBaiHat" value="<?php echo $article['ten_bhat']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTheLoai">Thể loại (*)</span>
                        <select class="form-select" name="sltTheLoai" >
                            <?php
                            // Kết nối tới database
                            $con = mysqli_connect('localhost', 'root', '11032002', 'btth01_cse485');

                            // Lấy danh sách thể loại từ bảng theloai
                            $sql = "SELECT * FROM theloai";
                            $result = mysqli_query($con, $sql);

                            // Hiển thị các tùy chọn thể loại trong dropdown list
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['ma_tloai'] == $article['ma_tloai']) {
                                    echo '<option value="' . $row['ma_tloai'] . '" selected>' . $row['ten_tloai'] . '</option>';
                                } else {
                                    echo '<option value="' . $row['ma_tloai'] . '">' . $row['ten_tloai'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTomTat">Tóm tắt</span>
                        <textarea class="form-control" name="txtTomTat" rows="3"><?php echo $article['tomtat']; ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblNoiDung">Nội dung</span>
                        <textarea class="form-control" name="txtNoiDung" rows="10" id="ckeditor1"><?php echo $article['noidung']; ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span style="width: 10%" class="input-group-text" id="lblTacGia">Tác giả (*)</span>
                        <select class="form-select" name="sltTacGia">
                            <?php
                            // Lấy danh sách tác giả từ bảng tacgia
                            $sql = "SELECT * FROM tacgia";
                            $result = mysqli_query($con, $sql);

                            // Hiển thị các tùy chọn tác giả trong dropdown list
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['ma_tgia'] == $article['ma_tgia']) {
                                    echo '<option value="' . $row['ma_tgia'] . '" selected>' . $row['ten_tgia'] . '</option>';
                                } else {
                                    echo '<option value="' . $row['ma_tgia'] . '">' . $row['ten_tgia'] . '</option>';
                                }
                            }
                            // Đóng kết nối
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span style="width: 10%; height: 20%" class="input-group-text" id="lblHinhAnh">Hình ảnh</span>
                        <?php
                        $sql = "SELECT * FROM baiviet";
                        $result = mysqli_query($con , $sql);
                       
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['ma_bviet'] == $article['ma_bviet']) {
                                
                                $imgFileName = "../images/songs/" . $row['hinhanh'];
                                echo "<input style='height: 20%; width: 10%' type='file' id='img_edit' class='form-control' name='fileHinhAnh' value='".$imgFileName."'>
                                    <img style='object-fit: contain;max-width: 30%;max-height: 30%;width: auto;height: auto;' src='".$imgFileName."'>";
                            } else {
                                
                            }
                        }
                        ?>
                        
                    </div>

                    <div class="form-group float-end">
                        <p id="noti"></p>
                        <input type="submit" value="Sửa" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
                
                <script>
                    CKEDITOR.replace("ckeditor1");
                </script>
                <?php
                // $id_old = "edit_article.php?id=" . $ma_bviet;
                // echo $id_old;
                ?>
                

                <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
                <!-- <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="process_add_category.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên bài viết</span>
                        <input type="text" class="form-control" name="txtCatName" >
                    </div>
                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div> -->
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
        <script>
            const form = document.querySelector('form');
            form.addEventListener('submit', (event) => {
                event.preventDefault(); // Ngăn chặn form submit nếu có lỗi

                var tieuDeInput = document.querySelector('input[name="txtTieuDe"]');
                var tenBaiHatInput = document.querySelector('input[name="txtTenBaiHat"]');
                var tomTatInput = document.querySelector('textarea[name="txtTomTat"]');
                var noiDungInput = document.querySelector('textarea[name="txtNoiDung"]');
                var tacGiaInput = document.querySelector('select[name="sltTacGia"]');

                // Kiểm tra trường Tiêu đề
                if (tieuDeInput.value.trim() === '') {
                    alert('Bạn chưa nhập Tiêu đề');
                    return;
                }

                // Kiểm tra trường Tên bài hát
                if (tenBaiHatInput.value.trim() === '') {
                    alert('Bạn chưa nhập Tên bài hát');
                    return;
                }

                // // Kiểm tra trường Tóm tắt
                // if (tomTatInput.value.trim() === '') {
                //     alert('Bạn chưa nhập Tóm tắt');
                //     return;
                // }

                // Kiểm tra trường Nội dung
                // if (noiDungInput.value.trim() === '') {
                //     alert('Bạn chưa nhập Nội dung');
                //     return;
                // }

                // Kiểm tra trường Tác giả
                if (tacGiaInput.value === '') {
                    alert('Bạn chưa chọn Tác giả');
                    return;
                }

                // Nếu không có lỗi, submit form
                form.submit();
            });
        </script>
</body>

</html>