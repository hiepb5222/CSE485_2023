<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location:../login.php");
    }
    ?>
    <?php
    function html_escape($text): string
    {
    
        $text = $text ?? ''; 
    
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
    }
    $tentg = html_escape($_POST['txtAuthorName']);
    $hinhtg=html_escape($_FILES['txtHinhanhtgia']['name']);
    $hinhtg_tmp=html_escape($_FILES['txtHinhanhtgia']['tmp_name']);

    // ket noi csdl
    require_once 'DB_con.php';

    //viet lenh sql de them du lieu 
    $themtg = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES ('$tentg','$hinhtg')";
   
    // xem đã đúng câu lệnh chưa
    // echo $themtg; exit;

    //thuc thi cau lenh them
    if (mysqli_query($conn, $themtg)
    ){
        $target='C:/xampp/htdocs/CSE485_2023/images/tacgia/'.basename($_FILES['txtHinhanhtgia']['name']);
        move_uploaded_file($hinhtg_tmp, $target);
    //in thong bao thanh cong 
    header("Location: author.php");
}
    

?>
