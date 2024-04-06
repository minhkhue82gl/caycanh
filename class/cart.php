
<?php
session_start();
require_once("class/dbcontroller.php");
include "class/user2.php";
$db_handle = new DBController();

function calculateTotalPrice() {
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $total_price += $item["quantity"] * $item["gia"];
    }
    return $total_price;
}
if(isset($_POST["place_order"]) ) {
    if(isset($_SESSION['current_user'])) {
        $user_id = $_SESSION['current_user']['user_id'];
        $ngaydat = date("Y-m-d H:i:s"); 
    $tong = calculateTotalPrice();
    $db_handle->runQuery("INSERT INTO giohang (user_id, ngaydat, tong) VALUES ('$user_id', '$ngaydat', '$tong')");
    $giohang_id = $db_handle->getLastInsertedId(); 

    foreach ($_SESSION["cart_item"] as $item) {
        $sanpham_id = $item['sanpham_id'];
        $soluong = $item['quantity'];
        $gia = $item['gia'];
        $db_handle->runQuery("INSERT INTO chitietgiohang (giohang_id, sanpham_id, soluong, gia) VALUES ('$giohang_id', '$sanpham_id', '$soluong', '$gia')");
    }

    unset($_SESSION["cart_item"]);

    header("Location: giaohang.php");
    exit;
    } elseif(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $ngaydat = date("Y-m-d H:i:s"); 
    $tong = calculateTotalPrice();
    $db_handle->runQuery("INSERT INTO giohang (user_id, ngaydat, tong) VALUES ('$user_id', '$ngaydat', '$tong')");
    $giohang_id = $db_handle->getLastInsertedId(); 

    foreach ($_SESSION["cart_item"] as $item) {
        $sanpham_id = $item['sanpham_id'];
        $soluong = $item['quantity'];
        $gia = $item['gia'];
        $db_handle->runQuery("INSERT INTO chitietgiohang (giohang_id, sanpham_id, soluong, gia) VALUES ('$giohang_id', '$sanpham_id', '$soluong', '$gia')");
    }

    unset($_SESSION["cart_item"]);

    header("Location: giaohang.php");
    exit;
    } 
    
}

if(isset($_SESSION['current_user'])) {
    $user_id = $_SESSION['current_user']['user_id']; 
    $select_query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy người dùng có ID là $user_id.";
    }
    mysqli_close($conn);
} elseif(isset($_SESSION['user_info'])) {
    $user_id = $_SESSION['user_info']['user_id']; 
    $select_query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $select_query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);}
}
?>