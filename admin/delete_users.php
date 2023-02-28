<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:../login.php");
}
?>
<?php
    $vid= $_GET['sid'];
    require_once 'DB_con.php';
    $delete_sql="delete from users where id=$vid";
    if (mysqli_query($conn,$delete_sql)){
    echo "<h1>Xoa thanh cong</h1>";
    header("Location: users.php");
    }
?>