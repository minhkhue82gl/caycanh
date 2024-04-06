<?php session_start(); ?>

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

<main style="margin: 5%;">
<?php
  require_once("class/dbcontroller.php");

  $db_handle = new DBController();
  
  $sanpham_id = $_GET['sanpham_id'];
  $product_array = $db_handle->runQuery("SELECT * FROM sanpham WHERE sanpham_id = $sanpham_id");
  if (!empty($product_array)) { 
      foreach($product_array as $key => $value) {
  ?>
  <form method="post" action="giohang.php?action=add&sanpham_id=<?php echo $product_array[$key]["sanpham_id"]; ?>">
      <div class="product-info">
          <div itemprop="image">
              <img src="<?php echo $product_array[$key]["cover_image_path"]; ?>" class="product-image">
          </div>
          <div class="product-details">
              <h2 class="product-title"><?php echo $product_array[$key]["tensanpham"]; ?></h2>
              <p class="product-price">Giá: <?php echo number_format($product_array[$key]["gia"], 0, ',', '.') . " VND"; ?></p>
              <p class="product-quantity">Số Lượng: <?php echo $product_array[$key]["soluong"]; ?></p>
              <p class="product-description"><?php echo $product_array[$key]["mieuta"]; ?></p>
              <div class="cart-action" style="display: none;"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></div>
              <input type="submit" value="Thêm Vào Giỏ Hàng" class="btnAddAction" style="    width: 20%;"/>
              <?php 
if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    echo '<a href="class/xoasp.php?sanpham_id=' . $product_array[$key]["sanpham_id"] . '" class="add-to-cart-btn" onclick="return confirm(\'Bạn có chắc muốn xóa sản phẩm này?\');">Xóa sản phẩm</a>';
}
?>
          </div>
      </div>
  </form>
  <?php
      }
  }
  ?>
  <div id="product-grid"  class="products-section" style="margin: 5%">
<h2>Sản Phẩm Khác </h2>
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
</main>

</body>
</html>
