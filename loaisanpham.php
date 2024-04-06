<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1</title>
    <script async="" src="JS/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>
<body>
  <?php include 'class/header.php'?>

<div style="margin: 5%">
    <div class="products-section">
        <h2>Sản Phẩm </h2>
        <?php
        require_once("class/dbcontroller.php");

        $db_handle = new DBController();
        $loai_id = isset($_GET['loai_id']) ? $_GET['loai_id'] : 0;
        $sql = "SELECT sp.* 
                FROM sanpham sp 
                INNER JOIN sanpham_loai spl ON sp.sanpham_id = spl.sanpham_id 
                WHERE spl.loai_id = ?";


        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $loai_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($product_array = $result->fetch_assoc()) {
                    ?>
                    <div class="product">
                        <form method="post" action="giohang.php?action=add&sanpham_id=<?php echo $product_array["sanpham_id"]; ?>">
                            <a href="chitiet.php?sanpham_id=<?php echo $product_array["sanpham_id"]; ?>">
                                <img src="<?php echo $product_array["cover_image_path"]; ?>">
                            </a>
                            <div class="product-info" style="flex-direction: column; margin-left: 10px;">
                                <div class="product-name">
                                    <a href="chitiet.php?sanpham_id=<?php echo $product_array["sanpham_id"]; ?>" class="product-name"><?php echo  $product_array["tensanpham"]; ?></a>
                                </div>
                                <div class="discounted-price"><?php echo number_format($product_array["gia"], 0, ',', '.') . " VND"; ?></div>
                                <div class="cart-action" style="display: none;"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /></div>
                                <input type="submit" value="Thêm Vào Giỏ Hàng" class="btnAddAction" />
                            </div>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "Không có sản phẩm nào.";
            }
            $stmt->close();
        } else {
            echo "Lỗi: " . $conn->error;
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
