<?php
require_once 'DB_con.php';
    $matg = $_POST['txtAuthorId'];
    $tentg = $_POST['txtAuthorName'];
    $sql_up = "SELECT hinh_tgia FROM tacgia WHERE ma_tgia = '$matg'";
    $result_up = mysqli_query($conn, $sql_up);
    $row_up=mysqli_fetch_assoc($result_up);
    if($_FILES['txtHinhanhtgia']['name']=='') {
        $hinhtg= $row_up['hinh_tgia'];
    }
    else{
        $hinhtg=$_FILES['txtHinhanhtgia']['name'];
        $hinhtg_tmp=$_FILES['txtHinhanhtgia']['tmp_name'];
        $target='C:/xampp/htdocs/CSE485_2023/images/tacgia/'.basename($_FILES['txtHinhanhtgia']['name']);
        move_uploaded_file($hinhtg_tmp, $target);
    }

    // ket noi csdl
    require_once 'DB_con.php';

    //viet lenh sql de them du lieu 
    $suatg = "UPDATE tacgia SET ten_tgia = '$tentg',hinh_tgia = '$hinhtg' WHERE ma_tgia = '$matg'";
    // xem đã đúng câu lệnh chưa
    // echo $themtg; exit;

    //thuc thi cau lenh them
    if (mysqli_query($conn, $suatg)
    ){
    //in thong bao thanh cong 
    header ("Location: author.php");
    }
    

?>
