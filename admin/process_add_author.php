<?php
    $tentg = $_POST['txtAuthorName'];

    // ket noi csdl
    require_once 'DB_conn.php';

    //viet lenh sql de them du lieu 
    $themtg = "INSERT INTO tacgia (ten_tgia) VALUES ('$tentg')";
    // xem đã đúng câu lệnh chưa
    // echo $themtg; exit;

    //thuc thi cau lenh them
    if (mysqli_query($conn, $themtg)
    ){
    //in thong bao thanh cong 
    header ("Location: author.php");
    }
    

?>