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
$matloai=html_escape($_POST['txtCatId']); 
$tentloai=html_escape($_POST['txtCatName']); 
require_once 'DB_con.php';
$themsql = "UPDATE theloai SET ten_tloai = '$tentloai' WHERE ma_tloai = '$matloai'";

if (mysqli_query($conn, $themsql)) {
    header("Location: category.php");
}

?>
