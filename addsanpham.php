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
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Thêm sản Phẩm </title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
 <?php include'class/header.php'?>
  <main style="margin: 5%;">
   
        <h2> Thêm sản phẩm </h2>
        <form action="class/themsanpham.php" method="post" enctype="multipart/form-data">
    <label for="tensanpham">Tên Sản Phẩm:</label>
    <input type="text" name="tensanpham" required>
    <label for="cover_image">Hình Ảnh:</label>
    <input type="file"name="cover_image" accept=".jpg, .png" required>
    <label  for="mieuta">Nội dung:</label>
    <textarea name="mieuta" rows="4" style="width: 100%;" required></textarea>
    <label for="gia">Giá:</label>
    <input type="number" name="gia" min="0" required>
    <label for="soluong">Số Lượng:</label>
    <input type="number"name="soluong" min="0" required>
    <label for="sanpham_loai[]">Loại Sản Phẩm:</label>
    <select  name="loai_id[]" required>
        <option value="">Chọn loại sản phẩm</option> 
       <?php include 'class/loai.php'?>
    </select>
    <input type="submit" value="Thêm Sản Phẩm">
</form>
  </main>

</body>
</html> 