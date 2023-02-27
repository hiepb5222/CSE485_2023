<?php
//lay du lieu ma_tgia can xoa
$matgia = $_GET['sid'];
require_once 'DB_con.php';
$xoatg = "DELETE FROM tacgia WHERE ma_tgia = $matgia";
mysqli_query($conn, $xoatg);
header("Location: author.php")
?>
