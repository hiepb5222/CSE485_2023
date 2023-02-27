<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:../login.php");
}
?>
<?php
//lay du lieu ma_tgia can xoa
$matgia = $_GET['sid'];
require_once 'DB_conn.php';
$xoatg = "DELETE FROM tacgia WHERE ma_tgia = $matgia";
mysqli_query($conn, $xoatg);
header("Location: author.php")
?>
