<?php session_start();
if(!isset($_SESSION['isUserLoggedIn']) || !$_SESSION['isUserLoggedIn'] || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
    <style>
        .container {
    width: 80%;
    margin: auto;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
}

.user-table th, .user-table td {
    padding: 8px;
    border: 1px solid #ddd;
}

.user-table th {
    background-color: #f2f2f2;
    text-align: left;
}

.user-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.user-table tr:hover {
    background-color: #ddd;
}
    </style>
</head>
<body>
<?php include 'class/header.php'?>
<?php include 'class/user.php'?>

<main class="container">
    <div class="product-info">
        <table class="user-table">
            <tr>
                <th>User ID</th>
                <th>Gmail</th>
                <th>Tên</th>
                <th>Địa chỉ</th>
                <th>Số Điện Thoại</th>
            </tr>
            <?php
            require_once 'class/DB.php';

            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["gmail"] . "</td>";
                    echo "<td>" . $row["ten"] . "</td>";
                    echo "<td>" . $row["diachi"] . "</td>";
                    echo "<td>" . $row["sdt"] . "</td>";
                    echo "<td><a href='class/xoauser.php?user_id=" . $row["user_id"] . "'>Xóa</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Không có dữ liệu.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</main>


</body>
</html>
