<?php
session_start();
require_once 'class/DB.php';
if (isset($_GET['giohang_id'])) {
    $giohang_id = $_GET['giohang_id'];
    $query = "SELECT giohang.*, users.ten AS ten_nguoi_dat, users.sdt AS sdt_nguoi_dat, users.diachi AS diachi_nguoi_dat 
              FROM giohang 
              INNER JOIN users ON giohang.user_id = users.user_id 
              WHERE giohang.giohang_id = $giohang_id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
    $donhang = mysqli_fetch_assoc($result);
    
    $query_detail = "SELECT chitietgiohang.*, sanpham.tensanpham 
                     FROM chitietgiohang 
                     INNER JOIN sanpham ON chitietgiohang.sanpham_id = sanpham.sanpham_id 
                     WHERE giohang_id = $giohang_id";
    $result_detail = mysqli_query($conn, $query_detail);
    if (!$result_detail) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }
} else {
    header("Location: danhsachdonhang.php");
    exit;   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>

<?php include 'class/header.php'?>
<body>
    <div style="margin: 5%;">
    <div class="products-section" >
        <h1>Chi tiết đơn hàng </h1>
        <?php
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    echo '<p><strong>Tên người đặt hàng:</strong> ' . $donhang['ten_nguoi_dat'] . '</p>';
    echo '<p><strong>Số điện thoại người đặt hàng:</strong> ' . $donhang['sdt_nguoi_dat'] . '</p>';
    echo '<p><strong>Địa chỉ người đặt hàng:</strong> ' . $donhang['diachi_nguoi_dat'] . '</p>';
}
?>

        <p><strong>Ngày đặt hàng:</strong> <?php echo $donhang['ngaydat']; ?></p>

      
        <h2>Danh sách sản phẩm trong đơn hàng:</h2>
        <form style="width: 1000px;">
        <table>
            <tr>
                <th style="text-align:right;" width="10%">Tên sản phẩm</th>
                <th style="text-align:right;" width="10%">Số lượng</th>
                <th style="text-align:right;" width="10%">Thành tiền</th>
            </tr>
            <?php
            while ($row_detail = mysqli_fetch_assoc($result_detail)) {
                echo "<tr>";
                echo "<td style=\"text-align:right;\">" . $row_detail['tensanpham'] . "</td>";
                echo "<td style=\"text-align:right;\">" . $row_detail['soluong'] . "</td>";
                echo "<td style=\"text-align:right;\">" . number_format($row_detail['soluong'] * $row_detail['gia'], 0, ',', '.') . " VND</td>";
                echo "</tr>";
                
            }
            ?>
            <tr></tr>
        </table>
        <p style="text-align:right;"><strong>Tổng giá trị:</strong> <?php echo number_format($donhang['tong'], 0, ',', '.') . " VND"; ?></p>
        <p><strong>Trạng thái thanh toán:</strong> </p>
        <p><strong>Trạng thái giao hàng:</strong> </p>
        </form>
    </div>
    </div>
</body>
</html>
