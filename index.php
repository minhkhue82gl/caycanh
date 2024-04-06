<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cây Xanh</title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
  
<?php include 'class/header.php'?>

<div class="slideshow-container">
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="image/72-the-cay-canh-bonsai-dep.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="image/Z4021725435264_B096c.jpg" style="width:100%">
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="image/qe.jpg" style="width:100%">
</div>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
<div style="margin: 5%;">
<div id="product-grid"  class="products-section">
<h2>Sản Phẩm </h2>
	<?php
  require_once("class/dbcontroller.php");

  $db_handle = new DBController();

	$product_array = $db_handle->runQuery("SELECT * FROM sanpham ORDER BY sanpham_id ASC"); 
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
	<div class="product">
	<form method="post" action="giohang.php?action=add&sanpham_id=<?php echo $product_array[$key]["sanpham_id"]; ?>">
		

			<a href="chitiet.php?sanpham_id=<?php echo $product_array[$key]["sanpham_id"]; ?>">
			<img src="<?php echo $product_array[$key]["cover_image_path"]; ?>">
			</a>
			<div class="product-info" style="flex-direction: column; margin-left: 10px;">
			<div class="product-name"><a href="chitiet.php?sanpham_id=<?php echo $product_array[$key]["sanpham_id"]; ?>" class="product-name"><?php echo  $product_array[$key]["tensanpham"]; ?></a></div>
			<div class="discounted-price"><?php echo number_format($product_array[$key]["gia"], 0, ',', '.') . " VND"; ?></div>
			<div class="cart-action" style="display: none;"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></div>
			<input type="submit" value="Thêm Vào Giỏ Hàng" class="btnAddAction" />
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</div>
</body>
</html> 
