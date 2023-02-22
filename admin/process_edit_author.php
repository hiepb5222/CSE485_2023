<?php
    $matg = $_POST['txtAuthorId'];
    $tentg = $_POST['txtAuthorName'];

    // ket noi csdl
    require_once 'DB_conn.php';

    //viet lenh sql de them du lieu 
    $suatg = "UPDATE tacgia SET ten_tgia = '$tentg' WHERE ma_tgia = '$matg'";
    // xem đã đúng câu lệnh chưa
    // echo $themtg; exit;

    //thuc thi cau lenh them
    if (mysqli_query($conn, $suatg)
    ){
    //in thong bao thanh cong 
    header ("Location: author.php");
    }
    

?>