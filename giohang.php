<?php
session_start();
require_once("class/dbcontroller.php");
$db_handle = new DBController();

function addToCart($productByid, $quantity) {
    $itemArray = array(
        $productByid[0]["sanpham_id"] => array(
            'tensanpham' => $productByid[0]["tensanpham"],
            'sanpham_id' => $productByid[0]["sanpham_id"],
            'quantity' => $quantity,
            'gia' => $productByid[0]["gia"],
            'cover_image_path' => $productByid[0]["cover_image_path"]
        )
    );
    
    if (!empty($_SESSION["cart_item"])) {
        if (array_key_exists($productByid[0]["sanpham_id"], $_SESSION["cart_item"])) {
            $_SESSION["cart_item"][$productByid[0]["sanpham_id"]]["quantity"] += $quantity;
        } else {
            $_SESSION["cart_item"] += $itemArray;
        }
    } else {
        $_SESSION["cart_item"] = $itemArray;
    }
}

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productByid = $db_handle->runQuery("SELECT * FROM sanpham WHERE sanpham_id='" . $_GET["sanpham_id"] . "'");
                if ($_POST["quantity"] > $productByid[0]["soluong"]) {
                    header("Location: chitiet.php?sanpham_id=" . $_GET["sanpham_id"] . "&error=insufficient_quantity");
                    exit;
                }
                addToCart($productByid, $_POST["quantity"]);
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["sanpham_id"] == $k)
                        unset($_SESSION["cart_item"][$k]);				
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $sanpham_id => $quantity) {
        $productByid = $db_handle->runQuery("SELECT soluong FROM sanpham WHERE sanpham_id='" . $sanpham_id . "'");
        $available_quantity = $productByid[0]["soluong"];

        if (filter_var($quantity, FILTER_VALIDATE_INT) && $quantity > 0 && $quantity <= $available_quantity) {
            $_SESSION['cart_item'][$sanpham_id]['quantity'] = $quantity;
        } elseif ($quantity > $available_quantity) {
            $_SESSION['cart_item'][$sanpham_id]['quantity'] = $available_quantity;
        } elseif ($quantity == 0) {
            unset($_SESSION['cart_item'][$sanpham_id]);
        }
    }
    header('Location: giohang.php');
    exit;
}


function calculateTotalPrice() {
    $total_price = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $total_price += $item['quantity'] * $item['gia'];
    }
    return $total_price;
}
if(isset($_POST["dathang"])) {
    header('Location: vnpay_pay2.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="style/cart_style.css" type="text/css" rel="stylesheet" />
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
	
    <?php include "class/header.php"; ?>
    <div id="shopping-cart">
        <div class="txt-heading">Giỏ hàng</div>
        <a id="btnEmpty" href="giohang.php?action=empty">Xóa giỏ hàng</a>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
        ?>	
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
		<form method="post" action="giohang.php">
        <tr>
        <th style="text-align:left;">Tên Sản Phẩm</th>
        <th style="text-align:right;" width="5%">Số Lượng</th>
        <th style="text-align:right;" width="10%">Giá</th>
        <th style="text-align:right;" width="10%">Tạm Tính</th>
        <th style="text-align:center;" width="5%">Xóa</th>
        </tr>	
        <?php		
        foreach ($_SESSION["cart_item"] as $item){
            $item_price = $item["quantity"] * $item["gia"];
        ?>
        <tr>
        <td><img src="<?php echo $item["cover_image_path"]; ?>" class="cart-item-image" /><?php echo $item["tensanpham"]; ?></td>
        <td style="text-align:right;">
                <input type="number" name="quantity[<?php echo $item['sanpham_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="product-quantity" />
        </td>
        <td style="text-align:right;"><?php echo number_format($item["gia"], 0, ',', '.') . " VND"; ?></td>
        <td style="text-align:right;"><?php echo number_format($item_price, 0, ',', '.') . " VND"; ?></td>
        <td style="text-align:center;">
           
			<a href="giohang.php?action=remove&sanpham_id=<?php echo $item["sanpham_id"]; ?>" class="btnRemoveAction">
        <img src="image/icon-delete.png" class="cart-item-image" alt="Remove Item"/>
    </a>
        </td>
        </tr>
        <?php
            $total_quantity += $item["quantity"];
            $total_price += $item_price;
        }
        ?>
        <tr>
        <td colspan="2" align="right">Tổng cộng:</td>
        <td align="right"><?php echo $total_quantity; ?></td>
        <td align="right" colspan="2"><strong><?php echo number_format($total_price, 0, ',', '.') . " VND"; ?></strong></td>
        </tr>
		<tr >
		<td colspan="3"><input type="submit" name="update_cart" value="Cập nhật" /></td>
		<td colspan="3"><a href="vnpay_pay2.php"><input type="submit" name="dathang" value="Dặt Hàng" /></a></td>

		</tr>
		</form>
        </tbody>
        </table>		
        <?php
        } else {
        ?>
        <div class="no-records">Giỏ hàng của bạn đang trống</div>
        <?php 
        }
        ?>
    </div>
	
<div id="product-grid"  class="products-section" style="margin: 5%">
<h2>Sản Phẩm </h2>
	<?php
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
</body>
</html>
