<?php session_start();?>
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
<?php include "class/header.php"?>
<body>
<?php
require_once 'class/DB.php';
$query = "SELECT * FROM giohang ORDER BY ngaydat DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>
<div  style="margin: 5%;">
    <h1>Danh sách đơn hàng</h1>
    <table>
        <tr>
            <th style="text-align:left;">ID Đơn hàng</th>
            <th style="text-align:right;" width="10%">Ngày đặt hàng</th>
            <th style="text-align:right;" width="10%">Tổng giá trị</th>
            <th style="text-align:right;" width="15%">Chi tiết đơn hàng</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td style=\"text-align:left;\">" . $row['giohang_id'] . "</td>";
            echo "<td style=\"text-align:right;\">" . $row['ngaydat'] . "</td>";
            echo "<td style=\"text-align:right;\">" . number_format($row['tong'], 0, ',', '.') . " VND</td>";
            echo "<td style=\"text-align:right;\"><button onclick=\"window.location.href='chitietdonhang.php?giohang_id=" . $row['giohang_id'] . "'\">Xem chi tiết</button></td>";

            echo "</tr>";
        }
        ?>
    </table>
    </div>
</body>

</html>
