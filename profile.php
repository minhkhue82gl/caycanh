
<?php
session_start();
require_once 'class/DB.php';
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tensanpham; ?></title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include 'class/header.php'?>
<?php include 'class/user.php'?>
<div style="margin: 5%">
<main class="container">
    <form method="post">
        <div >
            <div >
            <label for="ten">Tên:</label><br>
<input type="text" id="ten" name="ten" value="<?php echo isset($user['ten']) ? $user['ten'] : ''; ?>"><br>

<label for="gmail">Email:</label><br>
<input type="text" id="gmail" name="gmail" value="<?php echo isset($user['gmail']) ? $user['gmail'] : ''; ?>" readonly><br>

<label for="diachi">Địa chỉ:</label><br>
<input type="text" id="diachi" name="diachi" value="<?php echo isset($user['diachi']) ? $user['diachi'] : ''; ?>"><br>

<label for="sdt">Số điện thoại:</label><br>
<input type="text" id="sdt" name="sdt" value="<?php echo isset($user['sdt']) ? $user['sdt'] : ''; ?>"><br><br>

<input type="submit" name="submit" value="Cập nhật">

            </div>
        </div>
    </form>
</main>
</div>
</body>
</html>