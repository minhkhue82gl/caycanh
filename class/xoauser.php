<?php
require_once 'DB.php';

$user_id_to_delete = $_GET['user_id']; 
$sql = "DELETE FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id_to_delete);

if ($stmt->execute()) {
    echo '<script>window.location.href = "../quanly.php";</script>';

} else {
    echo "Xóa tài khoản thất bại: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
