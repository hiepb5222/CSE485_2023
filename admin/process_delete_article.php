<?php
require_once 'DB_con.php';
$ma_bviet=$_GET['sid']; 
$xoa_sql="DELETE FROM baiviet WHERE ma_bviet=$ma_bviet";
mysqli_query($conn,$xoa_sql);
header("Location: article.php")
?>
