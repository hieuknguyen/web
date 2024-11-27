<?php
    $server = 'localhost';
    $user = 'root';//mejcom_hieu';
    $pass = '';//Hieuknguyen439@';
    $database = 'mejcom_project';
    $conn = new mysqli($server, $user, $pass, $database);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    } else {
        $conn->set_charset("utf8");
        
    }
?>
