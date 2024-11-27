<?php
include "connect.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $web = mysqli_real_escape_string($conn, $_POST['web']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM account WHERE UserName = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $use = isset($_POST['username']) ? $_POST['username'] : ''; 
        $_SESSION['login']['username'] = $use; 
        $_SESSION['login']['id'] = $row['user_id'];
        $_SESSION['login']['role'] = $row['role'];
        echo $_SESSION['login']['username'];
        if ($web != '') {
            header("Location: $web");
            exit;
        }
        else{
            header("Location: index.php");
            exit;
        }
        
    } else {
        header("Location: login.php?status=false");
    }
}

?>