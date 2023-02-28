<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:../login.php");
}
?>
<?php
$namebandau = html_escape($_POST['txtName']);
$userbandau = html_escape($_POST['txtUser']);
$passbandau = html_escape($_POST['txtPass']);
function html_escape($text): string
{

  $text = $text ?? '';

  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
}
if (isset($_POST['signbtn'])) {
  // Lay tu FORM

  $id = html_escape($_POST['sid']);
  $name = html_escape($_POST['txtName']);
  $user = html_escape($_POST['txtUser']);
  $email = html_escape($_POST['txtEmail']);
  $pass = ($_POST['txtPass']);
  $confirm_password = ($_POST['txtResetPass']);
  // Kết nối CSDL
  require_once 'DB_con.php';
  if ($namebandau !== $name || $userbandau !== $user || $pass !== $passbandau) {
    $sqll = "delete from users where id=$id";
    mysqli_query($conn, $sqll);
    $query = "SELECT * FROM users WHERE username = '$user'";
    $mail = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      // Tài khoản đã tồn tại trong CSDL
      $message = "Tài khoản đã tồn tại!";
      echo "<script>alert('$message');</script>";
      exit();
    } else {
      // Kiểm tra mật khẩu trùng khớp
      if ($pass !== $confirm_password) {
        echo "Mật khẩu xác nhận không khớp.";
        exit();
      } else {
        if (preg_match('/[^\x00-\x7F]/', $user)) {
          echo "Không được nhập dấu";
        } else {
          if (strlen($name) > 50) {
            echo "Tài khoản không quá 50 ký tự";
          } else {
            if (strlen($email) > 50) {
              echo "Email không quá 50 ký tự";
            } else {
              if (strlen($user) > 20) {
                echo "User không quá 20 ký tự";
              } else {
                if (strlen($pass) > 50) {
                  echo "Pass không quá 20 ký tự";
                } else {
                  echo "Sửa thành công";
                  $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                  $sql = "INSERT INTO users (name, email,username, password) VALUES ('$name', '$email','$user', '$hashed_password')";
                  if (mysqli_query($conn, $sql)) {
                    header("Location: users.php");
                  } else {
                    echo "Sửa tài khoản thất bại: ";
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  else{
    header("Location: users.php");
  }
}
