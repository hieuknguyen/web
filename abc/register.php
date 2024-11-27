
<?php
include "connect.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $web = mysqli_real_escape_string($conn, $_POST['web']);
    $username = mysqli_real_escape_string($conn, $_POST['input_username']);
    $password = mysqli_real_escape_string($conn, $_POST['input_password']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['input_password1']);

    $sql = "SELECT * FROM account WHERE UserName = '$username'";
    $result = mysqli_query($conn, $sql);
    mysqli_num_rows($result);
    if(mysqli_num_rows($result) > 0){
        echo "tên người dùng đã tồn tại!";
    }
    else if($password != $password_1){
        echo "không đúng mật khẩu";
    }
    else{
        $sql = "INSERT INTO account (UserName, Password, created_at, update_at, role) 
            VALUES ('$username', '$password', NOW(), NOW(), 'user')";
        if (mysqli_query($conn, $sql)) {
            $sql = "SELECT * FROM account WHERE UserName = '$username' AND Password = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login']['username'] = $row['UserName']; 
            $_SESSION['login']['id'] = $row['user_id'];
            $_SESSION['login']['role'] = $row['role'];
            header("Location: index.php");
        }else{
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>