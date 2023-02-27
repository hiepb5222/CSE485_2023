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
        $tentloai = html_escape($_POST ['tentheloai']);
        require_once 'DB_con.php';
        $sql = "INSERT INTO theloai (ten_tloai) VALUES ('$tentloai')";
if (mysqli_query($conn, $sql)) {
        echo"<h5>Thêm thành công" ;

}
        header("Location: category.php")
?>
