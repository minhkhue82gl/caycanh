<?php
require_once 'DB.php';
if(isset($_POST["action"]) && $_POST["action"] == "update") {

if(isset($_SESSION['current_user'])) {
    $user_id = $_SESSION['current_user']['user_id']; 

    $select_query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $select_query);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ten']) && isset($_POST['diachi']) && isset($_POST['sdt'])) {
            $ten = $_POST['ten'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            if(preg_match('/^\d{10}$/', $sdt)) {
                $update_query = "UPDATE users SET ten = '$ten', diachi = '$diachi', sdt = '$sdt' WHERE user_id = $user_id";
                if (mysqli_query($conn, $update_query)) {
                    echo "<script>alert('Thông tin đã được cập nhật thành công');</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='./dathang.php';}, 1000);</script>";
                    exit;
                } else {
                    echo "<script>alert('Lỗi khi cập nhật thông tin người dùng: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Số điện thoại phải chứa đúng 10 chữ số và chỉ chứa ký tự số.');</script>";
            }
        } else {
            echo "<script>alert('Thiếu thông tin cần thiết để cập nhật người dùng.');</script>";
        }
    }
} else if(isset($_SESSION['user_info'])) {
    $user_id = $_SESSION['user_info']['user_id']; 
    $select_query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $select_query); if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ten']) && isset($_POST['diachi']) && isset($_POST['sdt'])) {
            $ten = $_POST['ten'];
            $diachi = $_POST['diachi'];
            $sdt = $_POST['sdt'];
            if(preg_match('/^\d{10}$/', $sdt)) {
                $update_query = "UPDATE users SET ten = '$ten', diachi = '$diachi', sdt = '$sdt' WHERE user_id = $user_id";
                if (mysqli_query($conn, $update_query)) {
                    echo "<script>alert('Thông tin đã được cập nhật thành công');</script>";
                    echo "<script>window.setTimeout(function(){window.location.href='./dathang.php';}, 1000);</script>";
                    exit;
                } else {
                    echo "<script>alert('Lỗi khi cập nhật thông tin người dùng: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Số điện thoại phải chứa đúng 10 chữ số và chỉ chứa ký tự số.');</script>";
            }
        } else {
            echo "<script>alert('Thiếu thông tin cần thiết để cập nhật người dùng.');</script>";
        }
    }
}}
?>
