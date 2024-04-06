<?php
require_once 'DB.php';
include 'loai.php';

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : null;
$mieuta = isset($_POST['mieuta']) ? $_POST['mieuta'] : null;
$gia = isset($_POST['gia']) ? $_POST['gia'] : null;
$soluong = isset($_POST['soluong']) ? $_POST['soluong'] : null;
$ten = isset($_POST['tenloai']) ? $_POST['tenloai'] : [];
$loai_ids = isset($_POST['loai_id']) ? $_POST['loai_id'] : [];
$cover_image_path = null;

if ($_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    $cover_image_path = $upload_dir . basename($_FILES['cover_image']['name']);
    
    $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    $fileType = mime_content_type($_FILES['cover_image']['tmp_name']);

    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Invalid file type. Only JPEG, PNG, and GIF files are allowed.');</script>";
        $conn->close();
        header("Location: ../addsanpham.php");
        exit();
    }

    move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_path);
    echo "File uploaded successfully.";
}
$sql_sanpham = $conn->prepare("INSERT INTO sanpham (tensanpham, mieuta, soluong, gia, cover_image_path) VALUES (?, ?, ?, ?, ?)");
$sql_sanpham->bind_param("ssdds", $tensanpham, $mieuta, $soluong, $gia, $cover_image_path);
$sql_sanpham->execute();

if ($sql_sanpham->errno) {
    echo "Lỗi khi thêm sản phẩm: " . $sql_sanpham->error;
    $conn->close();
    exit();
}
$sanpham_id = $conn->insert_id;
if (isset($_POST['loai_id'])) {
    $loai_arr = $_POST['loai_id'];
    foreach ($loai_arr as $loai_id) {
        $sql_loai = $conn->prepare("INSERT INTO sanpham_loai (sanpham_id, loai_id) VALUES (?, ?)");
        $sql_loai->bind_param("ii", $sanpham_id, $loai_id);
        $sql_loai->execute();
        if ($sql_loai->errno) {
            echo "Lỗi khi thêm loại sản phẩm: " . $sql_loai->error;
            $conn->close();
            exit();
        }
    }
} else {
    echo "Không có loại sản phẩm được chọn.";
}
echo '<script>window.location.href = "../chitiet.php?sanpham_id=' . $sanpham_id . '";</script>';

?>
