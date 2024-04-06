<?php
function loginFromSocialCallBack($socialUser) {
    include 'class/DB.php';
    $result = mysqli_query($con, "SELECT `user_id`, `ten`, `gmail` FROM `users` WHERE `gmail` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $password = 'default_password';
        $result = mysqli_query($con, "INSERT INTO `users` (`ten`, `gmail`, `pass`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', '" . $password . "');");        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "SELECT `user_id`, `ten`, `gmail` FROM `users` WHERE `gmail` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['isUserLoggedIn'] = true;
        $_SESSION['current_user'] = ['user_id' => $user['user_id'], 'ten' => $user['ten']];
   
    }
}
?>
