<?php
function html_escape($text): string
{

    $text = $text ?? ''; 

    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
}
if (isset($_POST['signbtn'])) {
  // Lay tu FORM
  $id =html_escape( $_POST['sid']);
  $name =html_escape($_POST['txtName']);
  $user = html_escape( $_POST['txtUser']);
  $email = html_escape( $_POST['txtEmail']);
  $pass = html_escape( $_POST['txtPass']);
  $confirm_password = html_escape( $_POST['txtResetPass']);
    
    // Kết nối CSDL
    require_once 'DB_con.php';
    if($conn){
        // Kiểm tra tồn tại trong csdl
        $query = "SELECT * FROM users WHERE username = '$user'";
        $mail = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $resulte =mysqli_query($conn, $mail);
        if (mysqli_num_rows($result) > 0 || mysqli_num_rows($resulte) > 0) {
            // Tài khoản đã tồn tại trong CSDL
            echo "Tài khoản hoặc email đã tồn tại";
            exit();
        }
        else {
          // Kiểm tra mật khẩu trùng khớp
          if ($pass !== $confirm_password) {
            echo "Mật khẩu xác nhận không khớp.";
            exit();
          }
          else{
            echo "Thêm thành công";
            // Hash mật khẩu
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email,username, password) VALUES ('$name', '$email','$user', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
              $message = "Thêm thành công!";
              echo "<script>alert('$message');</script>";
              header("Location:users.php");
            } else {
              echo "Thêm tài khoản thất bại: " . mysqli_error($conn);
            }
          }
        }
      }
        mysqli_close($conn);
  }
?>
