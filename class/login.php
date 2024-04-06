<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'DB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['gmail']) && isset($_POST['pass'])) {
        $username = $_POST['gmail'];
        $password = $_POST['pass'];

        $sql = "SELECT user_id, gmail, pass FROM users WHERE  gmail = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($user_id, $ten, $hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['isUserLoggedIn'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_info'] = ['user_id' => $user_id, 'ten' => $ten];
                    
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Mật khẩu không chính xác.');</script>";
                }
            }

            $stmt->close();
        } else {
            echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
        }
    } 
}
?>
