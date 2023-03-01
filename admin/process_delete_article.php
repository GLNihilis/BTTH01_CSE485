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

// Xóa bài viết
$sql = "DELETE FROM baiviet WHERE ma_bviet = '$ma_bviet'";
$result = mysqli_query($con, $sql);
if ($result) {
    echo "<script>alert('Xóa bài viết thành công!');</script>";
    echo "<script>window.location = 'article.php'</script>";
} else {
    echo "<script>alert('Xóa bài viết thất bại!');</script>";
    echo "<script>window.location = 'article.php'</script>";
}
?>