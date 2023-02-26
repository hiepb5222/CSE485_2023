<?php
$matloai=$_POST['txtCatId']; 
$tentloai=$_POST['txtCatName']; 
require_once 'DB_con.php';
$themsql = "UPDATE theloai SET ten_tloai = '$tentloai' WHERE ma_tloai = '$matloai'";

if (mysqli_query($conn,$themsql))
{
    header("Location: category.php");
}

?>