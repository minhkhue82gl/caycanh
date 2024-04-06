

<?php
require_once 'DB.php';
include 'google_source.php';
function getUserInfo($conn, $email, $userId) {
  $selectSql = "SELECT user_id, ten, gmail, diachi, sdt FROM users WHERE gmail = ? AND user_id = ?";
  $stmt = $conn->prepare($selectSql);
  $stmt->bind_param("si", $email, $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result && $result->num_rows > 0) {
      $userInfo = $result->fetch_assoc();
      $stmt->close();
      return $userInfo;
  } else {
      return null;
  }
}
$isUserLoggedIn = isset($_SESSION['isUserLoggedIn']) ? $_SESSION['isUserLoggedIn'] : false;
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
function isLoggedIn() {
  return isset($_SESSION['user_id']);
}function isUserAdmin($conn, $userId) {

  $sql = "SELECT * FROM admin WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result && $result->num_rows > 0;
}
if (isLoggedIn()) {
  
  if (isUserAdmin($conn, $_SESSION['user_id'])) {
      $_SESSION['user_role'] = 'admin';
  } else {
      $_SESSION['user_role'] = 'user';
  }


} else {
}

?>
<header>
    <div class="header">
        <div class="logo">
            <a href="index.php" title="Cây cảnh">
        <img src="image/logo-cay-canh.png"  alt=" Cây cảnh "></a>        
     </div>
        <div class="search-bar">
          <input type="text" placeholder="Tìm kiếm...">
        </div>
        <div class="container">
        <ul class="dropdown" style="float:right;">
                <?php if ($isUserLoggedIn) : ?>
        <div onclick="show_hidden_div('member_control');" class="member_profile">
            <img style="width: 70px; /* Adjust width as needed */
  height: 7 0px; /* Adjust height as needed */
  border-radius: 50%; /* Make the image round */
  cursor: pointer;" src="image/6596121.png" alt="Avatar">
        </div>
        <div class="dropdown-content" style="right:0;">
    
    <?php
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
      echo '<a href="addsanpham.php">Thêm Sản Phẩm</a>';
      echo '<a href="quanly.php">Quản Lý Tài Khoản</a>';
      echo '<a href="donhang.php">Đơn hàng</a>';
    }
    ?>
          <a href="dadat.php">Đã đặt</a>

   <a rel="nofollow" href="profile.php">Cài đặt thông tin</a>
    <a rel="nofollow" href="class/logout.php">Đăng xuất</a>

</ul>
        
<?php else : ?>
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Đăng nhập</button>
  <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Đăng ký</button>

<?php endif; ?>
              
          </div>
<div id="id01" class="modal">
<?php require_once 'login.php' ?>

  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="image/6596121.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
    <label for="gmail"><b>Gmail</b></label>
      <input type="text" placeholder="Enter Usergmail" name="gmail" required>

      <label for="pass"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>
        
      <button type="submit">Đăng nhập</button>
     
    </div>
    <div class="container">
    <?php if(isset($authUrl)){ ?>
      <a href="<?= $authUrl ?>" class="google">
        <i class="fa fa-google fa-fw"></i>  Google
      </a>
      <?php } ?>

    
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
    
  </form>
</div>

<div id="id02" class="modal">
<?php require_once 'signup.php' ?>

  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="image/6596121.png" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <label for="gmail"><b>Gmail</b></label>
      <input type="text" placeholder="Enter Username" name="gmail" required>

      <label for="pass"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>
      <label for="pass-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="pass-repeat" required>
      <button type="submit">Đăng ký</button>
    
    </div>

    <div class="container">
    <?php if(isset($authUrl)){ ?>
      <a href="<?= $authUrl ?>" class="google">
        <i class="fa fa-google fa-fw"></i>  Google
      </a>
      <?php } ?>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
    
  </form>
</div>
    
</header>
<nav>
    <ul class="menu">
      <li class="menu-item"><a href="index.php">Trang chủ</a></li>
      <li class="menu-item dropdown">
      <a href="#" class="dropbtn">Sản phẩm</a>
      <div class="dropdown-content">
      <?php
include 'DB.php';
$sql = "SELECT * FROM loai";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<a href="loaisanpham.php?loai_id='. $row["loai_id"] .'">' . $row["tenloai"] . '</a>';
    }
}
?>

      </div>
      </li>
      <li class="menu-item"><a href="#">Giới thiệu</a></li>
      <li class="menu-item"><a href="#">Liên hệ</a></li>
      <li class="menu-item"><a href="giohang.php">Giỏ hàng</a></li>
    </ul>
  </nav>