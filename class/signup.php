<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'DB.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['gmail']) && isset($_POST['pass']) && isset($_POST['pass-repeat'])) {
        $username = $_POST['gmail'];
        $password = $_POST['pass'];
        $repeat_password = $_POST['pass-repeat'];
        $min_char_limit = 8;
        $max_char_limit = 36;

        if (!filter_var($username, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $username)) {
            echo "<script> alert('Vui lòng nhập một địa chỉ Gmail hợp lệ.');</script>";
        } elseif ($password !== $repeat_password) {
            echo "<script> alert('Mật khẩu và mật khẩu lặp lại không khớp!');</script>";
        } elseif (strlen($password) < $min_char_limit || strlen($password) > $max_char_limit) {
            echo "<script>alert('Mật khẩu phải có độ dài từ {$min_char_limit} đến {$max_char_limit} ký tự.');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (gmail, pass) VALUES (?, ?)";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $username, $hashed_password);
                if ($stmt->execute()) {
                    echo "<script>alert('Đăng ký thành công!');</script>";
                } else {
                    echo "<script>alert('Lỗi khi thực thi câu lệnh SQL: " . $stmt->error . "');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Lỗi khi chuẩn bị câu lệnh SQL: " . $conn->error . "');</script>";
            }
            
            $conn->close();
        }
    } 
}
