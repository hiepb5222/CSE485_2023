<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'sendmail.php';
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
  $pass = html_escape($_POST['txtPass']);
  $confirm_password = html_escape($_POST['txtResetPass']);


  // Kết nối CSDL
  require_once 'DB_con.php';
  if ($conn) {
    // Kiểm tra tồn tại trong csdl
    $query = "SELECT * FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      // Tài khoản đã tồn tại trong CSDL
      echo "Tài khoản đã tồn tại";
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

                  if (send($email)) {
                    // Hash mật khẩu
                    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (name, email,username, password) VALUES ('$name', '$email','$user', '$hashed_password')";
                    if (mysqli_query($conn, $sql)) {
                      $message = "Đăng ký thành công!";
                      echo "<script>alert('$message');</script>";
                      header("Location:login.php");
                      exit();
                    } else {
                      echo "Đăng ký tài khoản thất bại: " . mysqli_error($conn);
                    }
                  } else {
                    echo "Email could not be sent.";
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  mysqli_close($conn);
}
