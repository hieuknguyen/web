<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title id ="title">Đăng Nhập</title>
    <link rel="stylesheet" href="style/index.css">
    <script type="text/javascript" src="js/index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link id="favicon" rel="icon" type="image/png" href="https://raw.githubusercontent.com/hieuknguyen/project/main/quacquac.png">
</head>
    <body>
        <header>
            <h2 class="logo">logo</h2>
        <nav class="navigation">
            <?php if(isset($_SESSION['login']['id'])){ echo "<button id=".'"bnt"' . "onclick=".'"seach()"' . ">Chat</button>";} ?>
            <a href="a/test.html">Home</a>
            <a href="About_us.html">About us</a>
            <a href="services.html">services</a>
            <a href="contact.html">contact</a>
            <button onclick="<?php if(isset($_SESSION['login']['id'])){echo "open_user()";}else{ echo "open_login()";} ?>" class="btnlogin"><?php if(isset($_SESSION['login']['id'])){echo "welcom ". $_SESSION['login']['username'];}else{ echo "login";} ?></button>
        </nav>
        </header>
        <div class="wrapper">
            <span onclick="close_login()" class="icon-close">
                <ion-icon onclick="close_login()" name="close"></ion-icon>
            </span>
            <div class="form-box login">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <div class="input-box">
                        <input id="input_username" name="username" required>
                        <label >Username</label>
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="input-box">
                        <input id="input_password" type="password" name="password" required>
                        <label >Password</label>
                        <span class="icon">
                            <ion-icon class="locks" id="locks" name="lock-closed-outline" onclick="hidden_show()"></ion-icon>
                            <ion-icon class="show" id="show" name="lock-open-outline" onclick="hidden_show()"></ion-icon>
                        </span>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox"> Remember me
                        </label>
                        <a href="#">Forgot Password</a>
                    </div>
                    <button id="bnt" type="submit" class="btn" onclick="check()">Đăng nhập
                    </button>
                    <div class="login-register">
                        <p>Bạn không có tài khoản đăng nhập?
                            <button id="bnt" type="button" class="register-link" onclick="dangki()">Đăng kí</button>
                        </p>
                    </div>
                </form>
            </div>
            <div class="form-box register" style="display:none">
                <h2>register</h2>
                <form action="register.php" method="post">
                    <div class="input-box">
                        <input id="input_username" name="input_username" required>
                        <label >Username</label>
                        <p class="data-item" id="pass_username"></p><br>
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                    </div>
                    <div class="input-box">
                        <input id="input_password" type="password" name="input_password" required><br>
                        <label >password</label>
                        
                        <p class="data-item" id="check_pass"></p><br>

                        <span class="icon">
                            <ion-icon class="locks" id="locks" name="lock-closed-outline" onclick="hidden_show()"></ion-icon>
                            <ion-icon class="show" id="show" name="lock-open-outline" onclick="hidden_show()"></ion-icon>
                        </span>
                    </div>
                    <div class="input-box">
                        <input id="input_password1" name="input_password1" type="password" required><br>
                        <label id="Re_enter_the_password">Re-enter password</label>
                        <p class="data-item" id="check_pass1"></p><br>
                        <span class="icon">
                            <ion-icon class="locks" id="locks" name="lock-closed-outline" onclick="hidden_show()"></ion-icon>
                            <ion-icon class="show" id="show" name="lock-open-outline" onclick="hidden_show()"></ion-icon>
                        </span>
                    </div>
                    <button id="bnt" onclick="register1()">Đăng kí</button>
                    <div class="login-register">
                    <p>Bạn đã có tài khoản đăng nhập?
                        <button id="bnt" type="button" class="register-link" onclick="dangnhap()">Đăng nhập</button>
                    </p>
                    </div>
                </form>
            </div>
            <div class="form-box user" style="display:none;">
                <h2><?php if(isset($_SESSION['login']['id'])){ echo "welcom ". $_SESSION['login']['username'];} ?></h2>
                <button id="bnt" type="button" onclick="logout()" > logout </button>
            </div>
        </div>
        <div class="seach" style="position: absolute; background-color:rgb(0,0,0,0);backdrop-filter: blur(20px); ;width:400px;height:400px; display:none; bottom:0%; right:0%">
        <form action="" method="post">
            <div class="input-box">
                <input id="input_password" type="text" name="seach" required>
                <label >Seach Name</label>
                <input  id="bnt" type="submit" value="seach">
            </div>
        </form>
        </div>   
        <div class="chat">
            <div class="a">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $seach = mysqli_real_escape_string($conn, $_POST['seach']);
                    $sql = "SELECT * FROM account WHERE UserName = '$seach'";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo "<script>chat();</script>";
                        $row = mysqli_fetch_assoc($result);
                        $user = $_SESSION['login']['id'];
                        $receiver = $row['user_id'];
                        $sql = "SELECT * FROM messages
                            WHERE (sender_id = $user AND receiver_id = $receiver) 
                            OR (sender_id = $receiver AND receiver_id = $user)
                            ORDER BY sent_at ASC;";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {?>
                            <div id="<?php echo 'messages_id_' . $row['messages_id']; ?>" name="<?php if ($row['sender_id'] == $user){echo "me";}else if($row['sender_id'] == $receiver){echo "you";}?>"><p id="<?php echo 'messages_id_p_' . $row['messages_id']; ?>"><?php echo $row['message']; ?> </p></div>
                            <?php if($row['sender_id'] == $user){ 
                                echo "<script>hi(" . $row['messages_id'] . ")</script>";
                            } ?>
                        <?php } ?>
                    <?php } ?>

                <?php } ?>
            </div>
            <div class="send">
                <form action="send_message.php" method="post">
                    <input type="text" name="message" id="message" autocomplete="off">
                    <input type="submit" id="bnt" value="" >
                </form>
            </div>
    
        </div>

    </body>
   
</html>
<script type="text/javascript" src="js/index.js"></script>


