<?php
session_start();
require_once 'DB.php';
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
   

if (isset($_GET['sanpham_id'])) {
    $sanpham_id = $_GET['sanpham_id'];

    $delete_sanpham_loai_sql = "DELETE FROM sanpham_loai WHERE sanpham_id = ?";
    $stmt = $conn->prepare($delete_sanpham_loai_sql);
    $stmt->bind_param("i", $sanpham_id);
    $stmt->execute();
    $stmt->close();

    $delete_sanpham_sql = "DELETE FROM sanpham WHERE sanpham_id = ?";
    $stmt = $conn->prepare($delete_sanpham_sql);
    $stmt->bind_param("i", $sanpham_id);
    $stmt->execute();
    $stmt->close();
    header("Location: ../index.php");
} else {
    echo "Không có ID sản phẩm được cung cấp     32423423442342342442432!";
}
}
$conn->close();
?>