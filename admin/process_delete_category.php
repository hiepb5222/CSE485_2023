<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:../login.php");
}
?>
<?php
$ma_tloai=$_GET['sid']; 
require_once 'DB_con.php';
$xoa_sql="DELETE FROM theloai WHERE ma_tloai=$ma_tloai";
mysqli_query($conn, $xoa_sql);
header("Location: category.php")
?>
