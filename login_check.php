<?php
session_start();
require_once './admin/DB_con.php';

if (isset($_POST['submit'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username='$username'";
   $rs = mysqli_query($conn, $sql);

   if (mysqli_num_rows($rs) > 0) {
    $row = mysqli_fetch_assoc($rs);
    $pass_hash = $row['password'];
    $role = $row['is_admin'];
    if ($pass_hash==$password) {
        if($role =='1'){
          $_SESSION['admin'] = $username;

      header("location:admin/index.php");}
      
    } else {
      echo 'mật khẩu không chính xác';
    }
  }

}